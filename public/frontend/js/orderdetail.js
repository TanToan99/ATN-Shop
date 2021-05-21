$(function() {
	print_orderdetail(cart);
	function print_orderdetail(cart) {
		var html = '';
		var totaldt = 0;
		if (cart.length > 0) {
			$.each(cart, function(index, val) {
				totaldt += val.subtotal;
			html += 
				'<tr>'
					+ '<td>' + val.name + '</td>'
					+ "<td>" + val.qtt +'</td>'
					+ '<td>' + val.subtotal + '</td>'
					+ "<input type=\"hidden\" name=\"pid[]\" value=\""+val.id+"\">"
					+ "<input type=\"hidden\" name=\"qtt[]\" value=\""+val.qtt+"\">"
					+ "<input type=\"hidden\" name=\"subtotal[]\" value=\""+val.subtotal+"\">"
					+ "<input type=\"hidden\" name=\"name[]\" value=\""+val.name+"\">"
				+ '</tr>';		
			});
			console.log(totaldt);
			$('#totaldetail').val(totaldt);
			$('tbody').html(html);
			$('#totalcheckout').html(totaldt);

		} else {
			html = '<h3>Không có sản phẩm trong giỏ hàng, xin quay lại <h3>'
				+ "<a href=\"{{route('home')}}\">Trang Chủ</a>";
			$('#error_order_detail').html(html);
		}
	}
});