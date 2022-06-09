@extends('admin.layouts.index')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Thêm mới hoá đơn</h1>
        </div>
    </div>
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
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{ session('thongbao') }}
        </div>
    @endif
    <div class="panel panel-default">
        <div class="panel-heading">
            Thêm mới hoá đơn
        </div>
        <div class="panel-body">
            <form action="{{ route('admin.hoadon.postThem') }}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
{{--
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Nhập Mã đặt phòng</label>
                    <input type="text" class="form-control" id="madp" placeholder="Mã đặt phòng" name="madp" value=""
                        autocomplete="off" />
                </div> --}}

                <div class="form-group" style="width: 30%">
                    <label for="exampleFormControlSelect1">Mã đặt phòng</label>
                    {{-- <input type="text" class="form-control" id="madp" placeholder="Mã đặt phòng" name="madp" value=""
                        autocomplete="off" /> --}}
                    <select name="madp" id="madp" class="form-control">
                        <option value="" selected disabled>-- Chọn mã đặt phòng --</option>
                        @foreach ($datphong as $item)
                            <option value="{{ $item->id }}">Mã đặt phòng: <span style="color: red">{{ $item->id }}</span></option>
                        @endforeach
                    </select>
                </div>

                {{-- <a class="btn btn-primary btn-xs btn-xacnhan" href="#" type="button" data-url="" id="btnxacnhan">Xác nhận</a> --}}
                <br>
                <br>
                <div class="form-group">
                    <label for="tongsophong">Chi tiết thuê phòng</label>
                    <div class="table-responsive">
                        <table
                            class="table table-striped table-bordered table-hover"
                            id="">
                            <thead>
                                <tr>
                                    <th>Tên phòng</th>
                                    <th>Loại Phòng</th>
                                    <th>Ngày check in</th>
                                    <th>Ngày check out</th>
                                    <th>Giá</th>
                                </tr>
                            </thead>
                            <tbody id="content_table">

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="form-group">
                    <label for="tongsophong">Tồng số phòng đặt</label>
                    <input type="text" class="form-control" id="tongsophong" placeholder="Tổng số phòng" name="tongsophong" value=""
                        autocomplete="off" />
                </div>
                <div class="form-group">
                    <label for="name">Tên khách hàng</label>
                    <input type="text" class="form-control" id="name" placeholder="Họ và tên" name="name" value=""
                        autocomplete="off" />
                </div>

                <div class="form-group">
                    <label for="sdt">Số điện thoại</label>
                    <input type="text" class="form-control" id="sdt" placeholder="Số điện thoại" name="sdt" value=""
                        autocomplete="off" />
                </div>

                <div class="form-group">
                    <label for="sdt">Địa chỉ</label>
                    <input type="text" class="form-control" id="dia_chi" placeholder="Địa chỉ" name="dia_chi" value=""
                        autocomplete="off" />
                </div>

                <div class="form-group">
                    <label for="dia_chi">Tổng số tiền phòng</label>
                    <input type="text" class="form-control" id="tienphong" placeholder="Tổng số tiền phòng" name="tienphong"
                        value="" required autocomplete="off" />
                </div>

                <button type="submit" class="btn btn-primary mb-2">Thêm</button>
                <button type="reset" class="btn btn-default">Nhập lại</button>
            </form>
        </div>
    </div>
    @include('admin.hoadon.modal_dialog')
@endsection

@section('script')

<script>

    $('#madp').change(function() {
        var url = '/admin/hoa-don/xem/' + $('#madp').val();
        $.ajax({
            type: 'get',
            url: url,
            success: function(response) {

                    $('#name').val(response.user.name)
                    $('#sdt').val(response.kh.sdt)
                    $('#dia_chi').val(response.kh.dia_chi)
                    $('#tienphong').val(response.data.tongtien)
                    $('#tongsophong').val(response.data.tongsophong)

                    $('#content_table').html("");
                    $('b#id').text(response.data.id)
                    $('b#name').text(response.user.name)
                    $('i#email').text(response.user.name)
                    $('i#phone_number').text(response.kh.sdt)
                    $('i#address').text(response.kh.dia_chi)
                    $('p#title').text(response.data.title)
                    $('p#content').text(response.data.content)

                    chitiet = response.ctdp
                    ct_id = 0;
                    iii = 0;
                    chitiet.forEach((element, index) => {
                        ct_id = element.id
                        iii = index

                            if (element.sophong == 1) {

                                html = `<tr>

                                            <td>${ element.phong.tenphong}</td>
                                            <td>${ element.phong.loaiphong.tenloaiphong}</td>
                                            <td>${ response.data.start_date}</td>
                                            <td>${ response.data.end_date}</td>
                                            <td>${ element.phong.gia}</td>
                                        </tr>`
                                $('#content_table').append(html);


                            } else {
                                for (i=0; i < element.sophong; i++) {

                                    html = `<tr>
                                            <td>
                                                <a class="btn btn-success btn-xs btn-themsophong" href="#" type="button" data-id="${element.id}" data-index="${iii}" data-url="" id="themsophong_${iii}__${element.id}" data-target="#modal-view"
                                                        data-toggle="modal" onclick="">Thêm số phòng</a>
                                                <span  id="sophong__${iii}__${element.id}"></span>
                                            </td>
                                            <td>${ element.phong.tenphong}</td>
                                            <td>${ element.phong.loaiphong.tenloaiphong}</td>
                                            <td>${ response.data.start_date}</td>
                                            <td>${ response.data.end_date}</td>
                                            <td>${ element.phong.gia}</td>
                                        </tr>`
                                        $('#content_table').append(html);
                                    iii+=1
                                }
                            }


                    })
                    $('i#time').text(response.time)
                    $('.btn-themsophong').click(function() {
                        id= $(this).attr('data-id');
                        index= $(this).attr('data-index');
                        temp = index

                        $.ajax({
                            type: 'get',
                            url: '/admin/hoa-don/lay-so-phong',
                            success: function(response) {
                                response.forEach(item => {
                                    html = ` <option value='${item.id}'>Số phòng: ${item.so_phong}</option> `
                                    $('#sophong').append(html)
                                })
                                $('.btn-them').click(function(){
                                    $.ajax({
                                        type: 'get',
                                        url: '/admin/hoa-don/them-so-phong/'+$('#sophong').val()+'/chitietdp='+id,
                                        success: function(response) {
                                            console.log(id)
                                            $('#themsophong_'+index+'__'+id).css('display', 'none')
                                            $('#sophong__'+index+'__'+id).text('Số phòng: ' +response.so_phong)
                                            temp=+1
                                            // $(window).bind('beforeunload', function () {
                                            //     $.ajax({
                                            //             type: 'get',
                                            //             url: '/admin/hoa-don/them-so-phong/'+$('#sophong').val()+'/chitietdp=0',
                                            //             success: function(response) {

                                            //             },
                                            //             error: function(jqXHR, textStatus, errorThrown) {
                                            //             }
                                            //         })

                                            //     return 'Các thay đổi chưa lưu của bạn sẽ bị mất.';
                                            // });
                                        },
                                        error: function(jqXHR, textStatus, errorThrown) {
                                        }
                                    })
                                })
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                            }
                        })
                    })
            },
            error: function(jqXHR, textStatus, errorThrown) {
                    //xử lý lỗi tại đây
                alert("Không tìm thấy mã đặt phòng!")
            }
        })
    })
</script>

<script type="text/javascript">
    //By using jQuery
    $(window).bind('beforeunload', function () {

        return 'Các thay đổi chưa lưu của bạn sẽ bị mất.';
    });
</script>
@endsection
