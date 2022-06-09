@extends('admin.layouts.index')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Loại phòng</h1>
        </div>
    </div>
    <div class="panel-body">
        <form method="GET" action="{{ route('admin.loaiphong.getThem') }}">
            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm mớI</button>
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
            Danh sách loại phòng
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="dtBasicExample">
                    <thead>
                        <tr>
                            <th>ID Loại phòng</th>
                            <th>Tên loại phòng</th>
                            <th>Người thêm</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($loaiphong))
                            @foreach ($loaiphong as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->tenloaiphong }}</td>
                                    <td>{{ $item->users->name }}</td>
                                    <th><a href="{{ route('admin.loaiphong.getSua', ['id' => $item->id]) }}">Sửa</a> | <a
                                            href="{{ route('admin.loaiphong.getXoa', ['id' => $item->id]) }}"
                                            onclick="return ConfirmDelete()">Xoá</a></th>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@section('script')

@endsection
