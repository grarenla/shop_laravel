@extends('master')

@section('content')
    <div class="inner-header">
        <div class="container">
            <div class="pull-left">
                <h6 class="inner-title">Sản phẩm</h6>
            </div>
            <div class="pull-right">
                <div class="beta-breadcrumb font-large">
                    <a href="/index">Home</a> / <span>Loại sản phẩm</span>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="container">
        <div id="content" class="space-top-none">
            <div class="main-content">
                <div class="space60">&nbsp;</div>
                <div class="row">
                    <div class="col-sm-3">
                        <ul class="aside-menu">
                            @foreach($listProductType as $pt)
                                <li><a href="/category/{{$pt->id}}">{{$pt->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-sm-9">
                        <div class="beta-products-list">
                            <h4>{{$productType->name}}</h4>
                            <div class="beta-products-details">
                                <p class="pull-left">{{count($list)}} styles found</p>
                                <div class="clearfix"></div>
                            </div>

                            <div class="row">
                                @foreach($list as $item)
                                    <div class="col-sm-4" style="margin-bottom: 20px">
                                        <div class="single-item">
                                            @if($item->promotion_price > 0)
                                                <div class="ribbon-wrapper">
                                                    <div class="ribbon sale">Sale</div>
                                                </div>
                                            @endif
                                            <div class="single-item-header">
                                                <a href="/product/{{$item->id}}"><img src="source/image/product/{{$item->image}}" height="250px"></a>
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
                                                <a class="add-to-cart pull-left" href="/add-to-cart/{{$item->id}}"><i
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
                        <div class="row center">
                            {{$list->links()}}
                        </div>
                        <div class="space50">&nbsp;</div>

                    </div>
                </div> <!-- end section with sidebar and main content -->


            </div> <!-- .main-content -->
        </div> <!-- #content -->
    </div> <!-- .container -->
@endsection