<!DOCTYPE html>
<html>
	<head>
		<title>Index</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
	</head>
	<body>
		<div class="container">
			<!-- Top Bar -->
			<div class="row">
				<div class="top-bar">
					<ul>
						<li><i class="fa fa-phone-volume"></i>  <a href="#">+370 644 54348</a></li>
						<li><i class="fa fa-envelope"></i>  <a href="#">info@gamestar.eu</a></li>
					</ul>
				</div>
			</div>
			<!-- Header -->
			<div class="row">
				<div class="logo">
					<a href="{{ route('home') }}"><img src="{{asset('images/logo2.png')}}"></a>
				</div>
				<div class="cart-menu-mobile">
					<span class="cart-menu-icon-mobile">
						<a href="{{ route('order.index') }}"><i class="fa fa-cart-arrow-down"></i></a>
					</span>
				</div>
				<div class="nav d-flex justify-content-end ">
					<nav class="navbar navbar-expand-lg navbar-light">
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
						</button>
						<div class="collapse navbar-collapse" id="navbarSupportedContent">
							<ul class="navbar-nav mr-auto">
								<li class="nav-item active">
									<a class="nav-link btn btn-outline-danger" href="#">Home <span class="sr-only">(current)</span></a>
								</li>
								<li class="nav-item">
									<a class="nav-link btn btn-danger" href="#">Order</a>
								</li>
								<li class="nav-item">
									<a class="nav-link btn btn-danger" href="#">Profile</a>
								</li>
								<li class="nav-item">
									<a class="nav-link btn btn-danger" href="#">Contact</a>
								</li>
							</ul>
						</div>
					</nav>
				</div>
				<div class="cart-menu">
					<a href="{{ route('order.index') }}"><span class="cart-menu-inside">
						<span class="cart-menu-icon">
							<i class="fa fa-cart-arrow-down"></i>
						</span>
						<span class="cart-menu-price">Items: 0</span>
						<span class="cart-menu-price">€200</span>
					</span></a>
				</div>
			</div>
			<!-- Slider -->
			<div id="search" class="row justify-content-center">
				<div class="slider">
					<div>
						<img src="{{asset('images/slides/1.jpg')}}" />
					</div>
					<div>
						<img src="{{asset('images/slides/2.jpg')}}" />
					</div>
					<div>
						<img src="{{asset('images/slides/3.jpg')}}" />
					</div>
					<div>
						<img src="{{asset('images/slides/4.jpg')}}" />
					</div>
				</div>
				<div class="slider-arrows-left left"><i class="fa fa-arrow-circle-left"></i></div>
				<div class="slider-arrows-right right"><i class="fa fa-arrow-circle-right right"></i></div>
			</div>
			<!-- Search -->
			<div class="row">
				<div class="col-12 d-flex justify-content-center pt-3 pb-3 search-bar-back">
					<form class="form-inline justify-content-center" action="{{ route('products.search') }}" method="GET">
						@csrf
						@if (isset($query))
							<input class="form-control mr-sm-2 search-inputas" name="query" type="search" placeholder="Search" aria-label="Search" value="{{ old('name', $query) }}">
						@else
							<input class="form-control mr-sm-2 search-inputas" name="query" type="search" placeholder="Search" aria-label="Search" value="{{ old('name') }}">
						@endif
						<button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Search</button>
					</form>
				</div>
			</div>
			
			@yield('content')
			<div class="container-fluid">
				<div class="row">
					<div class="col-12 mt-5 text-center footer">
						<p>Copyright © GameStar 2018</p>
					</div>
				</div>
			</div>
			<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
		</body>
	</html>