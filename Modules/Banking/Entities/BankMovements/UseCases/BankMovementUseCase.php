<?php

namespace Modules\Banking\Entities\BankMovements\UseCases;

use Modules\Banking\Entities\BankAccounts\Repositories\Interfaces\BankAccountRepositoryInterface;
use Modules\Banking\Entities\BankMovements\BankMovement;
use Modules\Banking\Entities\BankMovements\Repositories\BankMovementRepository;
use Modules\Banking\Entities\BankMovements\Repositories\Interfaces\BankMovementRepositoryInterface;
use Modules\Banking\Entities\BankMovements\UseCases\Interfaces\BankMovementUseCaseInterface;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;

class BankMovementUseCase implements BankMovementUseCaseInterface
{
    private $toolsInterface, $bankMovementInterface, $bankAccountInterface;

    public function __construct(
        BankAccountRepositoryInterface $bankAccountRepositoryInterface,
        BankMovementRepositoryInterface $bankMovementRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface
    ) {
        $this->bankAccountInterface  = $bankAccountRepositoryInterface;
        $this->bankMovementInterface = $bankMovementRepositoryInterface;
        $this->toolsInterface        = $toolRepositoryInterface;
        $this->module                = 'Movimiento Bancarios';
    }

    public function listBankMovements(array $requestData): array
    {
        $searchData = $this->toolsInterface->setSearchParametersRefactor($requestData);
        $searchData['q'] = $searchData['q']  == '' ? null : $searchData['q'];

        $list = $this->bankMovementInterface->searchBankMovements($searchData['q'], $searchData['fromOrigin'], $searchData['toOrigin']);

        return [
            'data' => [
                'bankMovements' => $list,
                'optionsRoutes' => config('generals.optionRoutes'),
                'module'        => $this->module,
                'headers'       => ['Fecha', 'Monto', 'Tipo de movimiento', 'Cuenta bancaria', 'Monto total']
            ],
            'search'  =>  $searchData['search']
        ];
    }

    public function createBankMovement(): array
    {
        return [
            'bankAccounts'  => $this->bankAccountInterface->findActiveBankAccounts(),
            'optionsRoutes' => config('generals.optionRoutes'),
            'module'        => $this->module
        ];
    }

    public function storeBankMovement(array $requestData): void
    {
        $this->bankMovementInterface->createBankMovement($this->calculateTotalBankAmount($requestData));
    }

    private function calculateTotalBankAmount(array $requestData)
    {
        $lastBankMovement = $this->bankMovementInterface->findLastBankMovement($requestData['bank_account_id']);
        $lastBankMovement = $lastBankMovement == null ? 0 : $lastBankMovement->total_bank_amount;
        $requestData['total_bank_amount'] = $requestData['movement_type'] == 'CREDIT' ?
            $lastBankMovement + $requestData['amount'] :
            $lastBankMovement - $requestData['amount'];

        return $requestData;
    }

    public function showBankMovement(int $bankMovementId): array
    {
        return [
            'bankMovement'  => $this->getBankMovement($bankMovementId),
            'optionsRoutes' => config('generals.optionRoutes'),
            'module'        => $this->module
        ];
    }

    public function updateBankMovement(array $requestData, int $bankMovementId): void
    {
        $this->getBankmovementRepository($bankMovementId)->updateBankMovement($requestData);
    }

    public function destroyBankMovement(int $bankMovementId): void
    {
        $this->getBankmovementRepository($bankMovementId)->deleteBankMovement();
    }

    private function getBankmovementRepository(int $bankMovementId): BankMovementRepository
    {
        return new BankMovementRepository($this->getBankMovement($bankMovementId));
    }

    private function getBankMovement(int $bankMovementId): BankMovement
    {
        return $this->bankMovementInterface->findBankMovementById($bankMovementId);
    }
}
