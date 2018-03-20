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
							<li><a href="{{ route('users.index') }}">Users</a></li>
							<ul>
								<li><a href="{{ route('users.create') }}">Add user</a></li>
							</ul>
							<li><a href="{{ route('publishers.index') }}">Publishers</a></li>
							<ul>
								<li><a href="{{ route('publishers.create') }}">Add publishers</a></li>
							</ul>
							<li><a href="{{ route('home') }}">Products</a></li>
							<ul>
								<li><a href="{{ route('products.create') }}">Add product</li>
							</ul>
							<ul>
								<li><a href="{{ route('products.import.form') }}">Import products</li>
							</ul>
							<ul>
								<li><a href="{{ route('products.import.log') }}">Products log</li>
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
								@foreach ($cats as $category)
								<li><a href="{{ route('products.cat', array('id'=>$category->id)) }}">{{$category->name}}</a></li>
								@endforeach
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
							@for ($x = 0; $x < 3; $x++)
							<div class="most-popular-prod-sidebar text-center">
								<a href="{{ route('products.show', array('id'=>$products_latest[$x]->id)) }}"><img id="popular" src="{{ $products_latest[$x]->featured_image_url }}" class="img-thumbnail"></a>
								<a href="{{ route('products.show', array('id'=>$products_latest[$x]->id)) }}"><h6 class="mt-2">{{ $products_latest[$x]->name }}</h6></a>
								<p>{{ str_limit($products_latest[$x]->description, 100) }}</p>
							</div>
							@endfor
						</div>
					</div>