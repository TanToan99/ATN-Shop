$(function() {
	$('#search').on('keyup', function() {
		var query = $(this).val();
		if (query != '') {
			console.log(query);
			var _token = $('input[name="_token"]').val();
			$.ajax({
				url: "{{route('products.autocomplete')}}",
				type: 'post',
				dataType: 'json',
				data: {query: query, _token: _token},
				success: function(data) {
					console.log(data);
					$('#seacrchList').fadeIn();
					print_autocomplete(data);
				}
			})			
		} else {
			$('#seacrchList').fadeOut();
		}	
	});
	function print_autocomplete(data) {
		var html = '';
		if (data.length > 0) {
			html += '<ul class="dropdown-menu" style="display:block; position:relative">';
			$.each(data, function(index, val) {
			 	html += "<li><a href=\"product/"+val.id+"\">"+val.name+"</a></li>";
			});
			html += '</ul>';
		} else {
			html += "<p>Không có sản phẩm nào<p>";
		}
		$('#seacrchList').html(html);
	}
	$(document).on('click', 'li', function() {
		console.log('da click');
		$('#search').val($(this).text());  
        $('#seacrchList').fadeOut(); 
	});
});