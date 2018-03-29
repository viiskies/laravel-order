@extends('layouts.main')

@section('content')
    <div class="col-10">
        <div class="row">
            <div class="col-12 text-center mt-5 mb-5">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <h2>Special offer</h2>
            </div>
        </div>
        <div class="row pl-4 pr-4">
            <div class="col-lg-6 col-md-12">
                <h6>Filter by platform and publisher</h6>
                <form action="{{ route('special.filter') }}" method="post" class="form-inline">
                    @csrf
                    <div class="input-group">
                        <select name="platform" class="custom-select" id="inputGroupSelect04">
                            <option value="0"></option>
                            @foreach($platforms as $platform)
                                <option {{$selectedPlatform == $platform->id ? 'selected="selected"' : '' }} value="{{ $platform->id }}">{{ $platform->name }}</option>
                            @endforeach
                        </select>
                        <select name="publisher" class="custom-select" id="inputGroupSelect04">
                            <option value="0"></option>
                            @foreach($publishers as $publisher)
                                <option {{$selectedPublisher == $publisher->id ? 'selected="selected"' : '' }} value="{{ $publisher->id }}">{{ $publisher->name }}</option>
                            @endforeach
                        </select>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Search" name="search">
                            <div class="input-group-append">
                                <button class="btn btn-outline-dark" type="submit" value="filter">Search</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row pl-4 pr-4">
            <div class="col-12">
                <form action="{{ route('special.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12 special-offers-clients-select">
                            <label>Clients</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <label class="special-offers-clients-select-all">Select all</label>
                                        <input class="form-group" type="checkbox" id="check-all">
                                    </div>
                                </div>
                                <select class="custom-select clients_select" name="client_id[]" multiple="multiple">
                                    @foreach($clients as $client)
                                        <option value="{{$client->id}}">{{$client->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <label>Expiration date</label>
                            <input class="form-control" type="date" name="expiration_date">
                        </div>
                        <div class="col-12">
                            <label>Price coefficient</label>
                            <input class="form-control" type="number" step="0.01" name="price_coef">
                        </div>
                        <div class="col-12 ">
                            <label for="exampleFormControlTextarea1"><h4>Description</h4></label>
                            <textarea class="form-control" name="description" id="exampleFormControlTextarea1"
                                      rows="6"></textarea>
                        </div>
                        <div class="col-12">
                            <label><h4>Banner image</h4></label>
                            <input class="form-control" type="file" name="filename">
                        </div>
                    </div>
                    @if ($errors->has('filename'))
                            <div class="alert alert-danger" role="alert">
                                <p>{{ $errors->first('filename') }}</p>
                            </div>
                    @endif
                    <div class="col-12 ml-4 mr-4">
                        <h4 class="mt-4">Products list</h4>
                        <div class="pt-3 pb-3">
                            <input class="select-all-products-special-offers" type="checkbox" name="select_all">
                            <label class="form-check-label" for="defaultCheck1">
                                Select all
                            </label>
                            <div class="row">
                                @foreach($products as $product)
                                    <div style="margin-right: auto" class="col-lg-6 col-md-12">
                                        <input class="form-check-input gamescheckall" name="games[]" type="checkbox"
                                               value="{{ $product->id }}">
                                        <label class="form-check-label" for="defaultCheck1">
                                            {{ $product->name }}
                                        </label>
                                        <input name="specialProductPrice[{{$product->id}}]" placeholder="price" style="width: 50px; float: right;" type="number">
                                    </div>
                                @endforeach
                            </div>
                            @if ($errors->has('games'))
                                    <div class="alert alert-danger" role="alert">
                                        <p>{{ $errors->first('games') }}</p>
                                    </div>
                            @endif
                        </div>
                        <div class="col-12">
                            <button class="btn btn-dark btn-block mt-5" type="submit" value="submit">Submit</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    </div>
@endsection