@extends('layouts.admin')
@section('content')
<table class="table">
	<thead>
		<tr>
			<th>ID</th>
			<th>Tiêu đề</th>
			<th>Nội dung</th>
			<th>Sản phẩm</th>
			<th>Người dùng</th>
			<th>Trạng thái</th>
			<th>Hành động</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>{{ $comment->id }}</td>
			<td>{{ $comment->name }}</td>
			<td>{{ $comment->content }}</td>
			<td>{{ $comment->product->name }}</td>
			<td>{{ $comment->user->username }}</td>
			@if(($comment->active === 1))
					<td><i class="fa fa-check btn btn-success" aria-hidden="true"></i></td>		
				@elseif(($comment->active === 2))
					<td><i class="fa fa-times btn btn-danger" aria-hidden="true"></i></td>
				@else
					<td>Đang chờ duyệt</td>	
				@endif 
			<td>
				@if(!($comment->active))
					<a href="{{ route('comments.approve', $comment->id) }}" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i></a>
					<a href="{{ route('comments.remove', $comment->id) }}" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i></i></a>
				@else
					<p>Đã được duyệt</p>
				@endif
			</td>
		</tr>
	</tbody>
</table>
@endsection