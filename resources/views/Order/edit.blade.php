@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Order Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Edit Order</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('list_order') }}" enctype="multipart/form-data">
                        Back</a>
                </div>
            </div>
        </div>
        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
        @endif
        <form action="{{ route('order_update',$order->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('GET')
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Customer Name:</strong>
                        <input type="text" name="name" value="{{ $order->cust_name }}" class="form-control"
                            placeholder="Customer name" autocomplete="off">
                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Phone number:</strong>
                        <input type="tel" name="phone" class="form-control" placeholder="Phone number" value="{{ $order->phone}}" autocomplete="off">
                        @error('phone')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary">Add Product</button>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <table class="table table-bordered my-2" id="dynamicAddRemove">
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Action</th>
                        </tr>
                        @foreach($order_product as $key=>$productval)
                        <tr>
                            <td>
                                <select name="addMoreInputFields[{{$key}}][product]" class="form-control">
                                    @foreach($products as $val)
                                    <option value='{{ $val->id }}' {{ ($val->id == $productval->product) ? 'selected' : '' }}>{{ $val->name}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="number" name="addMoreInputFields[{{$key}}][quantity]" placeholder="Enter quantity" class="form-control" min="1" value="{{$productval->qty}}" />
                            </td>
                            <td><a href='javascript:void(0)' class='btn btn-danger deleteRow'>-</a></td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
    
    var i = '<?php echo count($order_product);?>';
    $("#dynamic-ar").click(function () {
        var tr ="<tr>" +
                
                "<td>"+
                "<select name='addMoreInputFields["+i+"][product]' id='' class='form-control'>"+
                    "@foreach ($products as $post)"+
                        "<option value='{{ $post->id }}'>{{ $post->name }}</option>"+
                    "@endforeach"+
                "</select>"+
                "</td>"+
                "<td><input type='number' min='1' name='addMoreInputFields["+i+"][quantity]' placeholder='Enter quantity' class='form-control'></td>"+
                "<td><a href='javascript:void(0)' class='btn btn-danger deleteRow'>-</a></td>"+
                "</tr>";
                $('tbody').append(tr);
                i++;
    });

    $('tbody').on('click', '.deleteRow', function(){
        $(this).parent().parent().remove();
    });
</script>


</html>

@endsection
