<?php

namespace Modules\Banking\Entities\Banks\UseCases;

use Modules\Banking\Entities\Banks\Bank;
use Modules\Banking\Entities\Banks\Repositories\BankRepository;
use Modules\Banking\Entities\Banks\Repositories\Interfaces\BankRepositoryInterface;
use Modules\Banking\Entities\Banks\UseCases\Interfaces\BankUseCaseInterface;
use Modules\Generals\Entities\Countries\Repositories\Interfaces\CountryRepositoryInterface;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;

class BankUseCase implements BankUseCaseInterface
{
    private $bankRepositoryInterface, $toolsInterface, $module;

    public function __construct(
        BankRepositoryInterface $bankRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface,
        CountryRepositoryInterface $countryRepositoryInterface
    ) {
        $this->bankRepositoryInterface = $bankRepositoryInterface;
        $this->countryInterface        = $countryRepositoryInterface;
        $this->toolsInterface          = $toolRepositoryInterface;
        $this->module                  = 'Bancos';
    }

    public function listBanks(array $data): array
    {
        $searchData = $this->toolsInterface->setSearchParametersRefactor($data);
        $searchData['q'] = $searchData['q'] == '' ? null : $searchData['q'];

        return [
            'data' => [
                'banks'         => $this->bankRepositoryInterface->searchBank($searchData['q']),
                'optionsRoutes' => config('generals.optionRoutes'),
                'module'        => $this->module,
                'headers'       => ['Nombre', 'Tarifa de transferencia', 'Tarifa de Giro USD', 'Estado', 'Acciones'],
            ],
            'search'  =>  $searchData['search']
        ];
    }

    public function createBank(): array
    {
        return [
            'optionsRoutes' => config('generals.optionRoutes'),
            'module'        => $this->module,
            'countries'     => $this->countryInterface->getCountriesNames()
        ];
    }

    public function storeBank(array $requestData): void
    {
        $this->bankRepositoryInterface->createBank($requestData);
    }

    public function updateBank(array $requestData, $bankId): void
    {
        $this->getBankRepository($bankId)->updateBank($requestData);
    }

    public function destroyBank(int $bankId): void
    {
        $this->getBankRepository($bankId)->deleteBank();
    }

    private function getBankRepository(int $bankId): BankRepository
    {
        return new BankRepository($this->getBank($bankId));
    }

    private function getBank(int $bankId): Bank
    {
        return $this->bankRepositoryInterface->findBankById($bankId);
    }
}
