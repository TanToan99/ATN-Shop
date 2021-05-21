$(function() {
	$('#search').click(function() {
		console.log('đả click');
		var query = $('#q').val();
		load_products(query);
	});
	function load_products(query = "") {
		console.log(query);
		$.ajax({
			url: "search",
			type: 'GET',
			dataType: 'json',
			data: {query:query},
			success: function(result) {
				console.log(result);
			}
		})
		.done(function() {
			console.log("success");
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
	}
	
});