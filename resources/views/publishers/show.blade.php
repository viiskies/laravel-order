{{ $publisherSingle->name }}
<a href="{{ route('publishers.edit',$publisherSingle->id) }}"><button>Edit</button></a>

<form action="{{ route('publishers.destroy', ['id' => $publisherSingle->id])}}" method="post">
    @csrf
    <div class="form-group">
        <input type="hidden" name="_method" value="delete">
        <button type="submit" class="btn btn-secondary">Delete</button>
    </div>
</form>