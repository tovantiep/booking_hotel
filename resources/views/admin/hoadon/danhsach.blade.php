@extends('admin.layouts.index')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Hoá đơn</h1>
        </div>
    </div>
    <div class="panel-body">
        <form method="GET" action="{{ route('admin.hoadon.getThem') }}">
            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm mới hoá đơn</button>
        </form>
    </div>

    @if (session('thongbao'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{ session('thongbao') }}
        </div>
    @endif
    <div class="panel panel-default">
        <div class="panel-heading">
            Danh sách hoá đơn
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="dtBasicExample">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Số hoá đơn</th>
                            <th>Mã đặt phòng</th>
                            <th>Tên khách hàng</th>
                            <th>Số điện thoại</th>
                            <th>Trạng thái</th>
                            <th>Nhân viên </th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($hoadon))
                            <?php $i = 1 ?>
                            @foreach ($hoadon as $item)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->datphong_id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->sdt }}</td>
                                    <td>
                                        @if ($item->trang_thai == 1)
                                        <i style="color: green">Đã thanh toán</i>
                                    @else
                                    <i style="color: red">Chưa thanh toán</i> | <a class="btn btn-success btn-xs" href="{{ route('admin.hoadon.getXacNhan', ['id' => $item->id]) }}" onclick="">Xác nhận thanh toán</a>
                                    @endif
                                    </td>
                                   
                                    <td>{{ $item->user->name }}</td>
                                    <th>
                                        <a class="btn btn-success btn-xs" href="{{ route('admin.hoadon.getXuatHoaDon', ['id' => $item->id]) }}" onclick="">Xuất hoá đơn</a>
                                        <a class="btn btn-warning btn-xs" href="{{ route('admin.hoadon.getSua', ['id' => $item->id]) }}" onclick="">Sửa</a>
                                        <a class="btn btn-danger btn-xs" href="{{ route('admin.hoadon.getXoa', ['id' => $item->id]) }}" onclick="return ConfirmDelete()">Xoá</a>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
