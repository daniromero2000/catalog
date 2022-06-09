<?php

namespace Modules\PawnShop\Entities\JewelryQualities\UseCases;

use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\PawnShop\Entities\JewelryQualities\Exceptions\CreateJewelryQualityErrorException;
use Modules\PawnShop\Entities\JewelryQualities\Repositories\JewelryQualityRepository;
use Modules\PawnShop\Entities\JewelryQualities\Repositories\Interfaces\JewelryQualityRepositoryInterface;
use Modules\PawnShop\Entities\JewelryQualities\UseCases\Interfaces\JewelryQualityUseCaseInterface;

class JewelryQualityUseCase implements JewelryQualityUseCaseInterface
{
    private $jewelryQualityInterface;

    public function __construct(
        JewelryQualityRepositoryInterface $jewelryQualityRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface
    ) {
        $this->jewelryQualityInterface = $jewelryQualityRepositoryInterface;
        $this->toolsInterface          = $toolRepositoryInterface;
        $this->module                  = 'Calidades de Joya';
    }

    public function listJewelryQualities(array $data): array
    {
        $searchData = $this->toolsInterface->setSearchParametersRefactor($data);
        $searchData['q'] = $searchData['q'] == '' ? null : $searchData['q'];

        return [
            'data' => [
                'jewelry_qualities' => $this->jewelryQualityInterface->searchJewelryQuality($searchData['q']),
                'optionsRoutes'     => config('generals.optionRoutes'),
                'module'            => $this->module,
                'headers'           => ['id', 'Nombre', 'Precio', 'Fecha', 'Opciones'],
            ],
            'search'  =>  $searchData['search']
        ];
    }

    public function createJewelryQuality()
    {
        return  [
            'module'        => $this->module,
            'optionsRoutes' => config('generals.optionRoutes')
        ];
    }

    public function storeJewelryQuality(array $requestData)
    {
        $this->jewelryQualityInterface->createJewelryQuality($requestData);
    }

    public function updateJewelryQuality($request, int $id)
    {
        $update         = new JewelryQualityRepository($this->getJewelryQuality($id));
        $update->updateJewelryQuality($request->except('_token', '_method'));
    }

    public function destroyJewelryQuality(int $id)
    {
        $update = new JewelryQualityRepository($this->getJewelryQuality($id));
        $update->deleteJewelryQuality();
    }

    private function getJewelryQuality(int $id)
    {
        return $this->jewelryQualityInterface->findJewelryQualityById($id);
    }
}
