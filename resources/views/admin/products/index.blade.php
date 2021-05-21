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
      <h1><i class="fa fa-cube"></i>&nbsp;Product</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-cube fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Product manager</a></li>
    </ul>
  </div>
  <div class="">
    <div class="tile">
      <div class="tile-body">
        <div class="row">
          <div class="col-md-4">
            <a href="{{route('products.create')}}" class="btn btn-xs btn-info"><i class="ace-icon fa fa-plus bigger-120">&nbsp; &nbsp;Add Product</i></a>
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
        <th>Image</th>
        <th>Name</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Category</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
      @foreach($products as $product)
      <tr>
        @foreach($product->images as $image)
        <td><img src="{{url($image->name)}}" width="50px" height="50px"></td>
        @endforeach
        <td><a href="{{route('products.show', $product->id)}}">{{$product->name}}</a></td>
        <td>{{$product->quantity}}</td>
        <td>{{$product->price}}</td>
        <td>{{$product->category->name}}</td>
        <td>
          <a href="{{route('products.edit', $product->id)}}" class="btn btn-info"><i class="ace-icon fa fa-pencil bigger-120"></i></a>
          <button class="btn btn-danger" title="Xóa sản phẩm" data-id="{{$product->id}}" id="delete{{$product->id}}">
            <i class="fa fa-trash-o"></i></button>
        </td>
      </tr>
      @endforeach
    </tbody>
    
  </table>
</div>
<div class="paging">
  {!! $products->links() !!}
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
            Are you sure to delete product ?
          </p>
              <input type="hidden" name="user_id" id="user_id" value="">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-success" data-dismiss="modal">Back</button>
            <button type="submit" class="btn btn-warning" id="xoasanpham">Submit</button>
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
  $('#timkiem').on('click','button', function() {
      var product = $(this);
      var id = product.attr("data-id");
      console.log(id);
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
      });
  });
});
</script>

@endsection