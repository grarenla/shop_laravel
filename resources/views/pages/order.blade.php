@extends('master')

@section('content')
    <div class="container">
        <div id="content">
            @if(\Illuminate\Support\Facades\Session::has('cart'))
                <form action="/order" method="post" class="beta-form-checkout">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="row">
                    <div class="col-sm-6">
                        <h4>Đặt hàng</h4>
                        <div class="space20">&nbsp;</div>

                        <div class="form-block">
                            <label for="name">Họ tên*</label>
                            <input type="text" id="name" placeholder="Họ tên" name="name" required>
                        </div>

                        <div class="form-block">
                            <label for="email">Email*</label>
                            <input type="email" id="email" required placeholder="expample@gmail.com" name="email">
                        </div>

                        <div class="form-block">
                            <label for="adress">Địa chỉ*</label>
                            <input type="text" id="adress" placeholder="Street Address" name="address" required>
                        </div>


                        <div class="form-block">
                            <label for="phone">Điện thoại*</label>
                            <input type="text" id="phone" name="phone_number" required>
                        </div>

                        <div class="form-block">
                            <label for="notes">Ghi chú</label>
                            <textarea id="notes" name="note" required></textarea>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="your-order">
                            <div class="your-order-head"><h5>Đơn hàng của bạn</h5></div>
                            <div class="your-order-body" style="padding: 0px 10px">
                                @foreach($product_cart as $prod)
                                    <div class="your-order-item">
                                        <div>
                                            <!--  one item	 -->
                                            <div class="media">
                                                <img width="25%" src="source/image/product/{{$prod['item']['image']}}" alt="" class="pull-left">
                                                <div class="media-body">
                                                    <p class="font-large">{{$prod['item']['name']}}</p>
                                                    <span class="color-gray your-order-info">Price:
                                                        @if($prod['item']['promotion_price'] > 0)
                                                            {{number_format($prod['item']['promotion_price'])}}
                                                        @else
                                                            {{number_format($prod['item']['unit_price'])}}
                                                        @endif
                                                            VND</span>

                                                    <span class="color-gray your-order-info">Qty: {{$prod['qty']}}</span>
                                                </div>
                                            </div>
                                            <!-- end one item -->
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                @endforeach
                                <div class="your-order-item">
                                    <div class="pull-left"><p class="your-order-f18">Tổng tiền:</p></div>
                                    <div class="pull-right"><h1 class="color-black">{{number_format(Session('cart')->totalPrice)}} VND</h1></div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="your-order-head"><h5>Hình thức thanh toán</h5></div>

                            <div class="your-order-body">
                                <ul class="payment_methods methods">
                                    <li class="payment_method_bacs">
                                        <input id="payment_method_bacs" type="radio" class="input-radio" name="payment_method" value="COD" checked="checked" data-order_button_text="">
                                        <label for="payment_method_bacs">Thanh toán khi nhận hàng </label>
                                        <div class="payment_box payment_method_bacs" style="display: block;">
                                            Cửa hàng sẽ gửi hàng đến địa chỉ của bạn, bạn xem hàng rồi thanh toán tiền cho nhân viên giao hàng
                                        </div>
                                    </li>

                                    <li class="payment_method_cheque">
                                        <input id="payment_method_cheque" type="radio" class="input-radio" name="payment_method" value="ATM" data-order_button_text="">
                                        <label for="payment_method_cheque">Chuyển khoản </label>
                                        <div class="payment_box payment_method_cheque" style="display: none;">
                                            Chuyển tiền đến tài khoản sau:
                                            <br>- Số tài khoản: 123 456 789
                                            <br>- Chủ TK: Nguyễn A
                                            <br>- Ngân hàng ACB, Chi nhánh HN
                                        </div>
                                    </li>

                                </ul>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="beta-btn primary">
                                    Đặt hàng <i class="fa fa-chevron-right"></i>
                                </button>
                            </div>
                        </div> <!-- .your-order -->
                    </div>
                </div>
            </form>
            @else
                <h3 class="text-center">
                    Không có sản phẩm nào trong giỏ hàng.
                    <div class="row">
                        <a href="/home" class="btn btn-success" style="margin-top: 40px">
                            Tiếp tục mua hàng
                        </a>
                    </div>
                </h3>
            @endif
        </div> <!-- #content -->
    </div>
@endsection