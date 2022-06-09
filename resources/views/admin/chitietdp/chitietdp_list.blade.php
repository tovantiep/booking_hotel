@extends('admin.layouts.index')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Danh sách đặt phòng</h1>
        </div>
    </div>

    @if (session('thongbao'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{ session('thongbao') }}
        </div>
    @endif
    <div class="panel panel-default">
        <div class="panel-heading">
            Danh sách đặt phòng
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover dataTable no-footer" id="dtBasicExample">
                    <thead>
                        <tr>
                            <th>Mã đặt phòng</th>
                            <th>Người đặt</th>
                            <th>Số điện thoại</th>
                            <th>Email</th>
                            <th>Địa chỉ</th>
                            <th>Ngày đặt</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($datphong))
                            @foreach ($datphong as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ $item->user->kh->sdt }}</td>
                                    <td>{{ $item->user->email }}</td>
                                    <td>{{ $item->user->kh->dia_chi }}</td>
                                    <td>{{ $item->ngaydat }}</td>
                                    <td>{{ number_format($item->tongtien) }} VNĐ</td>
                                    <td>
                                        @if ($item->trang_thai == 1)
                                            Đã thanh toán   
                                        @else
                                            Chưa thanh toán
                                        @endif
                                    </td>
                                    <th>
                                        {{-- <a class="btn btn-warning btn-xs btn-view" href="{{ route('admin.chitietdp.getSua', ['id' => $item->id]) }}" >Sửa</a> --}}
                                        <a class="btn btn-primary btn-xs btn-view" href="" data-target="#modal-view"
                                        data-toggle="modal"
                                            data-url={{ route('admin.chitietdp.getView', ['id' => $item->id]) }}>Xem</a>
                                        <a class="btn btn-danger btn-xs btn-view" href="{{ route('admin.chitietdp.xoa', ['id' => $item->id]) }}" onclick="return ConfirmDelete()">Xoá</a>
                                        
                                    </th>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('admin.chitietdp.modal_dialog')

@endsection

@section('script')
    <script>
        $('.btn-view').click(function() {
            var url = $(this).attr('data-url');
            $.ajax({
                type: 'get',
                url: url,
                success: function(response) {
                    $('#content_table').html("");
                    $('b#id').text(response.data.id)
                    $('b#name').text(response.user.name)
                    $('i#email').text(response.user.name)
                    $('i#phone_number').text(response.kh.sdt)
                    $('i#address').text(response.kh.dia_chi)
                    $('p#title').text(response.data.title)
                    $('p#content').text(response.data.content)
                    
                    chitiet = response.ctdp

                    chitiet.forEach(element => {
                        html = `<tr>
                            <td>${ response.data.start_date}</td>
                            <td>${ response.data.end_date}</td>
                            <td>${ element.phong.tenphong}</td>
                            <td>${ element.phong.loaiphong.tenloaiphong}</td>
                            <td>${ element.sophong}</td>
                            <td>${element.gia} VNĐ</td>
                            <td><a class="btn btn-warning btn-xs btn-sua-ctdp" data-id="${element.id}" onclick="Redirect(${element.id})" >Sửa</a></td>
                        </tr>`
                        $('#content_table').append(html);
                    });
                    $('i#time').text(response.time)
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    //xử lý lỗi tại đây
                }
            })
        })

        function Redirect(id) {
                window.location= "sua/" + id;
            }

    </script>
@endsection
