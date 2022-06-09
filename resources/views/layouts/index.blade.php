<!DOCTYPE html>
<html class="no-js">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>UTT Hotel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="hotel, UTT"/>

    <!-- Facebook and Twitter integration -->
    <meta property="og:title" content=""/>
    <meta property="og:image" content=""/>
    <meta property="og:url" content=""/>
    <meta property="og:site_name" content=""/>
    <meta property="og:description" content=""/>
    <meta name="twitter:title" content=""/>
    <meta name="twitter:image" content=""/>
    <meta name="twitter:url" content=""/>
    <meta name="twitter:card" content=""/>
    <link rel="shortcut icon" href="favicon.ico">
    <!-- <link href='https://fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700italic,900,700,900italic' rel='stylesheet' type='text/css'> -->
    <link rel="stylesheet" href="{{ asset('font-end/page/css/superfish.css') }}">
    <link rel="stylesheet" href="{{ asset('font-end/page/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('font-end/page/css/cs-select.css') }}">
    <link rel="stylesheet" href="{{ asset('font-end/page/css/cs-skin-border.css') }}">
    <link rel="stylesheet" href="{{ asset('font-end/page/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('font-end/page/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('font-end/page/css/icomoon.css') }}">
    <link rel="stylesheet" href="{{ asset('font-end/page/css/flexslider.css') }}">
    <link rel="stylesheet" href="{{ asset('font-end/page/css/style.css') }}">


    <link href="{{ asset('font-end/admin/css/metisMenu.min.css') }}" rel="stylesheet">
    <link href="{{ asset('font-end/admin/css/startmin.css') }}" rel="stylesheet">
    <link href="{{ asset('font-end/admin/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <style>
        .img2 {
            width: 550px;
            height: 450px;
            background-color: #3e3e3e;
            background-image: none;
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
        }

        .sf-menu ul li {
            color: #FF5722;
        }

        .sf-menu .kh a:hover {
            color: #3e3e3e !important;
        }

        .search-form {
            position: fixed;
            display: none;
            width: 100%;
            height: 100vh;
            text-align: center;
            padding-top: 100px;
            background-color: rgba(62, 62, 62, 0.8);
            z-index: 100;
        }

        .search-form .close-form {
            position: absolute;
            right: 0;
            top: 0;
            margin-right: 50px;
        }

    </style>

    @yield('css')

</head>

<body>

<div id="fh5co-wrapper">
    <div id="fh5co-page">
        <div id="fh5co-header">
            <header id="fh5co-header-section">
                <div class="container">
                    <div class="nav-header">
                        <a href="{!! route('user.change-language', ['en']) !!}"><img style="width: 20px;height: 20px" src="{{ asset('upload/page/anh.png') }}"  alt=""></a>
                       || <a href="{!! route('user.change-language', ['vi']) !!}"><img style="width: 20px;height: 20px" src="{{ asset('upload/page/vietnam.jpg') }}"  alt=""></a>
                        <a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle"><i></i></a>
                        <h1 id="fh5co-logo"><a href="{{ route('website') }}">UTT Hotel</a></h1>
                        <nav id="fh5co-menu-wrap" role="navigation">
                            <ul class="sf-menu" id="fh5co-primary-menu">
                                <li><a href="{{ route('website') }}">{{__("generate.home")}}</a></li>
                                <li>
                                    <a href="{{ route('booking') }}"
                                       class="fh5co-sub-ddown">{{__('generate.booking')}}</a>
                                </li>
                                <li><a href="{{ route('lienhe') }}">{{__('generate.contact')}}</a></li>
                                <li><a href="{{ route('gioithieu') }}">{{__('generate.about')}}</a></li>
                                <li><a href="{{ route('mybooking') }}"><i
                                            class="fa fa-shopping-cart"></i> {{__('generate.my-booking')}}</a></li>
                                @if (Auth::check() && Auth::user()->role_id == 4)
                                    <li class="dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                            <i class="fa fa-user fa-fw"></i> {{ Auth::user()->name }}
                                        </a>
                                        <ul class="dropdown-menu dropdown-user">
                                            <li class="kh"><a href="{{ route('khachhang.getThongTin') }}"
                                                              style="color: #FF5722;" class="kh"><i
                                                        class="fa fa-user fa-fw"></i> {{__('generate.info')}}</a>
                                            </li>
                                            <li class="divider"></li>
                                            <li class="kh"><a href="{{ route('khachhang.getDangXuat') }}"
                                                              style="color: #FF5722" class="kh"><i
                                                        class="fa fa-sign-out fa-fw"></i> {{__('generate.logout')}}</a>
                                            </li>
                                        </ul>
                                    </li>
                                @else
                                    <li><a href="{{ route('khachhang.getDangNhap') }}"><i
                                                class="fa fa-home"></i>{{__('generate.login')}}</a></li>
                                @endif
                                <li><a href="#" id="search"><i class="fa fa-search"></i></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </header>
            <div class="search-form">
                <form action="{{ route('search') }}" id="form-search" method="GET">
                    <div class="container">
                        <div class="col-md-10">
                            <input type="text" placeholder="Nhập nội dung tìm kiếm..." id="search" name="search"
                                   class="form-control">
                        </div>
                        <div class="col-md-2">
                            <input type="submit" id="submit" value="Tìm kiếm" class="form-control">
                        </div>
                    </div>
                </form>
                <div class="close-form">
                    <a href="#" style="font-size: 50px" id="close"><i class="fa fa-close"></i></a>
                </div>
            </div>
        </div>
        <!-- end:fh5co-header -->
        @yield('content')
        <footer id="footer" class="fh5co-bg-color">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="copyright">
                            <p><small>&copy; 2022 UTT hotel. <br>
                                </small></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <h2>{{__('generate.shortcut')}}</h2>
                                <ul class="link">
                                    <li><a href="{{ route('website') }}">{{__('generate.dashboard')}}</a></li>
                                    <li><a href="{{ route('booking') }}">{{__('generate.booking')}}</a></li>
                                    <li><a href="{{ route('lienhe') }}">{{__('generate.contact')}}</a></li>
                                    <li><a href="{{ route('gioithieu') }}">{{__('generate.about')}}</a></li>
                                    <li><a href="{{ route('khachhang.getDangNhap') }}">{{__('generate.login')}}</a></li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h2>{{__('generate.receive_information')}}</h2>
                                <p>{{__('generate.last_footer')}}</p>
                                <form action="#" id="form-subscribe">
                                    <div class="form-field">
                                        <input type="email" placeholder="{{__('generate.input_mail')}}" id="email">
                                        <input type="submit" id="submit" value="{{__('generate.submit')}}">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <ul class="social-icons">
                            <li>
                                <a href="http://twitter.com"><i class="icon-twitter-with-circle"></i></a>
                                <a href="http://facebook.com"><i class="icon-facebook-with-circle"></i></a>
                                <a href="http://instagram.com"><i class="icon-instagram-with-circle"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <!-- END fh5co-page -->

</div>
<!-- END fh5co-wrapper -->
@yield('script')

<!-- Javascripts -->


<script src="{{ asset('font-end/page/js/jquery-2.1.4.min.js') }}"></script>

<!-- Dropdown Menu -->
<script src="{{ asset('font-end/page/js/hoverIntent.js') }}"></script>
<script src="{{ asset('font-end/page/js/superfish.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('font-end/page/js/bootstrap.min.js') }}"></script>
<!-- Waypoints -->
<script src="{{ asset('font-end/page/js/jquery.waypoints.min.js') }}"></script>
<!-- Counters -->
<script src="{{ asset('font-end/page/js/jquery.countTo.js') }}"></script>
<!-- Stellar Parallax -->
<script src="{{ asset('font-end/page/js/jquery.stellar.min.js') }}"></script>
<!-- Owl Slider -->
<!-- // <script src="js/owl.carousel.min.js"></script> -->
<!-- Date Picker -->
<script src="{{ asset('font-end/page/js/bootstrap-datepicker.min.js') }}"></script>
<!-- CS Select -->
<script src="{{ asset('font-end/page/js/classie.js') }}"></script>
<script src="{{ asset('font-end/page/js/selectFx.js') }}"></script>
<!-- Flexslider -->
<script src="{{ asset('font-end/page/js/jquery.flexslider-min.js') }}"></script>

<script src="{{ asset('font-end/page/js/custom.js') }}"></script>

<script type="text/javascript">
    function ConfirmChange() {
        var x = confirm("Bạn có chắc muốn thay đổi?");
        if (x) return true;
        else return false;
    }
</script>
<script type="text/javascript">
    $(".alert").fadeTo(3000, 800).slideUp(800, function () {
        $(".alert").slideUp(800);
    });
</script>

<script>
    $("#search").click(function () {
        $(".search-form").css('display', 'block')
    })
    $("#close").click(function () {
        $(".search-form").css('display', 'none')
    })
</script>

</body>

</html>
