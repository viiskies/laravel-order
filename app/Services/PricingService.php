<?php

namespace App\Services;

use App\Price;
use Illuminate\Http\Request;

class PricingService
{
    private function countPriceWithCoef($price, $coef, $special_offer_id, $user_id)
    {
        if ($special_offer_id ===null && $user_id === null) {
            $price = $price * $coef;
        }
    }

    private function countPriceWithSpecialOffer()
    {
        if ($special_offer_id !== null) {

        }
    }

    private function countIndividualPrice()
    {
        if($user_id !== null) {

        }
    }

    public function getPrice($user, $product)
    {
        return "dfsdg";
    }
}
