@extends('layouts.admin')
@section('content')
<div class="container">
  <h1>Create Product</h1>
  <form action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="form-group required">
      <label for="">Name</label>
      <input type="text" name="name" class="form-control" value="{{ old('name') }}">
      @if($errors->has('name'))
        <p class="text-danger">{{$errors->first('name')}}</p>
      @endif
    </div>
    
    <div class="form-group required">
      <label for="">Số lượng</label>
      <input type="text" name="quantity" class="form-control" value="{{ old('quantity') }}">
      @if($errors->has('quantity'))
        <p class="text-danger">{{$errors->first('quantity')}}</p>
      @endif
    </div>

    <div class="form-group required">
      <label for="">Price</label>
      <input type="text" name="price" class="form-control" value="{{ old('price') }}">
      @if($errors->has('price'))
        <p class="text-danger">{{$errors->first('price')}}</p>
      @endif
    </div>
    <div class="form-group required">
      <label for="">Description</label>
      <textarea name="description" class="form-control" value="{{ old('description') }}"></textarea>
      @if($errors->has('description'))
        <p class="text-danger">{{$errors->first('description')}}</p>
      @endif
    </div>
    <div class="form-group required">
      <label for="">Category</label>
      <select class="form-control" name="category_id">
        @foreach($categories as $category)
        <option value="{{$category->id}}">{{$category->name}}</option>
        @endforeach
      </select>
      @if($errors->has('category_id'))
        <p class="text-danger">{{$errors->first('category_id')}}</p>
      @endif
    </div>
    <div class="form-group">
      <input type="file" name="images[]" multiple value="">
      @if($errors->has('image'))
        <p class="text-danger">{{$errors->first('image')}}</p>
      @endif
    </div>
    <input type="submit" value="Create" class="btn btn-primary">
  </form>
</div>
@endsection
