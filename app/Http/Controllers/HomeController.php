<?php

namespace App\Http\Controllers;

use App\Category;
use App\Platform;
use App\Price;
use App\Product;
use App\Publisher;
use App\Stock;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Messerli90\IGDB\Facades\IGDB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('home', ['products' => $products]);
    }


}
