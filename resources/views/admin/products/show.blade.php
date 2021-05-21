@extends('layouts.admin')
@section('content')
<div class="showProduct container">
    <div class="row">
        <div class="col-6">
            <div id="products_example">
                <div id="products">
                    <div class="row">
                        <div class="col-12">
                            <div class="slides_container images_3_of_2">
                            @foreach($product->images as $image)
                            <a href="#" target="_blank"><img src="{{url($image->name)}}" alt=" " /></a>
                            @endforeach      
                            </div>                    
                        </div>
                    </div>                               
                </div>
            </div>
        </div>
        <div class="col-6">
            <h2>{{$product->name}}</h2>
            <div class="share-desc">
                <ul class="parameter">
                    <li>
                        <span>Price:</span>
                        <div>{{ number_format($product->price,0,",",".") . ' đ'}}</div>
                    </li>
                    <li>
                        <span>Quantity:</span>
                        <div>{{$product->quantity}}</div>
                    </li>
                </ul>
                            
                <div class="clear"></div>
                <div class="description area_article area_articleFull">
                    <h5>Description</h5 >
                     {{ $product->description }}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        
    </div>
</div>
@endsection