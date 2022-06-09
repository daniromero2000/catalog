<?php

namespace Modules\XisfoPay\Entities\PaymentRequestStatuses\Repositories\Interfaces;

use Illuminate\Support\Collection;
use Modules\XisfoPay\Entities\PaymentRequestStatuses\PaymentRequestStatus;

interface PaymentRequestStatusRepositoryInterface
{
    public function createPaymentRequestStatus(array $data): PaymentRequestStatus;

    public function updatePaymentRequestStatus(array $data): bool;

    public function findPaymentRequestStatusById(int $id): PaymentRequestStatus;

    public function listPaymentRequestStatuses($totalView): Collection;

    public function deletePaymentRequestStatus(): bool;

    public function searchPaymentRequestStatus(string $text = null, int $totalView, $from = null, $to = null): Collection;

    public function countPaymentRequestStatus(string $text = null,  $from = null, $to = null);

    public function getAllPaymentRequestStatusesNames(): Collection;
}
