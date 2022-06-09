<?php

namespace Modules\XisfoPay\Entities\ContractRates\UseCases;

use Modules\XisfoPay\Entities\ContractRates\Repositories\ContractRateRepository;
use Modules\XisfoPay\Entities\ContractRates\Repositories\Interfaces\ContractRateRepositoryInterface;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\XisfoPay\Entities\ContractRates\Exceptions\ContractRateNotFoundException;
use Modules\XisfoPay\Entities\ContractRates\UseCases\Interfaces\ContractRateUseCaseInterface;

class ContractRateUseCase implements ContractRateUseCaseInterface
{
    private $contractRatesInterface, $toolsInterface;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        ContractRateRepositoryInterface $contractRateRepositoryInterface
    ) {
        $this->contractRatesInterface = $contractRateRepositoryInterface;
        $this->toolsInterface         = $toolRepositoryInterface;
        $this->module                 = 'Tarifas de Contratos';
    }

    public function listContractRates(array $data): array
    {
        $searchData = $this->toolsInterface->setSearchParametersRefactor($data);
        $searchData['q'] = $searchData['q'] == '' ? null : $searchData['q'];

        return [
            'data' => [
                'contractRates' => $this->contractRatesInterface->searchContractRate($searchData['q']),
                'optionsRoutes' => config('generals.optionRoutes'),
                'module'        => $this->module,
                'headers'       => ['Porcentaje', 'Tipo', 'Valor', 'Activo / Aprobado', 'Opciones'],
            ],
            'search'  =>  $searchData['search']
        ];
    }

    public function storeContractRate(array $requestData)
    {
        $this->contractRatesInterface->createContractRate($requestData);
    }

    public function updateContractRate(array $requestData, int $id)
    {
        $update = new ContractRateRepository($this->getContractRate($id));
        $update->updateContractRate($requestData);
    }

    public function destroyContractRate(int $id)
    {
        $update = new ContractRateRepository($this->getContractRate($id));
        $update->deleteContractRate();
    }

    public function getContractRate(int $id)
    {
        return $this->contractRatesInterface->findContractRateById($id);
    }
}
