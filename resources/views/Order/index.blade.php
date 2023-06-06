@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
</head>
<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('home') }}"> Back to Home</a>
                </div>
                <div class="pull-left">
                    <h2>Order Management</h2>
                </div>
                <div class="pull-right mb-2">
                    <a class="btn btn-success" href="{{ route('add_order') }}"> Add Order</a>
                </div>
            </div>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Phone</th>
                    <th>Net Amount</th>
                    <th>Order Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order as $key=>$orders)
                    <tr>
                    	<td>{{ $key + 1 }}</td>
                        <td>{{ $orders->order_id }}</td>
                        <td>{{ ucfirst($orders->cust_name) }}</td>
                        <td>{{ $orders->phone }}</td>
                        <td>{{ $orders->total_amount }}</td>
                        <td> {{ $orders->order_date }}</td>
                        <td>
                            <form action="{{ route('order_destroy',$orders->id) }}" method="Post">
                                <a class="btn btn-primary" href="{{ route('order_edit',$orders->id) }}">Edit</a>
                                <a class="btn btn-secondary" href="{{ route('order_invoice',$orders->id) }}">Invoice</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
        {!! $order->links() !!}
    </div>
</body>
</html>

@endsection
