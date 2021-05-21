@extends('layouts.admin')
@section('content')
<h1>Edit Category</h1>
<?php if ($errors->any()): ?>
      <div class="text-danger">
        <ul>
          <?php foreach ($errors->all() as $error): ?>
              <li>{{$error}}</li>
          <?php endforeach ?>
        </ul>
      </div>
  <?php endif ?>
<form action="{{route('categories.update', $category->id)}}" method="post">
  {{ csrf_field() }}
  <input type="hidden" name="_method" value="put">
  <input type="hidden" name="id" value="{{$category->id}}">
  <div class="form-group required">
    <label for="">Name</label>
    <input type="text" name="name" class="form-control" value="{{$category->name}}">
  </div>
  <input type="submit" value="Edit" class="btn btn-primary">
</form>
@endsection
