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
								<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3833.674742207302!2d108.234132914808!3d16.082359588872798!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31421827a3c439f5%3A0xdec2fb897aa16a90!2zxJDhuqFpIGjhu41jIEdyZWVud2ljaCAoIFZp4buHdCBOYW0p!5e0!3m2!1sen!2s!4v1621590973457!5m2!1sen!2s" width="400" height="250" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
							  </div>
      				</div>
      			<div class="company_address">
				    <h3>ATN Toys Shop</h3>
					<p>Address: 685 Ngo Quyen, Son Tra, Da Nang City</p>
					<p>Phone: 0963523490</p>
				</div>
			</div>
			</div>		
         </div> 
    </div>
 </div>
@endsection