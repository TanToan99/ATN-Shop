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
        @if(session("success"))
  			<div class="success">
     			 <p class="bg-success text-white">{{session("success")}}</p>
  			</div>
		@elseif(session("fails"))
  			<div class="fails">
     			<p class="bg-danger text-white">{{session("fails")}}</p> 
  			</div>
		@endif
        <div class="section group">
           	<table id="tableServicesList" class="table table-list dataTable no-footer dtr-inline" aria-describedby="tableServicesList_info" role="grid">
           		<thead>
           			<tr>
           				<th class="text-center">Date Order</th>
           				<th class="text-center">Total</th>           				
           				<th class="text-center">Action</th>
           				<th class="text-center">Status</th>
           			</tr>
           		</thead>
           		<tbody>
           			@foreach($orders as $order)
           				<tr>
           					<td class="text-center"><a href="{{route('order.kiemtradonhang', $order->id)}}">{{$order->created_at}}</a></td>
           					<td class="text-center">{{$order->total}}</td>
           					<td class="text-center">{{$order->status->name}}</td>
           					@if($order->status_id == 1)
           					<td class="text-center text-info">Active</td>
           					@elseif($order->status_id == 2)
           					<td class="text-center"><a href="{{route('home.action', $order->id)}}" class="btn btn-danger">Cancer</a></td>
                    @else
                    <td class="text-center text-danger">Watting</td>
           					@endif
           				</tr>
           			@endforeach
           		</tbody>
           	</table>
        </div>
    </div>
</div>
@endsection
