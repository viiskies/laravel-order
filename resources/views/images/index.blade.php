<a href="{{ route('images.create') }}">Create an image/images</a>

<ul>
    @foreach($images as $image)
        <li>
            <a href="{{ route('images.show', [ 'id' => $image->id ]) }}">{{ $image->product->name }}</a>
            <img src="{{ URL::to('/storage/images/games')}}/{{ $image->filename }}">
        </li>
    @endforeach
</ul>