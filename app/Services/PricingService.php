<?php

namespace App\Services;

use App\Price;
use App\SpecialOffer;
use App\User;
use Illuminate\Http\Request;

class PricingService
{
    private function countPriceWithCoef($user, $product)
    {
        $new_product = $product->prices()->where('special_offer_id', null)->where('user_id', null)->orderBy('date', 'DESC')->first();
        $new_price = $new_product->amount;
        $coef = $user->price_coefficient;
        $price = $new_price * $coef;
        return $price;
    }

    private function countPriceWithSpecialOffer($user, $product)
    {
        dd($user->specialOffers);
        $offers = $product->prices()->where('special_offer_id', '!=', null)->where('user_id', null)->get();
        dd($offers);
        dd($offers->pluck('amount'));
        $price = min($offers->toArray());
        dd($price);

//        return $price;
    }

    private function countIndividualPrice($user, $product)
    {
        if($user_id !== null) {

        }
    }

    public function getPrice($user, $product)
    {
        $this->countPriceWithSpecialOffer($user, $product);
        $this->countPriceWithCoef($user, $product);

    }
}
