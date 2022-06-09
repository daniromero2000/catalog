<?php

namespace Modules\XisfoPay\Entities\PaymentBankTransfers\Repositories\Interfaces;

use Illuminate\Support\Collection;
use Modules\XisfoPay\Entities\PaymentBankTransfers\PaymentBankTransfer;

interface PaymentBankTransferRepositoryInterface
{
    public function createPaymentBankTransfer(array $data): PaymentBankTransfer;

    public function updatePaymentBankTransfer(array $data): bool;

    public function findPaymentBankTransferById(int $id): PaymentBankTransfer;

    public function listPaymentBankTransfersToConfirm(): Collection;

    public function listPaymentBankTransfers();

    public function deletePaymentBankTransfer(): bool;

    public function searchPaymentBankTransfer(string $text = null, $from = null, $to = null);

    public function getAprobedPaymentBankTransfers(): Collection;

    public function getCutPaymentBanktransfers($paymentCut);

    public function sendPaymentBankTransferToAdmin($paymentBankTransfer);

    public function listPaymentBankTransfersByCustomerId(array $payment_bank_transfers_ids);

    public function searchPaymentBankTransfersByCustomerId(string $text = null, array $payment_bank_transfers_ids, $from = null, $to = null);

    public function getCustomerPaymentBankTransfers($payment_requests_ids);

    public function sendCustomerPaymentBankTransfersEmailNotification($paymentRequestId);

    public function notifyUnTransferredTransfers();
}
