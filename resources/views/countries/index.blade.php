@extends('layouts.page')
@section('content')
<div class="col-10 mt-5">
	@include('layouts.partials.messages')
	<a class="btn btn-dark" href="{{route('countries.create')}}">Create new country</a>
	<div class="col-md-12 table-responsive no-gutters">
		<table class="table table-sm table_container">
			<thead class="thead-light">
				<tr>
					<th scope="col" colspan="3">Country:</th>
				</tr>
			</thead>
			<tbody>
				@foreach($countries as $country)
				<tr class="table-tr">
					<td Data-label="country:" class="align-middle text-right">
						<div class="justify-content-end">
							<p>{{ $country->name }}</p>
						</div>
					</td>
					<td class="text-lg-right"><a href="{{ route('countries.edit', ['id' => $country->id])}}" class="btn btn-dark btn-sm">Edit</a>
					</td>
					<td class="text-lg-left">
						<form action="{{ route('countries.destroy', ['id' => $country->id])}}" method="post">
							@csrf
							<div class="form-group">
								<input type="hidden" name="_method" value="delete">
								<button type="submit" class="btn btn-danger btn-sm">Delete</button>
							</div>
						</form>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
</div>
@endsection