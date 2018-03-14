@extends('layouts.main')
@section('content')
<div class="col-12 text-center mt-3">
    <h2>Create product</h2>
</div>
<form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="row">
            <div class="col-lg-6 col-md-12">

                <div class="form-group">
                    <label class="col control-label">Pre-order?</label>
                    <div class="col">
                        <div class="radio">
                            <label>
                                <input type="radio" name="pre_order" value="yes" /> Yes
                            </label>
                            <label>
                                <input type="radio" name="pre_order" value="no" /> No
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col control-label">Order deadline</label>
                    <div class="col inputGroupContainer">
                        <div class="input-group">
                            <input  name="deadline" placeholder="Order deadline" class="form-control" disabled="true"  type="date">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col control-label">Title</label>
                    <div class="col inputGroupContainer">
                        <div class="input-group">
                            <input  name="name" placeholder="Title" class="form-control"  type="text" value="{{ old('name') }}">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col control-label">EAN</label>
                    <div class="col inputGroupContainer">
                        <div class="input-group">
                            <input type="number"  name="ean" placeholder="EAN" class="form-control"  type="text" value="{{ old('ean') }}">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col control-label">Select a platform</label>
                    <div class="col selectContainer">
                        <div class="input-group">
                            <input data-autocomplete="{{ $platforms }}" class="form-control autocomplete" type="text" name="platform_id">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col control-label">Select a category</label>
                    <div class="col selectContainer">
                        <div class="input-group">
                            <input data-autocomplete="{{ $categories }}" class="form-control autocomplete" type="text" name="category_id">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col control-label">Select a publisher</label>
                    <div class="col selectContainer">
                        <div class="input-group">
                            <input data-autocomplete="{{ $publishers }}" class="form-control autocomplete" type="text" name="category_id">
                        </div>
                    </div>
                </div>



            <label for="stock_amount">Stock:</label>
            <br>
            <input type="number" name="stock_amount" class="form-control" placeholder="Available stock" value="{{ old('stock_amount') }}">
            <br>
            <label for="price_amount">Price:</label>
            <br>
            <input type="text" step="0.01" name="price_amount" class="form-control" placeholder="Price" value="{{ old('price_amount') }}">
            <br>

        </div>
        <div class="col-lg-6 col-md-12">


            <br>
            <label for="description">Description:</label>
            <br>
            <textarea type="text" name="description" id="description" class="form-control"
            placeholder="Product description">{{ old('description') }}</textarea>
            <br>
            <label for="release_date">Release Date:</label>
            <br>
            <input type="date" name="release_date" class="form-control" value="{{ old('release_date') }}">
            <br>
            <label for="video">Video</label>
            <br>
            <input type="text" name="video" class="form-control" value="{{ old('video') }}">
            <br>
            <label for="pegi">Pegi</label>
            <br>
            <input type="number" name="pegi" class="form-control" value="{{ old('pegi') }}">
            <br>
            <input type="file" name="image" id="image" >
            <br>
            <button type="submit" class="btn btn-secondary">Submit</button>
        </div>
    </div>
</div>
</form>
@endsection