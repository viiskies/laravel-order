<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class SuggestionController extends Controller
{
    public function suggest(Request $request)
    {
        $products = Product::searchRaw([
            "suggest" => [
                "product-suggest" => [
                    "prefix" => $request->get('term'),
                    "completion" => [
                        "field" => "suggest",
                        "fuzzy" => [
                            "fuzziness" => 'auto'
                        ],
                        "skip_duplicates" => true
                    ]
                ],
            ]
        ]);
        $prodArr = [];
        $products = $products['suggest']['product-suggest'][0]['options'];
        foreach ($products as $product) {
            $prodArr[] = ['value' => $product['text']];
        }

        return response()->json($prodArr, 200);
    }
}

