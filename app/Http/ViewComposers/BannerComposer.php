<?php

namespace App\Http\ViewComposers;



use App\SpecialOffer;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class BannerComposer
{
    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $user = Auth::user();
        $all_offers = SpecialOffer::all();
        if($user->role == 'admin'){
            $view->with(['offers'=> $all_offers]);
        } else {
            $offers = $user->specialOffers;
            $view->with(['offers'=> $offers]);
        }

    }
}