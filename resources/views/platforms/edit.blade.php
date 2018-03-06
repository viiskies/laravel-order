<form action="{{route('platforms.update', ['platform' => $platformEdit->id])}}" method="post">
    @csrf
    <div class="form-group">
        @if ($errors->get('name'))
            @foreach($errors->get('name') as $error)
                <div class="alert alert-danger" role="alert">
                    {{ $error }}
                </div>
            @endforeach
        @endif
        <input type="hidden" name="_method" value="put">
        <label for="name">Name:</label>
        <br>
        <input type="text" name="name" class="form-control" placeholder="Platform name" value="{{ $platformEdit->name }}">
        <br>
        <button type="submit" class="btn btn-secondary">Submit</button>
    </div>
</form>