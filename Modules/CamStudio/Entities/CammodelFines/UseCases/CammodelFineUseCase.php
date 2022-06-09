<?php

namespace Modules\CamStudio\Entities\CammodelFines\UseCases;

use Carbon\Carbon;
use Modules\CamStudio\Entities\CammodelFines\CammodelFine;
use Modules\CamStudio\Entities\CammodelFines\Repositories\CammodelFineRepository;
use Modules\CamStudio\Entities\CammodelFines\Repositories\Interfaces\CammodelFineRepositoryInterface;
use Modules\CamStudio\Entities\CammodelFines\UseCases\Interfaces\CammodelFineUseCaseInterface;
use Modules\CamStudio\Entities\Cammodels\Repositories\Interfaces\CammodelRepositoryInterface;
use Modules\CamStudio\Entities\Fouls\Repositories\Interfaces\FoulRepositoryInterface;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;

class CammodelFineUseCase implements CammodelFineUseCaseInterface
{
    private $cammodelFineInterface, $toolsInterface, $module, $cammodelInterface;
    private $foulInterface;

    public function __construct(
        ToolRepositoryInterface         $toolRepositoryInterface,
        CammodelFineRepositoryInterface $cammodelFineRepositoryInterface,
        CammodelRepositoryInterface     $cammodelRepositoryInterface,
        FoulRepositoryInterface         $foulRepositoryInterface
    ) {
        $this->toolsInterface        = $toolRepositoryInterface;
        $this->cammodelFineInterface = $cammodelFineRepositoryInterface;
        $this->cammodelInterface     = $cammodelRepositoryInterface;
        $this->foulInterface         = $foulRepositoryInterface;
        $this->module                = 'Multas de modelos';
    }

    public function listCammodelFines(array $data): array
    {
        $searchData      = $this->toolsInterface->setSearchParametersRefactor($data);
        $searchData['q'] = $searchData['q']  == '' ? null : $searchData['q'];

        if (auth()->guard('employee')->user()->hasRole('studio_admin|studio_manager|subsidiary_supervisor')) {
            $subsidiaryId = auth()->guard('employee')->user()->subsidiary_id;
            $list     = $this->cammodelFineInterface->searchSubsidiaryCammodelFine($searchData['q'], $subsidiaryId, $searchData['fromOrigin'], $searchData['toOrigin']);
        } else {
            $list     = $this->cammodelFineInterface->searchCammodelFine($searchData['q'], $searchData['fromOrigin'], $searchData['toOrigin']);
        }

        return [
            'data' => [
                'cammodelFines' => $list,
                'fouls'         => $this->foulInterface->getAllFoulNames(),
                'optionsRoutes' => config('generals.optionRoutes'),
                'module'        => $this->module,
                'headers'       => ['Modelo', 'Falta', 'Fecha', 'Aprobada', 'Acciones']
            ],
            'search'  =>  $searchData['search']
        ];
    }

    public function createCammodelFine(): array
    {
        return  [
            'cammodels'     => $this->cammodelInterface->getAllCammodels(),
            'fouls'         => $this->foulInterface->getAllFoulNames(),
            'module'        => $this->module,
            'optionsRoutes' => config('generals.optionRoutes')
        ];
    }

    public function storeCammodelFine(array $requestData): CammodelFine
    {
        return $this->cammodelFineInterface->createCammodelFine($requestData);
    }

    public function updateCammodelFine($requestData, int $cammodelFineId): void
    {
        $this->getCammodelFineRepository($cammodelFineId)->updateCammodelFine($requestData);
    }

    public function destroyCammodelFine(int $cammodelFineId): void
    {
        $this->getCammodelFineRepository($cammodelFineId)->deleteCammodelFine();
    }

    private function getCammodelFineRepository(int $cammodelFineId): CammodelFineRepository
    {
        return new CammodelFineRepository($this->getCammodelFine($cammodelFineId));
    }

    private function getCammodelFine(int $cammodelFineId): CammodelFine
    {
        return $this->cammodelFineInterface->findCammodelFineById($cammodelFineId);
    }

    public function getAllNotAvailableFouls(): array
    {
        $idsCollection = $this->cammodelFineInterface->getNotAvailableFouls(Carbon::now()->format('Y-m-d'));
        $ids_array = [];

        foreach ($idsCollection as $value) {
            array_push($ids_array, [$value->foul_id, $value->cammodel_id]);
        }

        return $ids_array;
    }
}
