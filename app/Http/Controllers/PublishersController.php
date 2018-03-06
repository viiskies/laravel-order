<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePublisherRequest;
use App\Publisher;
use Illuminate\Http\Request;

class PublishersController extends Controller
{
    public function index()
    {
        $publishers = Publisher::all();
        return view('publishers.index', ['publishers' => $publishers]);
    }


    public function create()
    {
        return view('publishers.create');
    }


    public function store(StorePublisherRequest $request)
    {
        Publisher::create($request->except('_token'));
        return redirect()->route('publishers.index');
    }


    public function show($id)
    {
        $publisher = Publisher::findOrFail($id);
        return view('publishers.show', ['publisherSingle' => $publisher]);
    }


    public function edit($id)
    {
        $publisher = Publisher::findOrFail($id);
        return view('publishers.edit', ['publisherEdit' => $publisher]);
    }


    public function update(StorePublisherRequest $request, $id)
    {
        Publisher::findOrFail($id)->update(['name' => $request->get('name')]);
        return redirect()->route('publishers.show', $id);
    }


    public function destroy($id)
    {
        Publisher::destroy($id);
        return redirect()->route('publishers.index');
    }
}
