@extends('layouts.admin')
@section('content')
<div class="app-title">
	<div>
	  <h1><i class="fa fa-comments-o"></i>&nbsp;Quản lý bình luận</h1>
	</div>
	<ul class="app-breadcrumb breadcrumb">
	  <li class="breadcrumb-item"><i class="fa fa-comments-o fa-lg"></i></li>
	  <li class="breadcrumb-item"><a href="{{ route('comments.index') }}">Quản lý bình luận</a></li>
	</ul>
</div>
<div class="container">	
	<div class="row">
        <div class="form-group col-md-2">
          <input class="form-control" type="text" name="search" id="search_comment" placeholder="Search ...">
        </div>
        <div class="col-md-10"></div>
    </div>
	<div id="list-comment">
		@include('admin.comments.search')
	</div>
</div>	
    <script src="{{ url('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ url('js/popper.min.js') }}"></script>
    <script src="{{ url('js/bootstrap.min.js') }}"></script>
<script>
	$(document).ready(function() {
		$('#search_comment').on('keyup',function(){
		  	var value = $(this).val();
			$.ajax({
				type : 'get',
				url:"{{ route('comments.search') }}",
				data: {'search':value},
				success:function(data){
					console.log(data);
					$('#list-comment').html(data);
				},
				error: function(error) {

				}
		  });
		})    	
	})	
</script>
@endsection