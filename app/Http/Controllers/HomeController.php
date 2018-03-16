<?php

namespace App\Http\Controllers;

use App\Product;
use DB;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

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
        $categories = Category::all();
        $products = Product::with('platform','publisher', 'images')->paginate(5);

        return view('home', [
            'products' => $products,
            'categories' => $categories
        ]);
    }

    public function sort(Request $request)
    {
//        dd(url()->previous());
        switch ($request->get('name')) {
            case 'pub':
                $products = Product::select('products.*')->leftJoin('publishers as pub', 'pub.id', '=', 'publisher_id')->orderBy('pub.name', 'desc');
                break;
            case 'plat':
                $products = Product::select('products.*')->leftJoin('platforms as plat', 'plat.id', '=', 'platform_id')->orderBy('plat.name');
                break;
            case 'title':
                $products = Product::with('platform','publisher', 'images')->orderBy('name');
                break;
            case 'ean':
                $products = Product::with('platform','publisher', 'images')->orderBy('ean');
                break;
            case 'release':
                $products = Product::with('platform','publisher', 'images')->orderBy('release_date');
                break;
            case 'stock':
                $products = Product::select('products.*',
                    DB::raw('(SELECT amount FROM stock WHERE product_id = products.id ORDER BY date DESC LIMIT 1) AS amount'))
                    ->orderBy('amount', 'desc');
                break;
            default:
                $products = Product::with('platform','publisher', 'images')->orderBy('name', 'desc');
                break;

        }
        $products = $products->paginate(5);
        $categories = Category::all();
        return view('home', [
            'products' => $products->appends(Input::except('page')),
            'categories' => $categories
        ]);
    }


}
