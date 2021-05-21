@extends('layouts.admin')
@section('content')
<div class="container">
	<h2>User: {{ $user->yourname }}</h2>
	<table class="table table-light table-striped">
		<tr>
			<td><b>Username</b></td>
			<td>{{ $user->username }}</td>
		</tr>
		<tr>
			<td><b>Email</b></td>
			<td>{{ $user->email }}</td>
		</tr>
		<tr>
			<td><b>Full name</b></td>
			<td>{{ $user->yourname }}</td>
		</tr>
		<tr>
			<td><b>Phone</b></td>
			<td>{{ $user->phone }}</td>
		</tr>
		<tr>
			<td><b>Address</b></td>
			<td>{{ $user->address }}</td>
		</tr>
		<tr>
			<td><b>Role</b></td>
			<td>{{ $user->role->name }}</td>
		</tr>
	</table>
	<a href="{{ route('users.index') }}" class="btn btn-info"><i class="fa fa-hand-o-left">&nbsp;&nbsp;Back</i></a>
</div>
@endsection