<a href="{{route('publishers.create')}}">Create a publisher</a>

<ul>
    @foreach($publishers as $publisher)
        <li>
            <a href="{{ route('publishers.show', [ 'id' => $publisher->id ]) }}">{{ $publisher->name }}</a>
        </li>
    @endforeach
</ul>