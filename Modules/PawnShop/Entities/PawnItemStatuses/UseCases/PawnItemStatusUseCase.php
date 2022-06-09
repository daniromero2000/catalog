<?php

namespace Modules\PawnShop\Entities\PawnItemStatuses\UseCases;

use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\PawnShop\Entities\PawnItemStatuses\Exceptions\PawnItemStatusNotFoundException;
use Modules\PawnShop\Entities\PawnItemStatuses\Exceptions\CreatePawnItemStatusErrorException;
use Modules\PawnShop\Entities\PawnItemStatuses\Exceptions\DeletingPawnItemStatusErrorException;
use Modules\PawnShop\Entities\PawnItemStatuses\Repositories\PawnItemStatusRepository;
use Modules\PawnShop\Entities\PawnItemStatuses\Repositories\Interfaces\PawnItemStatusRepositoryInterface;
use Modules\PawnShop\Entities\PawnItemStatuses\UseCases\Interfaces\PawnItemStatusUseCaseInterface;

class PawnItemStatusUseCase implements PawnItemStatusUseCaseInterface
{
    private $toolsInterface, $pawnItemStatusInterface, $module;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        PawnItemStatusRepositoryInterface $pawnItemStatusRepositoryInterface
    ) {
        $this->toolsInterface          = $toolRepositoryInterface;
        $this->pawnItemStatusInterface = $pawnItemStatusRepositoryInterface;
        $this->module                  = 'Estados Items Compraventa';
    }

    public function listPawnItemStatuses(array $data): array
    {
        $searchData = $this->toolsInterface->setSearchParametersRefactor($data);
        $searchData['q'] = $searchData['q'] == '' ? null : $searchData['q'];

        return [
            'data' => [
                'datas'         => $this->pawnItemStatusInterface->searchPawnItemStatus($searchData['q'], $searchData['skip'] * 10, $searchData['fromOrigin'], $searchData['toOrigin']),
                'optionsRoutes' => config('generals.optionRoutes'),
                'module'        => $this->module,
                'headers'       => ['ID', 'Nombre', 'Color',  'Estado', 'Opciones'],
                'skip'          => 0
            ],
            'search'  =>  $searchData['search']
        ];
    }

    public function createPawnItemStatus()
    {
        return [
            'optionsRoutes' => config('generals.optionRoutes'),
            'module'        => $this->module
        ];
    }

    public function storePawnItemStatus($requestData)
    {
        $this->pawnItemStatusInterface->createPawnItemStatus($requestData);

        return redirect()->route('admin.pawn-item-statuses.index')
            ->with('message', config('messaging.create'));
    }

    public function updatePawnItemStatus($requestData, $id)
    {
        $update = new PawnItemStatusRepository($this->pawnItemStatusInterface->findPawnItemStatusById($id));
        $update->updatePawnItemStatus($requestData);

        return redirect()->route('admin.pawn-item-statuses.index')
            ->with('message', config('messaging.update'));
    }

    public function destroyPawnItemStatus($id)
    {
        $this->pawnItemStatusInterface->findPawnItemStatusById($id)->delete();

        return redirect()->route('admin.pawn-item-statuses.index')
            ->with('message', config('messaging.delete'));
    }
}
