<?php

namespace Modules\XisfoPay\Entities\PaymentRequests;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Customers\Entities\CustomerBankAccounts\CustomerBankAccount;
use Modules\XisfoPay\Entities\ChaseTransfers\ChaseTransfer;
use Modules\XisfoPay\Entities\ContractRequestStreamAccounts\ContractRequestStreamAccount;
use Modules\XisfoPay\Entities\PaymentBankTransfers\PaymentBankTransfer;
use Modules\XisfoPay\Entities\PaymentCuts\PaymentCut;
use Modules\XisfoPay\Entities\PaymentRequestAdvances\PaymentRequestAdvance;
use Modules\XisfoPay\Entities\PaymentRequestCommentaries\PaymentRequestCommentary;
use Modules\XisfoPay\Entities\PaymentRequestImages\PaymentRequestImage;
use Modules\XisfoPay\Entities\PaymentRequestStatuses\PaymentRequestStatus;
use Modules\XisfoPay\Entities\PaymentRequestStatusesLogs\PaymentRequestStatusesLog;
use Nicolaslopezj\Searchable\SearchableTrait;

class PaymentRequest extends Model
{
    use SearchableTrait;
    protected $table = 'payment_requests';

    protected $fillable = [
        'contract_request_stream_account_id',
        'usd_amount',
        'trm',
        'commission',
        'advances',
        'subtotal',
        '4x1000',
        'grand_total',
        'finantial_retention',
        'payment_request_status_id',
        'payment_type',
        'customer_bank_account_id',
        'invoice',
        'is_aprobed',
        'chase_transfer_id'
    ];

    protected $hidden = [
        'updated_at',
        'id',
        'relevance'
    ];

    protected $guarded = [
        'id',
        'updated_at'
    ];

    protected $dates  = ['created_at', 'updated_at', 'deleted_at'];

    protected $searchable = [
        'columns' => [
            'payment_requests.id'                       => 10,
            'payment_request_statuses.name'             => 10,
            'contract_request_stream_accounts.nickname' => 10,
            'customer_companies.company_legal_name'     => 9,
        ],
        'joins' => [
            'contract_request_stream_accounts' => ['contract_request_stream_accounts.id', 'payment_requests.contract_request_stream_account_id'],
            'contract_requests'                => ['contract_requests.id', 'contract_request_stream_accounts.contract_request_id'],
            'customer_companies'               => ['customer_companies.id', 'contract_requests.customer_company_id'],
            'payment_request_statuses'         => ['payment_request_statuses.id', 'payment_requests.payment_request_status_id']
        ]
    ];

    public function searchPaymentRequest($term)
    {
        return self::search($term, null, true, true);
    }

    public function paymentRequestStatus(): BelongsTo
    {
        return $this->belongsTo(PaymentRequestStatus::class)
            ->select(['id', 'name', 'color', 'is_active']);
    }

    public function paymentRequestCommentaries(): HasMany
    {
        return $this->hasMany(PaymentRequestCommentary::class)
            ->orderBy('created_at', 'desc')
            ->select(['id', 'commentary', 'payment_request_id', 'user', 'created_at']);
    }

    public function paymentRequestStatusesLogs(): HasMany
    {
        return $this->hasMany(PaymentRequestStatusesLog::class)
            ->orderBy('created_at', 'desc')
            ->select(['id', 'payment_request_id', 'user', 'status', 'time_passed', 'created_at']);
    }

    public function activeContractRequestStreamAccount(): BelongsTo
    {
        return $this->belongsTo(ContractRequestStreamAccount::class)
            ->with(['contractRequest', 'streaming'])->where('is_active', 0)
            ->select(['id', 'contract_request_id', 'streaming_id', 'nickname', 'set_up', 'is_active', 'created_at']);
    }

    public function contractRequestStreamAccount(): BelongsTo
    {
        return $this->belongsTo(ContractRequestStreamAccount::class, 'contract_request_stream_account_id', 'id')
            ->with(['contractRequest', 'streaming', 'contractRequestStreamAccountCommission'])
            ->select(['id', 'contract_request_id', 'streaming_id', 'nickname', 'set_up', 'contract_request_stream_account_commission_id', 'is_active', 'created_at']);
    }


    public function paymentRequestAdvances(): HasMany
    {
        return $this->hasMany(PaymentRequestAdvance::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(PaymentRequestImage::class)
            ->select(['id', 'payment_request_id', 'src']);
    }

    public function paymentCut(): BelongsTo
    {
        return $this->belongsTo(PaymentCut::class)
            ->select(['id', 'is_aprobed', 'trm', 'created_at']);
    }

    public function bankTransfers(): HasMany
    {
        return $this->hasMany(PaymentBankTransfer::class)->with(['paymentRequest'])
            ->select(['id', 'payment_request_id', 'value', 'is_transfered', 'is_aprobed', 'created_at']);
    }

    public function customerBankAccount(): BelongsTo
    {
        return $this->belongsTo(CustomerBankAccount::class)->with(['bankNames', 'bankAccountCustomerIdentity'])
            ->select(['id', 'bank_id', 'customer_identity_id', 'account_type', 'account_number']);
    }

    public function hasUnAprobedAdvances(): HasMany
    {
        return $this->hasMany(PaymentRequestAdvance::class)->where('is_aprobed', 0);
    }

    public function hasAprovedBankTransfers(): HasMany
    {
        return $this->hasMany(PaymentBankTransfer::class)->where('is_transfered', 1);
    }

    public function chaseTransfer()
    {
        return $this->belongsTo(ChaseTransfer::class)
            ->with(['chaseTransferTrm', 'chaseTransferAmounts'])
            ->select(['id', 'chase_transfer_trm_id', 'transfer_amount', 'created_at', 'commission']);
    }
}
