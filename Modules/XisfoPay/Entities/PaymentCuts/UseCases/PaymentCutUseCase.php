<?php

namespace Modules\XisfoPay\Entities\PaymentCuts\UseCases;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\XisfoPay\Entities\PaymentBankTransfers\Repositories\Interfaces\PaymentBankTransferRepositoryInterface;
use Modules\XisfoPay\Entities\PaymentCuts\Repositories\PaymentCutRepository;
use Modules\XisfoPay\Entities\PaymentCuts\Repositories\Interfaces\PaymentCutRepositoryInterface;
use Modules\XisfoPay\Entities\PaymentCuts\UseCases\Interfaces\PaymentCutUseCaseInterface;
use Modules\XisfoPay\Entities\ChaseTransferTrms\Repositories\Interfaces\ChaseTransferTrmRepositoryInterface;
use Modules\XisfoPay\Entities\PaymentRequests\Repositories\Interfaces\PaymentRequestRepositoryInterface;
use Modules\XisfoPay\Entities\PaymentRequests\UseCases\Interfaces\PaymentRequestUseCaseInterface;
use Modules\XisfoPay\Events\PaymentBankTransfers\PaymentBankTransferWereCreated;
use Modules\XisfoPay\Events\PaymentCuts\PaymentCutWasCreated;

class PaymentCutUseCase implements PaymentCutUseCaseInterface
{
    private $toolsInterface, $paymentCutInterface, $paymentRequestInterface;
    private $paymentBankTransferInterface, $chaseTransferTrmInterface, $paymentRequestServiceInterface;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        PaymentCutRepositoryInterface $paymentCutRepositoryInterface,
        PaymentRequestRepositoryInterface $paymentRequestRepositoryInterface,
        PaymentBankTransferRepositoryInterface $paymentBankTransferRepositoryInterface,
        ChaseTransferTrmRepositoryInterface $chaseTransferTrmRepositoryInterface,
        PaymentRequestUseCaseInterface $paymentRequestUseCaseInterface
    ) {
        $this->toolsInterface                 = $toolRepositoryInterface;
        $this->paymentCutInterface            = $paymentCutRepositoryInterface;
        $this->paymentRequestInterface        = $paymentRequestRepositoryInterface;
        $this->paymentBankTransferInterface   = $paymentBankTransferRepositoryInterface;
        $this->chaseTransferTrmInterface      = $chaseTransferTrmRepositoryInterface;
        $this->paymentRequestServiceInterface = $paymentRequestUseCaseInterface;
        $this->module                         = 'Cortes de Pago';
    }

    public function listPaymentCuts(array $data): array
    {
        $searchData = $this->toolsInterface->setSearchParameters($data);

        if ($searchData['q'] != '' && ($searchData['fromOrigin'] == '' || $searchData['toOrigin'] == '')) {
            $list     = $this->paymentCutInterface->searchPaymentCut($searchData['q'], $searchData['skip'] * 10);
            $paginate = $this->paymentCutInterface->countPaymentCut($searchData['q'], '');
            $searchData['search'] = true;
        } elseif (($searchData['q'] != '' || $searchData['fromOrigin'] != '' || $searchData['toOrigin'] != '')) {
            $from     = $searchData['fromOrigin'] != '' ? $searchData['fromOrigin'] : Carbon::now()->subMonths(1);
            $to       = $searchData['toOrigin'] != '' ? $searchData['toOrigin'] : Carbon::now();
            $list     = $this->paymentCutInterface->searchPaymentCut($searchData['q'], $searchData['skip'] * 10, $from, $to);
            $paginate = $this->paymentCutInterface->countPaymentCut($searchData['q'], $from, $to);
            $searchData['search'] = true;
        } else {
            $paginate = $this->paymentCutInterface->countPaymentCut(null);
            $list     = $this->paymentCutInterface->listPaymentCuts($searchData['skip'] * 10);
        }

        $getPaginate  = $this->toolsInterface->getPaginate($paginate, $searchData['skip']);

        return [
            'data' => [
                'payment_cuts'  => $list,
                'optionsRoutes' => config('generals.optionRoutes'),
                'module'        => $this->module,
                'headers'       => ['Fecha', 'ID', 'Aprobado', 'Opciones'],
                'skip'          => $searchData['skip'],
                'paginate'      => $getPaginate['paginate'],
                'position'      => $getPaginate['position'],
                'page'          => $getPaginate['page'],
                'limit'         => $getPaginate['limit']
            ],
            'search'  =>  $searchData['search']
        ];
    }

    public function createPaymentCut()
    {
        return [
            'optionsRoutes'        => config('generals.optionRoutes'),
            'module'               => $this->module,
            'uncutPaymentRequests' => $this->paymentRequestInterface->getAprobedPaymentRequests(),
            'chaseTransferTrms'       => $this->chaseTransferTrmInterface->getActiveChaseTransferTrm()
        ];
    }

    public function storePaymentCut(array $requestData)
    {
        $paymentCut = $this->paymentCutInterface->createPaymentCut($requestData);
        $this->paymentRequestServiceInterface->updatePaymentRequests($paymentCut, $this->paymentRequestInterface->getAprobedPaymentRequests());
        event(new PaymentCutWasCreated($paymentCut));
    }

    public function showPaymentCut(int $id)
    {
        $payment_cut = $this->getPaymentCut($id);
        $chaseTransfers = new Collection();
        if ($payment_cut->paymentRequests != null) {
            $chaseTransfers = $payment_cut->paymentRequests->groupBy('chaseTransfer.id');
        }
        $chaseTransfers->forget("");

        return [
            'payment_cut'           => $payment_cut,
            'chaseTransfers'        => $chaseTransfers,
            'pendingPayments'       => $this->paymentRequestInterface->findPendingPayments($chaseTransfers->keys()->all()),
            'optionsRoutes'         => config('generals.optionRoutes'),
            'module'                => $this->module,
            'totalCutGain'          => $payment_cut->paymentRequests->sum('real_gain'),
            'totalCutTransfer'      => $payment_cut->paymentRequests->sum('subtotal'),
            'totalCutTransferPesos' => $payment_cut->paymentRequests->sum('grand_total'),
            'totalUSDCommission'    => $payment_cut->paymentRequests->sum('commission')
        ];
    }

    public function updatePaymentCut(array $requestData, int $id)
    {
        $payment_cut = $this->getPaymentCut($id);
        $user                         = $this->toolsInterface->setSignedUser();
        $requestData['user_approves'] = $user->name . ' ' . $user->last_name;
        $update                       = new PaymentCutRepository($payment_cut);
        $update->updatePaymentCut($requestData);
        $this->createPaymentCutBankTransfers($payment_cut);
    }

    public function createPaymentCutBankTransfers($paymentCut)
    {
        $paymentCut->paymentRequests->each(function ($paymentRequest) {
            $paymentRequest->payment_request_status_id = 7;
            $paymentRequest->save();
            $transferData = [
                'payment_request_id' => $paymentRequest->id,
                'value'              => $paymentRequest->grand_total > 0 ? $paymentRequest->grand_total : 0
            ];

            $this->paymentBankTransferInterface->createPaymentBankTransfer($transferData);
        });

        $paymentCut->refresh();
        $this->paymentRequestServiceInterface->sendCustomerPaymentRequestApproveNotification($paymentCut->paymentRequests);
        event(new PaymentBankTransferWereCreated($paymentCut));
    }

    public function reCalculatePaymentCut($id)
    {
        $payment_cut = $this->getPaymentCut($id);
        $payment_cut = $this->paymentRequestServiceInterface->resetePaymentRequestValues($payment_cut);
        $this->paymentRequestServiceInterface->updatePaymentRequests($payment_cut, $payment_cut->paymentRequests);
        return $payment_cut->id;
    }

    public function exportPaymentCut($id)
    {
        $payment_cut = $this->getPaymentCut($id);
        return 'corte' . " " . $payment_cut->created_at->format('Y-m-d') . '.xlsx';
    }

    public function exportPaymentCutBankTransfers($id)
    {
        $payment_cut = $this->getPaymentCut($id);
        return 'transferencias' . " " . $payment_cut->created_at->format('Y-m-d') . '.xlsx';
    }

    public function destroyPaymentCut(int $id)
    {
        $update = new PaymentCutRepository($this->getPaymentCut($id));
        $update->deletePaymentCut();
    }

    public function getPaymentCut(int $id)
    {
        return $this->paymentCutInterface->findPaymentCutById($id);
    }
}
