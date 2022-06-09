@extends('admin.layouts.index')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Sửa hoá đơn</h1>
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
            Sửa hoá đơn
        </div>
        <div class="panel-body">
            <form action="{{ route('admin.hoadon.postSua', ['id' => $hoadon->id]) }}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                <div class="form-group" style="width: 30%;">
                    <label for="exampleFormControlSelect1">Nhập Mã đặt phòng</label>
                    <input type="text" class="form-control" id="madp" placeholder="Mã đặt phòng" name="madp" value="{{ $hoadon->datphong_id }}"
                        autocomplete="off" disabled/>
                </div>
                <div class="form-group">
                    <label for="tongsophong">Chi tiết thuê phòng</label>
                    <div class="table-responsive">
                        <table
                            class="table table-striped table-bordered table-hover"
                            id="">
                            <thead>
                                <tr>
                                    <th>Số phòng</th>
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
                    <label for="name">Tên khách hàng</label>
                    <input type="text" class="form-control" id="name" placeholder="Họ và tên" name="name" value="{{ $hoadon->name }}"
                        autocomplete="off" />
                </div>

                <div class="form-group">
                    <label for="sdt">Số điện thoại</label>
                    <input type="text" class="form-control" id="sdt" placeholder="Số điện thoại" name="sdt" value="{{ $hoadon->sdt }}"
                        autocomplete="off" />
                </div>

                <div class="form-group">
                    <label for="sdt">Địa chỉ</label>
                    <input type="text" class="form-control" id="dia_chi" placeholder="Địa chỉ" name="dia_chi" value="{{ $hoadon->dia_chi }}"
                        autocomplete="off" />
                </div>

                <div class="form-group">
                    <label for="dia_chi">Tổng số tiền phòng</label>
                    <input type="text" class="form-control" id="tienphong" placeholder="Tổng số tiền phòng" name="tienphong"
                        value="{{ $hoadon->tienphong }}" required autocomplete="off" />
                </div>

                <button type="submit" class="btn btn-primary mb-2">Sửa</button>
                <button type="reset" class="btn btn-default">Nhập lại</button>
            </form>
        </div>
    </div>
    @include('admin.hoadon.modal_dialog')
@endsection

@section('script')
<script>
    $(document).ready(function() {
        var url = '/admin/hoa-don/xem/' + $('#madp').val();
        $.ajax({
            type: 'get',
            url: url,
            success: function(response) {
                    $('#btnxem').css('display', 'inline-block')
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
                    chitiet.forEach((element, index) => {

                        ct_id = element.id
                        stt = index;
                        
                        html = `<tr>
                            <td>
                                <span  id="sophong__${element.id}"></span>
                            </td>
                            <td>${ element.phong.tenphong}</td>
                            <td>${ element.phong.loaiphong.tenloaiphong}</td>
                            <td>${ response.data.start_date}</td>
                            <td>${ response.data.end_date}</td>
                            <td>${ element.phong.gia}</td>
                            </tr>`
                        $('#content_table').append(html);
                        if(element.sophong > 1) {
                            for(i = 1; i<element.sophong; i++) {
                                stt
                                $('#content_table').append(html);
                            }
                        }
                        response.sophong.forEach(sp => {
                            $('#sophong__'+ct_id).text('Số phòng: ' + sp.so_phong)
                        })
                    })
                    $('i#time').text(response.time)
                    $('.btn-themsophong').click(function() {
                        var id= $(this).attr('data-id');

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
                                        url: '/admin/hoa-don/them-so-phong/'+$('#sophong').val()+'/chitietdp='+ct_id,
                                        success: function(response) {
                                            $('#themsophong_'+id).css('display', 'none')
                                            $('#sophong__'+id).text('Số phòng: ' +response.so_phong)
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
@endsection
