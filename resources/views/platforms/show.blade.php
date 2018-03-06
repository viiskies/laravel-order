{{ $platformSingle->name }}
<a href="{{ route('platforms.edit',$platformSingle->id) }}"><button>Edit</button></a>

<form action="{{ route('platforms.destroy', ['id' => $platformSingle->id])}}" method="post">
    @csrf
    <div class="form-group">
        <input type="hidden" name="_method" value="delete">
        <button type="submit" class="btn btn-secondary">Delete</button>
    </div>
</form>