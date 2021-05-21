<h1>Tên khách hàng: {{ $data_order['yourname'] }}</h1>
@foreach($data_product as $product)
	<p>Khách hàng đả Order sản phẩm: {{ $product['name'] }}</p>
	<p>Với số lượng: {{ $product['quantity'] }}</p>
	<p>Thành tiền: {{ $product['subtotal'] }}</p>
@endforeach
<p>Tông thành tiền: {{ $data_order['total'] }}</p>