<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Image;
use Illuminate\Support\Facades\Storage;

class ImagesController extends Controller
{

    public function index()
    {
        $images = Image::all();
        return view('images.index', ['images' => $images] );
    }

    public function create()
    {
        //
    }

    public function store(Request $request, $id)
    {
        $featured = 1;
        foreach ($request->file('image') as $file) {
            $path = $file->storePublicly('public/images/games');
            $filename = basename($path);
            Image::create(['filename' => $filename, 'featured' => $featured, 'product_id' => $id]);
            $featured = 0;
        }
    }

    public function show($id)
    {
        $image = Image::findOrFail( $id );
        return view('images.show', [ 'image' => $image ]);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        //selecting featured image
        if (!empty($request->featured)) {
            foreach ($product->images as $image) {
                $image->update(['featured' => 0]);
            }
            $image = Image::findOrFail( $request->featured );
            $image->update(['featured' => 1]);
        }

        //deleting checked images
        if (!empty($request->get('image_id'))) {
            foreach ($product->images as $image) {
                if (in_array($image->id, $request->get('image_id'))) {
                    $fullFileName = 'public/images/games/' . $image->filename;
                    Storage::delete($fullFileName);
                    $image->delete($image->id);
                }
            }
        }

        //adding new images
        if (!empty($request->file('image'))) {
            foreach ($request->file('image') as $file) {
                $path = $file->storePublicly('public/images/games');
                $filename = basename($path);
                Image::create(['filename' => $filename, 'product_id' => $id, 'featured' => 0]);
            }
        }
    }

    public function destroy($id)
    {
        //
    }
}
