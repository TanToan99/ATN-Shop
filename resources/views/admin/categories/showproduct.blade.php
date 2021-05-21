@extends('layouts.admin')

@section('content')
@if(session("success"))
  <div class="success">
      <p class="bg-success text-white">{{session("success")}}</p>
  </div>
@elseif(session("fails"))
  <div class="fails">
     <p class="bg-danger text-white">{{session("fails")}}</p> 
  </div>
@endif
<div class="container">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-cube"></i>&nbsp;Quản lý thông tin sản phẩm</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-cube fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Quản lý sản phẩm</a></li>
    </ul>
  </div>
  <div class="">
    <div class="tile">
      <div class="tile-body">
        <div class="row">
          <div class="col-md-4">
            <a href="{{route('products.create')}}" class="btn btn-xs btn-info"><i class="ace-icon fa fa-user-plus bigger-120">&nbsp; &nbsp;Thêm sản phẩm</i></a>
            <a href="{{ route('products.index' ) }}" class="btn btn-success"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp; &nbsp;Refresh</a>
          </div>
          <div class="col-md-4"></div>
          <div class="col-md-4">
            <div class="row">
              <div class="form-group col-md-12">
                <div class="timkiem">
                  <input  class="form-control" type="text" id="q" placeholder="Search ...">
                </div>
              </div>
            </div>
          </div>
        </div>      
      </div>
   </div>
  </div>
  <table class="table table-light table-striped" id="timkiem" style="width:100%">
    <thead>
      <tr>
        <th>Hình ảnh</th>
        <th>Name</th>
        <th>Kho</th>
        <th>Giá</th>
        <th>Category</th>
    </tr>
    </thead>
    <tbody>
      @foreach($products as $product)
      <tr>
        @foreach( $product->images as $image )
          <td><img src="{{url($image->name)}}" width="50px" height="50px"></td>
        @endforeach
        <td>{{$product->name}}</td>
        <td>{{$product->quantity}}</td>
        <td>{{$product->price}}</td>
        <td>{{$product->category->name}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
<div class="modal modal-danger fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Xóa sản phẩm</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p class="text-center">
            Bạn chắc chắn muốn xóa sản phẩm này dùng này?
          </p>
              <input type="hidden" name="user_id" id="user_id" value="">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-success" data-dismiss="modal">Không, quay lại</button>
            <button type="submit" class="btn btn-warning" id="xoasanpham">Có</button>
        </div>
      </div>
    </div>
  </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {

  var token = $('meta[name="csrf-token"]').attr('content');
  //khi click vào search sẽ chạy ajax
  $('#q').change(function() {
    console.log('đả click');
    var query = $('#q').val();
    console.log(query);
    load_products(query);
  });
  //code ajax search
  function load_products(query = "") {
    console.log(query);
    $.ajax({
      url: "{{route('products.search')}}",
      type: 'GET',
      dataType: 'json',
      data: {query:query},
      success: function(result) {
        console.log(result);
        //display_product(result);
        $('tbody').html(result.table_product);
       }
    })
  }
  $('#timkiem').on('click','#delete0', function() {
      var product = $(this);
      var id = product.attr("data-id");
      $('#delete').modal('toggle');
      $('#xoasanpham').click(function() {
        console.log('da click vao xoa');
        console.log(id);
        $('#delete').modal('hide');
        $.ajax({
          url: "{{ route('products.remote') }}",
          type: 'get',
          dataType: 'json',
          data: {id:id},
          success: function(data) {
          console.log(data);
          alert(data);
          load_products();
        }
      })
          console.log("da xoa thanh cong");
        });
  });
});
</script>

@endsection