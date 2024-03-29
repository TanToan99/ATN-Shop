@extends('admin.layouts.master')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="#">
				<em class="fa fa-home"></em>
			</a></li>
			<li>Toys Manager</li>
			<li class="active">Add Toy</li>
		</ol>
	</div><!--/.row-->
	
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Toy Manager</h1>
		</div>
	</div><!--/.row-->

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					Add Toy
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">
							@if(session('class'))
							<div class="alert bg-{{session('class')}}" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em>{{session('message')}}</div>
							@endif
							<form action="{{ route('Book.Store') }}" method="post" enctype="multipart/form-data">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<div class="col-lg-3">
									<div class="form-group">
										<label for="input-file">Image</label>
	                    				<input type="file" id="input-file" name="img" class="dropify" data-height="364px" data-default-file="{{ asset('images/default.jpg') }}" accept="image/*"/>
									</div>
								</div>
								<div class="col-lg-9">
									<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
										<label>Name <font color="red">*</font></label>
										<input class="form-control" type="text" name="name" value="{{old('name')}}">
										@if ($errors->has('name'))
										<span class="text-danger">{{ $errors->first('name') }}</span>
										@endif
									</div>
									<div class="form-group {{ $errors->has('author') ? 'has-error' : '' }}">
										<label>Author<font color="red">*</font></label>
										<input class="form-control" type="text" name="author" value="{{old('author')}}">
										@if ($errors->has('author'))
										<span class="text-danger">{{ $errors->first('author') }}</span>
										@endif
									</div>
									<div class="form-group {{ $errors->has('published_year') ? 'has-error' : '' }}">
										<label>Year publish <font color="red">*</font></label>
										<input class="form-control" type="text" name="published_year" value="{{old('published_year')}}">
										@if ($errors->has('published_year'))
										<span class="text-danger">{{ $errors->first('published_year') }}</span>
										@endif
									</div>
									<div class="form-group {{ $errors->has('category') ? 'has-error' : '' }}">
										<label>Shop <font color="red">*</font></label>
										<select name="category" class="form-control">
											@foreach($categories as $category)
											<option value="{{$category->id}}">{{ $category->name }}</option>
											@endforeach
										</select>
										@if ($errors->has('category'))
										<span class="text-danger">{{ $errors->first('category') }}</span>
										@endif
									</div>
									<div class="form-group {{ $errors->has('quantity') ? 'has-error' : '' }}">
										<label>Quantity <font color="red">*</font></label>
										<input class="form-control" type="number" name="quantity" min="1" value="{{old('quantity')}}">
										@if ($errors->has('quantity'))
										<span class="text-danger">{{ $errors->first('quantity') }}</span>
										@endif
									</div>
									<div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
										<label>Price <font color="red">*</font></label>
										<input class="form-control" type="number" name="price" min="0" value="{{old('price')}}">
										@if ($errors->has('price'))
										<span class="text-danger">{{ $errors->first('price') }}</span>
										@endif
									</div>
									<div class="form-group">
										<label>Description</label>
										<textarea class="form-control" name="describes" rows="3">{{ old('describes') }}</textarea>
									</div>
									<button type="submit" class="btn btn-primary">Add</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div><!--/.col-->

	</div><!--/.row-->
</div>	<!--/.main-->
@endsection
@section('javascript')
<script type="text/javascript">
	$(document).ready(function(){
        // Basic
        $('.dropify').dropify();
    });
</script>
@endsection