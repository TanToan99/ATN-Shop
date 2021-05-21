@extends('layouts.frontend')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
@section('content')
<div class="main">
    <div class="content">
        <div class="content_top">
            <div class="back-links">
                <p><a href="{{ route('home.index') }}">Home</a>/<a href="{{ route('home.checkorder') }}">List Order</a></p>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>
	<div class="container">
		<div id="title">
			<h1>Check Information</h1>
			<p>Input your information to payment cart.</p>
		</div>
		<form action="{{route('home.orderdetail')}}" method="post" id="formcheckout">
			{{ csrf_field() }}
			<div id="infouser">
				<div id="subheading">
					<span>Personal Information</span>
				</div>
				<div class="row">
					<input type="hidden" name="user_id" value="{{$user->id}}">
					<div class="col-sm-6 form-group">
						<input type="text" name="yourname" value="{{$user->yourname}}" class="form-control">
					</div>
					<div class="col-sm-6 form-group">
						<input type="email" name="email" value="{{$user->email}}" class="form-control">
					</div>				
					<div class="col-sm-6 form-group">
						<input type="phone" name="phone" value="{{$user->phone}}" class="form-control">
					</div>
					<div class="col-sm-6 form-group">
						<input type="text" name="address" value="{{$user->address}}" class="form-control">
					</div>
				</div>
			</div>
			<div id="paymentdetail">
				<div id="subheading">
					<span>Cart</span>
				</div>
				<div id="table">
					<table class="table table-bordered table-striped">
						<thead>
							<th>Name</th>
							<th>Quantity</th>
							<th>Price</th>
						</thead>
						<tbody>
							
						</tbody>
					</table>
					<div id="error_order_detail">
						
					</div>
				</div>
				<div id="payment" >
					<span class="text-danger">Total: </span>
					<span id="totalcheckout"></span>
					<sup> đ</sup>
					<input type="hidden" name="total" id="totaldetail" value="">
				</div>
			</div>
			<div class="text-center">
				<input type="submit" value="Submit" class="btn btn-primary" id="submit">
			</div>			
		</form>
	</div>
	
<script type="text/javascript" src="{{ url('frontend/js/orderdetail.js') }}"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#submit').on('click', function(event) {
			console.log('da submit');
			cart = [];
        	localStorage.setItem('cart',JSON.stringify(cart));
		});
	});
</script>
@endsection
