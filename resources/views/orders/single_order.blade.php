@extends('layouts.main')
@section('content')
@inject('cartService',"App\Services\CartService")
<div class="container">

    <!-- Order table -->
    <div class="row">
        <div class="col-md-12 table-responsive">
            <table class="table table-sm">
                <thead class="thead-light">
                <tr>
                    <th scope="col">EAN:</th>
                    <th scope="col">Platform:</th>
                    <th scope="col">Name:</th>
                    <th scope="col">Release date:</th>
                    <th scope="col">Publisher:</th>
                    <th scope="col">Price:</th>
                    <th scope="col">Price Total:</th>
                    <th scope="col">Amount</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <td data-label="EAN:" class="align-middle">{{$product->product->ean}}</td>
                        <td data-label="Platform:" class="align-middle">{{$product->product->platform->name}}</td>
                        <td data-label="Name:" class="align-middle">{{$product->product->name}}</td>
                        <td data-label="Release date:" class="align-middle">{{$product->product->release_date}}</td>
                        <td data-label="Publisher:" class="align-middle">{{$product->product->publisher->name}}t</td>
                        <td data-label="Price:" class="align-middle">
                            <input class="input" type="number" value="{{$product->product->getPriceAmountAttribute()}}" name="amount"> €
                        </td>
                        <td data-label="Price Total:" class="align-middle">{{$cartService->getSingleProductPrice($product)}} €</td>
                        <td data-label="Amount:" class="align-middle">
                            <input class="input" type="number" value="{{$product->quantity}}" name="amount">
                        </td>
                        <td class="align-middle">
                            <div  class="btn btn-dark btn-sm updateQ_P">Update</div>
                            <div class="btn btn-danger btn-sm">Delete</div>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td class="total"></td>
                    <td class="total"></td>
                    <td class="total"></td>
                    <td class="total"></td>
                    <td class="total"></td>
                    <td class="total" scope="Total"><b>Total</b></td>
                    <td data-label="Total">{{!empty($products)?$cartService->getTotalCartPrice($order):""}}</td>
                    <td data-label="Total quantity">{{!empty($products)?$cartService->getTotalCartQuantity($order):""}}</td>
                    <td class="total"></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Comments and attachments -->
    <form method="post" action="{{route('order.action', $order->id)}}" enctype="multipart/form-data">
    <div class="row">

            @csrf
            @method('PUT')
            <div class="col-6">
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1"><h4>Comments</h4></label>
                        <textarea class="form-control" name="text" id="exampleFormControlTextarea1" rows="6"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="action" role="button" class="btn btn-primary" value="confirm">
                        <input type="submit" name="action" role="button" class="btn btn-danger" value="reject">
                    </div>
            </div>
            <div class="col-6">
                    <div class="form-group">
                        <label for="invoice"><h4>Invoice</h4></label>
                        <input class="form-control" id="invoice" type="file" name="invoice">
                    </div>
            </div>

    </div>
    </form>
@endsection