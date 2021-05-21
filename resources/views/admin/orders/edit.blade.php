@extends('layouts.admin')
@section('content')
    <div class="container">
        <h1>Edit Order</h1>
            <form action="{{route('orders.update', $order->id)}}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="put">
                <div class="row">
                    <div class="col-lg-8">
                    <div class="form-group required">
                        <label for="">Tên Khách Hàng</label>
                        <select name="user_id" id="user" class="form-control">
                            <option value="">Tên Khách Hàng</option>
                            @foreach($users as $user)
                                <?php 
                                    $selected = '';
                                    if ($user->id == $order->user_id) {
                                        $selected = "selected";
                                    }
                                 ?>
                                <option value="{{$user->id}}" {{$selected}}>{{$user->username}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group required">
                        <label for="">Order Status</label>                        
                        <select name="status_id" class="form-control">
                            <option value="">Status</option>
                            @foreach($statuses as $status)
                                <?php 
                                    $selected = '';
                                    if ($status->id == $order->status_id) {
                                     $selected = "selected";
                                    }
                                ?>
                                <option value="{{$status->id}}" {{$selected}}>{{$status->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <div class="form-group required">
                            <label for="">Sản Phẩm</label>
                            <select name="product_id" class="form-control"  id="product">
                                <option value="" id="">Chọn tên sản phẩm</option>
                                @foreach($products as $product)
                                    <option value="{{$product->id}}" id="{{$product->id}}" class="product{{$product->id}}">{{$product->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group required">
                            <label for="">Số lượng</label>
                            <input type="number" name="quantity" id="qtt" class="form-control" value="1">
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <h3 class="text-center">Order Summary</h3>
                    <table class="table table-bordered" id="table_product">
                        <thead>
                            <tr>
                                <th id="productname">No Items Selected</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Sub Total</td>
                                <td>0</td>
                            </tr>                            
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>Total</td>
                                <td>0</td>
                            </tr>
                        </tfoot>
                    </table>
                    <input type="submit" value="Edit Order" class="btn btn-primary">
                </div>
                </div>
            </form>
    </div>
<script src="{{ url('js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ url('js/popper.min.js') }}"></script>
<script src="{{ url('js/bootstrap.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var qtt = 0;
        $('#product').on('click', function(event) {
           var total = 0;
           var id = this.value;
           var qtt = parseInt($('#qtt').val());
           console.log(id);
           orders(id, qtt);          
        });
        function orders(id, qtt) {
            $.ajax({
               url: "{{route('orders.create_order')}}",
               type: 'get',
               dataType: 'json',
               data: {id: id},
               success: function(data) {
                    console.log(data);
                    $('#productname').text(data.name);
                    print_screen(data, qtt);
               }
           }) 
        }
        $('#qtt').change(function() {
            var qtt = parseInt($(this).val());
            var id = $('#product').val();
            orders(id, qtt);
        });
        function print_screen(data, qtt) {
            var html = '';
            var total = data.price * qtt;
            html = '<tr>'
                + '<td>'+'Sub Total'+'</td>'
                + '<td>'+data.price+'</td>'
                +'</tr>';                 
            footer = 
                    '<tr>'
                    +'<td>'+'Total'+'</td>'
                    + '<td>'+total+'</td>'
                    +'</tr>';
            $('tbody').html(html);
            $('tfoot').html(footer);
        }
    });
</script>
@endsection