<a href="{{route('platforms.create')}}">Create a platform</a>

<ul>
    @foreach($platforms as $platform)
        <li>
            <a href="{{ route('platforms.show', [ 'id' => $platform->id ]) }}">{{ $platform->name }}</a>
        </li>
    @endforeach
</ul>