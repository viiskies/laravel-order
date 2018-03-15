<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        if ($request->get('name') == null) {
            $products = Product::all();
        } else {
            $products = Product::search('*' . $request->get('name') . '*')->get();
        }
        return view('products.index', ['products' => $products, 'query' => $request->get('name')]);

    }
}
