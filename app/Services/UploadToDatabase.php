<?php

namespace App\Services;

use App\Platform;
use App\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class UploadToDatabase
{
    public $error;

    public function upload($filename)
    {
        $games = Excel::load($filename)->noHeading()->skipRows(6)->all();

        $this->importPlatforms($games);
        $this->importProductsStockPrices($games);
    }

    public function importPlatforms($games)
    {
        $names=[];

        foreach ($games as $game) {
            $name = explode('_', $game[1]);
            $names[] = $name[0];
        }

        $platform_names = array_unique($names);

        $platform_collection = collect($platform_names);

        $existing_names = Platform::all();
        $platforms = $existing_names->pluck('name');
        $diff = $platform_collection->diff($platforms);

        $new_platforms = $diff->all();

        // platforms
        foreach ($new_platforms as $new_platform) {
            Platform::create(['name' => $new_platform]);
        }
    }

    public function importProductsStockPrices($games)
    {
        foreach ($games as $game) {
            $name = explode('_', $game[1]);
            $platform = Platform::where('name', $name)->first();
            $products = Product::all('ean');
            $products_eans= $products->pluck('ean');

            if ($products_eans->contains($game[0]) !== true) {
                $product = $platform->products()->create(['ean' => $game[0], 'name' => $game[2]]);
                $product->stock()->create(['amount'=>$game[4], 'date'=>Carbon::now() ]); // Stock
                $product->prices()->create(['amount'=>$game[3], 'date'=>Carbon::now() ]); //Price
            } else {
                $product=Product::where('ean', $game[0])->first();
                $product->stock()->create(['amount'=>$game[4], 'date'=>Carbon::now() ]); // Stock
                $product->prices()->create(['amount'=>$game[3], 'date'=>Carbon::now() ]); //Price
            }
        }
    }

    public function validate($filename)
    {
        $games = Excel::load($filename)->noHeading()->skipRows(6)->all();

        foreach ($games as $game) {
            $validator = Validator::make(
                $game->toArray(),
                [
                    0 => 'required|digits:13',
                    1 => 'required',
                    2 => 'required',
                    3 => 'required|numeric',
                    4 => 'required|integer|min:1',
                ],
                [
                    0 . '.required' => 'EAN code is required.',
                    0 . '.digits' => 'EAN must be 13 digits.',
                    1 . '.required' => 'Platform is required.',
                    2 . '.required' => 'Title is required.',
                    3 . '.required' => 'Price is required.',
                    3 . '.numeric' => 'Check your price fields.',
                    4 . '.required' => 'Stock is required.',
                    4 . '.integer' => 'Stock must be whole number.',
                    4 . '.min' => 'Stock can not be 0 or negative number.',
                ]
            );

            if ($validator->fails()) {
                return $this->error = $validator->errors()->first();
            }
        }
    }
}
