<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePlatformRequest;
use App\Platform;

class PlatformController extends Controller
{

    public function index()
    {
        $platforms = Platform::all();
        return view('platforms.index', ['platforms' => $platforms]);
    }


    public function create()
    {   
        return view('platforms.create');
    }


    public function store(StorePlatformRequest $request)
    {
        Platform::create($request->except('_token'));
        session() -> flash( 'success', 'Platform created successfully' );
        return redirect()->route('platforms.index');
    }


    public function show($id)
    {
        $platform = Platform::findOrFail($id);
        return view('platforms.show', ['platformSingle' => $platform]);
    }


    public function edit($id)
    {
        $platform = Platform::findOrFail($id);
        return view('platforms.edit', ['platformEdit' => $platform]);
    }


    public function update(StorePlatformRequest $request, $id)
    {
        Platform::findOrFail($id)->update(['name' => $request->get('name')]);
        session() -> flash( 'success', 'Platform updated successfully' );
        return redirect()->route('platforms.index', $id);
    }


    public function destroy($id)
    {   
        $platform = Platform ::findOrFail( $id );
        if ($platform->products()->count() > 0)
        {
            session() -> flash( 'failure', 'Cannot delete, there are products in this platform' );  
        } else {
            $platform -> delete();
            session() -> flash( 'success', 'Platform deleted successfully' );
        }

        return redirect()->route('platforms.index');
    }
}
