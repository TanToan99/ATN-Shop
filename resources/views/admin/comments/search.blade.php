@if(!$comments->isEmpty())
<table class="table table-light table-striped">
	<thead>
		<tr>
			<th>ID</th>
			<th>Tiêu đề</th>
			<th>Tên sản phẩm</th>
			<th>Tên người dùng</th>
			<th>Trạng thái</th>
			<th>Hành động</th>
		</tr>
	</thead>
	@foreach($comments as $key => $comment)
		<tbody>
			<tr>
				@if(session('error'))
			        <div class="alert alert-danger">
				        {{session('error')}}
				    </div>
			    @endif
				<td>{{ $comment->id }}</td>
				<td>{{ $comment->name }}</td>
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

					<a href="{{ route('comments.show', $comment->id) }}" id="show" class="btn btn-info"><i class="fa fa-eye"></i></a>
					@if(!($comment->active))
						<a href="{{ route('comments.approve', $comment->id) }}" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i></a>
						<a href="{{ route('comments.remove', $comment->id) }}" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i></i></a>
					@endif
				</td>
			</tr>
		</tbody>
	@endforeach
</table>
	{{ $comments->links() }}
@else
<div class="alert alert-danger">
	<p>Not Data</p>	
</div>		        	
@endif	