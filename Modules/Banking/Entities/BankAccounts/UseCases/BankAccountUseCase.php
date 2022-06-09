<?php

namespace Modules\Banking\Entities\BankAccounts\UseCases;

use Modules\Banking\Entities\BankAccounts\BankAccount;
use Modules\Banking\Entities\BankAccounts\Repositories\BankAccountRepository;
use Modules\Banking\Entities\BankAccounts\Repositories\Interfaces\BankAccountRepositoryInterface;
use Modules\Banking\Entities\BankAccounts\UseCases\Interfaces\BankAccountUseCaseInterface;
use Modules\Banking\Entities\Banks\Repositories\Interfaces\BankRepositoryInterface;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;

class BankAccountUseCase implements BankAccountUseCaseInterface
{
    private $toolsInterface, $bankAccountInterface, $bankInterface;

    public function __construct(
        BankRepositoryInterface $bankRepositoryInterface,
        BankAccountRepositoryInterface $bankAccountRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface
    ) {
        $this->bankInterface        = $bankRepositoryInterface;
        $this->bankAccountInterface = $bankAccountRepositoryInterface;
        $this->toolsInterface       = $toolRepositoryInterface;
        $this->module               = 'Cuentas Bancarias';
    }

    public function listBankAccounts(array $requestData): array
    {
        $searchData = $this->toolsInterface->setSearchParametersRefactor($requestData);
        $searchData['q'] = $searchData['q']  == '' ? null : $searchData['q'];

        $list = $this->bankAccountInterface->searchBankAccounts($searchData['q'], $searchData['fromOrigin'], $searchData['toOrigin']);

        return [
            'data' => [
                'bankAccounts'  => $list,
                'optionsRoutes' => config('generals.optionRoutes'),
                'module'        => $this->module,
                'headers'       => ['Nombre', 'Banco', 'Número de cuenta', 'Fecha', 'Acciones']
            ],
            'search'  =>  $searchData['search']
        ];
    }

    public function createBankAccount(): array
    {
        return [
            'banks'         => $this->bankInterface->getAllBankNames(),
            'optionsRoutes' => config('generals.optionRoutes'),
            'module'        => $this->module
        ];
    }

    public function storeBankAccount(array $requestData): void
    {
        $this->bankAccountInterface->createBankAccount($requestData);
    }

    public function showBankAccount(int $bankAccountid): array
    {
        return [
            'bankAccount'   => $this->getBankAccount($bankAccountid),
            'optionsRoutes' => config('generals.optionRoutes'),
            'module'        => $this->module
        ];
    }

    public function updateBankAccount(array $requestData, int $bankAccountid): void
    {
        $this->getBankAccountRepository($bankAccountid)->updateBankAccount($requestData);
    }

    public function destroyBankAccount(int $bankAccountid): void
    {
        $this->getBankAccountRepository($bankAccountid)->deleteBankAccount();
    }

    private function getBankAccountRepository(int $bankAccountid): BankAccountRepository
    {
        return new BankAccountRepository($this->getBankAccount($bankAccountid));
    }

    private function getBankAccount(int $bankAccountid): BankAccount
    {
        return $this->bankAccountInterface->findBankAccountById($bankAccountid);
    }
}
