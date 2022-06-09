<?php

namespace Modules\Ecommerce\Entities\PaymentMethods\PayU;

use Illuminate\Database\Eloquent\Model;

class PaymentMethods extends Model
{
    private $creditCards, $pse;

    public function __construct()
    {
        $this->creditCards = [
            'DINERS' => [
                "id" => "22",
                "description" => "DINERS",
                "country" => "CO",
                "enabled" => true,
                "icon" =>  "img/cards/diners.png"
            ], 'VISA' => [
                "id" => "10",
                "description" => "VISA",
                "country" => "CO",
                "enabled" => true,
                "icon" =>  "img/cards/visa.png"
            ], 'MASTERCARD' => [
                "id" => "10",
                "description" => "MASTERCARD",
                "country" => "CO",
                "enabled" => true,
                "icon" =>  "img/cards/mastercard.png"
            ]
        ];

        $this->pse = [
            "id" => "25",
            "description" => "PSE",
            "country" => "CO",
            "enabled" => true
        ];
    }

    public function getCreditCards()
    {
        return $this->creditCards;
    }

    public function getPse()
    {
        return $this->pse;
    }
}
