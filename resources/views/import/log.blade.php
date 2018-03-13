@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <form method="post" action="{{route('products.import.filter')}}">
                {{csrf_field()}}
                <select name="status">
                    <option value="all">All</option>
                    <option value="0">Waiting</option>
                    <option value="1">In progress</option>
                    <option value="2">Success</option>
                    <option value="3">Fail</option>
                </select>
                <button type="submit">Filter</button>
            </form>
            <table>
                <thead>
                    <tr>
                        <th>Line</th>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Error</th>
                        <th>Upload time</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($all as $line => $one_line)
                        <tr>
                            <td>{{($all->currentpage()-1) * $all->perpage() + $line + 1}}</td>
                            <td>{{$one_line->product_id}}</td>
                            <td>{{$one_line->product_name}}</td>
                            <td>
                                @if ($one_line->import_status == 'Fail')
                                    <span class="text-danger">{{$one_line->import_status}}</span>
                                @else
                                    {{$one_line->import_status}}
                                @endif
                            </td>
                            <td>{{$one_line->error_message}}</td>
                            <td>{{$one_line->updated_at}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="row ">
            <div class="col mx-auto">{{$all->links()}}</div>
        </div>
    </div>
@endsection