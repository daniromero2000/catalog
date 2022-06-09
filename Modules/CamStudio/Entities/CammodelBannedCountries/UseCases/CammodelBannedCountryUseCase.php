<?php

namespace Modules\CamStudio\Entities\CammodelBannedCountries\UseCases;

use Modules\CamStudio\Entities\CammodelBannedCountries\Repositories\Interfaces\CammodelBannedCountryRepositoryInterface;
use Modules\CamStudio\Entities\CammodelBannedCountries\UseCases\Interfaces\CammodelBannedCountryUseCaseInterface;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;

class CammodelBannedCountryUseCase implements CammodelBannedCountryUseCaseInterface
{
    private $cammodelBannedCountryInterface, $toolsInterface;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        CammodelBannedCountryRepositoryInterface $cammodelBannedCountryRepositoryInterface
    ) {
        $this->toolsInterface                 = $toolRepositoryInterface;
        $this->cammodelBannedCountryInterface = $cammodelBannedCountryRepositoryInterface;
        $this->module                         = 'Países Bloquedos';
    }

    public function listCammodelBannedCountries(array $data): array
    {
        $searchData      = $this->toolsInterface->setSearchParametersRefactor($data);
        $searchData['q'] = $searchData['q']  == '' ? null : $searchData['q'];

        if (auth()->guard('employee')->user()->hasRole('studio_admin|studio_manager|subsidiary_supervisor')) {
            $subsidiaryId = auth()->guard('employee')->user()->subsidiary_id;
            $list     = $this->cammodelBannedCountryInterface->searchCammodelBannedCountries($searchData['q'], $subsidiaryId);
        } else {
            $list     = $this->cammodelBannedCountryInterface->searchCammodelBannedCountries($searchData['q']);
        }

        return [
            'data' => [
                'module'          => $this->module,
                'bannedCountries' => $list,
                'optionsRoutes'   => config('generals.optionRoutes'),
                'headers'         => ['Id', 'Pais', 'Modelo'],
            ],
            'search'  =>  $searchData['search']
        ];
    }

    public function storeCammodelBannedCountry(array $requestData): void
    {
        $this->cammodelBannedCountryInterface->createCammodelBannedCountry($requestData);
    }
}
