@extends('layouts.main')
@section('content')

<div class="row">
    <div id="sidebar" class="col-2">
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
                    <img id="popular" src="images/fc4.jpg"class="img-thumbnail">
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
                    <img id="popular" src="images/fc4.jpg"class="img-thumbnail">
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

    <!-- Single page -->

    <div class="col-10 mt-5 single-product">
        <div class="row">
            <div class="col-lg-12 col-md-12 text-center">
                <h1>{{ $productSingle->name }}</h1> 
            </div>
            <div class="col-lg-12 col-md-12 text-center">
                <h4 class="single-pre-order">Pre-Order Now</h4>
            </div>
        </div>
        <div class="row">
            {{-- @admin --}}
            <div class="col-12 d-flex justify-content-center">
                <a href="{{ route('products.edit', $productSingle->id) }}"><button class="btn btn-secondary">Edit</button></a>
                <form action="{{ route('products.destroy', ['id' => $productSingle->id ])}}" method="post">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="_method" value="delete">
                        <button type="submit" class="btn btn-secondary">Delete</button>
                    </div>
                </form>
            </div>
            {{-- @endadmin --}}
        </div>
        <div class="row slider-mobile-margin">
            <div class="col-lg-5 col-md-12">
                <div class="row">
                    <div class="col-12">
                        <div id="gll" class="slider-for">
                            <div class="single-product-image d-flex justify-content-center"><a href="{{ $productSingle->featured_image_url }}"><img class="zoom" src="{{ $productSingle->featured_image_url }}"></a></div>
                            @foreach($productSingle->images as $image)
                            @if($image->featured != 1)
                            <div class="single-product-image d-flex justify-content-center"><a href="{{ $image->url }}"><img class="zoom" src="{{ $image->url }}"></a></div>
                            @endif
                            @endforeach        
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 d-flex justify-content-center">
                        <div class="slider-nav mt-3">
                            <div class="d-flex justify-content-center"><img class="zoom" src="{{ $productSingle->featured_image_url }}"></div>
                            @foreach($productSingle->images as $image)
                            @if($image->featured != 1)
                            <div class="d-flex justify-content-center"><img class="zoom" src="{{ $image->url }}"></div>
                            @endif
                            @endforeach  
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-10 mt-5 pl-5 single-info">
                        @foreach ($productSingle->categories as $cat)
                        <p>Category: {{ $cat->name }}</p>
                        @endforeach
                        <p>EAN: {{ $productSingle->ean }}</p>
                        <p>Platform: {{ $productSingle->platform->name }}</p>
                        @if (isset($productSingle->publisher->name))
                        <p>Publisher: {{ $productSingle->publisher->name }}</p>
                        @endif
                        <p>Pegi Rating: {{ $productSingle->pegi }}</p>
                        <p>Release date: {{ $productSingle->release_date }}</p>
                    </div>
                </div>

            </div>
            <div class="col-lg-7 col-md-12">

                <div class="row">
                    <div class="col-lg-12 col-md-12 single-price-block">
                        <div class="row">
                            <div class="col-lg-1 col-md-6">
                                <p>Price:</p>
                            </div>
                            <div class="col-lg-2 col-md-6">
                                <h3>€{{ $productSingle->price_amount }}</h3>
                            </div>
                            <div class="col-lg-1 col-md-6">
                                <p>Stock:</p>
                            </div>
                            <div class="col-lg-2 col-md-6">
                                <h3>{{ $productSingle->stock_amount }}</h3>
                            </div>
                            <div class="col-lg-6 col-md-12 single-price-block-button">
                                <div class="input-group mt-1 mb-1 d-flex justify-content-center">
                                    <input class="counter-inputas" type="number" name="amount">
                                    <div class="input-group-append">
                                        <a class="btn btn-dark" href="#">Add to Cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-justify mt-3">
                        <p>{{ $productSingle->description }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mt-3">
                        <iframe width="100%" height="315" src="{{ $productSingle->video }}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-12 mt-5">
            <h4>Related products</h4>
        </div>
        <div class="row mt-3">
            @foreach ($products as $related_prod)
            <div class="col-lg-3 col-md-12 related-products d-flex justify-content-center">
                <a href="{{ route('products.show', [ 'id' => $related_prod->id ]) }}"><img src="{{ $related_prod->featured_image_url }}"></a>
            </div>
            @endforeach
        </div>
    </div>
</div>

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
            <div class="karuseles-arrow prev"><i class="fas fa-caret-left"></i>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="karusele">
                <div class="karuseles-img">
                    <img class="gallery" src="images/fc4.jpg">
                    <h5>Half Life</h5>
                </div>
                <div class="karuseles-img">
                    <img class="gallery" src="images/fc4.jpg">
                    <h5>Half Life</h5>
                </div>
                <div class="karuseles-img">
                    <img class="gallery" src="images/fc4.jpg">
                    <h5>Half Life</h5>
                </div>
                <div class="karuseles-img">
                    <img class="gallery" src="images/fc4.jpg">
                    <h5>Half Life</h5>
                </div>
                <div class="karuseles-img">
                    <img class="gallery" src="images/fc4.jpg">
                    <h5>Half Life</h5>
                </div>
                <div class="karuseles-img">
                    <img class="gallery" src="images/fc4.jpg">
                    <h5>Half Life</h5>
                </div>
                <div class="karuseles-img">
                    <img class="gallery" src="images/fc4.jpg">
                    <h5>Half Life</h5>
                </div>
            </div>
        </div>
        <div class="col-sm-2 karuseles-arrow-containeris d-flex justify-content-center">
            <div class="karuseles-arrow next"><i class="fas fa-caret-right"></i></div>
        </div>
    </div>
</div>




@endsection

