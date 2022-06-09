<?php

namespace Modules\CamStudio\Entities\CammodelImages\UseCases;

use Modules\CamStudio\Entities\CammodelImages\CammodelImage;
use Modules\CamStudio\Entities\CammodelImages\Repositories\Interfaces\CammodelImageRepositoryInterface;
use Modules\CamStudio\Entities\CammodelImages\UseCases\Interfaces\CammodelImageUseCaseInterface;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;

class CammodelImageUseCase implements CammodelImageUseCaseInterface
{
    private $cammodelRepositoryInterface, $toolsInterface;

    public function __construct(
        CammodelImageRepositoryInterface $cammodelRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface
    ) {
        $this->cammodelRepositoryInterface = $cammodelRepositoryInterface;
        $this->toolsInterface              = $toolRepositoryInterface;
        $this->module                      = 'Perfiles Modelos';
    }

    public function listCammodelImages(array $data): array
    {
        $searchData = $this->toolsInterface->setSearchParametersRefactor($data);
        $searchData['q'] = $searchData['q'] == '' ? null : $searchData['q'];

        if (auth()->guard('employee')->user()->hasRole('studio_admin|studio_manager|subsidiary_supervisor')) {
            $subsidiaryId = auth()->guard('employee')->user()->subsidiary_id;
            $list     = $this->cammodelRepositoryInterface->searchSubsidiaryCammodelImage($searchData['q'], $subsidiaryId);
        } else {
            $list     = $this->cammodelRepositoryInterface->searchCammodelImage($searchData['q']);
        }

        return [
            'data' => [
                'cammodels'     => $list,
                'optionsRoutes' => config('generals.optionRoutes'),
                'module'        => $this->module,
                'headers'       => ['NickName', 'Nombre', 'Opciones'],
            ],
            'search'  =>  $searchData['search']
        ];
    }

    public function storeCammodelImage(array $requestData): CammodelImage
    {
        return $this->cammodelRepositoryInterface->createCammodelImage($requestData);
    }
}
