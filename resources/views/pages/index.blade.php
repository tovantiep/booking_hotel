@extends('layouts.index')
@section('content')

    <aside id="fh5co-hero" class="js-fullheight">
        <div class="flexslider js-fullheight">
            <ul class="slides">
                @foreach ($slide as $item)
                    <li style="background-image: url({{ url('upload/slide/'.$item->hinh) }});">
                        <div class="overlay-gradient"></div>
                        <div class="container">
                            <div class="col-md-12 col-md-offset-0 text-center slider-text">
                                <div class="slider-text-inner js-fullheight">
                                    <div class="desc">
                                        <p><span>{{ $item->tieude }}</span></p>
                                        <h2>{{ $item->noidung }}</h2>
                                        <p>
                                            <a href="{{ route('booking') }}"
                                               class="btn btn-primary btn-lg">{{__('generate.booking-now')}}</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach

            </ul>
        </div>
    </aside>
    <div class="wrap">
        <div class="container">
            <div class="row">
                <div id="availability" style="z-index: 10">
                    <form action="{{route('cart.addIndextoCart')}}" method="GET" id="form1" autocomplete="off">
                        <div class="a-col">
                            <section>
                                <select class="form-control" id="select-loai-phong" name="loaiphong"
                                        style="color: #db4118; font-weight: 16px; font-weight: 700;"
                                        onchange="changeLoaiPhong(this.value)">
                                    <option value="" disabled selected>{{__('generate.select-cate')}}</option>
                                    @foreach ($loaiphong as $lp)
                                        <option value="{{ $lp->id }}">{{ $lp->tenloaiphong }}</option>
                                    @endforeach
                                </select>
                            </section>
                        </div>
                        <div class="a-col">
                            <section>
                                <select class="form-control" id="select-phong" name="phong"
                                        style="color: #db4118; font-weight: 16px; font-weight: 700;">
                                    <option value="" disabled selected>{{__('generate.select-room')}}</option>
                                </select>
                            </section>
                        </div>
                        <div class="a-col alternate">
                            <div class="input-field">
                                <label for="date-start">{{__('generate.check-in')}}: </label>
                                <input type="text" name="startdate" class="form-control" id="date-start"/>
                            </div>
                        </div>
                        <div class="a-col alternate">
                            <div class="input-field">
                                <label for="date-end">{{__('generate.check-out')}}: </label>
                                <input type="text" name="enddate" class="form-control" id="date-end"/>
                            </div>
                        </div>
                        <div class="a-col action">
                            <a href="javascript:;" onclick="document.getElementById('form1').submit();">
                                <span>{{__('generate.booking-now')}}</span>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="fh5co-counter-section" class="fh5co-counters">
        <div class="container" style="">
            <div class="row">

                <div class="col-md-3 text-center">
                        <span class="fh5co-counter js-counter" data-from="" data-to=""
                              data-speed="5"
                              data-refresh-interval="50">{{\App\KhachHang::count()}}</span>
                        <span class="fh5co-counter-label">{{__('generate.users')}}</span>
                </div>

                <div class="col-md-3 text-center">
                    <span class="fh5co-counter js-counter" data-from="0" data-to="155" data-speed="5"
                          data-refresh-interval="50">{{\App\Phong::sum('soluong')}}</span>
                    <span class="fh5co-counter-label">{{__('generate.rooms')}}</span>
                </div>
                <div class="col-md-3 text-center">
                    <span class="fh5co-counter js-counter" data-from="0" data-to="820" data-speed="5"
                          data-refresh-interval="50">{{\App\HoaDon::count()}}</span>
                    <span class="fh5co-counter-label">{{__('generate.transaction')}}</span>
                </div>
                <div class="col-md-3 text-center">
                    <span class="fh5co-counter js-counter" data-from="0" data-to="876" data-speed="5"
                          data-refresh-interval="50">3</span>
                    <span class="fh5co-counter-label">{{__('generate.comment')}}</span>
                </div>
            </div>
        </div>
    </div>

    <div id="featured-hotel" class="fh5co-bg-color">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title text-center">
                        <h2>{{__('generate.list_room')}}</h2>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach ($phong1 as $p1)
                    <div class="feature-full-1col">
                        <div class="image" style="background-image: url({{ url('upload/phong/' . $p1->hinhanh) }});">
                            <div class="descrip text-center">
                                <p><small>{{__('generate.price')}} </small><span>{{ number_format($p1->gia) }} VNĐ</span></p>
                            </div>
                        </div>
                        <div class="desc">
                            <h3>{{ $p1->tenphong }}</h3>
                            <h4><i>{{ $p1->loaiphong->tenloaiphong }}</i></h4>
                            <p>{{ $p1->chuthich }}</p>
                            <p><a href="{{ route('cart.addCart', ['id' => $p1->id]) }}"
                                  class="btn btn-primary btn-luxe-primary">{{__('generate.booking-now')}} <i class="ti-angle-right"></i></a>
                            </p>
                        </div>
                    </div>
                @endforeach

                <div class="feature-full-2col">
                    @foreach ($phong2 as $p2)
                        <div class="f-hotel">
                            <div class="image"
                                 style="background-image: url({{ url('upload/phong/' . $p2->hinhanh) }});">
                                <div class="descrip text-center">
                                    <p><small>{{__('generate.price')}}</small><span>{{ number_format($p2->gia) }} VNĐ</span></p>
                                </div>
                            </div>
                            <div class="desc">
                                <h3>{{ $p2->tenphong }}</h3>
                                <h4><i>{{ $p2->loaiphong->tenloaiphong }}</i></h4>
                                <p>{{ $p2->chuthich }}</p>
                                <p><a href="{{ route('cart.addCart', ['id' => $p2->id]) }}"
                                      class="btn btn-primary btn-luxe-primary">{{__('generate.booking-now')}} <i
                                            class="ti-angle-right"></i></a>
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="feature-full-2col">
                    @foreach ($phong3 as $p3)
                        <div class="f-hotel">
                            <div class="image"
                                 style="background-image: url({{ url('upload/phong/' . $p3->hinhanh) }});">
                                <div class="descrip text-center">
                                    <p><small>{{__('generate.price')}}</small><span>{{ number_format($p3->gia) }} VNĐ</span></p>
                                </div>
                            </div>
                            <div class="desc">
                                <h3>{{ $p3->tenphong }}</h3>
                                <h4><i>{{ $p3->loaiphong->tenloaiphong }}</i></h4>
                                <p>{{ $p3->chuthich }}</p>
                                <p><a href="{{ route('cart.addCart', ['id' => $p3->id]) }}"
                                      class="btn btn-primary btn-luxe-primary">{{__('generate.booking-now')}} <i
                                            class="ti-angle-right"></i></a>
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="feature-full-2col">
                    @foreach ($phong3 as $p3)
                        <div class="f-hotel">
                            <div class="image"
                                 style="background-image: url({{ url('upload/phong/' . $p3->hinhanh) }});">
                                <div class="descrip text-center">
                                    <p><small>{{__('generate.price')}}</small><span>{{ number_format($p3->gia) }} VNĐ </span></p>
                                </div>
                            </div>
                            <div class="desc">
                                <h3>{{ $p3->tenphong }}</h3>
                                <h4><i>{{ $p3->loaiphong->tenloaiphong }}</i></h4>
                                <p>{{ $p3->chuthich }}</p>
                                <p><a href="{{ route('cart.addCart', ['id' => $p3->id]) }}"
                                      class="btn btn-primary btn-luxe-primary">{{__('generate.booking-now')}} <i
                                            class="ti-angle-right"></i></a>
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="section text-center">
                            <a href="{{route('booking')}}" class="btn btn-primary btn-lg">{{__('generate.see_more')}}...</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div id="hotel-facilities">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title text-center">
                        <h2>{{__('generate.service_hotel')}}</h2>
                    </div>
                </div>
            </div>

            <div id="tabs">
                <nav class="tabs-nav">
                    <a href="#" class="active" data-tab="tab1">
                        <i class="flaticon-restaurant icon"></i>
                        <span>{{__('generate.restaurant')}}</span>
                    </a>
                    <a href="#" data-tab="tab2">
                        <i class="flaticon-cup icon"></i>
                        <span>Bar</span>
                    </a>
                    <a href="#" data-tab="tab3">
                        <i class="flaticon-car icon"></i>
                        <span>{{__('generate.shuttle')}}</span>
                    </a>
                    <a href="#" data-tab="tab4">
                        <i class="flaticon-swimming icon"></i>
                        <span>{{__('generate.pool')}}</span>
                    </a>
                    <a href="#" data-tab="tab5">
                        <i class="flaticon-massage icon"></i>
                        <span>SPA</span>
                    </a>
                    <a href="#" data-tab="tab6">
                        <i class="flaticon-bicycle icon"></i>
                        <span>GYM</span>
                    </a>
                </nav>
                <div class="tab-content-container">
                    <div class="tab-content active show" data-tab-content="tab1">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <img src="{{ url('upload/page/restaurant.jpg') }}" class="img-responsive img2"
                                         alt="Image">
                                </div>
                                <div class="col-md-6">
                                    <h3 class="heading">{{__('generate.restaurant')}}</h3>
                                    <p>{{__('generate.text_restaurant')}}</p>
                                    <p class="service-hour">
                                        <span>{{__('generate.open')}}</span>
                                        <strong>7:30 AM - 8:00 PM</strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content" data-tab-content="tab2">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <img src="{{ url('upload/page/bar.jpg') }}" class="img-responsive img2" alt="Image">
                                </div>
                                <div class="col-md-6">
                                    <h3 class="heading">BARS</h3>
                                    <p>{{__('generate.text_bar')}}</p>
                                    <p class="service-hour">
                                        <span>{{__('generate.open')}}</span>
                                        <strong>7:30 AM - 8:00 PM</strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content" data-tab-content="tab3">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <img src="{{ url('upload/page/pickup.jpg') }}" class="img-responsive img2"
                                         alt="Image">
                                </div>
                                <div class="col-md-6">
                                    <h3 class="heading">{{__('generate.shuttle')}}</h3>
                                    <p>{{__('generate.text_shuttle')}}
                                    </p>
                                    <p class="service-hour">
                                        <span>{{__('generate.open')}}</span>
                                        <strong>7:30 AM - 8:00 PM</strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content" data-tab-content="tab4">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <img src="{{ url('upload/page/swimming.jpg') }}" class="img-responsive img2"
                                         alt="Image">
                                </div>
                                <div class="col-md-6">
                                    <h3 class="heading">{{__('generate.pool')}}</h3>
                                    <p>{{__('generate.text_pool')}}</p>
                                    <p class="service-hour">
                                        <span>{{__('generate.open')}}</span>
                                        <strong>7:30 AM - 8:00 PM</strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content" data-tab-content="tab5">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <img src="{{ url('upload/page/spa.jpg') }}" class="img-responsive img2" alt="Image">
                                </div>
                                <div class="col-md-6">
                                    <h3 class="heading">Spa</h3>
                                    <p>{{__('generate.text_spa')}}
                                    </p>
                                    <p class="service-hour">
                                        <span>{{__('generate.open')}}</span>
                                        <strong>7:30 AM - 8:00 PM</strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content" data-tab-content="tab6">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <img src="{{ url('upload/page/gym.jpg') }}" class="img-responsive img2" alt="Image">
                                </div>
                                <div class="col-md-6">
                                    <h3 class="heading">Gym</h3>
                                    <p>{{__('generate.text_gym')}}</p>
                                    <p class="service-hour">
                                        <span>{{__('generate.open')}}</span>
                                        <strong>7:30 AM - 8:00 PM</strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="testimonial">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title text-center">
                        <h2>{{__('generate.comment')}}...</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="testimony">
                        <blockquote>
                            {{__('generate.long')}}
                        </blockquote>
                        <p class="author"><cite> Long </cite></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimony">
                        <blockquote>
                            {{__('generate.mai_anh')}}
                        </blockquote>
                        <p class="author"><cite>Mai Anh</cite></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimony">
                        <blockquote>
                            {{__('generate.lam')}}
                        </blockquote>
                        <p class="author"><cite>Lâm</cite></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script language="javascript">

        function addIndextoCart() {
            $.ajax({
                url: 'booking-phong-id=' + $('#select-phong').val() + '&date-start=' + $('#date-start').val() + '&date-end=' + $('#date-end').val(),
                type: 'GET',
            }).done(function (response) {

            })
        }

        function getValue() {
            var i = $('#date-start').val();
            alert(i)
        }

        function changeLoaiPhong(id) {
            $.ajax({
                url: 'ajax/loaiphong/' + id,
                type: 'GET',
            }).done(function (response) {
                $("#select-phong").empty();
                $("#select-phong").html(response);
            })
        }

    </script>
@endsection
