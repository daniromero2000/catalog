<?php

namespace Modules\XisfoPay\Entities\PaymentRequestImages\Repositories\Interfaces;

use Illuminate\Support\Collection;
use Modules\XisfoPay\Entities\PaymentRequestImages\PaymentRequestImage;

interface PaymentRequestImageRepositoryInterface
{
    public function createPaymentRequestImage(array $data): PaymentRequestImage;

    public function updatePaymentRequestImage(array $data): bool;

    public function findPaymentRequestImageById(int $id): PaymentRequestImage;

    public function deletePaymentRequestImage(): bool;

    public function savePaymentRequestImages($id, Collection $collection, $client);
}
