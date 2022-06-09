<?php

namespace Modules\XisfoPay\Entities\ChaseTransferAmounts\UseCases;

use Maatwebsite\Excel\Facades\Excel;
use Modules\Banking\Entities\BankMovements\UseCases\Interfaces\BankMovementUseCaseInterface;
use Modules\Banking\Entities\Banks\Repositories\Interfaces\BankRepositoryInterface;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\Streamings\Entities\Streamings\UseCases\Interfaces\StreamingUseCaseInterface;
use Modules\XisfoPay\Entities\ChaseTransferAmounts\Exceptions\ChaseTransferAmountNotFoundException;
use Modules\XisfoPay\Entities\ChaseTransferAmounts\Exceptions\CreateChaseTransferAmountErrorException;
use Modules\XisfoPay\Entities\ChaseTransferAmounts\Exceptions\DeletingChaseTransferAmountErrorException;
use Modules\XisfoPay\Entities\ChaseTransferAmounts\Imports\ChaseTransferAmountsImport;
use Modules\XisfoPay\Entities\ChaseTransferAmounts\Repositories\ChaseTransferAmountRepository;
use Modules\XisfoPay\Entities\ChaseTransferAmounts\Repositories\Interfaces\ChaseTransferAmountRepositoryInterface;
use Modules\XisfoPay\Entities\ChaseTransferAmounts\UseCases\Interfaces\ChaseTransferAmountUseCaseInterface;
use Modules\XisfoPay\Entities\ChaseTransfers\Repositories\Interfaces\ChaseTransferRepositoryInterface;
use Modules\XisfoPay\Entities\ChaseTransferTrms\Repositories\Interfaces\ChaseTransferTrmRepositoryInterface;

class ChaseTransferAmountUseCase implements ChaseTransferAmountUseCaseInterface
{
    private $toolsInterface, $chaseTransferAmountInterface, $bankInterface;
    private $chaseTransferTrmInterface, $chaseTransferInterface, $streamingServiceInterface;
    private $bankMovementServiceInterface;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        BankRepositoryInterface $bankRepositoryInterface,
        BankMovementUseCaseInterface $bankMovementUseCaseInterface,
        ChaseTransferAmountRepositoryInterface $chaseTransferAmountRepositoryInterface,
        ChaseTransferRepositoryInterface $chaseTransferRepositoryInterface,
        ChaseTransferTrmRepositoryInterface $chaseTransferTrmRepositoryInterface,
        StreamingUseCaseInterface $streamingUseCaseInterface
    ) {
        $this->toolsInterface               = $toolRepositoryInterface;
        $this->bankInterface                = $bankRepositoryInterface;
        $this->bankMovementServiceInterface = $bankMovementUseCaseInterface;
        $this->chaseTransferAmountInterface = $chaseTransferAmountRepositoryInterface;
        $this->chaseTransferInterface       = $chaseTransferRepositoryInterface;
        $this->chaseTransferTrmInterface    = $chaseTransferTrmRepositoryInterface;
        $this->streamingServiceInterface    = $streamingUseCaseInterface;
        $this->module                       = 'Giros Por Plataforma';
    }

    public function listChaseTransferAmounts(array $data): array
    {
        $searchData = $this->toolsInterface->setSearchParametersRefactor($data);
        $searchData['q'] = $searchData['q']  == '' ? null : $searchData['q'];

        $list = $this->chaseTransferAmountInterface->searchChaseTransferAmounts($searchData['q'], $searchData['fromOrigin'], $searchData['toOrigin']);

        return [
            'data' => [
                'chaseTransferAmounts' => $list,
                'optionsRoutes'        => config('generals.optionRoutes'),
                'module'               => $this->module,
                'headers'              => ['Fecha', 'Monto', 'TRM / Banco', 'Plataforma', 'Giro', 'Opciones']
            ],
            'search'  =>  $searchData['search']
        ];
    }

    public function createChaseTransferAmount()
    {
        return [
            'optionsRoutes'  => config('generals.optionRoutes'),
            'module'         => $this->module,
            'chaseTransferTrms' => $this->chaseTransferTrmInterface->getActiveChaseTransferTrm()
        ];
    }

    public function storeChaseTransferAmount($requestData)
    {
        if ($requestData->has('file')) {
            $this->deleteChaseTransferAmounts($requestData['chase_transfer_id']);
            Excel::import(new ChaseTransferAmountsImport($requestData['chase_transfer_id']), $requestData['file']);
            $chaseTransfer = $this->chaseTransferInterface->findChaseTransferById($requestData['chase_transfer_id']);
            $chaseTransfer->commission = $this->streamingServiceInterface->streamingsCommissions($chaseTransfer);
            $chaseTransfer->commission += $this->bankInterface->getBankDraftRate(54)->draft_rate;
            return $chaseTransfer->save();
        }
    }

    public function storeChaseBankMovements($chaseTransfer)
    {
        foreach ($chaseTransfer->chaseTransferAmounts as $chaseTransferAmount) {
            $bankMovementData['amount']        = $chaseTransferAmount['amount'];
            $bankMovementData['bank_id']       = 54;
            $bankMovementData['movement_type'] = 'CREDIT';

            $this->bankMovementServiceInterface->storeBankMovement($bankMovementData);
        }

        $bankMovementData['amount']        = $chaseTransfer['transfer_amount'];
        $bankMovementData['bank_id']       = 54;
        $bankMovementData['movement_type'] = 'DEBIT';

        $this->bankMovementServiceInterface->storeBankMovement($bankMovementData);
    }

    public function showChaseTransferAmount(int $id)
    {
        $chaseTransferAmount = $this->getChaseTransferAmount($id);

        return [
            'chaseTransferAmount' => $chaseTransferAmount,
            'optionsRoutes'       => config('generals.optionRoutes'),
            'module'              => $this->module,
            'headers'             => ['Fecha', 'Monto', 'TRM / Banco', 'Plataforma']
        ];
    }

    public function updateChaseTransferAmount(array $requestData, int $id)
    {
        $chaseTransferAmount = $this->getChaseTransferAmount($id);
        $update              = new ChaseTransferAmountRepository($chaseTransferAmount);
        $update->updateChaseTransferAmount($requestData);
    }

    public function getChaseTransferAmount(int $id)
    {
        return $this->chaseTransferAmountInterface->findChaseTransferAmountById($id);
    }

    public function destroyChaseTransferAmount(int $id)
    {
        $chaseTransferAmount = new ChaseTransferAmountRepository($this->getChaseTransferAmount($id));
        $chaseTransferAmount->deleteChaseTransferAmount();
    }

    private function deleteChaseTransferAmounts(int $chaseTransferId)
    {
        $chaseTransferAmounts = $this->chaseTransferAmountInterface->findChaseTransferAmounts($chaseTransferId);
        $chaseTransferAmounts->each(function ($item) {
            $item->forceDelete();
        });
    }
}
