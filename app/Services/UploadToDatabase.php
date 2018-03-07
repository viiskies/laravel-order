<?php

namespace App\Services;

use App\Platform;
use App\Product;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class UploadToDatabase
{
   public function upload($filename){
       $games = Excel::load($filename)->noHeading()->skipRows(6)->all();

       

       foreach ($games as $game) {
           if(count($game) !== 5) {
               return redirect()->back()->with('error', 'File is not correct');
           };

           if(round($game[4])!==$game[4]) {
               return redirect()->back()->with('error', 'Check your stock for mistakes');
           }

           foreach ($game as $field) {
               if ($field === null ) {
                   return redirect()->back()->with('error', 'File is not correct');
               }
           }
       }



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

       // products
       foreach ($games as $game) {
           $name = explode('_', $game[1]);
           $platform = Platform::where('name', $name)->first();
           $products = Product::all('ean');
           $products_eans= $products->pluck('ean');

           if($products_eans->contains($game[0]) !== true) {
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
}