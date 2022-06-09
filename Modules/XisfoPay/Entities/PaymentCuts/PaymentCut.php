<?php

namespace Modules\XisfoPay\Entities\PaymentCuts;

use Illuminate\Database\Eloquent\Model;
use Modules\XisfoPay\Entities\ChaseTransferTrms\ChaseTransferTrm;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\XisfoPay\Entities\PaymentRequests\PaymentRequest;
use Nicolaslopezj\Searchable\SearchableTrait;

class PaymentCut extends Model
{
    use SearchableTrait;
    protected $table = 'payment_cuts';

    protected $fillable = [
        'is_aprobed',
        'chase_transfer_trm_id',
        'chase_transfer_trm',
        'payment_cut_bank',
        'user_approves'
    ];

    protected $hidden = [
        'updated_at',
        'id'
    ];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $dates  = ['created_at', 'updated_at', 'deleted_at'];

    protected $searchable = [
        'columns' => [
            'payment_cuts.id'  => 10,
            'banks.name'       => 10
        ],
        'joins' => [
            'chase_transfer_trms' => ['chase_transfer_trms.id', 'payment_cuts.chase_transfer_trm_id'],
            'banks'            => ['banks.id', 'chase_transfer_trms.bank_id'],
        ]
    ];

    public function searchPaymentCut($term)
    {
        return self::search($term, null, true, true);
    }

    public function paymentRequests(): HasMany
    {
        return $this->hasMany(PaymentRequest::class)->with(['bankTransfers', 'contractRequestStreamAccount', 'chaseTransfer'])
            ->select([
                'id', 'payment_cut_id', 'payment_request_status_id', 'is_aprobed', 'contract_request_stream_account_id',
                'usd_amount', 'commission', 'real_commission', 'trm', 'advances', 'subtotal', '4x1000', 'grand_total', 'payment_request_status_id', 'real_gain', 'finantial_retention', 'usd_gain', 'created_at', 'payment_type',
                'invoice', 'chase_transfer_id'
            ]);
    }

    public function ChaseTransferTrm(): BelongsTo
    {
        return $this->belongsTo(ChaseTransferTrm::class)->with(['bank'])
            ->select(['id', 'trm', 'bank_id']);
    }

    public function paymentRequestsForExport(): HasMany
    {
        return $this->hasMany(PaymentRequest::class)->with(['contractRequestStreamAccount', 'customerBankAccount'])
            ->select([
                'customer_bank_account_id', 'payment_cut_id',  'contract_request_stream_account_id', 'usd_amount', 'commission', 'trm', 'advances', 'subtotal', '4x1000', 'finantial_retention', 'grand_total',
                'invoice', 'real_gain', 'usd_gain', 'created_at', 'payment_type'
            ]);
    }
}
