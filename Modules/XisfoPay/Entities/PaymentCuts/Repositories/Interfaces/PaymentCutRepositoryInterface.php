<?php

namespace Modules\XisfoPay\Entities\PaymentCuts\Repositories\Interfaces;

use Illuminate\Support\Collection;
use Modules\XisfoPay\Entities\PaymentCuts\PaymentCut;

interface PaymentCutRepositoryInterface
{
    public function createPaymentCut(array $data): PaymentCut;

    public function updatePaymentCut(array $data): bool;

    public function findPaymentCutById(int $id): PaymentCut;

    public function listPaymentCuts($totalView): Collection;

    public function deletePaymentCut(): bool;

    public function searchPaymentCut(string $text = null, int $totalView, $from = null, $to = null): Collection;

    public function countPaymentCut(string $text = null,  $from = null, $to = null);
}
