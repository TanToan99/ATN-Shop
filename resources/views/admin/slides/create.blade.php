@extends('layouts.admin')
@section('content')
<form action="{{ route('slides.store') }}" method="post" enctype="multipart/form-data">
	{{ csrf_field() }}
	<input type="file" name="image" id="image" >
	<input type="submit">
</form>
@endsection