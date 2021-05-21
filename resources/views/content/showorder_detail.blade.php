@extends('layouts.frontend')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
@section('content')
<div class="main">
    <div class="content">
        <div class="content_top">
            <div class="back-links">
                <p><a href="{{ route('home.index') }}">Order /</a></p>
            </div>
            <div class="clear"></div>
        </div>
        <div class="section group">
           	<table id="tableServicesList" class="table table-bordered table-list dataTable no-footer dtr-inline" aria-describedby="tableServicesList_info" role="grid">
           		<thead>
           			<tr>
                  <th class="text-center">Name</th>
                  <th class="text-center">Price</th>
                  <th class="text-center">Quantity</th>
                  <th class="text-center">Sub Total</th>
           			</tr>
           		</thead>
           		<tbody>
           			@foreach($orderdetails as $detail)
                <tr>
                  <td class="text-center">{{$detail->product->name}}</td>
                  <td class="text-center">{!!number_format($detail->product->price,0,",",".") . 'đ'!!}</td>
                  <td class="text-center">{{$detail->quantity}}</td>
                  <td class="text-center">{!!number_format($detail->quantity * $detail->product->price,0,",",".") . 'đ'!!}</td>
                </tr>
                @endforeach
           		</tbody>
           	</table>
        </div>
        <div id="tongtien">
          <span class="text-danger">Total: </span>
          <span id="totalcheckout">{!!number_format($total,0,",",".") . 'đ'!!}</sup>
        </div>
    </div>
</div>
@endsection
