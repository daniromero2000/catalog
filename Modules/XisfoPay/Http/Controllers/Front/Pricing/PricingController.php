<?php

namespace Modules\XisfoPay\Http\Controllers\Front\Pricing;

use App\Http\Controllers\Controller;
use Modules\XisfoPay\Entities\Pricing\UseCases\Interfaces\PricingUseCaseInterface;

class PricingController extends Controller
{
    private $pricingServiceInterface;

    public function __construct(
        PricingUseCaseInterface $pricingUseCaseInterface
    ) {
        $this->pricingServiceInterface = $pricingUseCaseInterface;
    }

    public function commercialPricingCalculator()
    {
        return view('xisfopay::front.pricing.commercial_calculator', $this->pricingServiceInterface->commercialCalculator());
    }
}
