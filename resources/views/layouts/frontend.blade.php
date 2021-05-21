<!DOCTYPE html>
<head>
    <title>ATN Toys Shop</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="{{ url('frontend/css/style.css') }}" rel="stylesheet" type="text/css" media="all"/>
    <link href="{{ url('frontend/css/slider.css') }}" rel="stylesheet" type="text/css" media="all"/>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script> -->
    <!-- <script type="text/javascript" src="{{ url('frontend/js/jquery-1.7.2.min.js') }}"></script>  -->
    <script type="text/javascript" src="{{ url('frontend/js/move-top.js') }}"></script>
    <script type="text/javascript" src="{{ url('frontend/js/easing.js') }}"></script>
    <script type="text/javascript" src="{{ url('frontend/js/startstop-slider.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- bootstrap -->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
  <div class="wrap">
    <div class="header">
        <div class="headertop_desc">
            <div class="call">
                 <p><span>Help </span>Contact us <span class="number">+84963523490</span></span></p>
            </div>
            <div class="account_desc">
                <ul>
                    @if(Auth::check()) 
                        <li>Hi,{{ Auth::user()->yourname }}</li>
                        <li><a href="{{ route('users.logout') }}">Logout</a></li>        
                    @else
                        <li><a href="{{ route('users.register') }}">Register</a></li>
                        <li><a href="{{ route('users.login') }}">Login</a></li>
                    @endif  
                </ul>
            </div>
            <div class="clear"></div>
        </div>
        <div class="header_top">
            <div class="logo">
                <a href="{{ route('home.index') }}"><img src="/frontend/images/logo.png" alt="" /></a>
            </div>
              <div id="navbar-cart" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li>
                            <a id="cart-popover" class="btn" data-toggle="popover"  data-placement="bottom" title="Shopping Cart">
                                <span class="glyphicon glyphicon-shopping-cart"></span>
                                <span class="badge">0</span>
                            </a>
                        </li>
                    </ul>
              </div>
              <div id="popover_content_wrapper" style="display: none">
                    <span id="cart_details"></span>
                    <div align="right">
                        @if(Auth::check()) 
                            <a href="{{ route('home.showorder', Auth::user()->id) }}"><i class="oi oi-cart">Check order</i></a>
                        @endif                        
                        <a href="{{route('home.checkorder')}}" class="btn btn-primary" id="check_out_cart">
                            <span class="glyphicon glyphicon-shopping-cart"></span> Check out
                        </a>
                        <a href="#" class="btn btn-default" id="clear_cart">
                            <span class="glyphicon glyphicon-trash"></span> Clear
                        </a>
                    </div>
                </div>
     <div class="clear"></div>
  </div>
    <div class="header_bottom">
            <div class="menu">
                <ul>
                    <li class="active"><a href="{{ route('home.index') }}">Home</a></li>
                    <li><a href="{{ route('home.showAllProduct') }}">Categories</a></li>
                    <li><a href="{{ route('home.contact') }}">Contact</a></li>
                    <div class="clear"></div>
                </ul>
            </div>
            <div class="search_box">
                <form>
                    <input autocomplete="off" type="text" name="country_name" id="search" class="form-control input-lg" placeholder="Tìm kiếm....." />
                     {{ csrf_field() }}
                </form>
                <div class="live-search-results text-left z-top"> 
                    <div class="autocomplete-suggestions" id="seacrchList">
                    </div>
                </div>   
            </div>
         </div>   
        <div id="content">
            @yield('content')
        </div>
        <div class="copy_right">

            <p>&copy; 2021 ATN Shop. All rights reserved

       </div>
    </div>
    <script type="text/javascript" src="{{ url('frontend/js/cart.js') }}"></script> 
    <script type="text/javascript">

        $(document).ready(function() {
            print_shopping(cart);                   
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
                    $.each(data, function(index, val) {
                        html += "<div class=\"search-name\"><a href=\"product/"+val.id+"\">"+val.name+"</a></div>";
                    });
                } 
                $('#seacrchList').html(html);
            }
            $('.live-search-results').on('hover', 'a' , function(e) {
                e.preventDefault();
                console.log('da click');
                $('#search').val($(this).text());  
                $('#seacrchList').fadeOut(); 
            });
            $('#cart-popover').popover({
                html : true,
                container: 'body',
                content:function(){
                    return $('#popover_content_wrapper').html();                    
                }
            });
        });        
    </script>
    <a href="#" id="toTop"><span id="toTopHover"> </span></a>
</body>
</html>

