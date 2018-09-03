@extends('master')

@section('content')
    <div class="inner-header">
        <div class="container">
            <div class="pull-left">
                <h6 class="inner-title">Product Detail</h6>
            </div>
            <div class="pull-right">
                <div class="beta-breadcrumb font-large">
                    <a href="/index">Home</a> / <span>Product Detail</span>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="container">
        <div id="content">
            <div class="row">
                <div class="col-sm-9">

                    <div class="row">
                        <div class="col-sm-4">
                            <img src="source/image/product/{{$product->image}}">
                        </div>
                        <div class="col-sm-8">
                            <div class="single-item-body">
                                <p class="single-item-title" style="font-size: 30px">{{$product->name}}</p>
                                <p class="single-item-price">
                                                <span
                                                        @if($product->promotion_price > 0)
                                                        class="flash-del"
                                                        @endif>{{number_format($product->unit_price)}} VND</span>
                                    @if($product->promotion_price > 0)
                                        <span class="flash-sale">{{number_format($product->promotion_price)}} VND</span>
                                    @endif
                                </p>
                            </div>
                            <div class="clearfix"></div>
                            <div class="space20">&nbsp;</div>

                            <div class="single-item-desc">
                                <p>{{$product->description}}</p>
                            </div>
                            <div class="space20">&nbsp;</div>

                            <p>Options:</p>
                            <div class="single-item-options">
                                <select class="wc-select" name="color">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                                <a class="add-to-cart" href="#"><i class="fa fa-shopping-cart"></i></a>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>

                    <div class="space40">&nbsp;</div>
                    <div class="woocommerce-tabs">
                        <ul class="tabs">
                            <li><a href="#tab-description">Description</a></li>
                            <li><a href="#tab-reviews">Reviews (0)</a></li>
                        </ul>

                        <div class="panel" id="tab-description">
                            <p>{{$product->description}}</p>
                        </div>
                        <div class="panel" id="tab-reviews">
                            <p>No Reviews</p>
                        </div>
                    </div>
                    <div class="space50">&nbsp;</div>
                    <div class="beta-products-list">
                        <h4>Related Products</h4>

                        <div class="row">
                            @foreach($listRelated as $item)
                                <div class="col-sm-4" style="margin-bottom: 20px">
                                    <div class="single-item">
                                        @if($item->promotion_price > 0)
                                            <div class="ribbon-wrapper">
                                                <div class="ribbon sale">Sale</div>
                                            </div>
                                        @endif
                                        <div class="single-item-header">
                                            <a href="/product/{{$item->id}}"><img src="source/image/product/{{$item->image}}" height="200px"></a>
                                        </div>
                                        <div class="single-item-body">
                                            <p class="single-item-title">{{$item->name}}</p>
                                            <p class="single-item-price">
                                                <span
                                                        @if($item->promotion_price > 0)
                                                        class="flash-del"
                                                        @endif>{{number_format($item->unit_price)}} VND</span>
                                                @if($item->promotion_price > 0)
                                                    <span class="flash-sale">{{number_format($item->promotion_price)}} VND</span>
                                                @endif
                                            </p>
                                        </div>
                                        <div class="single-item-caption">
                                            <a class="add-to-cart pull-left" href="shopping_cart.html"><i
                                                        class="fa fa-shopping-cart"></i></a>
                                            <a class="beta-btn primary" href="/product/{{$item->id}}">Details <i
                                                        class="fa fa-chevron-right"></i></a>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div> <!-- .beta-products-list -->
                </div>
                <div class="col-sm-3 aside">
                    <div class="widget">
                        <h3 class="widget-title">Best Sellers</h3>
                        <div class="widget-body">
                            <div class="beta-sales beta-lists">
                                @foreach($listPromotion as $item)
                                    <div class="media beta-sales-item">
                                        <a class="pull-left" href="/product/{{$item->id}}"><img src="source/image/product/{{$item->image}}" alt=""></a>
                                        <div class="media-body">
                                            {{$item->name}}

                                        </div>
                                        <span class="beta-sales-price">{{$item->promotion_price}}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div> <!-- best sellers widget -->
                    <div class="widget">
                        <h3 class="widget-title">New Products</h3>
                        <div class="widget-body">
                            <div class="beta-sales beta-lists">
                                @foreach($listNew as $item)
                                    <div class="media beta-sales-item">
                                        <a class="pull-left" href="/product/{{$item->id}}"><img src="source/image/product/{{$item->image}}" alt=""></a>
                                        <div class="media-body">
                                            {{$item->name}}
                                        </div>
                                        <span class="beta-sales-price">
                                        @if($item->promotion_price > 0)
                                            {{$item->promotion_price}}
                                        @else
                                            {{$item->unit_price}}
                                        @endif
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div> <!-- best sellers widget -->
                </div>
            </div>
        </div> <!-- #content -->
    </div> <!-- .container -->
@endsection