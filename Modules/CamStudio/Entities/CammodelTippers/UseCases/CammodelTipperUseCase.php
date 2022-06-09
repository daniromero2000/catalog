<?php

namespace Modules\CamStudio\Entities\CammodelTippers\UseCases;

use Modules\CamStudio\Entities\Cammodels\Repositories\Interfaces\CammodelRepositoryInterface;
use Modules\CamStudio\Entities\Cammodels\UseCases\Interfaces\CammodelUseCaseInterface;
use Modules\CamStudio\Entities\CammodelTippers\CammodelTipper;
use Modules\CamStudio\Entities\CammodelTippers\Repositories\CammodelTipperRepository;
use Modules\CamStudio\Entities\CammodelTippers\Repositories\Interfaces\CammodelTipperRepositoryInterface;
use Modules\CamStudio\Entities\CammodelTippers\UseCases\Interfaces\CammodelTipperUseCaseInterface;
use Modules\Generals\Entities\SocialMedias\Repositories\Interfaces\SocialMediaRepositoryInterface;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\Streamings\Entities\Streamings\Repositories\Interfaces\StreamingRepositoryInterface;

class CammodelTipperUseCase implements CammodelTipperUseCaseInterface
{
    private $cammodelTipperInterface, $toolsInterface, $module;
    private $cammodelInterface, $streamingInterface, $cammodelServiceInterface;
    private $socialMediaInterface;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        CammodelTipperRepositoryInterface $cammodelTipperRepositoryInterface,
        CammodelUseCaseInterface $cammodelUseCaseInterface,
        CammodelRepositoryInterface $cammodelRepositoryInterface,
        SocialMediaRepositoryInterface $socialMediaRepositoryInterface,
        StreamingRepositoryInterface $streamingRepositoryInterface
    ) {
        $this->toolsInterface           = $toolRepositoryInterface;
        $this->cammodelTipperInterface  = $cammodelTipperRepositoryInterface;
        $this->cammodelServiceInterface = $cammodelUseCaseInterface;
        $this->cammodelInterface        = $cammodelRepositoryInterface;
        $this->socialMediaInterface     = $socialMediaRepositoryInterface;
        $this->streamingInterface       = $streamingRepositoryInterface;
        $this->module                   = 'Tippers de modelos';
    }

    public function listCammodelTippers(array $data): array
    {
        $searchData      = $this->toolsInterface->setSearchParametersRefactor($data);
        $searchData['q'] = $searchData['q']  == '' ? null : $searchData['q'];

        return [
            'data' => [
                'streamings'      => $this->streamingInterface->getAllStreamingNames(),
                'cammodelTippers' => $this->cammodelTipperInterface->searchCammodelTipper($searchData['q']),
                'optionsRoutes'   => config('generals.optionRoutes'),
                'module'          => $this->module,
                'headers'         => ['Tipper', 'Apodo', 'Plataforma', 'Gustos', 'Acciones']
            ],
            'search'  =>  $searchData['search']
        ];
    }

    public function showCammodelTipper(int $CammodelTipperid): array
    {
        return [
            'data' => [
                'socialMedias'   => $this->socialMediaInterface->getAllSocialMedias(),
                'cammodelTipper' => $this->getCammodelTipper($CammodelTipperid),
                'module'         => $this->module,
                'optionsRoutes'  => config('generals.optionRoutes'),
            ]
        ];
    }

    public function createCammodelTipper(): array
    {
        return  [
            'streamings'    => $this->streamingInterface->getAllStreamingNames(),
            'cammodels'     => $this->cammodelInterface->getAllCammodelNames(),
            'module'        => $this->module,
            'optionsRoutes' => config('generals.optionRoutes')
        ];
    }

    public function storeCammodelTipper(array $requestData)
    {
        $tipper = $this->cammodelTipperInterface->findCammodelTipperByParams($requestData);
        if ($tipper == null) {
            $tipper = $this->cammodelTipperInterface->createCammodelTipper($requestData);
        }

        $this->cammodelServiceInterface->setCammodelTippers([$tipper->id], $requestData['cammodel_id']);
    }

    public function updateCammodelTipper($request, int $CammodelTipperid)
    {
        $cammodel_tipper = new CammodelTipperRepository($this->getCammodelTipper($CammodelTipperid));
        $cammodel_tipper->updateCammodelTipper($request->except('_token', '_method'));
    }

    private function getCammodelTipper(int $CammodelTipperid): CammodelTipper
    {
        return $this->cammodelTipperInterface->findCammodelTipperById($CammodelTipperid);
    }

    public function destroyCammodelTipper(int $CammodelTipperid)
    {
        $cammodel_tipper = new CammodelTipperRepository($this->getCammodelTipper($CammodelTipperid));
        $cammodel_tipper->deleteCammodelTipper();
    }
}
