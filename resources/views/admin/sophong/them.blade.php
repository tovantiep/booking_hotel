@extends('admin.layouts.index')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Thêm Số Phòng</h1>
        </div>
    </div>
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

    <div class="panel panel-default">
        <div class="panel-heading">
            Thêm phòng
        </div>
        <div class="panel-body">
            <form action="{{ route('admin.sophong.postThem', ['id' => $phong->id]) }}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                
                @for ($i = 1; $i<=$phong->soluong - $sophong; $i++)
                <div class="form-group">
                    <input type="hidden" name="user_id" value="1">
                    <label for="exampleFormControlInput1">Phòng {{ $i }}</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Nhập số phòng"
                        name="sophong_{{ $i }}" value="">
                </div>
                @endfor  
                

                <button type="submit" class="btn btn-primary mb-2">Thêm</button>
                <button type="reset" class="btn btn-default">Nhập lại</button>
            </form>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#blah').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#inputGroupFile01").change(function() {
            readURL(this);
        });

    </script>
@endsection
