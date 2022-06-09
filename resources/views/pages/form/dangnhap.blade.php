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
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    {{ session('thongbao') }}
                </div>
            @endif
            <div class="col-md-12">
                <h2>{{__('generate.login')}}</h2>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <form action="{{ route('khachhang.postDangNhap') }}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="email">Email: </label>
                                <input type="email" id="email" name="email" class="form-control" placeholder="Email">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="password">{{__('generate.password')}}: </label>
                                <input type="password" id="password" name="password" class="form-control" placeholder="{{__('generate.input_password')}}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="submit" value="{{__('generate.login')}}" class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-12">
                <p>{{__('generate.do_you_have')}}? <a href="{{ route('khachhang.getDangKy') }}">{{__('generate.register')}}!</a></p>
            </div>
		</div>
	</div>
@endsection

@section('script')


@endsection
