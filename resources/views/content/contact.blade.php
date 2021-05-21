@extends('layouts.frontend')
@section('content')
 <div class="main">
    <div class="content">
    	<div class="section group">
				<div class="col span_2_of_3">
				  <div class="contact-form">
				  	<h2>Contact Us</h2>
				  		@if (session('status'))
					        <div class="alert alert-info" style="color:red" >{{session('status')}}</div>
					    @endif
					    <form action="{{ route('home.sendcontact') }}" method="post">
					    	{{ csrf_field() }}
					    	<div>
						    	<span><label>Name</label></span>
						    	<span><input type="text" name="name" class="textbox" ></span>
						    	@if($errors->has('name'))
									<span class="text-danger">{{ $errors->first('name') }}</span>
								@endif
						    </div>
						    <div>
						    	<span><label>E-mail</label></span>
						    	<span><input type="text" name="email" class="textbox"></span>
						    	@if($errors->has('email'))
									<span class="text-danger">{{ $errors->first('email') }}</span>
								@endif
						    </div>
						    <div>
						    	<span><label>Subject</label></span>
						    	<span><textarea name="content"></textarea></span>
						    	@if($errors->has('content'))
									<span class="text-danger">{{ $errors->first('content') }}</span>
								@endif
						    </div>
						   <div>
						   		<span><input type="submit" value="Submit"  class="myButton"></span>
						  </div>
					    </form>
				  </div>
  				</div>
				<div class="col span_1_of_3">
					<div class="contact_info">
    	 				<h3>Find Us Here</h3>
					    	  <div class="map">
							   	   <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3833.8235641147858!2d108.21673041425562!3d16.07464294356401!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314218374466a2b3%3A0x4ab855ae8b73564f!2zVFTEkFQgTOG6rXAgVHLDrG5oIFZpw6puIGlWaWV0dGVjaA!5e0!3m2!1svi!2s!4v1539220072040" width="100%" height="175" frameborder="0" style="border:0" allowfullscreen></iframe><br><small><a href="https://maps.google.co.in/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=Lighthouse+Point,+FL,+United+States&amp;aq=4&amp;oq=light&amp;sll=26.275636,-80.087265&amp;sspn=0.04941,0.104628&amp;ie=UTF8&amp;hq=&amp;hnear=Lighthouse+Point,+Broward,+Florida,+United+States&amp;t=m&amp;z=14&amp;ll=26.275636,-80.087265" style="color:#666;text-align:left;font-size:12px">View Larger Map</a></small>
							  </div>
      				</div>
      			<div class="company_address">
				     	<h3>ATN Toys Shop</h3>
						    	<!-- <p>500 Lorem Ipsum Dolor Sit,</p>
						   		<p>22-56-2-9 Sit Amet, Lorem,</p>
						   		<p>USA</p>
				   		<p>Phone:(00) 222 666 444</p>
				   		<p>Fax: (000) 000 00 00 0</p>
				 	 	<p>Email: <span><a href="mailto:@example.com">info@mycompany.com</a></span></p>
				   		<p>Follow on: <span>Facebook</span>, <span>Twitter</span></p> -->
				</div>
			</div>
			</div>		
         </div> 
    </div>
 </div>
@endsection