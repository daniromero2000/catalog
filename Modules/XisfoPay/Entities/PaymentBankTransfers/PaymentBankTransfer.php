<?php

namespace Modules\XisfoPay\Entities\PaymentBankTransfers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\XisfoPay\Entities\PaymentRequestAdvances\PaymentRequestAdvance;
use Modules\XisfoPay\Entities\PaymentRequests\PaymentRequest;
use Nicolaslopezj\Searchable\SearchableTrait;

class PaymentBankTransfer extends Model
{
    use SoftDeletes, SearchableTrait;
    protected $table = 'payment_bank_transfers';

    protected $fillable = [
        'payment_request_id',
        'payment_request_advance_id',
        'value',
        'is_transfered'
    ];

    protected $hidden = [
        'updated_at',
        'id',
        'relevance'
    ];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $dates  = ['created_at', 'updated_at', 'deleted_at'];

    protected $searchable = [
        'columns' => [
            'payment_bank_transfers.id'                  => 10,
            'customer_bank_accounts.account_number'      => 10,
            'contract_request_stream_accounts.nickname'  => 8,
            'customer_companies.company_legal_name'      => 9,
            'banks.name'                                 => 9,
        ],
        'joins' => [
            'payment_requests'                 => ['payment_requests.id', 'payment_bank_transfers.payment_request_id'],
            'customer_bank_accounts'           => ['customer_bank_accounts.id', 'payment_requests.customer_bank_account_id'],
            'banks'                            => ['banks.id', 'customer_bank_accounts.bank_id'],
            'contract_request_stream_accounts' => ['contract_request_stream_accounts.id', 'payment_requests.contract_request_stream_account_id'],
            'contract_requests'                => ['contract_requests.id', 'contract_request_stream_accounts.contract_request_id'],
            'customer_companies'               => ['customer_companies.id', 'contract_requests.customer_company_id']
        ]
    ];

    public function searchPaymentBankTransfer($term)
    {
        return self::search($term, null, true, true);
    }

    public function paymentRequest(): BelongsTo
    {
        return $this->belongsTo(PaymentRequest::class)
            ->with(['contractRequestStreamAccount', 'customerBankAccount'])
            ->select(['id', 'contract_request_stream_account_id', 'customer_bank_account_id']);
    }

    public function paymentRequestAdvance(): BelongsTo
    {
        return $this->belongsTo(PaymentRequestAdvance::class)
            ->select(['id']);
    }
}
