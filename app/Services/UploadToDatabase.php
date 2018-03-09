<?php

namespace App\Services;

use App\Platform;
use App\Product;
use App\Publisher;
use Carbon\Carbon;
use DOMDocument;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Messerli90\IGDB\Facades\IGDB;

class UploadToDatabase
{
    protected $publisher;

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
                $name = explode(' ', $game[2], 2);
                $data = $this->importFromApi($game);
//                $xml = $this->getDataFromXml($game);

                $publisher = $this->getPublishers();
                if ($publisher === null) {
                    $publisher_id = null;
                } else {
                    $publisher_id = $publisher->id;
                }

                $product = $platform->products()->create(['ean' => $game[0], 'name' => $name[1], 'publisher_id' => $publisher_id] + $data); //Name

                $product->stock()->create(['amount'=>$game[4], 'date'=>Carbon::now() ]); // Stock
                $product->prices()->create(['amount'=>$game[3], 'date'=>Carbon::now() ]); //Price
            } else {
                $product=Product::where('ean', $game[0])->first();
                $product->stock()->create(['amount'=>$game[4], 'date'=>Carbon::now() ]); // Stock
                $product->prices()->create(['amount'=>$game[3], 'date'=>Carbon::now() ]); //Price
            }
        }
    }

    public function importFromApi($game)
    {
        $game_name = explode(' ', $game[2], 2);
        $name = $game_name[1];

        $all_games = IGDB::searchGames($name);

        if ($all_games === null) {
            return 'Api not working.';
        }

        $games = collect($all_games);
        $game = $games->first();

        if (isset($game->summary)) {
            $summary = $game->summary;
        } else {
            $summary = null;
        }

        if (isset($game->release_dates)) {
            $release_date = $game->release_dates;
            $date = Carbon::parse($release_date[0]->human);
        } else {
            $date = null;
        }

        if (isset($game->pegi->rating)) {
            $pegi = $game->pegi->rating;
        } else {
            $pegi = null;
        }

        if (isset($game->videos[0]->video_id)) {
            $video = $game->videos[0]->video_id;
        } else {
            $video = null;
        }
        if (!isset($game->publishers)) {
            $publisher_id = null;
        } else {
            $publisher_id = $game->publishers[0];
        }

        if ($publisher_id === null) {
            $this->publisher = null;
        }
        $publisher = IGDB::getCompany($publisher_id);
        $this->publisher = $publisher->name;

//        $cover_image = $game->cover->url;
//        $screenshots1 = $game->screenshots[0]->url;
//        $screenshots2 = $game->screenshots[1]->url;
//        $screenshots3 = $game->screenshots[2]->url;

        return $data = [
            'description' => $summary,
            'release_date' => $date,
            'video' => $video,
            'pegi' => $pegi
        ];
    }

    public function validate($filename)
    {
        $games = Excel::load($filename)->noHeading()->skipRows(6)->all();

        foreach ($games as $game) {
            $validator = Validator::make(
                $game->toArray(),
                [
                    0 => 'required|numeric',
                    1 => 'required',
                    2 => 'required',
                    3 => 'required|numeric',
                    4 => 'required|integer|min:1',
                ],
                [
                    0 . '.required' => 'EAN code is required.',
                    0 . '.numeric' => 'EAN must be numeric.',
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
                return $validator->errors()->first();
            }
        }
    }

//    public function getDataFromXml($game)
//    {
//        ini_set('max_execution_time', 0);
//        $game_name = explode(' ', $game[2], 2);
//
//        $client = new Client();
//        $res = $client->request('GET', 'http://thegamesdb.net/api/GetGame.php?name=' . $game_name[1]);
//        $res->getStatusCode();
//        $res->getHeaderLine('content-type');
//        $result = $res->getBody();
//        $game = $result->getContents();
//
//        $dom = new DOMDocument;
//        $dom->loadXML($result);
//
//        $release_date = $dom->getElementsByTagName('ReleaseDate');
//        if ($release_date->item(0) !== null) {
//            $date = $release_date->item(0)->nodeValue;
//            $date = Carbon::createFromFormat('d/m/Y', $date);
//        } else {
//            $date = null;
//        }
//
//        $desc = $dom->getElementsByTagName('Overview');
//        if ($desc->item(0) !== null) {
//            $description = $desc->item(0)->nodeValue;
//        } else {
//            $description = null;
//        }
//
//        $rating = $dom->getElementsByTagName('Rating');
//        if ($rating->item(0) !== null) {
//            $pegi = $rating->item(0)->nodeValue;
//        } else {
//            $pegi = null;
//        }
//
//        $publisher = $dom->getElementsByTagName('Publisher');
//        if ($publisher->item(0) !== null) {
//            $this->publisher = $publisher->item(0)->nodeValue;
//        } else {
//            $this->publisher = null;
//        }
//
//        return [
//            'description' => $description,
//            'release_date' => $date,
//            'pegi' => $pegi
//        ];
//    }

    public function getPublishers()
    {
        $pub = Publisher::where('name', $this->publisher)->first();
        if ($this->publisher === null) {
            return;
        }

        if ($pub === null) {
            $publisher =  Publisher::create(['name' => $this->publisher]);
        } else {
            $publisher = Publisher::where('name', $this->publisher)->first();
        }

        return $publisher;
    }
}
