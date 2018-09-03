<div id="header">
    <div class="header-top">
        <div class="container">
            <div class="pull-left auto-width-left">
                <ul class="top-menu menu-beta l-inline">
                    <li><a href=""><i class="fa fa-home"></i> 8 Tôn Thất Thuyết</a></li>
                    <li><a href=""><i class="fa fa-phone"></i> 0969696969</a></li>
                </ul>
            </div>
            <div class="pull-right auto-width-right">
                <ul class="top-details menu-beta l-inline">
                    @if(\Illuminate\Support\Facades\Auth::check())
                        <li><a href="#"><i class="fa fa-user"></i>{{\Illuminate\Support\Facades\Auth::user()->full_name}}</a></li>
                        <li><a href="/logout">Đăng xuất</a></li>
                    @else
                        <li><a href="/register">Đăng kí</a></li>
                        <li><a href="/login">Đăng nhập</a></li>
                    @endif
                </ul>
            </div>
            <div class="clearfix"></div>
        </div> <!-- .container -->
    </div> <!-- .header-top -->
    <div class="header-body">
        <div class="container beta-relative">
            <div class="pull-left">
                <a href="/home" id="logo"><img src="source/assets/dest/images/logo-cake.png" width="200px" alt=""></a>
            </div>
            <div class="pull-right beta-components space-left ov">
                <div class="space10">&nbsp;</div>
                <div class="beta-comp">
                    <form role="search" method="get" id="searchform" action="/search">
                        <input type="text" value="" name="search" id="s" placeholder="Nhập từ khóa..."/>
                        <button class="fa fa-search" type="submit" id="searchsubmit"></button>
                    </form>
                </div>

                <div class="beta-comp">
                    <div class="cart">
                        @if(\Illuminate\Support\Facades\Session::has('cart'))
                            <div class="beta-select"><i class="fa fa-shopping-cart"></i> Giỏ hàng
                                ({{Session('cart')->totalQty}}) <i
                                        class="fa fa-chevron-down"></i></div>
                            <div class="beta-dropdown cart-body">
                                @foreach($product_cart as $prod)
                                    <div class="cart-item">
                                        <a class="cart-item-delete" href="/delete-item-cart/{{$prod['item']['id']}}"><i class="fa fa-times"></i></a>
                                        <div class="media">
                                            <a class="pull-left" href="#"><img
                                                        src="source/image/product/{{$prod['item']['image']}}"></a>
                                            <div class="media-body">
                                                <span class="cart-item-title">{{$prod['item']['name']}}</span>
                                                <span class="color-gray your-order-info">Price: {{$prod['item']['']}}</span>
                                                <span class="cart-item-amount">{{$prod['qty']}} *<span>
                                                    @if($prod['item']['promotion_price']!=0)
                                                        {{number_format($prod['item']['promotion_price'])}}
                                                    @else
                                                        {{number_format($prod['item']['unit_price'])}}
                                                    @endif
                                                </span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <div class="cart-caption">
                                    <div class="cart-total text-right">Tổng tiền: <span
                                                class="cart-total-value">{{number_format(Session('cart')->totalPrice)}} VND</span></div>
                                    <div class="clearfix"></div>

                                    <div class="center">
                                        <div class="space10">&nbsp;</div>
                                        <a href="/order" class="beta-btn primary text-center">Đặt hàng <i
                                                    class="fa fa-chevron-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="beta-select"><i class="fa fa-shopping-cart"></i> Giỏ hàng (Trống) <i
                                        class="fa fa-chevron-down"></i></div>
                            <div class="beta-dropdown cart-body">
                                <div class="cart-item">
                                    <div class="text-center">
                                        Không có sản phẩm nào trong giỏ hàng.
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div> <!-- .cart -->
                </div>
            </div>
            <div class="clearfix"></div>
        </div> <!-- .container -->
    </div> <!-- .header-body -->
    <div class="header-bottom" style="background-color: #0277b8;">
        <div class="container">
            <a class="visible-xs beta-menu-toggle pull-right" href="#"><span class='beta-menu-toggle-text'>Menu</span>
                <i class="fa fa-bars"></i></a>
            <div class="visible-xs clearfix"></div>
            <nav class="main-menu">
                <ul class="l-inline ov">
                    <li><a href="/home">Trang chủ</a></li>
                    <li><a href="javascript:void(0)">Loại sản phẩm</a>
                        <ul class="sub-menu">
                            @foreach($productType as $pt)
                                <li><a href="/category/{{$pt->id}}">{{$pt->name}}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li><a href="/about">Giới thiệu</a></li>
                    <li><a href="/contact">Liên hệ</a></li>
                </ul>
                <div class="clearfix"></div>
            </nav>
        </div> <!-- .container -->
    </div> <!-- .header-bottom -->
</div> <!-- #header -->