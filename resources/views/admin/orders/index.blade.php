@extends('admin.layouts.master')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="#">
				<em class="fa fa-home"></em>
			</a></li>
			<li>Order Manager</li>
			<li class="active">List Orders</li>
		</ol>
	</div><!--/.row-->
	
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">List order</h1>
		</div>
	</div><!--/.row-->

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<form action="{{ route('Order.Search', $status) }}" method="GET">
						<div class="input-group">
							<input type="text" class="form-control input-md" name="key" placeholder="Search for..." />
							<span class="input-group-btn"><button type="submit" class="btn btn-primary btn-md" >Search</button></span>
						</div>
					</form>
				</div>
				<div class="panel-body">
					<table class="table">
						<thead>
							<tr>
								<th>ID</th>
								<th>Author</th>
								<th>Time order</th>
								<th>Status</th>
								<th>Details</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@if($orders->count() < 1)
							<tr><td colspan="6">Không có đơn hàng nào</td></tr>
							@endif
							@foreach($orders as $order)<tr data-row="{{$order->id}}">
								<td>{{$order->id}}</td>
								<td>{{$order->user->firstname.' '.$order->user->lastname}}</td>
								<td>{{$order->created_at}}</td>
								<td>
									@switch($order->status)
									@case(1)
									<span class="btn-sm btn-warning">Waiting</span>
									@break
									@case(2)
									<span class="btn-sm btn-warning">Submit order</span>
									@break
									@case(3)
									<span class="btn-sm btn-danger">Đã hủy</span>
									@break
									@case(4)
									<span class="btn-sm btn-primary">Transfering</span>
									@break
									@case(5)
									<span class="btn-sm btn-success">OK</span>
									@break
									@endswitch
								</td>
								<td><a href="javascript:void(0);" class="btn btn-sm btn-info order-show" data-id="{{$order->id}}">View</a></td>
								<td class="table-button">
									@switch($order->status)
									@case(1)
									<a href="javascript:void(0);" class="btn btn-sm btn-success allow-order" data-id="{{$order->id}}">Confirm</a>
									<a href="javascript:void(0);" class="btn btn-sm btn-danger refused-order" data-id="{{$order->id}}">Cancel</a>
									@break
									@case(2)
									<a href="javascript:void(0);" class="btn btn-sm btn-success received-book" data-id="{{$order->id}}">Transfering</a>
									<a href="javascript:void(0);" class="btn btn-sm btn-danger refused-order" data-id="{{$order->id}}">Cancel</a>
									@break
									@case(3)
									<a href="javascript:void(0);" class="btn btn-sm btn-danger order-remove" data-id="{{$order->id}}">Delete</a>
									@break
									@case(4)
									<a href="javascript:void(0);" class="btn btn-sm btn-success return-book" data-id="{{$order->id}}">Complete</a>
									@break
									@case(5)
									<a href="javascript:void(0);" class="btn btn-sm btn-danger order-remove" data-id="{{$order->id}}">Delete</a>
									@break
									@endswitch
									
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<div class="panel-footer">
					<center>
						{{ $orders->links() }}
					</center>
				</div>
			</div>
		</div><!--/.col-->

	</div><!--/.row-->
</div>	<!--/.main-->

<!-- Detail Order Modal -->
<div id="detail-order" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    	<div class="panel panel-default">
			<div class="panel-heading">View Details</div>
			<div class="panel-body"></div>
		</div>
    </div>
  </div>
</div>
<!-- END Detail Order Modal -->
@endsection
@section('javascript')
<script type="text/javascript">
    var api_domain = "{{ url('/admin') }}";
    var api_token = "{{ csrf_token() }}";
</script>
<script type="text/javascript" src="{{ asset('admin_assets/js/main-app.js') }}"></script>
@endsection