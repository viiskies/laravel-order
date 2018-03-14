@extends('layouts.main')
@section('content')
<!-- Sidebar -->
<div class="row">
    <div id="sidebar" class="col-2">
            {{-- @admin --}}
            <div class="col-12 text-center">
                <h4>Admin panel</h4>
            </div>
            <div class="sidebar-categories">
                <ul class="list-group">
                    <li>Orders</li>
                    <ul>
                        <li>Pre-Orders</li>
                        <li>Back-Orders</li>
                    </ul>
                    <li>Users</li>
                    <ul>
                        <li>Add user</li>
                    </ul>
                    <li>Products</li>
                    <ul>
                        <li>Add product</li>
                    </ul>
                </ul>
            </div>
            {{-- @endadmin --}}
        <div id="categories" class="row">
            <div class="col-12 text-center">
                <h4>Categories</h4>
            </div>
            <div class="sidebar-categories">
                <ul class="list-group">
                    <li>Cras justo odio</li>
                    <li>Dapibus ac facilisis in</li>
                    <li>Morbi leo risus</li>
                    <li>Porta ac consectetur ac</li>
                    <li>Vestibulum at eros</li>
                    <li>Vestibulum at eros</li>
                    <li>Vestibulum at eros</li>
                    <li>Vestibulum at eros</li>
                    <li>Vestibulum at eros</li>
                    <li>Vestibulum at eros</li>
                    <li>Vestibulum at eros</li>
                </ul>
            </div>
        </div>
        <!-- Most popular -->
        <hr>
        <div id="popular" class="row">
            <div class="col-12 text-center">
                <h4>Most Popular</h4>
            </div>
            <div class="col-12">
                <div class="most-popular-prod-sidebar text-center">
                    <img id="popular" src="https://images-na.ssl-images-amazon.com/images/I/91uQklakGXL._SL1500_.jpg"class="img-thumbnail">
                    <h6 class="mt-2">Half Life</h6>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    <div class="row">
                        <div class="input-group mb-3 d-flex justify-content-center">
                            <input class="counter-inputas" type="number" name="amount">
                            <div class="input-group-append">
                                <a class="btn btn-dark" href="#">Add to Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="most-popular-prod-sidebar text-center">
                    <img id="popular" src="https://images-na.ssl-images-amazon.com/images/I/91uQklakGXL._SL1500_.jpg"class="img-thumbnail">
                    <h6 class="mt-2">Half Life</h6>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    <div class="row">
                        <div class="input-group mb-3 d-flex justify-content-center">
                            <input class="counter-inputas" type="number" name="amount">
                            <div class="input-group-append">
                                <a class="btn btn-dark" href="#">Add to Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="most-popular-prod-sidebar text-center">
                    <img id="popular" src="https://images-na.ssl-images-amazon.com/images/I/91uQklakGXL._SL1500_.jpg"class="img-thumbnail">
                    <h6 class="mt-2">Half Life</h6>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    <div class="row">
                        <div class="input-group mb-3 d-flex justify-content-center">
                            <input class="counter-inputas" type="number" name="amount">
                            <div class="input-group-append">
                                <a class="btn btn-dark" href="#">Add to Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="most-popular-prod-sidebar text-center">
                    <img id="popular" src="https://images-na.ssl-images-amazon.com/images/I/91uQklakGXL._SL1500_.jpg"class="img-thumbnail">
                    <h6 class="mt-2">Half Life</h6>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    <div class="row">
                        <div class="input-group mb-3 d-flex justify-content-center">
                            <input class="counter-inputas" type="number" name="amount">
                            <div class="input-group-append">
                                <a class="btn btn-dark" href="#">Add to Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Table filters -->
    <div class="col-lg-10 col-md-12">
        <div id="radioboxes" class="row justify-content-around">
            <div class="col-12">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck1">
                        Show Pre-orders
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck1">
                        Show Back-orders
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck1">
                        Show Packshots
                    </label>
                </div>
            </div>
            <!-- Product table -->
            
            
            <div class="col-md-12 table-responsive">
                <table class="table table-sm">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">EAN:</th>
                            <th scope="col">Title:</th>
                            <th scope="col">Platform:</th>
                            <th scope="col">Release Date:</th>
                            <th scope="col">Publisher:</th>
                            <th scope="col">Stock:</th>
                            <th scope="col">Price:</th>
                            <th scope="col">Amount</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($errors->first()))
                        {{ $errors->first() }}
                        @endif
                        @foreach($products as $product)
                        <tr>
                            <td Data-label="EAN:" class="align-middle text-right" >{{$product->ean}}</td>
                            <td Data-label="Title:" class="align-middle text-right">{{ $product->name }}</td>
                            <td Data-label="Platform:" class="align-middle text-right">{{ $product->platform->name }}</td>
                            <td Data-label="Release date:" class="align-middle text-right">{{ $product->release_date }}</td>
                            <td Data-label="Publisher:" class="align-middle text-right">{{ $product->publisher->name }}</td>
                            <td Data-label="Stock:" class="align-middle text-right">{{ $product->getPriceAmountAttribute() }}</td>
                            <td Data-label="Price:" class="align-middle text-right">{{ $product->getStockAmountAttribute() }}</td>
                            <td Data-label="Amount" class="align-middle text-right">
                                <input class="input" type="number" id="value{{ $product->id }}" name="amount">
                                <span style="display: none; color: green" id="message{{ $product->id }}" ></span>
                            </td>
                            <td class="align-middle text-right product-image-mobile-center">
                                <button class="btn btn-dark btn-sm add-into-cart" data-url="{{ route('order.store', $product->id) }}">To cart</button>
                            </td>
                            <td class="align-middle product-image-mobile-center">
                                <img class="packshot" src="{{ $product->featured_image_url}}">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div id="pagination" class="row justify-content-center">
                {{$products->links()}}
            </div>
        </div>
    </div>
</div>
<!-- New arrivals -->
<hr>
<div class="row">
    <div class="col-12 text-center">
        <h4>New arrivals</h4>
    </div>
</div>
</div>
<div class="container">
<div class="row">
    <div class="col-sm-2 karuseles-arrow-containeris d-flex justify-content-center">
        <div class="karuseles-arrow prev"><i class="fa fa-caret-left"></i>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="karusele">
            <div class="karuseles-img">
                <img class="gallery" src="https://images-na.ssl-images-amazon.com/images/I/91uQklakGXL._SL1500_.jpg">
                <h5>Half Life</h5>
            </div>
            <div class="karuseles-img">
                <img class="gallery" src="https://images-na.ssl-images-amazon.com/images/I/91uQklakGXL._SL1500_.jpg">
                <h5>Half Life</h5>
            </div>
            <div class="karuseles-img">
                <img class="gallery" src="https://images-na.ssl-images-amazon.com/images/I/91uQklakGXL._SL1500_.jpg">
                <h5>Half Life</h5>
            </div>
            <div class="karuseles-img">
                <img class="gallery" src="https://images-na.ssl-images-amazon.com/images/I/91uQklakGXL._SL1500_.jpg">
                <h5>Half Life</h5>
            </div>
            <div class="karuseles-img">
                <img class="gallery" src="https://images-na.ssl-images-amazon.com/images/I/91uQklakGXL._SL1500_.jpg">
                <h5>Half Life</h5>
            </div>
            <div class="karuseles-img">
                <img class="gallery" src="https://images-na.ssl-images-amazon.com/images/I/91uQklakGXL._SL1500_.jpg">
                <h5>Half Life</h5>
            </div>
            <div class="karuseles-img">
                <img class="gallery" src="https://images-na.ssl-images-amazon.com/images/I/91uQklakGXL._SL1500_.jpg">
                <h5>Half Life</h5>
            </div>
        </div>
    </div>
    <div class="col-sm-2 karuseles-arrow-containeris d-flex justify-content-center">
        <div class="karuseles-arrow next"><i class="fa fa-caret-right"></i></div>
    </div>
</div>
</div>
@endsection