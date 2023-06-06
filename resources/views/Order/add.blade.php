@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Order</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left mb-2">
                    <h2>Add Order</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('list_order') }}"> Back</a>
                </div>
            </div>
        </div>
        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
        @endif
        <form action="{{ route('order_store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                 
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Customer Name:</strong>
                        <input type="text" name="name" class="form-control" placeholder="Customer Name" min="1" autocomplete="off">
                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Phone number:</strong>
                        <input type="tel" name="phone" class="form-control" placeholder="Phone number"  autocomplete="off">
                        @error('phone')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                    <table class="table table-bordered" id="dynamicAddRemove">
                    <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Action</th>
                    </tr>
                    <tr>
                    <td><select name="addMoreInputFields[0][product]" class="form-control">
                        @foreach($products as $val)
                        <option value='{{ $val->id }}'>{{ $val->name}}</option>
                        @endforeach
                    </select>
                    </td>
                    <td><input type="number" name="addMoreInputFields[0][quantity]" placeholder="Enter quantity" class="form-control" min="1"/>
                    </td>
                    <td><button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary">Add Product</button></td>
                    </tr>
                    </table>

                
                
                <button type="submit" class="btn btn-primary ml-3">Submit</button>
            </div>
        </form>
    </div>
</body>


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
    var i = 0;
    $("#dynamic-ar").click(function () {
        i++;
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

    });
    $('tbody').on('click', '.deleteRow', function(){
        $(this).parent().parent().remove();
    });
</script>


</html>

@endsection
