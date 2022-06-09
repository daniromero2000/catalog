<?php

namespace Modules\CamStudio\Entities\Fouls\UseCases;

use Carbon\Carbon;
use Modules\CamStudio\Entities\Fouls\Repositories\FoulRepository;
use Modules\CamStudio\Entities\Fouls\Repositories\Interfaces\FoulRepositoryInterface;
use Modules\CamStudio\Entities\Fouls\UseCases\Interfaces\FoulUseCaseInterface;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;

class FoulUseCase implements FoulUseCaseInterface
{
    private $foulInterface, $toolsInterface, $module;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        FoulRepositoryInterface $foulRepositoryInterface
    ) {
        $this->toolsInterface = $toolRepositoryInterface;
        $this->foulInterface  = $foulRepositoryInterface;
        $this->module         = 'Faltas';
    }

    public function listFouls(array $data): array
    {
        $searchData = $this->toolsInterface->setSearchParameters($data);

        if ($searchData['q'] != '' && ($searchData['fromOrigin'] == '' || $searchData['toOrigin'] == '')) {
            $list     = $this->foulInterface->searchFoul($searchData['q'], $searchData['skip'] * 10);
            $paginate = $this->foulInterface->countFoul($searchData['q'], '');
            $searchData['search'] = true;
        } elseif (($searchData['q'] != '' || $searchData['fromOrigin'] != '' || $searchData['toOrigin'] != '')) {
            $from     = $searchData['fromOrigin'] != '' ? $searchData['fromOrigin'] : Carbon::now()->subMonths(1);
            $to       = $searchData['toOrigin'] != '' ? $searchData['toOrigin'] : Carbon::now();
            $list     = $this->foulInterface->searchFoul($searchData['q'], $searchData['skip'] * 10, $from, $to);
            $paginate = $this->foulInterface->countFoul($searchData['q'], $from, $to);
            $searchData['search'] = true;
        } else {
            $paginate = $this->foulInterface->countFoul(null);
            $list     = $this->foulInterface->listFouls($searchData['skip'] * 10);
        }

        $getPaginate  = $this->toolsInterface->getPaginate($paginate, $searchData['skip']);

        return [
            'data' => [
                'fouls'                 => $list,
                'optionsRoutes'         => config('generals.optionRoutes'),
                'module'                => $this->module,
                'headers'               => ['Id', 'Nombre', 'Descripción', 'Costo (COP)', 'Acciones'],
                'skip'                  => $searchData['skip'],
                'paginate'              => $getPaginate['paginate'],
                'position'              => $getPaginate['position'],
                'page'                  => $getPaginate['page'],
                'limit'                 => $getPaginate['limit']
            ],
            'search'  =>  $searchData['search']
        ];
    }

    public function createFoul()
    {
        return  [
            'module'        => $this->module,
            'optionsRoutes' => config('generals.optionRoutes')
        ];
    }

    public function storeFoul(array $requestData)
    {
        $this->foulInterface->createFoul($requestData);
    }

    public function updateFoul($request, int $id)
    {
        $update = new FoulRepository($this->getFoul($id));
        $update->updateFoul($request->except('_token', '_method'));
    }

    public function destroyFoul(int $id)
    {
        $update = new FoulRepository($this->getFoul($id));
        $update->deleteFoul();
    }

    private function getFoul(int $id)
    {
        return $this->foulInterface->findFoulById($id);
    }
}
