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
<li><a href="{{ route('products.create') }}">Add product</a></li>
</ul>
<ul>
<li><a href="{{ route('products.import.form') }}">Import products</a></li>
</ul>
<ul>
<li><a href="{{ route('products.import.log') }}">Products log</a></li>
</ul>
<ul>
<li><a href="{{ route('special.index') }}">Special offers</a></li>
</ul>
</ul>