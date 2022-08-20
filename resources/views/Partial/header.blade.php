<div id="header">
    <div class="header-top">
        <div class="container">
            <div class="pull-left auto-width-left">
                <ul class="top-menu menu-beta l-inline">
                    <li><a href=""><i class="fa fa-home"></i> 90-92 Lê Thị Riêng, Bến Thành, Quận 1</a></li>
                    <li><a href=""><i class="fa fa-phone"></i> 0163 296 7751</a></li>
                </ul>
            </div>
         
            <div class="pull-right auto-width-right">
                <ul class="top-details menu-beta l-inline">
                    <li><a href={{Session::has('user')?"/":"/input-email"}}><i class="fa fa-user">{{ Session::has('user') ? Session::get('user')->full_name: 'quen mat khau' }}</i></a></li>
            <li><a href="{{Session::has('user')? route('user.logout'):  route('user.get-sign-up')}}"> {{Session::has('user')? "Dang xuat": "Dang ky"}}</a></li>
            <li><a href="{{route('user.get-log-in')}}">Đăng nhập</a></li>     
                </ul>
            </div>
            <div class="clearfix"></div>
        </div> <!-- .container -->
    </div> <!-- .header-top -->
    <div class="header-body">
        <div class="container beta-relative">
            <div class="pull-left">
                <a href="index.html" id="logo"><img src="source/assets/dest/images/logo-cake.png" width="200px"
                        alt=""></a>
            </div>
            <div class="pull-right beta-components space-left ov">
                <div class="space10">&nbsp;</div>
                <div class="beta-comp">
                    <form role="search" method="get" id="searchform" action="/">
                        <input type="text" value="" name="s" id="s"
                            placeholder="Nhập từ khóa..." />
                        <button class="fa fa-search" type="submit" id="searchsubmit"></button>
                    </form>
                </div>

                <div class="beta-comp">
                    <div class="cart">
                        <div class="beta-select">
                            <i class="fa fa-shopping-cart"></i>
                            Giỏ hàng ({{ Session::has('cart') ? Session('cart')->totalQty : '0' }}) <i
                                class="fa fa-chevron-down"></i>
                        </div>
                        <div class="beta-dropdown cart-body">


                            @if (Session::has('cart'))
                                @foreach ($product_cart as $item)
                                    <div class="cart-item">
                                        <a class="cart-item-delete" href={{route('delete-cart-item',$item['item']['id'])}}>xoa</a>
                                        <div class="media">
                                            <a class="pull-left" href="#"><img
                                                    src="source/image/product/{{ $item['item']['image'] }} "
                                                    alt=""></a>
                                            <div class="media-body">
                                                <span class="cart-item-title">{{ $item['item']['name'] }}</span>
                                                <span class="cart-item-options">Size: XS; Colar: Navy</span>
                                                <span
                                                    class="cart-item-amount">{{ $item['qty'] }}*<span>{{ $item['item']['promotion_price'] === 0 ? $item['item']['unit_price'] : $item['item']['promotion_price'] }}</span></span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif

                            <div class="cart-caption">
                                <div class="cart-total text-right">Tổng tiền:<span
                                        class="cart-total-value">${{ Session::has('cart') ? Session('cart')->totalPrice : '0' }}
                                    </span></div>
                                <div class="clearfix"></div>
                                <div class="center">
                                    <div class="space10">&nbsp;</div>
                                    <a href="{{route('check-out')}}" class="beta-btn primary text-center">Đặt hàng <i
                                            class="fa fa-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div> <!-- .cart -->
                </div>
            </div>
            <div class="clearfix"></div>
        </div> <!-- .container -->
    </div> <!-- .header-body -->
    <div class="header-bottom" style="background-color: #0277b8;">
        <div class="container">
            <a class="visible-xs beta-menu-toggle pull-right" href="#"><span
                    class='beta-menu-toggle-text'>Menu</span> <i class="fa fa-bars"></i></a>
            <div class="visible-xs clearfix"></div>
            <nav class="main-menu">
                <ul class="l-inline ov">
                    <li><a href="/">Trang chủ</a></li>
                    <li><a href="{{ route('cake-type') }}">Loai Sản phẩm</a>
                        <ul class="sub-menu">
                            @foreach ($product_type as $type)
                                <li><a href="/type/{{ $type->name }}">{{ $type->name }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li><a href="about.html">Giới thiệu</a></li>
                    <li><a href="contacts.html">Liên hệ</a></li>
                </ul>
                <div class="clearfix"></div>
            </nav>
        </div> <!-- .container -->
    </div> <!-- .header-bottom -->
</div> <!-- #header -->
