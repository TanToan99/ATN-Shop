
$(document).ready(function() {
	$('#search_comment').on('keyup',function(){
	  $value=$(this).val();
	      $.ajax({
	      type : 'get',
	      dataType: 'json',
	      url:"{{ route('comments.search') }}",
	      data:{'search':$value},
	      success:function(data){
	        $('tbody').html(data);
	    }	
	  });
	})
})	