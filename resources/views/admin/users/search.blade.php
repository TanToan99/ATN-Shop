@if(!$users->isEmpty())	
<table class="table table-light table-striped">
	<thead>
		<tr>
			<th>#</th>
			<th>UserName</th>
			<th>Email</th>
			<th>Role</th>
			<th>Action</th>
		</tr>
	</thead>
	@foreach($users as $key => $user)
		<tbody>
			<tr>
				<td>{{ ++$key }}</td>
				<td>{{ $user->username }}</td>
				<td>{{ $user->email }}</td>
				<td>{{ $user->role->name }}</td>
				<td class="hidden-sm hidden-xs btn-group">
					<a href="{{ route('users.show', $user) }}" class="btn btn-xs btn-success" title="Xem thông tin"><i class="ace-icon fa fa-eye bigger-120"></i></a>
					
			        <a href="{{ route('users.edit', $user) }}" class="btn btn-xs btn-info" title="Chỉnh sửa thông tin"><i class="ace-icon fa fa-pencil bigger-120"></i></a>
			        
					@if($user->role_id === 2)
						<button class="btn btn-danger" data-userid={{ $user->id }} data-toggle="modal" data-target="#delete" title="Xóa người dùng"><i class="fa fa-trash-o"></i></button>
					@endif	
				</td> 
			</tr>				
		</tbody>
	@endforeach	
</table>
<!-- Modal -->
<div class="modal modal-danger fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('users.destroy','test')}}" method="post">
      		{{method_field('delete')}}
      		{{csrf_field()}}
	      <div class="modal-body">
				<p class="text-center">
					You are sure to delete this user ?
				</p>
	      		<input type="hidden" name="user_id" id="user_id" value="">
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-success" data-dismiss="modal">Back</button>
	        <button type="submit" class="btn btn-warning">Delete</button>
	      </div>
      </form>
    </div>
  </div>
</div>
{{ $users->links() }}
@else
<div class="alert alert-danger">
	<p>Not Data</p>	
</div>					        	
@endif		