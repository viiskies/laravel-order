@extends('layouts.main')
@section('content')
<div class="col-10 mt-5">

<a href="{{route('publishers.create')}}">Create a publisher</a>

<ul>
    @foreach($publishers as $publisher)
        <li>
            <a href="{{ route('publishers.show', [ 'id' => $publisher->id ]) }}">{{ $publisher->name }}</a>
        </li>
    @endforeach
</ul>

</div>
</div>
@endsection
