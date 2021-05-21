@extends('layouts.frontend')
@section('content')
<div class="header_slide">
<div class="header_bottom_left">                
    <div class="categories">
      <ul>
        <h3>Categories</h3>
          @foreach($categories as $category)
          <li><a href="{{route('categories.showproduct', $category->id)}}">{{$category->name}}</a></li>
          @endforeach
      </ul>
    </div>                  
 </div>
         <div class="header_bottom_right">                   
             <div class="slider">                        
                <div id="slider">
                  <div id="mover">
                    <div id="slide-1" class="slide">                                
                       <div class="slider-img">
                           <a href="preview.html"><img src="{{ url('images/slides/sl1.jpg') }}" alt="learn more" /></a>         
                        </div>                      
                        <div class="clear"></div>             
                    </div>    
                        <div class="slide">
                            <!--<div class="slider-text">
                             <h1>Clearance<br><span>SALE</span></h1>
                             <h2>UPTo 40% OFF</h2>
                           <div class="features_list">
                            <h4>Get to Know More About Our Memorable Services</h4>                                         
                            </div>
                             <a href="preview.html" class="button">Shop Now</a>
                           </div>  -->      
                             <div class="slider-img">
                             <a href="preview.html"><img src="{{ url('images/slides/sl2.jpg') }}" alt="learn more" /></a>
                          </div>                                                                         
                          <div class="clear"></div>             
                      </div>
                      <div class="slide">                                     
                          <div class="slider-img">
                             <a href="preview.html"><img src="{{ url('images/slides/sl3.jpg') }}" alt="learn more" /></a>
                          </div>
                          <!-- <div class="slider-text">
                             <h1>Clearance<br><span>SALE</span></h1>
                             <h2>UPTo 10% OFF</h2>
                           <div class="features_list">
                            <h4>Get to Know More About Our Memorable Services Lorem Ipsum is simply dummy text</h4>                                        
                            </div>
                             <a href="preview.html" class="button">Shop Now</a>
                           </div>    -->
                          <div class="clear"></div>             
                      </div>                                                
                 </div>     
            </div>
         <div class="clear"></div>                         
     </div>
  </div>
<div class="clear"></div>
</div>
</div>
<div class="main">
<div class="content">
<div class="content_top">
    <div class="heading">
    <h3>New Toys</h3>
    </div>
    <div class="see">
        <p><a href="{{ route('home.showAllProduct') }}">View All</a></p>
    </div>
    <div class="clear"></div>
</div>

  <div class="section group">
    @foreach($new_products as $product)
        <div class="grid_1_of_4 images_1_of_4">
          <a href="{{ route('home.product', $product->id) }}">
            @foreach($product->images as $image)
            <img src="{{url($image->name)}}" alt="" height="200px" />
            @endforeach
          </a>
          <h2><a href="{{ route('home.product', $product->id) }}">{{$product->name}}</a></h2>
            <div class="price-details">
               <div class="price-number">
                    <p><span class="rupees price-red" id="cangiua">{!!number_format($product->price,0,",",".") . 'đ'!!}</span></p>
                </div>
                        <div class="add-cart" id="{{$product->id}}" data-name="{{$product->name}}" data-price="{{$product->price}}">                              
                            <h4><a href="#">Add to Cart</a></h4>
                         </div>
                     <div class="clear"></div>
            </div>
             
        </div>
    @endforeach
  </div>
    <div class="content_bottom">
      <div class="heading">
      <h3>Hot Toys</h3>
      </div>
      <div class="see">
          <p><a href="{{ route('home.showAllProduct') }}">View All</a></p>
      </div>
      <div class="clear"></div>
  </div>
    <div class="section group">
    @foreach($highLights_products as $product)
      <div class="grid_1_of_4 images_1_of_4">
        <a href="{{ route('home.product', $product->id) }}">
          @foreach($product->images as $image)
          <img src="{{url($image->name)}}" alt="" height="200px" />
          @endforeach
        </a>
        <h2><a href="{{ route('home.product', $product->id) }}">{{$product->name}}</a></h2>
          <div class="price-details">
             <div class="price-number">
                  <p><span class="rupees price-red" id="cangiua">{!!number_format($product->price,0,",",".") . 'đ'!!}</span></p>
              </div>
                      <div class="add-cart" id="{{$product->id}}" data-name="{{$product->name}}" data-price="{{$product->price}}">                              
                          <h4><a href="#">Add to Cart</a></h4>
                       </div>
                   <div class="clear"></div>
          </div>
           
      </div>
    @endforeach
  </div>
</div>
</div>
</div>
<div class="footer">
<div class="wrap">    
 <div class="section group">
<!--         <div class="col_1_of_4 span_1_of_4">
                <h4>Information</h4>
                <ul>
                <li><a href="about.html">About Us</a></li>
                <li><a href="contact.html">Customer Service</a></li>
                <li><a href="#">Advanced Search</a></li>
                <li><a href="delivery.html">Orders and Returns</a></li>
                <li><a href="contact.html">Contact Us</a></li>
                </ul>
            </div>
        <div class="col_1_of_4 span_1_of_4">
            <h4>Why buy from us</h4>
                <ul>
                <li><a href="about.html">About Us</a></li>
                <li><a href="contact.html">Customer Service</a></li>
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="contact.html">Site Map</a></li>
                <li><a href="#">Search Terms</a></li>
                </ul>
        </div>
        <div class="col_1_of_4 span_1_of_4">
            <h4>My account</h4>
                <ul>
                    <li><a href="contact.html">Sign In</a></li>
                    <li><a href="index.html">View Cart</a></li>
                    <li><a href="#">My Wishlist</a></li>
                    <li><a href="#">Track My Order</a></li>
                    <li><a href="contact.html">Help</a></li>
                </ul>
        </div>
        <div class="col_1_of_4 span_1_of_4">
            <h4>Contact</h4>
                <ul>
                    <li><span>+91-123-456789</span></li>
                    <li><span>+00-123-000000</span></li>
                </ul>
                <div class="social-icons">
                    <h4>Follow Us</h4>
                      <ul>
                          <li><a href="#" target="_blank"><img src="frontend/images/facebook.png" alt="" /></a></li>
                          <li><a href="#" target="_blank"><img src="frontend/images/twitter.png" alt="" /></a></li>
                          <li><a href="#" target="_blank"><img src="frontend/images/skype.png" alt="" /> </a></li>
                          <li><a href="#" target="_blank"> <img src="frontend/images/dribbble.png" alt="" /></a></li>
                          <li><a href="#" target="_blank"> <img src="frontend/images/linkedin.png" alt="" /></a></li>
                          <div class="clear"></div>
                     </ul>
                </div>
        </div> -->
    </div>          
</div>
@endsection