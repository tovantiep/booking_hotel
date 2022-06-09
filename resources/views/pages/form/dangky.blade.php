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

    <div id="fh5co-services-section">
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
                    {{ session('thongbao') }} <a href="{{ route('khachhang.getDangNhap') }}">{{__('generate.login')}}</a>
                </div>
            @endif

            <div class="col-md-12">
                <h2>{{__('generate.register')}}</h2>
            </div>

            <div class="col-md-12">
                <div class="row">
                    <form action="{{ route('khachhang.postDangKy') }}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">{{__('generate.username')}}: </label>
                                <input type="text" id="name" name="name" class="form-control" placeholder="{{__('generate.input_name')}}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="email">{{__('generate.email')}}: </label>
                                <input type="email" id="email" name="email" class="form-control" placeholder="{{__('generate.input_mail')}}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="password">{{__('generate.password')}}: </label>
                                <input type="password" id="password" name="password" class="form-control" placeholder="{{__('generate.input_passowrd')}}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="confirmPassword">{{__('generate.confirm_password')}}: </label>
                                <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" placeholder="{{__('generate.input_confirm_password')}}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="sdt">{{__('generate.number_phone')}}: </label>
                                <input type="text" id="sdt" name="sdt" class="form-control" placeholder="{{__('generate.input_number_phone')}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="gioitinh">{{__('generate.sex')}}: </label>
                                <select name="gioitinh" id="" class="form-control">
                                    <option value="1" selected>{{__('generate.male')}}</option>
                                    <option value="0">{{__('generate.female')}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ngaysinh">{{__('generate.birth_day')}}: </label>
                                <input type="date" id="ngaysinh" name="ngaysinh" class="form-control" placeholder="{{__('generate.input_birth_day')}}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="so_cmnd">{{__('generate.id_card')}}: </label>
                                <input type="text" id="so_cmnd" name="so_cmnd" class="form-control" placeholder="{{__('generate.input_id_card')}}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="diachi">{{__('generate.address')}}: </label>
                                <input type="text" id="diachi" name="diachi" class="form-control" placeholder="{{__('generate.input_address')}}">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="submit" value="{{__('generate.register')}}" class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-12">
                <i><p>{{__('generate.you_have_account')}}? <a href="{{ route('khachhang.getDangNhap') }}">{{__('generate.login')}}!</a></p></i>
            </div>
		</div>
	</div>
@endsection

@section('script')
<script type="text/javascript">
    var password = document.getElementById("password"),
        confirm_password = document.getElementById("confirmPassword");

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
