<?php

namespace Modules\PawnShop\Entities\FasecoldaPriceRates\UseCases;

use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\PawnShop\Entities\FasecoldaPriceRates\Repositories\FasecoldaPriceRateRepository;
use Modules\PawnShop\Entities\FasecoldaPriceRates\Repositories\Interfaces\FasecoldaPriceRateRepositoryInterface;
use Modules\PawnShop\Entities\FasecoldaPriceRates\UseCases\Interfaces\FasecoldaPriceRateUseCaseInterface;

class FasecoldaPriceRateUseCase implements FasecoldaPriceRateUseCaseInterface
{
    private $fasecoldaPriceRateInterface;

    public function __construct(
        FasecoldaPriceRateRepositoryInterface $fasecoldaPriceRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface
    ) {
        $this->fasecoldaPriceRateInterface = $fasecoldaPriceRepositoryInterface;
        $this->toolsInterface              = $toolRepositoryInterface;
        $this->module                      = 'Tarifas Fasecolda';
    }

    public function listFasecoldaPriceRates(array $data): array
    {
        $searchData = $this->toolsInterface->setSearchParametersRefactor($data);
        $searchData['q'] = $searchData['q'] == '' ? null : $searchData['q'];

        return [
            'data' => [
                'fasecolda_price_rates' => $this->fasecoldaPriceRateInterface->searchFasecoldaPriceRate($searchData['q']),
                'optionsRoutes'         => config('generals.optionRoutes'),
                'module'                => $this->module,
                'headers'               => ['id', 'Nombre', 'Precio', 'Fecha', 'Opciones'],
            ],
            'search'  =>  $searchData['search']
        ];
    }

    public function createFasecoldaPriceRate()
    {
        return  [
            'module'        => $this->module,
            'optionsRoutes' => config('generals.optionRoutes')
        ];
    }

    public function storeFasecoldaPriceRate(array $requestData)
    {
        $this->fasecoldaPriceRateInterface->createFasecoldaPriceRate($requestData);
    }

    public function updateFasecoldaPriceRate($request, int $id)
    {
        $update      = new FasecoldaPriceRateRepository($this->getFasecoldaPriceRate($id));
        $update->updateFasecoldaPriceRate($request->except('_token', '_method'));
    }

    public function destroyFasecoldaPriceRate(int $id)
    {
        $update = new FasecoldaPriceRateRepository($this->getFasecoldaPriceRate($id));
        $update->deleteFasecoldaPriceRate();
    }

    private function getFasecoldaPriceRate(int $id)
    {
        return $this->fasecoldaPriceRateInterface->findFasecoldaPriceRateById($id);
    }
}
