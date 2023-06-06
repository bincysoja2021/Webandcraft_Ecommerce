@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product</title>
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
                    <h2>Product Management</h2>
                </div>
                <div class="pull-right mb-2">
                    <a class="btn btn-success" href="{{ route('add_product') }}"> Add Product</a>
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
                    <th>Name</th>
                    <th>Image</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($product as $key=>$products)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $products->name }}</td>
                        <td><img src=" {{ $products->image }}" style="width: 10%"></td>
                        <td>{{$products->cat_deatils['name']}}</td>
                        <td>{{ $products->price }}</td>
                        <td>
                            <form action="{{ route('product_destroy',$products->id) }}" method="Post">
                                <a class="btn btn-primary" href="{{ route('product_edit',$products->id) }}">Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
        {!! $product->links() !!}
    </div>
</body>
</html>

@endsection
