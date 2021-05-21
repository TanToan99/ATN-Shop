@extends('layouts.admin')
@section('content')
<div class="app-title">
	<div>
	  <h1><i class="fa fa-user"></i>&nbsp;User Manager</h1>
	</div>
	<ul class="app-breadcrumb breadcrumb">
	  <li class="breadcrumb-item"><i class="fa fa-user fa-lg"></i></li>
	  <li class="breadcrumb-item"><a href="{{ route('users.index') }}">User Manager</a></li>
	</ul>
</div>
<div class="container">	
	@if (session('status'))
        <div class="alert alert-info">{{session('status')}}</div>
    @endif
    	@if (session('error'))
        <div class="alert alert-danger">{{session('error')}}</div>
    @endif
    <div class="">
      <div class="tile">
        <div class="tile-body">
			<div class="row">
				<div class="col-md-4">
					<a href="{{ route('users.create') }}" class="btn btn-xs btn-info" title="Xem thông tin"><i class="ace-icon fa fa-user-plus bigger-120">&nbsp; &nbsp;Add User</i></a>
					<a href="{{ route('users.index'	) }}" class="btn btn-success"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp; &nbsp;Refresh</a>
				</div>
				<div class="col-md-4"></div>
				<div class="col-md-4">
					<div class="row">
			            <div class="form-group col-md-12">
			              <input class="form-control" type="text" name="search" id="search_user" placeholder="Search ...">
			            </div>
		            </div>
				</div>
			</div>      
        </div>
      </div>
    </div>
    <div id="list-user">
		@include('admin.users.search')
	</div>
</div>	
	<script src="{{ url('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ url('js/popper.min.js') }}"></script>
    <script src="{{ url('js/bootstrap.min.js') }}"></script>
	<script>
		$(document).ready(function() {
			$('#search_user').on('keyup',function(){
			  	var value = $(this).val();
				$.ajax({
					type : 'get',
					url:"{{ route('users.search') }}",
					data: {'search':value},
					success:function(data){
						
						$('#list-user').html(data);
					},
					error: function(error) {

					}
			  });
			})   
		})		
	</script>
@endsection