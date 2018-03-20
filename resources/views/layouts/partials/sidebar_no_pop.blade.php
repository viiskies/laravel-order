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