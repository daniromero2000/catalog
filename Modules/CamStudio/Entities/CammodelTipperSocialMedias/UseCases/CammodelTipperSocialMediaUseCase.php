<?php

namespace Modules\CamStudio\Entities\CammodelTipperSocialMedias\UseCases;

use Module\CamStudio\Entities\CammodelTipperSocialMedias\Exceptions\DeletingCammodelTipperSocialMediaErrorException;
use Modules\CamStudio\Entities\CammodelTippers\Repositories\Interfaces\CammodelTipperRepositoryInterface;
use Modules\CamStudio\Entities\CammodelTipperSocialMedias\CammodelTipperSocialMedia;
use Modules\CamStudio\Entities\CammodelTipperSocialMedias\Exceptions\CammodelTipperSocialMediaNotFoundException;
use Modules\CamStudio\Entities\CammodelTipperSocialMedias\Exceptions\CreateCammodelTipperSocialMediaErrorException;
use Modules\CamStudio\Entities\CammodelTipperSocialMedias\Repositories\CammodelTipperSocialMediaRepository;
use Modules\CamStudio\Entities\CammodelTipperSocialMedias\Repositories\Interfaces\CammodelTipperSocialMediaRepositoryInterface;
use Modules\CamStudio\Entities\CammodelTipperSocialMedias\UseCases\Interfaces\CammodelTipperSocialMediaUseCaseInterface;
use Modules\Generals\Entities\SocialMedias\Repositories\Interfaces\SocialMediaRepositoryInterface;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;

class CammodelTipperSocialMediaUseCase implements CammodelTipperSocialMediaUseCaseInterface
{
    private $cammodelTipperSocialMediaInterface, $socialMediaInterface;
    private $cammodelTipperInterface, $toolsInterface;

    public function __construct(
        CammodelTipperSocialMediaRepositoryInterface $cammodelTipperSocialMediaRepositoryInterface,
        CammodelTipperRepositoryInterface $cammodelTipperRepositoryInterface,
        SocialMediaRepositoryInterface $socialMediaRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface
    ) {
        $this->cammodelTipperSocialMediaInterface = $cammodelTipperSocialMediaRepositoryInterface;
        $this->cammodelTipperInterface            = $cammodelTipperRepositoryInterface;
        $this->socialMediaInterface               = $socialMediaRepositoryInterface;
        $this->toolsInterface                     = $toolRepositoryInterface;
        $this->module                             = 'Redes Sociales de Tippers';
    }

    public function listCammodelTipperSocialMedias(array $data): array
    {
        $searchData = $this->toolsInterface->setSearchParametersRefactor($data);
        $searchData['q'] = $searchData['q'] == '' ? null : $searchData['q'];

        return [
            'data' => [
                'cammodelTipperSocialMedias' => $this->cammodelTipperSocialMediaInterface->searchCammodelTipperSocialMedias($searchData['q']),
                'socialMedias'    => $this->socialMediaInterface->getAllSocialMedias(),
                'cammodelTippers' => $this->cammodelTipperInterface->getCammodelTipperProfiles(),
                'optionsRoutes'              => config('generals.optionRoutes'),
                'module'                     => $this->module,
                'headers'                    => ['tipper', 'profile', 'social media', 'acciones'],
            ],
            'search'  =>  $searchData['search']
        ];
    }

    public function createCammodelTipperSocialMedia(): array
    {
        return [
            'socialMedias'    => $this->socialMediaInterface->getAllSocialMedias(),
            'cammodelTippers' => $this->cammodelTipperInterface->getCammodelTipperProfiles(),
            'optionsRoutes'   => config('generals.optionRoutes'),
            'module'          => $this->module
        ];
    }

    public function storeCammodelTipperSocialMedia(array $requestData): CammodelTipperSocialMedia
    {
        return $this->cammodelTipperSocialMediaInterface->createCammodelTipperSocialMedia($requestData);
    }

    public function updateCammodelTipperSocialMedia($request, $id): bool
    {
        $cammodelTipperSocialMedia = new CammodelTipperSocialMediaRepository($this->getCammodelTipperSocialMedia($id));
        return $cammodelTipperSocialMedia->updateCammodelTipperSocialMedia($request->except('_token', '_method'));
    }

    public function destroyCammodelTipperSocialMedia(int $id): bool
    {
        $this->cammodelSocialMediaInterface->findCammodelTipperSocialMediaById($id)->delete();
        return true;
    }

    public function getCammodelTipperSocialMedia(int $id)
    {
        return $this->cammodelSocialMediaInterface->findCammodelTipperSocialMediaById($id);
    }
}
