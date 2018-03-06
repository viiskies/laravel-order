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
        return redirect()->route('platforms.show', $id);
    }


    public function destroy($id)
    {
        Platform::destroy($id);
        return redirect()->route('platforms.index');
    }
}
