@extends('layouts.index')
@section('css')
    <style>
        .list-view {
            margin-top: 5rem;
        }

    </style>
@endsection
@section('content')

    <!-- end:fh5co-header -->
    <div class="fh5co-parallax" style="background-image: url({{ url('upload/slide/111.jpg') }});"
        data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div
                    class="col-md-12 col-md-offset-0 col-sm-12 col-sm-offset-0 col-xs-12 col-xs-offset-0 text-center fh5co-table">
                    <div class="fh5co-intro fh5co-table-cell">
                        <h1 class="text-center">UTT HOTEL</h1>
                        <p>{{__('generate.welcome')}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="fh5co-services-section" style="height: 1150px">
		<div class="container">


            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    @foreach ($errors->all() as $err)
                        {{ $err }}<br>
                    @endforeach
                </div>
            @endif

            @if (session('thongbao'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    {{ session('thongbao') }}
                </div>
            @endif

            @if (session('loi'))
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    {{ session('loi') }}
                </div>
            @endif
            <div class="col-md-12">
                <h2>{{__('generate.username')}}: <a href="">{{ Auth::user()->name }}</a></h2>
                <div style="border: #555555 0.5px solid; margin-bottom: 50px"></div>
            </div>
            <div class="row">
                {{-- <div id="tabs">
                    <nav class="tabs-nav">
                        <a href="#" class="active" data-tab="tab1">
                            <span>Thông tin người dùng</span>
                        </a>
                        <a href="#" data-tab="tab2">
                            <span>Lịch sử đặt phòng</span>
                        </a>
                        <a href="#" data-tab="tab3">
                            <span>Đổi mật khẩu</span>
                        </a>
                    </nav>
                    <div class="tab-content-container">
                        <div class="tab-content active show" data-tab-content="tab1">

                        </div>
                        <div class="tab-content" data-tab-content="tab2">
                        </div>
                        <div class="tab-content" data-tab-content="tab3">

                        </div>
                    </div>
                </div> --}}
                <nav>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                        <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">{{__('generate.information_account')}}</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" id="history-tab" data-toggle="tab" href="#history" role="tab" aria-controls="history" aria-selected="false">{{__('generate.booking_history')}}</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" id="password-tab" data-toggle="tab" href="#password" role="tab" aria-controls="password" aria-selected="false">{{__('generate.change_password')}}</a>
                        </li>
                    </ul>
                </nav>
                <div class="tab-content" id="myTabContent" style="margin-top: 15px">
                    <div class="tab-pane fade active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="container">
                            <div class="col-md-12">
                                <div class="row">
                                    <form action="{{ route('khachhang.postThongTin') }}" method="POST">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="name">{{__('generate.username')}}: </label>
                                                <input type="text" id="name" name="name" class="form-control" placeholder="" value="{{ Auth::user()->name }}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="email">{{__('generate.email')}}: </label>
                                                <input type="email" id="email" name="email" class="form-control" placeholder="" value="{{ Auth::user()->email }}" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="sdt">{{__('generate.number_phone')}}: </label>
                                                <input type="text" id="sdt" name="sdt" class="form-control" placeholder="" @if(isset(Auth::user()->kh->sdt)) value="{{ Auth::user()->kh->sdt }}"  @endif>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="gioitinh">{{__('generate.sex')}}: </label>
                                                <select name="gioitinh" id="" class="form-control">
                                                    @if(Auth::user()->kh->gioi_tinh == 1)
                                                        <option value="1" selected>{{__('generate.male')}}</option>
                                                        <option value="0">{{__('generate.female')}}</option>
                                                    @else
                                                        <option value="1" >{{__('generate.male')}}</option>
                                                        <option value="0" selected>{{__('generate.female')}}</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="ngaysinh">{{__('generate.birth_day')}}: </label>
                                                <input type="date" id="ngaysinh" name="ngaysinh" class="form-control" placeholder="" value="{{Auth::user()->kh->ngaysinh}}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="so_cmnd">{{__('generate.id_card')}}: </label>
                                                <input type="text" id="so_cmnd" name="so_cmnd" class="form-control" placeholder="" value="{{Auth::user()->kh->so_cmnd}}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="diachi">{{__('generate.address')}}: </label>
                                                <input type="text" id="diachi" name="diachi" class="form-control" placeholder="" value="{{Auth::user()->kh->dia_chi}}">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="submit" value="{{__('generate.update')}}" class="btn btn-primary" onclick="ConfirmChange()">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="history" role="tabpanel" aria-labelledby="history-tab">
                        <table class="table table-hover">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{__('generate.id')}}</th>
                                <th scope="col">{{__('generate.room')}}</th>
                                <th scope="col">{{__('generate.day_booking')}}</th>
                                <th scope="col">{{__('generate.quantity')}}</th>
                                <th scope="col">{{__('generate.price')}}</th>
                                <th scope="col">{{__('generate.start_day')}}</th>
                                <th scope="col">{{__('generate.end_day')}}</th>
                                <th scope="col">{{__('generate.status')}}</th>
                              </tr>
                            </thead>
                            <tbody>
                              {{-- <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                              </tr> --}}
                            @if (isset(Auth::user()->datphong))
                                <?php $i = 1; ?>
                                @foreach (Auth::user()->datphong as $values)
                                    @foreach ( $values->chitietdp as $item)
                                    <tr>
                                        <th scope="row">{{ $i++ }}</th>
                                        <td>{{ $values->id }}</td>
                                        <td>{{ $item->phong->tenphong }}</td>
                                        <td>{{ $values->ngaydat }}</td>
                                        <td>{{ $item->sophong }}</td>
                                        <td>{{ $item->gia }}</td>
                                        <td>{{ $values->start_date }}</td>
                                        <td>{{ $values->end_date }}</td>
                                        <td>
                                            @if ($values->trang_thai == 1)
                                               <i> {{__('generate.paid')}}</i>
                                            @else
                                               <i>{{__('generate.unpaid')}}</i>
                                            @endif
                                        </td>
                                      </tr>
                                    @endforeach

                                @endforeach
                            @else
                                <tr colspan="9">{{__('generate.not_booking')}}</tr>
                            @endif
                            </tbody>
                          </table>
                    </div>
                    <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
                        <div class="container">
                            <div class="col-md-12">
                                <div class="row">
                                    <form action="{{ route('khachhang.postDoiMatKhau') }}" method="POST">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="oldPassword">{{__('generate.password')}}: </label>
                                                <input type="password" id="oldPassword" name="oldPassword" class="form-control" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="newPassword">{{__('generate.new_password')}}: </label>
                                                <input type="password" id="newPassword" name="newPassword" class="form-control" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="confirm_newPassword">{{__('generate.confirm_password')}}: </label>
                                                <input type="password" id="confirm_newPassword" name="confirm_newPassword" class="form-control" placeholder="">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="submit" value="{{__('generate.change_password')}}" class="btn btn-primary" onclick="ConfirmChange()">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
		</div>
	</div>
@endsection

@section('script')
<script type="text/javascript">
    var password = document.getElementById("newPassword"),
        confirm_password = document.getElementById("confirm_newPassword");

    function validatePassword() {
        if (password.value != confirm_password.value) {
            confirm_password.setCustomValidity("Xác nhận mật khẩu không đúng!");
        } else {
            confirm_password.setCustomValidity('');
        }
    }

    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;

</script>

@endsection
