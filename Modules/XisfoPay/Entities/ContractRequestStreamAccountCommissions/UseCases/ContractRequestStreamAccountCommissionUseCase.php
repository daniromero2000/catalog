<?php

namespace Modules\XisfoPay\Entities\ContractRequestStreamAccountCommissions\UseCases;

use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\Streamings\Entities\Streamings\Repositories\Interfaces\StreamingRepositoryInterface;
use Modules\XisfoPay\Entities\ContractRequestStreamAccountCommissions\Repositories\ContractRequestStreamAccountCommissionRepository;
use Modules\XisfoPay\Entities\ContractRequestStreamAccountCommissions\Repositories\Interfaces\ContractRequestStreamAccountCommissionRepositoryInterface;
use Modules\XisfoPay\Entities\ContractRequestStreamAccountCommissions\UseCases\Interfaces\ContractRequestStreamAccountCommissionUseCaseInterface;

class ContractRequestStreamAccountCommissionUseCase implements ContractRequestStreamAccountCommissionUseCaseInterface
{
    private $toolsInterface, $contractRequestStreamAccountCommissionInterface;
    private $streamingInterface;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        StreamingRepositoryInterface $streamingRepositoryInterface,
        ContractRequestStreamAccountCommissionRepositoryInterface $contractRequestStreamAccountCommissionRepositoryInterface
    ) {
        $this->toolsInterface                                  = $toolRepositoryInterface;
        $this->streamingInterface                              = $streamingRepositoryInterface;
        $this->contractRequestStreamAccountCommissionInterface = $contractRequestStreamAccountCommissionRepositoryInterface;
        $this->module                                          = 'Comisiones de streamings';
    }

    public function listContractRequestStreamAccountCommissions(array $data): array
    {
        $searchData = $this->toolsInterface->setSearchParametersRefactor($data);
        $searchData['q'] = $searchData['q']  == '' ? null : $searchData['q'];

        $list = $this->contractRequestStreamAccountCommissionInterface->searchContractRequestStreamAccountCommissions($searchData['q'], $searchData['fromOrigin'], $searchData['toOrigin']);

        return [
            'data' => [
                'contractRequestStreamAccountCommissions' => $list,
                'optionsRoutes'                           => config('generals.optionRoutes'),
                'module'                                  => $this->module,
                'headers'                                 => ['Fecha', 'Monto', 'Plataforma', 'Default', 'Opciones']
            ],
            'search'  =>  $searchData['search']
        ];
    }

    public function createContractRequestStreamAccountCommission()
    {
        return [
            'streamings'     => $this->streamingInterface->getAllStreamingNames(),
            'optionsRoutes'  => config('generals.optionRoutes'),
            'module'         => $this->module
        ];
    }

    public function storeContractRequestStreamAccountCommission(array $requestData)
    {
        $this->contractRequestStreamAccountCommissionInterface->createContractRequestStreamAccountCommission($requestData);
    }

    public function showContractRequestStreamAccountCommission(int $id)
    {
        $contractRequestStreamAccountCommission = $this->getContractRequestStreamAccountCommission($id);

        return [
            'contractRequestStreamAccountCommission' => $contractRequestStreamAccountCommission,
            'optionsRoutes' => config('generals.optionRoutes'),
            'module'        => $this->module
        ];
    }

    public function updateContractRequestStreamAccountCommission(array $requestData, int $id)
    {
        $contractRequestStreamAccountCommission = $this->getContractRequestStreamAccountCommission($id);
        $update = new ContractRequestStreamAccountCommissionRepository($contractRequestStreamAccountCommission);
        $update->updateContractRequestStreamAccountCommission($requestData);
    }

    public function getContractRequestStreamAccountCommission(int $id)
    {
        return $this->contractRequestStreamAccountCommissionInterface->findContractRequestStreamAccountCommissionById($id);
    }

    public function destroyContractRequestStreamAccountCommission(int $id)
    {
        $contractRequestStreamAccountCommission = new ContractRequestStreamAccountCommissionRepository($this->getContractRequestStreamAccountCommission($id));
        $contractRequestStreamAccountCommission->deleteContractRequestStreamAccountCommission();
    }
}
