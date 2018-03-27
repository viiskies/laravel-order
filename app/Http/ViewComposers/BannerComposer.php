<?php

namespace App\Http\ViewComposers;


use App\SpecialOffer;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class BannerComposer
{
    public function compose(View $view)
    {
        $user = Auth::user();
        $offers = new SpecialOffer;
        if ($user->role != 'admin') {
            $offers = $user->specialOffers();
        }
        $offers = $offers->where('expiration_date', '>', Carbon::now('Europe/Vilnius'))->get();
        $view->with(['offers' => $offers]);
    }
}