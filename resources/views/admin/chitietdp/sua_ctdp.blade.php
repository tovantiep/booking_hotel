@extends('admin.layouts.index')

@section('content')
<div class="container">
    <br>
    <br>
    @if (count($errors) > 0)
        <div class="alert alert-danger" style="">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            @foreach ($errors->all() as $err)
                {{ $err }}<br>
            @endforeach
        </div>
    @endif

    @if (session('thongbao'))
        <div class="alert alert-success"  style="">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            {{ session('thongbao') }}
        </div>
    @endif
    <div class="col-lg-12" style=" padding: 10px; margin-bottom: 15px">
        <h1 class="page-header" style="">SỬA THÔNG TIN  </h1>
    </div>
    <br>
    <br>
    <br>    
    <form action="{{ route('admin.chitietdp.postSua', ['id' => $chitietdp->id]) }}"
        style="margin-left: 100px; margin-right: 100px; padding-bottom: 200px" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <div class="form-group">
            <label for="exampleFormControlInput1">Tên Khách đặt phòng</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Nguyễn Văn A" name="Ten_kh"
                value="{{ $chitietdp->datphong->user->name }}">
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Số điện thoại</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="0123456789" name="SDT"
                value="{{ $chitietdp->datphong->user->kh->sdt }}">
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Email</label>
            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="email@email.com"
                name="Email" value="{{ $chitietdp->datphong->user->email }}">
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Ngày check in</label>
            <input style="width: 200px" type="date" class="form-control" id="exampleFormControlInput1" placeholder=""
                name="Start_date" value="{{  date("Y-m-d", strtotime($chitietdp->datphong->start_date) ) }}">
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Ngày check out</label>
            <input style="width: 200px" type="date" class="form-control" id="exampleFormControlInput1" placeholder=""
                name="End_date" value="{{ date("Y-m-d", strtotime($chitietdp->datphong->end_date) ) }}"/>
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect1">Loại phòng</label>
            <select style="width: 400px" class="form-control" id="loaiphong" name="LoaiPhong" onchange="changeLoaiPhong(this.value)">
                <option value="" disabled selected>Chọn loại phòng</option>
                @foreach ($loaiphong as $lp)
                    <option value="{{$lp->id}}" @if($lp->id == $chitietdp->phong->loaiphong->id) selected @endif >{{ $lp->tenloaiphong }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="exampleFormControlSelect1">Phòng</label>
            <select style="width: 400px" class="form-control" id="select-phong" name="Phong">
            </select>
        </div>

        
        </section>
        <div class="form-group">
            <label for="exampleFormControlInput1">Số phòng</label>
            <input style="width: 200px" type="number" class="form-control" id="exampleFormControlInput1" placeholder=""
                name="Sophong" value="{{ $chitietdp->sophong }}">
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Chú thích</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" name="Chuthich"
                value="{{ $chitietdp->chuthich }}">
        </div>
        <button type="submit" class="btn btn-primary mb-2">Sửa thông tin</button>
    </form>
</div>
  

@endsection

@section('script')

    <script>
        function changeLoaiPhong(id) {
            $.ajax({
                url: '/ajax/loaiphong/' + id,
                type: 'GET',
            }).done(function(response) {
                console.log(response)
                $("#select-phong").empty();
                $("#select-phong").html(response);
            })
        }

    </script>
@endsection
