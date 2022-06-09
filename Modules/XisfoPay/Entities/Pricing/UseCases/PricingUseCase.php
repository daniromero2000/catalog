<?php

namespace Modules\XisfoPay\Entities\Pricing\UseCases;

use Modules\Banking\Entities\Banks\Repositories\Interfaces\BankRepositoryInterface;
use Modules\Banking\Entities\Trms\UseCases\Interfaces\TrmUseCaseInterface;
use Modules\XisfoPay\Entities\ContractRates\Repositories\Interfaces\ContractRateRepositoryInterface;
use Modules\XisfoPay\Entities\ContractRequestStreamAccountCommissions\Repositories\Interfaces\ContractRequestStreamAccountCommissionRepositoryInterface;
use Modules\XisfoPay\Entities\Pricing\UseCases\Interfaces\PricingUseCaseInterface;

class PricingUseCase implements PricingUseCaseInterface
{
    private $streamingCommissionInterface, $bankInterface, $trmServiceInterface;
    private $contractRateInterface;

    public function __construct(
        ContractRateRepositoryInterface $contractRateRepositoryInterface,
        TrmUseCaseInterface $trmUseCaseInterface,
        BankRepositoryInterface $bankRepositoryInterface,
        ContractRequestStreamAccountCommissionRepositoryInterface $contractRequestStreamAccountCommissionRepositoryInterface
    ) {
        $this->contractRateInterface        = $contractRateRepositoryInterface;
        $this->streamingCommissionInterface = $contractRequestStreamAccountCommissionRepositoryInterface;
        $this->bankInterface                = $bankRepositoryInterface;
        $this->trmServiceInterface          = $trmUseCaseInterface;
    }

    public function commercialCalculator(): array
    {
        return [
            'trmReduction'         => $this->contractRateInterface->findContractRateById(3),
            'trm'                  => $this->trmServiceInterface->getOnlineTRM(),
            'chaseCommission'      => $this->bankInterface->findBankProcessingCommission(54),
            'streamateCommission'  => $this->streamingCommissionInterface->findCommissionByStreaming(8),
            'epayCommission'       => $this->streamingCommissionInterface->findCommissionByStreaming(17),
            'chaturbateCommission' => $this->streamingCommissionInterface->findCommissionByStreaming(1)
        ];
    }
}
