@extends('layouts.main')

@section('content')
<div class="col-10">
    <div class="row">
        <div class="col-12 text-center mt-5 mb-5">
            <h2>Special offer</h2>
        </div>
    </div>
    <div class="row pl-4 pr-4">
        <div class="col-lg-3 col-md-12">
            <h6>Filter by platform</h6>
            <form action="{{ route('special.filter.platform') }}" method="post" class="form-inline">
                @csrf
                <div class="input-group">
                    <select name="platform" class="custom-select" id="inputGroupSelect04">
                        @foreach($platforms as $platform)
                        <option value="{{ $platform->id }}">{{ $platform->name }}</option>
                        @endforeach
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-outline-dark" type="submit">Filter</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-5 col-md-12 mx-auto">
            <h6>Filter by publisher</h6>
            <form action="{{ route('special.filter.publisher') }}" method="post" class="form-inline">
                @csrf
                <div class="input-group">
                    <select name="publisher" class="custom-select" id="inputGroupSelect04">
                        @foreach($publishers as $publisher)
                        <option value="{{ $publisher->id }}">{{ $publisher->name }}</option>
                        @endforeach
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-outline-dark" type="submit">Filter</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-4 col-md-12 mx-auto">
            <h6>Search</h6>
            <form action="{{ route('special.search') }}" method="post" class="form-inline">
                @csrf
                <div class="input-group mb-3">
                  <input type="text" class="form-control" placeholder="Search" name="search">
                  <div class="input-group-append">
                    <button class="btn btn-outline-dark" type="submit" value="Filter">Search</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="row pl-4 pr-4">
    <div class="col-12">
        @if($products !== null)
        <form action="{{ route('special.store') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-12 special-offers-clients-select">
                    <label>Clients</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <div class="input-group-text">
                            <label class="special-offers-clients-select-all">Select all</label>
                              <input class="form-group"  type="checkbox" id="check-all">
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
          <input class="form-control" type="datetime-local" name="expiration_date">
      </div>
      <div class="col-12">
          <label>Price</label>
          <input class="form-control" type="number" step="0.01" name="price">
          @if(isset($platform_name))
          <h4 class="mt-4">Products list by {{ $platform_name->name }}</h4>
          @elseif(isset($publisher_name))
          <h4 class="mt-4">Products list by {{ $publisher_name->name }}</h4>
          @else
          <h4 class="mt-4">Products list</h4>
          @endif
          <div class="pt-3 pb-3">
          <input class="select-all-products-special-offers" type="checkbox" name="select_all">
          <label class="form-check-label" for="defaultCheck1">
          Select all
          </label>
      </div>
      </div>
      <div class="col-12 ml-4 mr-4">
        <div class="row">
            @foreach($products as $product)
            <div class="col-lg-4 col-md-12">
                <input class="form-check-input gamescheckall" name="games[]" type="checkbox" value="{{ $product->id }}">
                <label class="form-check-label" for="defaultCheck1">
                    {{ $product->name }}
                </label>
            </div>
            @endforeach
        </div>
    </div>
    <div class="col-12">
        <button class="btn btn-dark mt-3" type="submit" value="submit">Submit</button>
    </div>
</div>
</form>
@endif
</div>
</div>
</div>
</div>
@endsection