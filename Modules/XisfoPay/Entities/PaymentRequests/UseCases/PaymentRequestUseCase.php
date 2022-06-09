<?php

namespace Modules\XisfoPay\Entities\PaymentRequests\UseCases;

use ErrorException;
use Illuminate\Support\Collection;
use Modules\Customers\Entities\CustomerBankAccounts\Repositories\Interfaces\CustomerBankAccountRepositoryInterface;
use Modules\Banking\Entities\Banks\Repositories\Interfaces\BankRepositoryInterface;
use Modules\Banking\Entities\Trms\UseCases\Interfaces\TrmUseCaseInterface;
use Modules\Streamings\Entities\Streamings\Repositories\Interfaces\StreamingRepositoryInterface;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\XisfoPay\Entities\ChaseTransfers\Repositories\Interfaces\ChaseTransferRepositoryInterface;
use Modules\XisfoPay\Entities\ContractRequests\Repositories\Interfaces\ContractRequestRepositoryInterface;
use Modules\XisfoPay\Entities\ContractRequestStreamAccounts\Repositories\Interfaces\ContractRequestStreamAccountRepositoryInterface;
use Modules\XisfoPay\Entities\PaymentBankTransfers\Repositories\Interfaces\PaymentBankTransferRepositoryInterface;
use Modules\XisfoPay\Entities\PaymentBankTransfers\Repositories\PaymentBankTransferRepository;
use Modules\XisfoPay\Entities\PaymentCuts\Exceptions\PaymentCutNotFoundException;
use Modules\XisfoPay\Entities\PaymentCuts\PaymentCut;
use Modules\XisfoPay\Entities\PaymentCuts\Repositories\Interfaces\PaymentCutRepositoryInterface;
use Modules\XisfoPay\Entities\PaymentRequestAdvances\Exceptions\CreatePaymentRequestAdvanceErrorException;
use Modules\XisfoPay\Entities\PaymentRequestAdvances\Repositories\Interfaces\PaymentRequestAdvanceRepositoryInterface;
use Modules\XisfoPay\Entities\PaymentRequestAdvances\UseCases\Interfaces\PaymentRequestAdvanceUseCaseInterface;
use Modules\XisfoPay\Entities\PaymentRequestImages\Repositories\Interfaces\PaymentRequestImageRepositoryInterface;
use Modules\XisfoPay\Entities\PaymentRequests\Exceptions\PaymentRequestNotFoundException;
use Modules\XisfoPay\Entities\PaymentRequests\Exceptions\CreatePaymentRequestErrorException;
use Modules\XisfoPay\Entities\PaymentRequests\Exceptions\ExceededAmountErrorException;
use Modules\XisfoPay\Entities\PaymentRequests\Exceptions\StreamingNotFoundErrorException;
use Modules\XisfoPay\Entities\PaymentRequests\Exceptions\UpdatePaymentRequestErrorException;
use Modules\XisfoPay\Entities\PaymentRequests\PaymentRequest;
use Modules\XisfoPay\Entities\PaymentRequests\Repositories\PaymentRequestRepository;
use Modules\XisfoPay\Entities\PaymentRequests\Repositories\Interfaces\PaymentRequestRepositoryInterface;
use Modules\XisfoPay\Entities\PaymentRequests\UseCases\Interfaces\PaymentRequestUseCaseInterface;
use Modules\XisfoPay\Entities\PaymentRequestStatuses\Repositories\Interfaces\PaymentRequestStatusRepositoryInterface;
use Modules\XisfoPay\Entities\PaymentRequestStatusesLogs\UseCases\Interfaces\PaymentRequestStatusesLogUseCaseInterface;
use Modules\XisfoPay\Entities\XisfoPayParameters\UseCases\Interfaces\XisfoPayParameterUseCaseInterface;
use Modules\XisfoPay\Events\PaymentBankTransfers\PaymentBankTransferWasCreated;
use Modules\XisfoPay\Events\PaymentBankTransfers\PaymentBankTransferWereCreated;
use Modules\XisfoPay\Events\PaymentRequestAdvances\PaymentRequestAdvanceCreated;
use Modules\XisfoPay\Events\PaymentRequests\PaymentRequestWasApproved;

class PaymentRequestUseCase implements PaymentRequestUseCaseInterface
{
    private $toolsInterface, $paymentRequestInterface, $paymentRequestStatusInterface;
    private $paymentRequestStatusesLogServiceInterface, $contractRequestInterface;
    private $contractRequestStreamAccountInterface, $bankInterface;
    private $xisfoPayParametersServiceInterface, $paymentRequestImageInterface;
    private $trmServiceInterface, $paymentRequestAdvanceServiceInterface;
    private $chaseTransferInterface, $paymentCutInterface;
    private $paymentBankTransferInterface;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        PaymentBankTransferRepositoryInterface $paymentBankTransferRepositoryInterface,
        PaymentCutRepositoryInterface $paymentCutRepositoryInterface,
        PaymentRequestRepositoryInterface $paymentRequestRepositoryInterface,
        PaymentRequestStatusRepositoryInterface $paymentRequestStatusRepositoryInterface,
        PaymentRequestStatusesLogUseCaseInterface $paymentRequestStatusesLogUseCaseInterface,
        ContractRequestRepositoryInterface $contractRequestRepositoryInterface,
        ContractRequestStreamAccountRepositoryInterface $contractRequestStreamAccountInterface,
        PaymentRequestAdvanceRepositoryInterface $paymentRequestAdvanceRepositoryInterface,
        CustomerBankAccountRepositoryInterface $customerBankAccountRepositoryInterface,
        BankRepositoryInterface $bankRepositoryInterface,
        XisfoPayParameterUseCaseInterface $xisfoPayParameterUseCaseInterface,
        PaymentRequestImageRepositoryInterface $paymentRequestImageRepositoryInterface,
        TrmUseCaseInterface $trmUseCaseInterface,
        PaymentRequestAdvanceUseCaseInterface $paymentRequestAdvanceUseCaseInterface,
        ChaseTransferRepositoryInterface $chaseTransferRepositoryInterface
    ) {
        $this->toolsInterface                            = $toolRepositoryInterface;
        $this->paymentBankTransferInterface              = $paymentBankTransferRepositoryInterface;
        $this->paymentCutInterface                       = $paymentCutRepositoryInterface;
        $this->paymentRequestInterface                   = $paymentRequestRepositoryInterface;
        $this->paymentRequestStatusInterface             = $paymentRequestStatusRepositoryInterface;
        $this->paymentRequestStatusesLogServiceInterface = $paymentRequestStatusesLogUseCaseInterface;
        $this->contractRequestInterface                  = $contractRequestRepositoryInterface;
        $this->contractRequestStreamAccountInterface     = $contractRequestStreamAccountInterface;
        $this->paymentRequestAdvanceInterface            = $paymentRequestAdvanceRepositoryInterface;
        $this->customerBankAccountsInterface             = $customerBankAccountRepositoryInterface;
        $this->bankInterface                             = $bankRepositoryInterface;
        $this->xisfoPayParametersServiceInterface        = $xisfoPayParameterUseCaseInterface;
        $this->paymentRequestImageInterface              = $paymentRequestImageRepositoryInterface;
        $this->trmServiceInterface                       = $trmUseCaseInterface;
        $this->paymentRequestAdvanceServiceInterface     = $paymentRequestAdvanceUseCaseInterface;
        $this->chaseTransferInterface                    = $chaseTransferRepositoryInterface;
        $this->module                                    = 'Solicitudes de Pago';
        $this->optionRoutes                              = request()->segment(1) . '.' . (request()->segment(2));
    }

    public function listPaymentRequests(array $data): array
    {
        $searchData      = $this->toolsInterface->setSearchParametersRefactor($data);
        $searchData['q'] = $searchData['q']  == '' ? null : $searchData['q'];
        $user            = $this->toolsInterface->setSignedUser();

        if ($user->hasRole('xisfopay_comercial')) {
            $list = $this->paymentRequestInterface->searchPaymentRequest(
                $searchData['q'],
                $searchData['fromOrigin'],
                $searchData['toOrigin'],
                $user->id
            );
        } else {
            $list = $this->paymentRequestInterface->searchPaymentRequest(
                $searchData['q'],
                $searchData['fromOrigin'],
                $searchData['toOrigin']
            );
        }

        return [
            'data' => [
                'payment_requests'         => $list,
                'payment_request_statuses' => $this->paymentRequestStatusInterface->getAllPaymentRequestStatusesNames(),
                'optionsRoutes'            => config('generals.optionRoutes'),
                'module'                   => $this->module,
                'chase_transfers'          => $this->chaseTransferInterface->getLastChaseTransfers(),
                'headers'                  => ['Id', 'Fecha', 'Cliente/Plataforma', 'Monto', 'Total Pesos', 'Facturar Xisfo', 'Estado', 'Aprobado / Pago Total', 'Opciones']
            ],
            'search'  =>  $searchData['search']
        ];
    }

    public function listCustomerPaymentRequests(array $data): array
    {
        $contract_requests_ids = $this->contractRequestInterface->getCustomerContractRequests(auth()->user()->id);
        $stream_accounts_ids   = $this->contractRequestStreamAccountInterface->getCustomerStreamAccounts($contract_requests_ids);
        $payment_requests_ids  = $this->paymentRequestInterface->getCustomerPaymentRequests($stream_accounts_ids);
        $searchData            = $this->toolsInterface->setSearchParametersRefactor($data);
        $searchData['q']       = $searchData['q'] == '' ? null : $searchData['q'];

        return [
            'data' => [
                'payment_requests'         => $this->paymentRequestInterface->searchPaymentRequestsByCustomerId($searchData['q'], $payment_requests_ids, $searchData['fromOrigin'], $searchData['toOrigin']),
                'payment_request_statuses' => $this->paymentRequestStatusInterface->getAllPaymentRequestStatusesNames(),
                'module'                   => $this->module,
                'optionsRoutes'            => config('generals.optionRoutes'),
                'headers'                  => ['Fecha', 'Plataforma', 'TRM', 'Monto', 'Total Pesos', 'Estado', 'Aprobado / Pago Total', 'Opciones'],
            ],
            'search' => $searchData['search']
        ];
    }

    public function createPaymentRequest()
    {
        return  [
            'module'            => $this->module,
            'optionsRoutes'     => config('generals.optionRoutes'),
            'contract_requests' => $this->contractRequestInterface->listIds(),
            'stream_accounts'   => $this->contractRequestStreamAccountInterface->getAllStreamAccountNames()
        ];
    }

    public function createFromPaymentRequest()
    {
        $contract_requests_ids = $this->contractRequestInterface->getCustomerContractRequests(auth()->user()->id);

        return [
            'optionsRoutes'     => config('generals.optionRoutes'),
            'module'            => $this->module,
            'contract_requests' => $this->contractRequestInterface->listIds(),
            'stream_accounts'   => $this->contractRequestStreamAccountInterface->getCustomerStreamAccountsNames($contract_requests_ids),
            'bank_accounts'     => $this->customerBankAccountsInterface->getCustomerBankAccounts(auth()->user()->id)
        ];
    }

    public function storePaymentRequest($request)
    {
        $paymentRequest = $this->paymentRequestInterface->createPaymentRequest($request->except('_token', '_method', 'image'));
        $this->createPaymentAdvance($request, $paymentRequest);
        $stream = $paymentRequest->contractRequestStreamAccount()->get();

        if ($request->hasFile('image')) {
            $this->paymentRequestImageInterface->savePaymentRequestImages($paymentRequest->id, collect($request->file('image')), $stream[0]->contractRequest->client_identifier);
        }

        $this->paymentRequestStatusesLogServiceInterface->storePaymentRequestStatusesLog($paymentRequest->id, 'Solicitud Creada');

        return $paymentRequest;
    }

    public function showPaymentRequest(int $id)
    {
        $paymentRequest = $this->getPaymentRequest($id);

        return  [
            'payment_request'          => $paymentRequest,
            'module'                   => $this->module,
            'optionsRoutes'            => config('generals.optionRoutes'),
            'images'                   => $paymentRequest->images()->get(['src']),
            'chase_transfers'          => $this->chaseTransferInterface->getLastChaseTransfers($paymentRequest->contractRequestStreamAccount->streaming_id),
            'payment_request_statuses' => $this->paymentRequestStatusInterface->getAllPaymentRequestStatusesNames()
        ];
    }

    public function updatePaymentRequest($request, int $id)
    {
        $paymentRequest = $this->getPaymentRequest($id);

        if ($request->has('chase_transfer_id') && $request['chase_transfer_id'] != null) {
            $validChaseTransfers = $this->chaseTransferInterface->getLastChaseTransfers($paymentRequest->contractRequestStreamAccount->streaming_id);

            if (in_array($request['chase_transfer_id'], $validChaseTransfers->pluck('id')->all())) {
                $targetChaseTransfer = $validChaseTransfers->where('id', $request['chase_transfer_id'])->first();
                $streamingAmounts = $targetChaseTransfer->chaseTransferAmounts->where('streaming_id', $paymentRequest->contractRequestStreamAccount->streaming_id);
                $streamingPayments = $targetChaseTransfer->paymentRequests->where('contractRequestStreamAccount.streaming_id', $paymentRequest->contractRequestStreamAccount->streaming_id);
                if ($streamingPayments->sum('usd_amount') + $request->usd_amount > $streamingAmounts->sum('amount')) {
                    throw new ExceededAmountErrorException('No se encuentra');
                }
            } else {
                throw new StreamingNotFoundErrorException('no se Encuentra');
            }
        }

        if ($paymentRequest->is_aprobed == 0 && $request['payment_request_status_id'] == 5) {
            $request['is_aprobed'] = 1;
        }

        if ($request->hasFile('image')) {
            $this->paymentRequestImageInterface->savePaymentRequestImages($paymentRequest->id, collect($request->file('image')), $paymentRequest->contractRequestStreamAccount->contractRequest->client_identifier);
            $status = 'Comprobante Agregado';
        } elseif ($paymentRequest->paymentRequestStatus->id != $request['payment_request_status_id']) {
            $status = 'Cambio de Estado';
        } else {
            $status = 'Solicitud Actualizada';
        }

        if ($request['is_aprobed'] == 1 && $request['payment_request_status_id'] == 5) {
            $status = 'Solicitud Aprobada';
        }

        $paymentRequest = $this->anulatePaymentRequest($paymentRequest, $request);
        $update         = new PaymentRequestRepository($paymentRequest);
        $update->updatePaymentRequest($request->except('_token', '_method'));
        $this->paymentRequestStatusesLogServiceInterface->storePaymentRequestStatusesLog($paymentRequest->id, $status);
    }

    public function destroyPaymentRequest(int $id)
    {
        $update = new PaymentRequestRepository($this->getPaymentRequest($id));
        $update->deletePaymentRequest();
    }

    public function removePaymentRequestThumbnail(string $src)
    {
        $this->toolsInterface->deleteThumbFromServer($src);
        $this->paymentRequestInterface->deleteThumb($src);
    }

    private function getPaymentRequest(int $id)
    {
        return $this->paymentRequestInterface->findPaymentRequestById($id);
    }

    public function anulatePaymentRequest($paymentRequest, $request)
    {
        if ($paymentRequest->is_aprobed == 0 && $request['payment_request_status_id'] == 9 && $paymentRequest->hasAprovedBankTransfers->isEmpty()) {
            if (!$paymentRequest->paymentRequestAdvances->isEmpty()) {
                $paymentRequest->paymentRequestAdvances->each(function ($paymentRequestAdvance) {
                    $paymentRequestAdvance->is_aprobed                = 0;
                    $paymentRequestAdvance->transfer                  = 0;
                    $paymentRequestAdvance->payment_request_status_id = 9;
                    $paymentRequestAdvance->save();
                });
            }

            if (!$paymentRequest->bankTransfers->isEmpty()) {
                $paymentRequest->bankTransfers->each(function ($bankTransfer) {
                    $bankTransferRepo = new PaymentBankTransferRepository($bankTransfer);
                    $bankTransferRepo->deletePaymentBankTransfer();
                });
            }

            $paymentRequest->is_aprobed     = 0;
            $paymentRequest->payment_cut_id = null;
            $paymentRequest->save();
        }

        return $paymentRequest;
    }

    public function createPaymentAdvance($request, $paymentRequest)
    {
        if ($request->payment_type != 1) {
            $trm                                  = $this->trmServiceInterface->getOnlineTRM();
            $request['payment_request_id']        = $paymentRequest->id;
            $request['value']                     = $this->setPaymentAdvanceValue($paymentRequest, $request->usd_amount, $trm);
            $request['payment_request_status_id'] = 1;

            if ($paymentRequest->payment_type == 2 || $request['loan'] == '1') {
                $paymentRequestAdvance =  $this->paymentRequestAdvanceServiceInterface->storePaymentRequestAdvance($request);

                if ($paymentRequest->payment_type == 2 && $paymentRequest->contractRequestStreamAccount->contractRequest->contract->contractRenewals->first()->contractRate->type == 2) {
                    $paymentRequestAdvance->value      = $this->paymentRequestAdvanceServiceInterface->getTokensPrice($paymentRequestAdvance, $paymentRequest, $trm);
                    $paymentRequest->subtotal          = $this->paymentRequestAdvanceServiceInterface->getUSDTokensPrice($paymentRequest);
                    $paymentRequestAdvance->trm_tokens = ($trm - 200);
                    $paymentRequestAdvance->save();
                    $paymentRequest->save();
                }

                if ($request['loan'] == 1) {
                    $paymentRequestAdvance->load('paymentRequest');
                    event(new PaymentRequestAdvanceCreated($paymentRequestAdvance));
                }
            }
        }
    }

    private function setPaymentAdvanceValue($paymentRequest, $usd_amount, $trm)
    {
        if ($paymentRequest->payment_type == 2 && $paymentRequest->contractRequestStreamAccount->contractRequest->contract->contractRenewals->first()->contractRate->type == 2) {
            return $usd_amount;
        } else {
            return $this->xisfoPayParametersServiceInterface->getAdvanceValuePercentage($usd_amount * $trm);
        }
    }

    public function updatePaymentRequests($paymentCut, $uncutPayments)
    {
        $uncutPayments = $this->addPlatformRealComissionToPayment($uncutPayments);
        $uncutPayments = $this->addPlatformCommecialComissionToPayment($uncutPayments);
        $uncutPayments = $this->addColombianBankCommission($uncutPayments);
        $uncutPayments = $this->addChaseBankCommission($uncutPayments);

        $chaseCommission = $this->bankInterface->findBankProcessingCommission(54)->bank_processing_commission;

        $uncutPayments->each(function ($payment) use ($paymentCut, $chaseCommission) {
            $payment->payment_cut_id  = $paymentCut->id;
            $payment->trm             = $payment->chaseTransfer->chaseTransferTrm->trm;
            $payment->chaseCommission = $chaseCommission * (1 - $payment->contractRequestStreamAccount->contractRequest->is_bank_processing_commission_free);
            $this->liquidatePaymentRequest($payment);
        });
    }

    public function liquidatePaymentRequest($payment)
    {
        if ($payment->payment_type == 2) {
            return $this->liquidateTokens($payment);
        } else {
            return $this->liquidateUSD($payment);
        }
    }

    public function liquidateUSD($payment)
    {
        $contractRate          = $this->getCustomerContractRate($payment);
        $bankPesosTransferCost = $this->getCustomerBankTransferRate($payment);
        $payment->subtotal     = $payment->usd_amount - $payment->commission;
        $payment               = $this->setPaymentTotalAdvance($payment);
        $xisfo_rate            = (($payment->subtotal * $payment->trm) * (1 - $contractRate));
        $payment->grand_total  = round($xisfo_rate - $payment->advances, 2);
        $payment['4x1000']     = $this->xisfoPayParametersServiceInterface->set4x1000($payment->subtotal * $payment->trm);
        $gain                  = round(($payment->subtotal * $payment->trm) - ($payment->advances + $payment->grand_total) - ($payment['4x1000'] + $bankPesosTransferCost), 2);
        $payment->real_gain    = round(($gain - $payment->finantial_retention) - ($this->xisfoPayParametersServiceInterface->getEnsuranceValuePercentage($gain - $payment->finantial_retention)), 2);
        $payment->usd_gain     = round((($payment->subtotal * $payment->trm) - $xisfo_rate) / $payment->trm, 2);
        $payment               = $this->setPaymentFinantialRetention($payment, ($payment->usd_gain * $payment->trm));
        $payment->grand_total  = floor(($payment->grand_total + $payment->finantial_retention -
            ($payment->chaseCommission * $payment->trm)) * 2) / 2;
        $payment->invoice      = round((($payment->subtotal * $payment->trm) * (1 - $contractRate)) / $payment->trm, 2);
        $payment->commission   += $payment->chaseCommission;
        unset($payment->chaseCommission);
        $payment->save();

        return $payment;
    }

    public function liquidateTokens($payment)
    {
        $bankPesosTransferCost    = $this->getCustomerBankTransferRate($payment);
        $payment                  = $this->setPaymentTotalAdvance($payment);
        $payment->commission      = 0;
        $payment->real_commission = 0;
        $payment->subtotal        = round(($payment->usd_amount * $payment->contractRequestStreamAccount->contractRequestStreamAccountCommission->amount) - $payment->commission, 2);
        $payment['4x1000']        = $this->xisfoPayParametersServiceInterface->set4x1000($payment->subtotal * $payment->trm);
        $payment->grand_total     = 0;
        $gain                     = round((($payment->subtotal * $payment->trm) - $payment->paymentRequestAdvances[0]->value) - ($payment['4x1000'] + $bankPesosTransferCost), 2);
        $payment->real_gain       = round($gain - ($this->xisfoPayParametersServiceInterface->getEnsuranceValuePercentage($gain - $payment->finantial_retention)));
        $payment->usd_gain        = round($payment->subtotal, 2);
        $payment->invoice         = round($payment->subtotal, 2);
        unset($payment->chaseCommission);
        $payment->save();

        return $payment;
    }

    public function getCustomerContractRate($payment)
    {
        return $payment->contractRequestStreamAccount->contractRequest->contract->contractRenewals->where('is_active', 1)->first()->contractRate->value;
    }

    public function getCustomerBankTransferRate($payment)
    {
        return $payment->chaseTransfer->ChaseTransferTrm->bank->transfer_rate;
    }

    public function setPaymentFinantialRetention($payment, $gain)
    {
        if ($payment->contractRequestStreamAccount->contractRequest->finantial_retention == 1) {
            $retention = $this->xisfoPayParametersServiceInterface->getValueRetention($gain);
        } else {
            $retention = 0;
        }
        $payment->finantial_retention = $retention;

        return $payment;
    }

    public function setPaymentTotalAdvance($payment)
    {
        $payment->advances = $payment->paymentRequestAdvances->where('is_aprobed', 1)->sum('value');

        return $payment;
    }

    public function addPlatformRealComissionToPayment($uncutPayments)
    {
        $platformsPayments = $uncutPayments->groupBy('contractRequestStreamAccount.streaming_id');
        foreach ($platformsPayments as $streaming => $platformPayments) {
            foreach ($platformPayments as $key => $payment) {
                $sumPaymentAmounts = $payment->chaseTransfer->chaseTransferAmounts->where('streaming_id', $streaming)->sum('amount');
                $payment->real_commission = round(($payment->usd_amount * $payment->contractRequestStreamAccount->streaming->usd_commission) / $sumPaymentAmounts, 2);
                if ($payment->contractRequestStreamAccount->streaming_id == 17) {
                    $payment->real_commission += round($payment->usd_amount * $payment->contractRequestStreamAccount->streaming->usd_token_rate, 2);
                }
            }
        }

        return $platformsPayments->flatten(1);
    }

    public function addPlatformCommecialComissionToPayment($uncutPayments)
    {
        foreach ($uncutPayments as $key => $payment) {
            $payment->commission =  $payment->contractRequestStreamAccount->contractRequestStreamAccountCommission->amount;
            if ($payment->contractRequestStreamAccount->streaming_id == 17) {
                $payment->commission += round($payment->usd_amount * $payment->contractRequestStreamAccount->streaming->usd_token_rate, 2);
            }
        }

        return $uncutPayments;
    }

    public function addColombianBankCommission($uncutPayments)
    {
        $colombianBanksPayments = $uncutPayments->groupBy('chaseTransfer.id');
        foreach ($colombianBanksPayments as $key => $colombianBanksPayment) {
            $sumPaymentAmounts = $colombianBanksPayment[0]->chaseTransfer->transfer_amount;
            foreach ($colombianBanksPayment as $key => $payment) {
                $bankCommissionIva    = round($this->xisfoPayParametersServiceInterface->getValueIva($payment->chaseTransfer->chaseTransferTrm->bank->draft_rate * $payment->chaseTransfer->chaseTransferTrm->trm)) / $payment->chaseTransfer->chaseTransferTrm->trm;
                $usdBankCommissionIva = $bankCommissionIva + $payment->chaseTransfer->chaseTransferTrm->bank->draft_rate;
                $commission =  round(($payment->usd_amount * $usdBankCommissionIva)  / $sumPaymentAmounts, 2);
                $payment->real_commission += $commission;
                $payment->commission += $commission;
            }
        }

        return $colombianBanksPayments->flatten(1);
    }

    public function addChaseBankCommission($uncutPayments)
    {
        $chaseBanksPayments = $uncutPayments->groupBy('chaseTransfer.id');
        foreach ($chaseBanksPayments as $key => $chaseBanksPayment) {
            $sumPaymentAmounts = $chaseBanksPayment[0]->chaseTransfer->chaseTransferAmounts->sum('amount');
            foreach ($chaseBanksPayment as $key => $payment) {
                $commission = round(($payment->usd_amount * $this->bankInterface->getBankDraftRate(54)->draft_rate) / $sumPaymentAmounts, 2);
                $payment->real_commission += $commission;
                //$payment->commission += $commission;
            }
        }
        return $chaseBanksPayments->flatten(1);
    }

    public function resetePaymentRequestValues($paymentCut)
    {
        $paymentCut->paymentRequests->each(function ($paymentRequest) {
            $paymentRequest->commission  = 0;
            $paymentRequest->trm         = 0;
            $paymentRequest->subtotal    = 0;
            $paymentRequest->grand_total = 0;
            $paymentRequest['4x1000']    = 0;
            $paymentRequest->real_gain   = 0;
            $paymentRequest->usd_gain    = 0;
        });

        return $paymentCut;
    }

    public function sendCustomerPaymentRequestApproveNotification($paymentRequests)
    {
        $paymentRequests->each(function ($paymentRequest) {
            event(new PaymentRequestWasApproved($paymentRequest));
        });
    }

    public function addPaymentRequestToCut($requestData)
    {
        $paymentCut = $this->paymentCutInterface->findPaymentCutById($requestData['payment_cut_id']);
        $paymentRequest = $this->paymentRequestInterface->findPaymentRequestById($requestData['payment_request_id']);
        $uncutPayments = new Collection();
        $uncutPayments->push($paymentRequest);
        $this->updatePaymentRequests($paymentCut, $uncutPayments);
        $paymentRequest->refresh();

        if ($paymentCut->is_aprobed == 1) {
            $this->createPaymentBankTransfers($paymentRequest);
        }
    }

    public function createPaymentBankTransfers($paymentRequest)
    {
        $paymentRequest->payment_request_status_id = 7;
        $paymentRequest->save();
        $transferData = [
            'payment_request_id' => $paymentRequest->id,
            'value'              => $paymentRequest->grand_total > 0 ? $paymentRequest->grand_total : 0
        ];

        $paymentBankTransfer = $this->paymentBankTransferInterface->createPaymentBankTransfer($transferData);
        $toNotifyPayments = new Collection();
        $toNotifyPayments->push($paymentRequest);

        $this->sendCustomerPaymentRequestApproveNotification($toNotifyPayments);
        event(new PaymentBankTransferWasCreated($paymentBankTransfer));
    }

    public function pendingPaymentRequests()
    {
        return [
            'paymentRequests' => $this->paymentRequestInterface->findPendingPaymentRequests(),
            'chaseTransfers'  => $this->chaseTransferInterface->getLastChaseTransfers(),
            'module'          => $this->module,
            'optionsRoutes'   => config('generals.optionRoutes'),
            'headers'         => ['Id', 'Fecha', 'Master', 'Monton USD', 'Aprobar']
        ];
    }

    public function approvePaymentRequests($requestData)
    {
        if (array_key_exists('payments', $requestData)) {
            foreach ($requestData['payments'] as $payment) {
                $paymentRequest = $this->paymentRequestInterface->findPaymentRequestById($payment);
                $paymentRequest->is_aprobed = $requestData['is_aprobed'];
                $paymentRequest->chase_transfer_id = $requestData['chase_transfer_id'];
                $paymentRequest->save();
            }
        }
    }
}
