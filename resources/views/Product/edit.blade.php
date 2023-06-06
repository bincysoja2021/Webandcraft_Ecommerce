@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Product Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Edit Product</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('list_product') }}" enctype="multipart/form-data">
                        Back</a>
                </div>
            </div>
        </div>
        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
        @endif
        <form action="{{ route('product_update',$product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('GET')
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Product Name:</strong>
                        <input type="text" name="name" value="{{ $product->name }}" class="form-control"
                            placeholder="Product name" autocomplete="off">
                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Product Image:</strong>
                         <input type="file" name="image" class="form-control">
                         <img src=" {{ $product->image }}" style="width: 10%">
                         
                        
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Product Category:</strong>
                        <select name="cat_id">
                        @foreach($cat as $val)
                        <option value='{{ $val->id }}' {{ ($val->id == $product->cat_id) ? 'selected' : '' }}>{{ $val->name}}</option>
                        @endforeach
                    </select>
                        @error('cat_id')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Product Price:</strong>
                        <input type="number" name="price" class="form-control" placeholder="Product Price" min="1" value="{{ $product->price }}" autocomplete="off">
                        @error('price')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                
                
                
                <button type="submit" class="btn btn-primary ml-3">Submit</button>
            </div>
        </form>
    </div>
</body>

</html>

@endsection
