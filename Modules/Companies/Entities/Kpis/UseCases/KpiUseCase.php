<?php

namespace Modules\Companies\Entities\Kpis\UseCases;

use Modules\Companies\Entities\Kpis\Repositories\Interfaces\KpiRepositoryInterface;
use Modules\Companies\Entities\Kpis\Repositories\KpiRepository;
use Modules\Companies\Entities\Kpis\UseCases\Interfaces\KpiUseCaseInterface;
use Modules\Companies\Entities\Shifts\Repositories\Interfaces\ShiftRepositoryInterface;
use Modules\Companies\Entities\Subsidiaries\Repositories\Interfaces\SubsidiaryRepositoryInterface;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;

class KpiUseCase implements KpiUseCaseInterface
{
    private $kpiInterface, $toolsInterface, $module;
    private $subsidiaryInterface, $shiftInterface;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        KpiRepositoryInterface $kpiRepositoryInterface,
        ShiftRepositoryInterface $shiftRepositoryInterface,
        SubsidiaryRepositoryInterface $subsidiaryRepositoryInterface
    ) {
        $this->toolsInterface      = $toolRepositoryInterface;
        $this->kpiInterface        = $kpiRepositoryInterface;
        $this->shiftInterface      = $shiftRepositoryInterface;
        $this->subsidiaryInterface = $subsidiaryRepositoryInterface;
        $this->module              = 'Kpis';
    }

    public function listKpis(array $data): array
    {
        $searchData      = $this->toolsInterface->setSearchParametersRefactor($data);
        $searchData['q'] = $searchData['q']  == '' ? null : $searchData['q'];

        return [
            'data' => [
                'kpis'          => $this->kpiInterface->searchKpi($searchData['q'], $searchData['fromOrigin'], $searchData['toOrigin']),
                'optionsRoutes' => config('generals.optionRoutes'),
                'module'        => $this->module,
                'headers'       => ['Fecha', 'Meta Mínima Quincenal', 'Sede', 'Turno', 'Acciones'],
                'shifts'        => $this->shiftInterface->getAllShiftNames(),
                'subsidiaries'  => $this->subsidiaryInterface->getAllSubsidiaryNames()
            ],
            'search'  =>  $searchData['search']
        ];
    }

    public function createKpi()
    {
        return  [
            'module'        => $this->module,
            'optionsRoutes' => config('generals.optionRoutes'),
            'shifts'        => $this->shiftInterface->getAllShiftNames(),
            'subsidiaries'  => $this->subsidiaryInterface->getAllSubsidiaryNames()
        ];
    }

    public function storeKpi(array $requestData)
    {
        $this->kpiInterface->createKpi($requestData);
    }

    public function updateKpi($request, int $kpiId)
    {
        $update      = new KpiRepository($this->kpiInterface->findKpiById($kpiId));
        $update->updateKpi($request->except('_token', '_method'));
    }

    public function destroyKpi(int $kpiId)
    {
        $update = new KpiRepository($this->getKpi($kpiId));
        $update->deleteKpi();
    }

    private function getKpi(int $kpiId)
    {
        return $this->kpiInterface->findKpiById($kpiId);
    }
}
