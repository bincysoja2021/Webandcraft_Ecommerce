<!DOCTYPE html>
<html>
<head>
    <title>Invoice </title>
</head>
<style type="text/css">
    body{
        font-family: 'Roboto Condensed', sans-serif;
    }
    .m-0{
        margin: 0px;
    }
    .p-0{
        padding: 0px;
    }
    .pt-5{
        padding-top:5px;
    }
    .mt-10{
        margin-top:10px;
    }
    .text-center{
        text-align:center !important;
    }
    .w-100{
        width: 100%;
    }
    .w-50{
        width:50%;   
    }
    .w-85{
        width:85%;   
    }
    .w-15{
        width:15%;   
    }
    .logo img{
        width:200px;
        height:60px;        
    }
    .gray-color{
        color:#5D5D5D;
    }
    .text-bold{
        font-weight: bold;
    }
    .border{
        border:1px solid black;
    }
    table tr,th,td{
        border: 1px solid #d2d2d2;
        border-collapse:collapse;
        padding:7px 8px;
    }
    table tr th{
        background: #F4F4F4;
        font-size:15px;
    }
    table tr td{
        font-size:13px;
    }
    table{
        border-collapse:collapse;
    }
    .box-text p{
        line-height:10px;
    }
    .float-left{
        float:left;
    }
    .total-part{
        font-size:16px;
        line-height:12px;
    }
    .total-right p{
        padding-right:20px;
    }
</style>
<body>
<div class="head-title">
    <h1 class="text-center m-0 p-0">Invoice</h1>
</div>
<div class="add-detail mt-10">
    <div class="w-50 float-left mt-10">
        <p class="m-0 pt-5 text-bold w-100">Order Id - <span class="gray-color">{{$data->order_id}}</span></p>
        <p class="m-0 pt-5 text-bold w-100">Order Date - <span class="gray-color">{{$data->order_date}}</span></p>
    </div>
    
    <div style="clear: both;"></div>
</div>
<div class="table-section bill-tbl w-100 mt-10">
    <table class="table w-100 mt-10">
        <tr>
            <th class="w-50">Customer Details</th>
        </tr>
        <tr>
            <td>
                <div class="box-text">
                    <p>Name: {{ucfirst($data->cust_name)}}</p>
                    <p>Phone : {{ $data->phone }}</p>
                </div>
            </td>
            
        </tr>
    </table>
</div>

<div class="table-section bill-tbl w-100 mt-10">
    <table class="table w-100 mt-10">
        <tbody>
            <tr>
                <th>Order ID</th>
                <td>{{$data->order_id}}</td>
            </tr>
            <tr>
                <th>Products</th>
                <td>@foreach($order_product as $key=>$value) <p>{{$key + 1}}. {{$value->products['name']}} X {{$value->qty}} = {{$value->total_amount}} </p>@endforeach</td>
            </tr>
            <tr>
                <th>Total Amount</th>
                <td>{{$data->total_amount}}</td>
            </tr>
        </tbody>
    </table>
</div>
</html>
