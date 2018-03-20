@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h4 class="mb-4">Make special offer</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3 mx-auto">
                <h6>Filter by platform</h6>
                <form action="{{ route('special.filter.platform') }}" method="post" class="form-inline">
                    @csrf
                    <div class="form-group">
                      <select class="form-control" name="platform">
                            @foreach($platforms as $platform)
                                <option value="{{ $platform->id }}">{{ $platform->name }}</option>
                            @endforeach
                        </select>
                        <input type="submit" value="Filter" class="btn btn-default">
                    </div>
                </form>
            </div>
            <div class="col-sm-5 mx-auto">
                <h6>Filter by publisher</h6>
                <form action="{{ route('special.filter.publisher') }}" method="post" class="form-inline">
                    @csrf
                    <div class="form-group">
                        <select class="form-control" name="publisher">
                            @foreach($publishers as $publisher)
                                <option value="{{ $publisher->id }}">{{ $publisher->name }}</option>
                            @endforeach
                        </select>
                        <input type="submit" value="Filter" class="btn btn-default">
                    </div>
                </form>
            </div>
            <div class="col-sm-4 mx-auto">
                <h6>Search</h6>
                <form action="{{ route('special.search') }}" method="post" class="form-inline">
                    @csrf
                    <div class="form-group">
                        <input class="form-control" type="text" name="search" placeholder="Search">
                        <input type="submit" value="Filter" class="btn btn-default">
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12"><br><hr>
                <h4>Make special offer</h4>
                @if($products !== null)
                    <form action="{{ route('special.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <input class="form-check-input"  type="checkbox" id="check-all">
                            <label class="form-check-label">Select all</label>
                        </div>
                        <label>Clients</label>
                        <select class="form-control clients_select" name="client_id[]" multiple="multiple">
                            @foreach($clients as $client)
                                <option value="{{$client->id}}">{{$client->name}}</option>
                            @endforeach
                        </select>
                        <label>Expiration date</label>
                            <input class="form-control" type="datetime-local" name="expiration_date">
                        <label>Price</label>
                        <input class="form-control" type="number" step="0.01" name="price">
                        @if(isset($platform_name))
                            <h4 class="mt-4">Products list by {{ $platform_name->name }}</h4>
                        @elseif(isset($publisher_name))
                            <h4 class="mt-4">Products list by {{ $publisher_name->name }}</h4>
                        @else
                            <h4 class="mt-4">Products list</h4>
                        @endif
                        <ul>
                            @foreach($products as $product)
                                <li>
                                    <input class="form-check-input" name="games[]" type="checkbox" value="{{ $product->id }}" id="defaultCheck1">
                                    <label class="form-check-label" for="defaultCheck1">
                                        {{ $product->name }}
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                        <input type="submit" value="submit">
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection