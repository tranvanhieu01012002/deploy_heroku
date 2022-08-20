@extends('Layouts.master');
@section('ajax')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endsection
@section('content')
    <div class="inner-header">
        <div class="container">
            <div class="pull-left">
                <h6 class="inner-title">Đặt hàng</h6>
            </div>
            <div class="pull-right">
                <div class="beta-breadcrumb">
                    <a href="index.html">Trang chủ</a> / <span>Đặt hàng</span>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="container">
        <div id="content">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (Session::has('success'))
                <h1>dat hang thanh cong</h1>
            @endif
            <form action="{{ route('payment') }}" method="post" class="beta-form-checkout">
                @csrf
                <div class="row">
                    <div class="col-sm-6">

                        <h4>Đặt hàng</h4>
                        <div class="space20">&nbsp;</div>

                        <div class="form-block">
                            <label for="name">Họ tên*</label>
                            <input name="name" type="text" id="name" placeholder="Họ tên"
                                value="{{ Session::has('user') ? Session::get('user')->full_name : '' }}" required>
                        </div>
                        <div class="form-block">
                            <label>Giới tính </label>
                            <input id="gender" type="radio" class="input-radio" name="gender" value="nam"
                                checked="checked" style="width: 10%"><span style="margin-right: 10%">Nam</span>
                            <input id="gender" type="radio" class="input-radio" name="gender" value="nữ"
                                style="width: 10%"><span>Nữ</span>

                        </div>

                        <div class="form-block">
                            <label for="email">Email*</label>
                            <input value="{{ Session::has('user') ? Session::get('user')->email : '' }}" name="email"
                                type="email" id="email" required placeholder="expample@gmail.com">
                        </div>

                        <div class="form-block">
                            <label for="adress">Địa chỉ*</label>
                            <select id="province">
                            </select>

                            <select id="district">
                            </select>

                            <select id="ward">
                            </select>
                            <input name="address"
                                value="{{ Session::has('user') ? (Session::get('user')->address == null ? '...' : Session::get('user')->address) : '' }}"
                                type="text" id="adress" placeholder="Street Address" required>
                        </div>


                        <div class="form-block">
                            <label for="phone">Điện thoại*</label>
                            <input name="phone_number" value="{{ Session::has('user') ? Session::get('user')->phone : '' }}"
                                type="text" id="phone" required>
                        </div>

                        <div class="form-block">
                            <label for="notes">Ghi chú</label>
                            <textarea name="notes" id="notes"></textarea>
                        </div>




                    </div>
                    <div class="col-sm-6">
                        <div class="your-order">
                            <div class="your-order-head">
                                <h5>Đơn hàng của bạn</h5>
                            </div>
                            <div class="your-order-body" style="padding: 0px 10px">
                                <div class="your-order-item">
                                    @if (Session::has('cart'))
                                        @foreach ($product_cart as $item)
                                            <div class="media">
                                                <img width="25%"
                                                    src={{ env('APP_URL') . '/source/image/product/' . $item['item']['image'] }}
                                                    alt="" class="pull-left">
                                                <div class="media-body">
                                                    <p class="font-large">{{ $item['item']['name'] }}</p>
                                                    <span class="color-gray your-order-info">Color: Red</span>
                                                    <span class="color-gray your-order-info">Size: M</span>
                                                    <span class="color-gray your-order-info">Qty:
                                                        {{ $item['qty'] }}</span>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif

                                    <div>
                                        <!--  one item	 -->

                                        <!-- end one item -->
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="your-order-item">
                                    <div class="pull-left">
                                        <p class="your-order-f18">Tổng tiền:</p>
                                    </div>
                                    <div class="pull-right">
                                        <h5 class="color-black">
                                            ${{ Session::has('cart') ? Session('cart')->totalPrice : '0' }}</h5>
                                    </div>

                                    <div class="clearfix"></div>
                                </div>
                                <div class="your-order-item">
                                    <div class="pull-left">
                                        <p class="your-order-f18">Tien fee:</p>
                                    </div>
                                    <div class="pull-right">
                                        <p class="color-black">$<input readonly name="deliveryFee" value="0" id="quantity"/></p>
                                    </div>

                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="your-order-head">
                                <h5>Hình thức thanh toán</h5>
                            </div>
                            `
                            <div class="your-order-body">
                                <ul class="payment_methods methods">
                                    <li class="payment_method_bacs">
                                        <input id="payment_method_bacs" type="radio" class="input-radio"
                                            name="payment_method" value="COD" checked="checked"
                                            data-order_button_text="">
                                        <label for="payment_method_bacs">Thanh toán khi nhận hàng </label>
                                        <div class="payment_box payment_method_bacs" style="display: block;">
                                            Cửa hàng sẽ gửi hàng đến địa chỉ của bạn, bạn xem hàng rồi thanh toán tiền cho
                                            nhân viên giao hàng
                                        </div>
                                    </li>

                                    <li class="payment_method_cheque">
                                        <input id="payment_method_cheque" type="radio" class="input-radio"
                                            name="payment_method" value="ATM" data-order_button_text="">
                                        <label for="payment_method_cheque">Chuyển khoản </label>
                                        <div class="payment_box payment_method_cheque" style="display: none;">
                                            Chuyển tiền đến tài khoản sau:
                                            <br>- Số tài khoản: 123 456 789
                                            <br>- Chủ TK: Nguyễn A
                                            <br>- Ngân hàng ACB, Chi nhánh TPHCM
                                        </div>
                                    </li>
                                    <li class="payment_method_cheque"><input id="payment_method_cheque" type="radio"
                                            class="input-radio" name="payment_method" value="VNPAY"
                                            data-order_button_text="">
                                        <label for="payment_method_cheque">Thanh toán online</label>
                                    </li>

                                </ul>
                            </div>

                            <div class="text-center"><button class="beta-btn primary">Đặt hàng <i
                                        class="fa fa-chevron-right"></i></button></div>
                        </div> <!-- .your-order -->
                    </div>
                </div>
            </form>
        </div> <!-- #content -->
    </div> <!-- .container -->

@endsection


@section('footer_scripts')
    @include('Partial.handleFee')
@endsection
