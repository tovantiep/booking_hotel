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
                    <th scope="col">{{__('generate.image')}}</th>
                    <th scope="col">{{__('generate.room')}}</th>
                    <th scope="col">{{__('generate.category_room')}}</th>
                    <th scope="col">{{__('generate.quantity')}} </th>
                    <th scope="col">{{__('generate.price')}}</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            @if (Session::has('Cart') != null)
                <tbody>
                    @foreach (Session::get('Cart')->phong as $item)
                        <tr>
                            <td> <img src="{{ url('/upload/phong/' . $item['phongInfo']->hinhanh) }}" width="150px"
                                    height="100px" alt="Hình ảnh phòng"></td>
                            <td> {{ $item['phongInfo']->tenphong }}</td>
                            <td> {{ $item['phongInfo']->loaiphong->tenloaiphong }}</td>
                            <td>
                                <select name="soluong" id="select-{{$item['phongInfo']->id}}"
                                    data-idselect="{{ $item['phongInfo']->id }}" onchange="updateItemCart({{ $item['phongInfo']->id }})">
                                    @for ($i = 1; $i <= $item['phongInfo']->soluong; $i++)
                                        <option value="{{ $i }}" @if ($i == $item['soluong'])
                                            selected
                                    @endif
                                    >{{ $i }} {{__('generate.room')}}</option>
                    @endfor
                    </select>
                    </td>

                    <td>{{ number_format($item['phongInfo']->gia) }}</td>
                    <td class="delete"><i class="fa fa-remove"
                            onclick="deleteItemCart({{ $item['phongInfo']->id }})"
                            style="font-size: 30px; cursor: pointer; color: #FF5722;"></i></td>
                    </tr>
            @endforeach
            </tbody>
        @else
            <tbody>
                <tr>
                    <th colspan="7">
                        {{__('generate.not_booking')}}
                    </th>
                </tr>
            </tbody>
            @endif
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
                <a href="{{route('payment')}}" class="btn btn-primary btn-lg btn-block">{{__('generate.check-out')}}</a>
            </li>
        </ul>
    </div>

</div>
