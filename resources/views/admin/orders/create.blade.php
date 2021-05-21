@extends('layouts.admin')
@section('content')
    <div class="container">
        <h1>Add New Order</h1>
            <form action="{{route('orders.store')}}" method="post">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-lg-8">
                    <div class="form-group required">
                        <label for="">Tên Khách Hàng</label>
                        <select name="user_id" id="user" class="form-control">
                            <option value="">Tên Khách Hàng</option>
                            @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->username}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group required">
                        <label for="">Order Status</label>
                        <select name="status_id" class="form-control">
                            <option value="">Status</option>
                            @foreach($statuses as $status)
                                <option value="{{$status->id}}">{{$status->name}}</option>
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
                        <tbody>
                             <tr>
                                <th id="productname">No Items Selected</th>
                            </tr>
                            <tr>
                                <td>Sub Total</td>
                                <td>0</td>
                            </tr>
                            <tr>
                                <td>Total</td>
                                <td>0</td>
                            </tr>                            
                        </tbody>
                    </table>
                    <input type="submit" value="Tạo Order" class="btn btn-primary">
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
                    //$('#productname').text(data.name);
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
            html +=  '<tr id="name">';
            html +=  '<td>' + data.name + '</td>';
            html +=  '<td>' + data.price + '</td>';
            html +=  '<div id="sub">';
            html +=    '</div>';
            html +=     '</tr>';
            html +=    '<tr id="item">';
            html +=    '<td>'+'Sub Total'+'</td>';
            html +=    '<td>'+data.price+'</td>';
            html +=   '</tr>';
            html +=    '<tr id="total">';
            html +=    '<td>'+'Total'+'</td>';
            html +=     '<td>'+total+'</td>';
            html +=    '</tr>';
            console.log(html);
            $('tbody').html(html);
        }
    });
</script>
@endsection