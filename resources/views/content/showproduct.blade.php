@extends('layouts.frontend')
@section('content')
<div class="main">
    <div class="content">
        <div class="content_top">
            <div class="back-links">
                <p><a href="{{ route('home.index') }}">Home</a>/<a href="{{ route('home.showAllProduct') }}">All Product</a></p>
            </div>
            <div class="clear"></div>
        </div>
        <div class="section group">
            <div class="cont-desc span_1_of_2">                
                <div class="content_bottom">
                    <div class="heading">
                        <h3>All Product</h3>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="section group">
                    @foreach($products as $product)
                    <div class="grid_1_of_4 images_1_of_4">
                        <a href="{{ route('home.product', $product->id) }}">
                        @foreach($product->images as $image)
                        <img src="{{url($image->name)}}" alt="" height="200px" />
                        @endforeach
                        </a>
                    <h2><a href="{{ route('home.product', $product->id) }}">{{$product->name}}</a></h2>
                    <div class="price-details">
                        <div class="price-number">
                            <p><span class="rupees price-red">{!!number_format($product->price,0,",",".") . 'đ'!!}</span></p>
                        </div>
                        <div class="add-cart" id="{{$product->id}}" data-name="{{$product->name}}" data-price="{{$product->price}}">                              
                            <h4><a href="#">Add to Cart</a></h4>
                         </div>
                        <div class="clear"></div>
                    </div>
             
                </div>
                    @endforeach
                </div>
                <div id="pagining">
                    {!! $products->links() !!}
                </div>
            </div>
            
            <div class="rightsidebar span_3_of_1">
                <h2>CATEGORIES</h2>
                <ul class="side-w3ls">
                    @foreach($categories as $category)
                    <li><a href="{{route('categories.showproduct', $category->id)}}">{{$category->name}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection