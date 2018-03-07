<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFileRequest;
use App\Platform;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProductsImportController extends Controller
{
    public function importForm()
    {
        return view('import.import');
    }

    public function import(StoreFileRequest $request)
    {
        $filename = $request->file('file');
        $games = Excel::load($filename)->noHeading()->skipRows(6)->all();


        foreach ($games as $game) {
            $name = explode('_', $game[1]);
            $names[] = $name[0];
            $platform_names = array_unique($names);
        }
        $platform_collection = collect($platform_names);

        $existing_names = Platform::all();
        $platforms = $existing_names->pluck('name');
        $diff = $platform_collection->diff($platforms);

        $new_platforms = $diff->all();


        foreach ($new_platforms as $new_platform) {
            Platform::create(['name' => $new_platform]);
        }
    }
}
