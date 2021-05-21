@extends('layouts.admin')
@section('content')
<div class="container">
	<h1>Add User</h1>
	<form action="{{ route('users.store') }}" method="post">
		{{ csrf_field() }}
		<div class="from-group required">
			<label for="">Username</label>
			<input type="text" name="username" class="form-control" placeholder="Tên đăng nhập" value="{{ old('username') }}">
			@if ($errors->has('username'))
		        <span class="text-danger">{{ $errors->first('username') }}</span>
		    @endif
		</div>
		<div class="from-group required">
			<label for="">Email</label>
			<input type="email" name="email" class="form-control" placeholder="Email đăng nhập" value="{{ old('email') }}">
			@if ($errors->has('email'))
		        <span class="text-danger">{{ $errors->first('email') }}</span>
		    @endif
		</div>
		<div class="from-group required">
			<label for="">Password</label>
			<input type="password" name="password" class="form-control" placeholder="Nhập Mật khẩu" value="{{ old('password') }}">
			@if ($errors->has('password'))
		        <span class="text-danger">{{ $errors->first('password') }}</span>
		    @endif
		</div>
		<div class="from-group required">
			<label for="">Re password</label>
			<input type="password" name="confirm_password" class="form-control" placeholder="Nhập Mật khẩu" value="{{ old('confirm_password') }}">
			@if ($errors->has('confirm_password'))
		        <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
		    @endif
		</div>
		<div class="from-group required">
			<label for="">Yourname</label>
			<input type="text" name="yourname" class="form-control" placeholder="Họ và tên" value="{{ old('yourname') }}">
			@if ($errors->has('yourname'))
		        <span class="text-danger">{{ $errors->first('yourname') }}</span>
		    @endif
		</div>
		<div class="from-group required">
			<label for="">Phone</label>
			<input type="text" name="phone" class="form-control" placeholder="Nhập Số điện thoại" value="{{ old('phone') }}">
			@if ($errors->has('phone'))
		        <span class="text-danger">{{ $errors->first('phone') }}</span>
		    @endif
		</div>
		<div class="from-group required">
			<label for="">Address</label>
			<input type="text" name="address" class="form-control" placeholder="Nhập Địa chỉ" value="{{ old('address') }}">
			@if ($errors->has('address'))
		        <span class="text-danger">{{ $errors->first('address') }}</span>
		    @endif
		</div>
		<div class="form-group required">
			<label for="">Role</label>
			<select name="role_id" id="" class="form-control">
				@foreach($roles as $role)
					<option value="{{ $role->id }}">{{ $role->name }}</option>
				@endforeach	
			</select>
		</div>
		<div class="from-group">
			<input type="submit" value="Đăng ký" class="btn btn-primary">
			<a href="{{ route('users.index') }}" class="btn btn-info"><i class="fa fa-hand-o-left">&nbsp;&nbsp;Quay lại</i></a>
		</div>
	</form>
</div>
@endsection