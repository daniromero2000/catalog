<?php

namespace Modules\XisfoPay\Entities\ChaseTransfers\UseCases;

use Modules\Banking\Entities\BankAccounts\Repositories\Interfaces\BankAccountRepositoryInterface;
use Modules\Banking\Entities\BankMovements\UseCases\Interfaces\BankMovementUseCaseInterface;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\Streamings\Entities\Streamings\UseCases\Interfaces\StreamingUseCaseInterface;
use Modules\XisfoPay\Entities\ChaseTransferAmounts\UseCases\Interfaces\ChaseTransferAmountUseCaseInterface;
use Modules\XisfoPay\Entities\ChaseTransfers\Repositories\ChaseTransferRepository;
use Modules\XisfoPay\Entities\ChaseTransfers\Repositories\Interfaces\ChaseTransferRepositoryInterface;
use Modules\XisfoPay\Entities\ChaseTransfers\UseCases\Interfaces\ChaseTransferUseCaseInterface;
use Modules\XisfoPay\Entities\ChaseTransferTrms\Repositories\Interfaces\ChaseTransferTrmRepositoryInterface;

class ChaseTransferUseCase implements ChaseTransferUseCaseInterface
{
    private $toolsInterface, $chaseTransferInterface;
    private $chaseTransferTrmInterface, $streamingServiceInterface;
    private $bankMovementServiceInterface, $chaseTransferAmountServiceInterface;
    private $bankAccountInterface;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        BankAccountRepositoryInterface $bankAccountRepositoryInterface,
        BankMovementUseCaseInterface $bankMovementUseCaseInterface,
        ChaseTransferAmountUseCaseInterface $chaseTransferAmountUseCaseInterface,
        ChaseTransferRepositoryInterface $chaseTransferRepositoryInterface,
        StreamingUseCaseInterface $streamingUseCaseInterface,
        ChaseTransferTrmRepositoryInterface $chaseTransferTrmRepositoryInterface
    ) {
        $this->toolsInterface                      = $toolRepositoryInterface;
        $this->bankAccountInterface                = $bankAccountRepositoryInterface;
        $this->bankMovementServiceInterface        = $bankMovementUseCaseInterface;
        $this->chaseTransferAmountServiceInterface = $chaseTransferAmountUseCaseInterface;
        $this->chaseTransferInterface              = $chaseTransferRepositoryInterface;
        $this->streamingServiceInterface           = $streamingUseCaseInterface;
        $this->chaseTransferTrmInterface           = $chaseTransferTrmRepositoryInterface;
        $this->module                              = 'Giros Chase';
    }

    public function listChaseTransfers(array $data): array
    {
        $searchData = $this->toolsInterface->setSearchParametersRefactor($data);
        $searchData['q'] = $searchData['q']  == '' ? null : $searchData['q'];

        return [
            'data' => [
                'chaseTransfers' => $this->chaseTransferInterface->searchChaseTransfers($searchData['q'], $searchData['fromOrigin'], $searchData['toOrigin']),
                'optionsRoutes'  => config('generals.optionRoutes'),
                'module'         => $this->module,
                'headers'        => ['ID', 'Fecha', 'Monto USD', 'TRM / Banco', 'Comisión Comercial', 'Comisión Real', 'Aprobado', 'Opciones']
            ],
            'search'  =>  $searchData['search']
        ];
    }

    public function createChaseTransfer()
    {
        return [
            'optionsRoutes'     => config('generals.optionRoutes'),
            'module'            => $this->module,
            'chaseTransferTrms' => $this->chaseTransferTrmInterface->getActiveChaseTransferTrm()
        ];
    }

    public function storeChaseTransfer(array $requestData)
    {
        return $this->chaseTransferInterface->createChaseTransfer($requestData);
    }

    public function storeLocalBankMovement(array $requestData, $chaseTransfer)
    {
        $trm = $this->chaseTransferTrmInterface->findChaseTransferTrmById($requestData['chase_transfer_trm_id']);
        $bankMovementData['amount']        = $requestData['transfer_amount'] * $trm->trm;
        $bankMovementData['bank_id']       = $trm->bank->id;
        $bankMovementData['movement_type'] = 'CREDIT';
        $this->bankMovementServiceInterface->storeBankMovement($bankMovementData);
    }

    public function showChaseTransfer(int $id)
    {
        return [
            'chaseTransfer' =>  $this->getChaseTransfer($id),
            'optionsRoutes' => config('generals.optionRoutes'),
            'module'        => $this->module,
            'headers'       => ['Monto Giro / Monto Total', 'Costo', 'TRM / Banco', 'Comisión Comercial', 'Comisión Real', 'Aprobado', 'Opciones']
        ];
    }

    public function updateChaseTransfer(array $requestData, int $id)
    {
        $user                         = $this->toolsInterface->setSignedUser();
        $requestData['user_approves'] = $user->name . ' ' . $user->last_name;
        $update                       = new ChaseTransferRepository($this->getChaseTransfer($id));
        $update->updateChaseTransfer($requestData);
    }

    public function getChaseTransfer(int $id)
    {
        return $this->chaseTransferInterface->findChaseTransferById($id);
    }

    public function destroyChaseTransfer(int $id)
    {
        $chaseTransfer = new ChaseTransferRepository($this->getChaseTransfer($id));
        $chaseTransfer->deleteChaseTransfer();
    }

    public function legalizeViewData()
    {
        return [
            'bankAccounts'      => $this->bankAccountInterface->findActiveBankAccounts(),
            'chaseTransfers'    => $this->chaseTransferInterface->findNotLegalizedChaseTransfers(),
            'chaseTransferTrms' => $this->chaseTransferTrmInterface->getActiveChaseTransferTrm(),
            'headers'           => ['ID', 'Monto USD', 'Fecha', 'Legalizar'],
            'module'            => $this->module,
            'optionsRoutes'     => config('generals.optionRoutes'),

        ];
    }

    public function legalizeChaseTransfers(array $requestData)
    {
        if (array_key_exists('chaseTransfers', $requestData)) {
            foreach ($requestData['chaseTransfers'] as $key => $chaseTransfer) {
                $bankMovement = $this->storeBankMovements($requestData, $chaseTransfer);
                $chaseTransferData['bank_movement_id'] = $bankMovement->id;
                $this->updateChaseTransfer($chaseTransferData, $key);
            }
        }
    }

    private function storeBankMovements($requestData, $chaseTransfer)
    {
        $chaseMovementData['amount']          = $chaseTransfer;
        $chaseMovementData['bank_account_id'] = 4;
        $chaseMovementData['movement_type']   = 'DEBIT';
        $this->bankMovementServiceInterface->storeBankMovement($chaseMovementData);
        $bankMovementData['amount']          = $chaseTransfer * $requestData['trm'];
        $bankMovementData['trm']             = $requestData['trm'];
        $bankMovementData['bank_account_id'] = $requestData['bank_account_id'];
        $bankMovementData['movement_type']   = 'CREDIT';
        return $this->bankMovementServiceInterface->storeBankMovement($bankMovementData);
    }
}
