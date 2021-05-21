@extends('layouts.admin')
@section('content')
<div class="app-title">
  <div>
    <h1><i class="fa fa-cart-plus"></i>&nbsp;Quản lý thông tin đơn đặt hàng</h1>
  </div>
  <ul class="app-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><i class="fa fa-cart-plus fa-lg"></i></li>
    <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">Quản lý đơn đặt hàng</a></li>
  </ul>
</div>
<div class="">
    <div class="tile">
      <div class="tile-body">
        <div class="row">
          <div class="col-md-4">
            <a href="{{ route('orders.index' ) }}" class="btn btn-success"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp; &nbsp;Refresh</a>
          </div>
          <div class="col-md-4"></div>
          <div class="col-md-4"></div>
        </div>      
      </div>
   </div>
</div>
<table class="table table-light table-striped">
  <tr>
    <th>ID</th>
    <th>Tên Khách Hàng</th>
    <th>Sản Phẩm</th>
    <th>Số lượng</th>
    <th>Giá</th>
  </tr>
  @foreach($order_details as $detail)
  <tr>
    <td>{{$detail->id}}</td>
    <td>{{$user->yourname}}</td>
    <td>{{$detail->product->name}}</td>
    <td>{{$detail->quantity}}</td>
    <td>{{$detail->quantity * $detail->product->price}}</td>
  @endforeach
</table>
<div class="modal modal-danger fade" id="delete" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Xóa Đơn Hàng</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="{{route('orders.destroy', 'test')}}" method="post">
                {{method_field('delete')}}
                {{csrf_field()}}
              <div class="modal-body">
                    <p class="text-center">
                        Bạn chắc chắn muốn xóa đơn hàng này?
                    </p>
                    <input type="hidden" name="id" id="order_id" value="">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Không, quay lại</button>
                <input type="submit" value="Có" class="btn btn-danger">
              </div>
          </form>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('button').on('click' ,function(event) {
            event.preventDefault();
            var id = $(this).attr('data-id');
            console.log(id);
            $('#delete').modal('show');
            $('#order_id').val(id);
        });
    });
</script>
@endsection
