@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-6 mx-auto">
                @if($errors->has('file'))
                    <small class="alert alert-danger">
                        {{ $errors->first('file') }}
                    </small>
                @endif
                <form action="{{ route('products.import') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Import excel file</label>
                        <input type="file" class="form-control-file" name="file">
                        <input type="submit" value="Import">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection