@extends('layouts.admin')
@section('content')
<div class="app-title">
	<div>
	  <h1><i class="fa fa-picture-o"></i>&nbsp;Add slide</h1>
	</div>
	<ul class="app-breadcrumb breadcrumb">
	  <li class="breadcrumb-item"><i class="fa fa-picture-o fa-lg"></i></li>
	  <li class="breadcrumb-item"><a href="{{ route('slides.index') }}">Slide Manager</a></li>
	</ul>
</div>
	@if (session('status'))
        <div class="alert alert-info">{{session('status')}}</div>
    @endif
<table class="table table-bordered">
	<a href="{{ route('slides.create') }}" class="btn btn-success"><i class="fa fa-plus"></i></a>
	<thead>
		<tr>
			<th>ID</th>
			<th>Image</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>1</td>
			<td><img src="{{url('images/slides/sl1.jpg')}}" alt="sl1"></td>
			<td>
				<a href="" class="btn btn-warning"><i class="fa fa-pencil"></i></a>
				<a href="" class="btn btn-danger"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		<tr>
			<td>2</td>
			<td><img src="{{url('images/slides/sl2.png')}}" alt="sl2"></td>
			<td>
				<a href="" class="btn btn-success"><i class="fa fa-plus"></i></a>
				<a href="" class="btn btn-warning"><i class="fa fa-pencil"></i></a>
				<a href="" class="btn btn-danger"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
	</tbody>
</table>
@endsection