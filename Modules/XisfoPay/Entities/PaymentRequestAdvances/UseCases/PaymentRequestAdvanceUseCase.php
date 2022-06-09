<?php

namespace Modules\XisfoPay\Entities\PaymentRequestAdvances\UseCases;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use Modules\Banking\Entities\Trms\UseCases\Interfaces\TrmUseCaseInterface;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\Generals\Entities\Tools\UploadableTrait;
use Modules\XisfoPay\Entities\ContractRequests\Repositories\Interfaces\ContractRequestRepositoryInterface;
use Modules\XisfoPay\Entities\ContractRequestStreamAccounts\Repositories\Interfaces\ContractRequestStreamAccountRepositoryInterface;
use Modules\XisfoPay\Entities\PaymentBankTransfers\UseCases\Interfaces\PaymentBankTransferUseCaseInterface;
use Modules\XisfoPay\Entities\PaymentRequestAdvanceImages\PaymentRequestAdvanceImage;
use Modules\XisfoPay\Entities\PaymentRequestAdvances\Exceptions\PaymentRequestAdvanceNotFoundException;
use Modules\XisfoPay\Entities\PaymentRequestAdvances\Exceptions\CreatePaymentRequestAdvanceErrorException;
use Modules\XisfoPay\Entities\PaymentRequestAdvances\Exceptions\UpdatePaymentRequestAdvanceErrorException;
use Modules\XisfoPay\Entities\PaymentRequestAdvances\Repositories\PaymentRequestAdvanceRepository;
use Modules\XisfoPay\Entities\PaymentRequestAdvances\Repositories\Interfaces\PaymentRequestAdvanceRepositoryInterface;
use Modules\XisfoPay\Entities\PaymentRequestAdvances\UseCases\Interfaces\PaymentRequestAdvanceUseCaseInterface;
use Modules\XisfoPay\Entities\PaymentRequests\Repositories\Interfaces\PaymentRequestRepositoryInterface;
use Modules\XisfoPay\Entities\PaymentRequestStatuses\Repositories\Interfaces\PaymentRequestStatusRepositoryInterface;
use Modules\XisfoPay\Entities\PaymentRequestStatusesLogs\UseCases\Interfaces\PaymentRequestStatusesLogUseCaseInterface;
use Modules\XisfoPay\Mail\PaymentRequestAdvances\SendNewPaymentRequestAdvanceEmailNotificationToAdmin;

class PaymentRequestAdvanceUseCase implements PaymentRequestAdvanceUseCaseInterface
{
    use UploadableTrait;

    private $toolsInterface, $paymentRequestAdvanceInterface, $paymentRequestStatusInterface;
    private $contractRequestInterface, $contractRequestStreamAccountInterface;
    private $module, $trmServiceInterfa, $paymentRequestInterface;
    private $paymentBankTransferServiceInterface, $paymentRequestStatusesLogServiceInterface;
    private $tokenUsdConversion;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        PaymentRequestRepositoryInterface $paymentRequestRepositoryInterface,
        PaymentRequestStatusRepositoryInterface $paymentRequestStatusRepositoryInterface,
        ContractRequestRepositoryInterface $contractRequestRepositoryInterface,
        ContractRequestStreamAccountRepositoryInterface $contractRequestStreamAccountInterface,
        PaymentRequestAdvanceRepositoryInterface $paymentRequestAdvanceRepositoryInterface,
        TrmUseCaseInterface $trmUseCaseInterface,
        PaymentBankTransferUseCaseInterface $paymentBankTransferUseCaseInterface,
        PaymentRequestStatusesLogUseCaseInterface $paymentRequestStatusesLogUseCaseInterface
    ) {
        $this->toolsInterface                            = $toolRepositoryInterface;
        $this->paymentRequestInterface                   = $paymentRequestRepositoryInterface;
        $this->paymentRequestStatusInterface             = $paymentRequestStatusRepositoryInterface;
        $this->contractRequestInterface                  = $contractRequestRepositoryInterface;
        $this->contractRequestStreamAccountInterface     = $contractRequestStreamAccountInterface;
        $this->paymentRequestAdvanceInterface            = $paymentRequestAdvanceRepositoryInterface;
        $this->trmServiceInterfa                         = $trmUseCaseInterface;
        $this->paymentBankTransferServiceInterface       = $paymentBankTransferUseCaseInterface;
        $this->paymentRequestStatusesLogServiceInterface = $paymentRequestStatusesLogUseCaseInterface;
        $this->tokenUsdConversion                        = 0.05;
        $this->module                                    = 'Prestamos';
        $this->optionRoutes                              = request()->segment(1) . '.' . (request()->segment(2));
    }

    public function listPaymentRequestAdvances(array $data): array
    {
        $searchData      = $this->toolsInterface->setSearchParametersRefactor($data);
        $searchData['q'] = $searchData['q']  == '' ? null : $searchData['q'];

        return [
            'data' => [
                'payment_request_advances'  => $this->paymentRequestAdvanceInterface->searchPaymentRequestAdvance($searchData['q'], $searchData['fromOrigin'], $searchData['toOrigin']),
                'payment_request_statuses' => $this->paymentRequestStatusInterface->getAllPaymentRequestStatusesNames(),
                'optionsRoutes'            => config('generals.optionRoutes'),
                'module'                   => $this->module,
                'headers'                  => ['Fecha', 'Solicitud de Pago',  'Valor', 'Estado', 'Aprobado', 'Opciones'],
            ],
            'search'  =>  $searchData['search']
        ];
    }

    public function listCustomerPaymentRequestAdvances(array $data): array
    {
        $contract_requests_ids         = $this->contractRequestInterface->getCustomerContractRequests(auth()->user()->id);
        $stream_accounts_ids           = $this->contractRequestStreamAccountInterface->getCustomerStreamAccounts($contract_requests_ids);
        $payment_requests_ids          = $this->paymentRequestInterface->getCustomerPaymentRequests($stream_accounts_ids);
        $payment_requests_advances_ids = $this->paymentRequestAdvanceInterface->getCustomerPaymentRequestsAdvances($payment_requests_ids);
        $searchData                    = $this->toolsInterface->setSearchParametersRefactor($data);
        $searchData['q']               = $searchData['q'] == '' ? null : $searchData['q'];

        return [
            'data' => [
                'payment_request_advances' => $this->paymentRequestAdvanceInterface->searchPaymentRequestAdvanceByCustomerId($searchData['q'], $payment_requests_advances_ids, $searchData['fromOrigin'], $searchData['toOrigin']),
                'payment_request_statuses' => $this->paymentRequestStatusInterface->getAllPaymentRequestStatusesNames(),
                'module'                   => $this->module,
                'optionsRoutes'            => config('generals.optionRoutes'),
                'headers'                  => ['Fecha', 'Solicitud de Pago',  'Valor', 'Estado', 'Aprobado', 'Opciones'],
            ],
            'search' => $searchData['search']
        ];
    }

    public function storePaymentRequestAdvance($request)
    {
        $paymentRequestAdvance = $this->paymentRequestAdvanceInterface->createPaymentRequestAdvance($request->except('_token', '_method', 'image'));
        $payment = $paymentRequestAdvance->paymentRequest()->get();
        if ($payment[0]->payment_type == 2 && $payment[0]->contractRequestStreamAccount->contractRequest->contract->contractRenewals->first()->contractRate->type == 2) {
            $trm = $this->trmServiceInterfa->getOnlineTRM();
            $paymentRequestAdvance->value = $this->getTokensPrice($paymentRequestAdvance, $payment[0], $trm);
            $paymentRequestAdvance->save();
        }

        if ($request->hasFile('image')) {
            $this->savePaymentRequestAdvanceImages($paymentRequestAdvance->id, collect($request->file('image')), $payment[0]->contractRequestStreamAccount->contractRequest->client_identifier);
        }

        $this->paymentRequestStatusesLogServiceInterface->storePaymentRequestStatusesLog($paymentRequestAdvance->payment_request_id, array_key_exists('loan', $request->input()) && $request['loan'] == 0 ? 'Compra de Tokens' : 'Prestamo Añadido');

        return $paymentRequestAdvance;
    }

    public function showPaymentRequestAdvance(int $id)
    {
        $paymentRequestAdvance = $this->getPaymentRequestAdvance($id);

        return  [
            'payment_request_advance'  => $paymentRequestAdvance,
            'module'                   => $this->module,
            'optionsRoutes'            => config('generals.optionRoutes'),
            'images'                   => $paymentRequestAdvance->images()->get(['src']),
            'payment_request_statuses' => $this->paymentRequestStatusInterface->getAllPaymentRequestStatusesNames()
        ];
    }

    public function updatePaymentRequestAdvance($request, int $id)
    {
        $paymentRequestAdvance = $this->getPaymentRequestAdvance($id);

        $status = '';
        if ($paymentRequestAdvance->is_aprobed == 0 && $request['payment_request_status_id'] == 5) {
            $request['is_aprobed']         = 1;
            $request['payment_request_id'] = $paymentRequestAdvance->paymentRequest->id;
            $status                        = 'Prestamo Aprobado';
            $paymentRequestAdvance = $this->paymentRequestAdvanceInterface->findPaymentRequestAdvanceById($paymentRequestAdvance->id);
            $paymentRequestAdvance->transfer = 1;
            $paymentRequestAdvance->save();
            $request['payment_request_advance_id'] = $paymentRequestAdvance->id;
            $this->paymentBankTransferServiceInterface->storeBankTransfer($request->except('_token', '_method', 'image'));
        }

        if ($request->hasFile('image')) {
            $this->savePaymentRequestAdvanceImages($paymentRequestAdvance->id, collect($request->file('image')), $paymentRequestAdvance->paymentRequest->contractRequestStreamAccount->contractRequest->client_identifier);
            $this->paymentRequestStatusesLogServiceInterface->storePaymentRequestStatusesLog($paymentRequestAdvance->payment_request_id, 'Comprobante de Prestamo Agregado');
        } elseif ($paymentRequestAdvance->is_aprobed != $request['is_aprobed']) {
            $this->paymentRequestStatusesLogServiceInterface->storePaymentRequestStatusesLog($paymentRequestAdvance->payment_request_id, $status);
        } elseif ($paymentRequestAdvance->paymentRequestStatus->id != $request['payment_request_status_id']) {
            $this->paymentRequestStatusesLogServiceInterface->storePaymentRequestStatusesLog($paymentRequestAdvance->payment_request_id, 'Cambio de Estado de Prestamo');
        } else {
            $this->paymentRequestStatusesLogServiceInterface->storePaymentRequestStatusesLog($paymentRequestAdvance->payment_request_id, 'Estado Prestamo Actualizada');
        }

        $update = new PaymentRequestAdvanceRepository($paymentRequestAdvance);
        $update->updatePaymentRequestAdvance($request->except('_token', '_method'));
    }

    public function savePaymentRequestAdvanceImages($id, Collection $collection, $client)
    {
        $collection->each(function (UploadedFile $file) use ($id, $client) {
            $filename            = $this->storeFile($file, 'payment_request_advances/' . $client);
            $paymentRequestAdvenceImage = new PaymentRequestAdvanceImage([
                'payment_request_advance_id' => $id,
                'src'                => $filename
            ]);
            $paymentRequestAdvenceImage->save();
        });
    }

    public function destroyPaymentRequestAdvance(int $id)
    {
        $update = new PaymentRequestAdvanceRepository($this->getPaymentRequestAdvance($id));
        $update->deletePaymentRequestAdvance();
    }

    public function removePaymentRequestAdvanceThumbnail(string $src)
    {
        $this->toolsInterface->deleteThumbFromServer($src);
        $this->paymentRequestAdvanceInterface->deleteThumb($src);
    }

    private function getPaymentRequestAdvance(int $id)
    {
        return $this->paymentRequestAdvanceInterface->findPaymentRequestAdvanceById($id);
    }

    public function getTokensPrice($paymentRequestAdvance, $payment, $trm)
    {
        return round((($paymentRequestAdvance->value * $this->tokenUsdConversion) * ($trm - $payment->contractRequestStreamAccount->contractRequest->contract->contractRenewals->first()->contractRate->value)));
    }

    public function getUSDTokensPrice($payment)
    {
        return (floor($payment->usd_amount * $this->tokenUsdConversion));
    }

    public function sendNewPaymentRequestAdvanceEmailNotificationToAdmin($paymentRequestAdvance)
    {
        Mail::to(['email' => 'sycgroupsas@gmail.com'])
            ->cc(['contabilidad@sycgroup.co', 'carlosq.syc@gmail.com'])
            ->queue(new SendNewPaymentRequestAdvanceEmailNotificationToAdmin($paymentRequestAdvance));
    }
}
