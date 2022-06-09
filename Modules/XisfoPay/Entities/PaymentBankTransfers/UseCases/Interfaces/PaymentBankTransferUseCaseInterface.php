<?php

namespace Modules\XisfoPay\Entities\PaymentBankTransfers\UseCases\Interfaces;

interface PaymentBankTransferUseCaseInterface
{
    public function listPaymentBankTransfers(array $data);

    public function listPaymentBankTransfersToConfirm();

    public function storeBankTransfer(array $requestData);

    public function registerTokenAdvanceBankTransfer($request);

    public function updateBankTransfer($request, int $id);

    public function destroyBankTransfer($id);

    public function confirmTranfers($request);

}
