<?php

namespace Modules\XisfoPay\Entities\PaymentRequestCommentaries\Repositories;

use Illuminate\Database\QueryException;
use Modules\XisfoPay\Entities\PaymentRequestCommentaries\PaymentRequestCommentary;
use Modules\XisfoPay\Entities\PaymentRequestCommentaries\Exceptions\CreatePaymentRequestCommentaryErrorException;
use Modules\XisfoPay\Entities\PaymentRequestCommentaries\Repositories\Interfaces\PaymentRequestCommentaryRepositoryInterface;

class PaymentRequestCommentaryRepository implements PaymentRequestCommentaryRepositoryInterface
{
    protected $model;

    public function __construct(
        PaymentRequestCommentary $contractCommentary
    ) {
        $this->model = $contractCommentary;
    }

    public function createPaymentRequestCommentary(array $data): PaymentRequestCommentary
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreatePaymentRequestCommentaryErrorException($e->getMessage());
        }
    }
}
