<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePublisherRequest;
use App\Publisher;
use Illuminate\Http\Request;
use Session;

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
        session() -> flash( 'success', 'Publisher created successfully' );
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
        session() -> flash( 'success', 'Publisher updated successfully' );
        return redirect()->route('publishers.index', $id);
    }


    public function destroy($id)
    {   
        $publisher = Publisher::findOrFail( $id );
        if ($publisher->products()->count() > 0)
        {
            session() -> flash( 'failure', 'Cannot delete, there are products for this publisher' );    
        } else {
            Publisher::destroy($id);
            session() -> flash( 'success', 'Publisher deleted successfully' );
        }
        
        return redirect()->route('publishers.index');
    }
}
