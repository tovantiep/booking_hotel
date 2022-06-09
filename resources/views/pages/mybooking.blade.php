@extends('layouts.index')
@section('css')
    <style>
        .container2 {
            display: flex;
            justify-content: space-between;
            align-items: center
            width: 100%;
        }

        .total {
            margin-left: 20px;
            width: 400px;
        }

        #content-booking,
        .list-view {
            margin-left: 5rem;
            margin-right: 5rem;
        }

        .header-fixed tbody,
        .header-fixed thead {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
        }

        .header-fixed tr {
            -ms-flex-preferred-size: 100%;
            flex-basis: 100%;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
        }

        .header-fixed th,
        .header-fixed td {
            -webkit-box-flex: 1;
            -ms-flex: 1;
            flex: 1;
            text-align: center;
        }

        .header-fixed tbody {
            height: 400px;
            overflow-y: auto;
        }

        .header-fixed thead {
            padding-right: 15px;
        }

    </style>
@endsection
@section('content')
    <!-- end:fh5co-header -->
    <div class="fh5co-parallax" style="background-image: url({{ url('upload/slide/444.jpg') }});"
         data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div
                    class="col-md-12 col-md-offset-0 col-sm-12 col-sm-offset-0 col-xs-12 col-xs-offset-0 text-center fh5co-table">
                    <div class="fh5co-intro fh5co-table-cell">
                        <h1 class="text-center">{{__('generate.your_list_room')}}</h1>
                        <p>{{__('generate.thank_you_for')}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form action="{{route('payment')}}" id="form2" method="GET">
        <div class="wrap">
            <div class="container">
                <div class="row">
                    <div id="availability">
                        <form action="#" autocomplete="off">
                            <div class="a-col alternate" style="margin: auto;">
                                <i class="fa fa-calendar" style="font-size: 20px; color: white;"></i>
                                <span style="color: white">{{__('generate.choose')}}: </span>
                            </div>
                            <div class="a-col alternate">
                                <div class="input-field">
                                    <label for="date-start">{{__('generate.check-in')}}: </label>
                                    <input type="text" name="startdate" class="form-control" id="date-start"
                                           value="@if (Session::has('std') != null){!! Session::get('std') !!}@endif"
                                           onchange="updateDate()"/>
                                </div>
                            </div>
                            <div class="a-col alternate">
                                <div class="input-field">
                                    <label for="date-end">{{__('generate.check-out')}}: </label>
                                    <input type="text" name="enddate" class="form-control" id="date-end"
                                           value="@if (Session::has('end') != null){{ Session::get('end') }}@endif"
                                           onchange="updateDate()"/>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div id="content-booking">
            <div class="row">
                <div class="col-md-12">
                    <div class="section text-center">
                        <h4>{{__('generate.list_room_booked')}}</h4>
                    </div>
                </div>
            </div>
            <div class="container2">
                <div class="table">
                    <table class="table header-fixed">
                        <thead>
                        <tr>
                            <th scope="col" class="col-3">{{__('generate.image')}}</th>
                            <th scope="col" class="col-3">{{__('generate.room')}}</th>
                            <th scope="col" class="col-3">{{__('generate.category_room')}}</th>
                            <th scope="col" class="col-3">{{__('generate.quantity')}}</th>
                            <th scope="col" class="col-3">{{__('generate.price')}}</th>
                            <th scope="col" class="col-3"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if (Session::has('Cart') != null)

                            @foreach (Session::get('Cart')->phong as $item)
                                <tr>
                                    <td class="col-3"><img
                                            src="{{ url('/upload/phong/' . $item['phongInfo']->hinhanh) }}"
                                            width="150px" height="100px" alt="Hình ảnh phòng"></td>
                                    <td class="col-3"> {{ $item['phongInfo']->tenphong }}</td>
                                    <td class="col-3"> {{ $item['phongInfo']->loaiphong->tenloaiphong }}</td>
                                    <td class="col-3">
                                        <select name="soluong" id="select-{{ $item['phongInfo']->id }}"
                                                data-idselect="{{ $item['phongInfo']->id }}"
                                                onchange="updateItemCart({{ $item['phongInfo']->id }})">
                                            @for ($i = 1; $i <= $item['phongInfo']->soluong; $i++)
                                                <option value="{{ $i }}" @if ($i == $item['soluong'])
                                                selected
                                                    @endif
                                                >{{ $i }} {{__('generate.room')}}</option>
                                            @endfor
                                        </select>
                                    </td>
                                    <td class="col-3">{{ number_format($item['phongInfo']->gia) }}</td>
                                    <td class="col-3"><i class="fa fa-remove"
                                                         onclick="deleteItemCart({{ $item['phongInfo']->id }})"
                                                         style="font-size: 30px; cursor: pointer; color: #FF5722;"></i>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <th colspan="7">
                                    {{__('generate.not_booking')}}! <a
                                        href="{{ route('booking') }}">{{__('generate.booking')}}</a>
                                </th>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="total" id="list-cart">
                    <ul class="list-group">
                        <li class="list-group-item active">{{__('generate.bill')}}</li>
                        <li class="list-group-item">{{__('generate.quantity')}}:
                            @if (isset(Session::get('Cart')->tongSoluong))
                                {{ number_format(Session::get('Cart')->tongSoluong) }} {{__('generate.room')}}
                            @else
                                0 {{__('generate.room')}}
                            @endif
                        </li>
                        <li class="list-group-item">{{__('generate.number_day')}}:
                            @if (isset(Session::get('Cart')->songay))
                                {{ Session::get('Cart')->songay }} {{__('generate.day')}}
                            @else
                                0 {{__('generate.day')}}
                            @endif
                        </li>
                        <li class="list-group-item">{{__('generate.price')}}:
                            @if (isset(Session::get('Cart')->tongGia))
                                {{ number_format(Session::get('Cart')->tongGia) }} VNĐ
                            @else
                                0 VNĐ
                            @endif
                        </li>
                        <li>
                            <a href="javascript:;" onclick="document.getElementById('form2').submit();"
                               class="btn btn-primary btn-lg btn-block">CHECK OUT</a>
                             <button type="button"
                                class="btn btn-primary btn-lg btn-block">CHECK OUT</button>
                        </li>
                    </ul>
                </div>
            </div>
    </form>

    </div>
    <div class="container" style="margin-bottom: 5rem;">
        <div class="row">
            <div class="col-md-12">
                <div class="section text-center">
                    <a href="{{ route('booking') }}" class="btn btn-primary btn-lg">{{__('generate.see_list_room')}}</a>
                </div>
            </div>
        </div>
    </div>




@endsection

@section('script')

    <script>
        function deleteItemCart(id) {
            $.ajax({
                url: 'cart/delete-cart/' + id,
                type: 'GET',
            }).done(function (response) {
                $("#content-booking").empty();
                $("#content-booking").html(response);
            })
        }

        function updateItemCart(id) {
            var value = $("#select-" + id).val();
            $.ajax({
                url: 'cart/update-cart/' + id + '/' + value,
                type: 'GET',
            }).done(function (response) {
                $("#content-booking").empty();
                $("#content-booking").html(response);
            })
        }

        function formatDate(date) {
            var today = new Date(date);
            var dd = today.getDate();

            var mm = today.getMonth() + 1;
            var yyyy = today.getFullYear();
            if (dd < 10) {
                dd = '0' + dd;
            }

            if (mm < 10) {
                mm = '0' + mm;
            }
            today = mm + '-' + dd + '-' + yyyy;
            return today
        }

        function updateDate() {
            std = $('#date-start').val()
            end = $('#date-end').val()

            var startdate = new Date(std)
            var enddate = new Date(end)

            var std2 = formatDate(std)
            var end2 = formatDate(end)

            var date = (enddate.getTime() / 86400000) - (startdate.getTime() / 86400000) //1440516958

            if (date < 0 || end == '') {
                alert("Hãy chọn lại ngày checkout")
                $('#date-end').val(std)
                end = $('#date-end').val()
                return
            } else if (date == 0) {
                date = 1
            }
            $.ajax({
                url: 'cart/update-cart-date/' + date + '/' + std2 + '/' + end2,
                type: 'GET',
            }).done(function (response) {
                $("#content-booking").empty();
                $("#content-booking").html(response);
            })

        }

        function changeLoaiPhong(id) {
            $.ajax({
                url: 'ajax/booking/loaiphong/' + id,
                type: 'GET',
            }).done(function (response) {
                $("#list-phong").empty();
                $("#list-phong").html(response);
            })
        }

        function addCartBooking(id) {
            $.ajax({
                url: 'cart/add-cart-booking/' + id,
                type: 'GET',
            }).done(function (respone) {
                $("#content-booking").empty();
                $("#content-booking").html(response);
            })
        }

    </script>

@endsection
