<div class="modal fade" id="modal-view">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Chi tiết đặt phòng</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <table class="detail">
                        <tr >
                            <td style="padding-bottom:15px;"><span class="label label-default">Mã đặt phòng: </span></td>
                            <td style="padding-left:15px;"><b id="id" style="color: rgb(158, 30, 30)"></b></td>
                        </tr>
                        <tr >
                            <td style="padding-bottom:15px;"><span class="label label-default">Họ tên: </span></td>
                            <td style="padding-left:15px;"><b id="name" style="color: rgb(158, 30, 30)"></b></td>
                        </tr>
                        <tr >
                            <td style="padding-bottom:15px;"><span class="label label-default">Email: </span></td>
                            <td style="padding-left:15px;"><i id="email" style="color: rgb(0, 0, 0)"></i></td>
                        </tr>
                        <tr >
                            <td style="padding-bottom:15px;"><span class="label label-default">Số điện thoại: </span></td>
                            <td style="padding-left:15px;"><i id="phone_number" style="color: rgb(0, 0, 0)"></i></td>
                        </tr>
                        <tr >
                            <td style="padding-bottom:15px;"><span class="label label-default">Địa chỉ: </span></td>
                            <td style="padding-left:15px;"><i id="address" style="color: rgb(0, 0, 0)"></i></td>
                        </tr>
                        <tr >
                            <td style="padding-bottom:15px;"><span class="label label-default">Thời gian gửi: </span></td>
                            <td style="padding-left:15px;"><i id="time" style="color: rgb(0, 0, 0)"></i></td>
                        </tr>
                    </table>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table
                            class="table table-striped table-bordered table-hover"
                            id="dtBasicExample">
                            <thead>
                                <tr>
                                    <th>Ngày check in</th>
                                    <th>Ngày check out</th>
                                    <th>Tên phòng</th>
                                    <th>Loại Phòng</th>
                                    <th>Số lượng phòng</th>
                                    <th>Tổng tiền</th>
                                    <th>Chức năng</th>
                                </tr>
                            </thead>
                            <tbody id="content_table">
                                {{-- @foreach ($dp->chitietdp as $ctdp)
                                    <tr>
                                        @if (isset($ctdp->datphong->start_date))
                                            <td>{{ $ctdp->datphong->start_date }}
                                            </td>
                                        @else
                                            <td><i style="color: red;"> --</i></td>
                                        @endif

                                        @if (isset($ctdp->datphong->end_date))
                                            <td>{{ $ctdp->datphong->end_date }}</td>
                                        @else
                                            <td><i style="color: red;"> --</i></td>
                                        @endif

                                        @if (isset($ctdp->phong->loaiphong->tenloaiphong))
                                            <td>{{ $ctdp->phong->loaiphong->tenloaiphong }}
                                            </td>
                                        @else
                                            <td><i style="color: red;"> --</i></td>
                                        @endif

                                        @if (isset($ctdp->phong->tenphong))
                                            <td>{{ $ctdp->phong->tenphong }}</td>
                                        @else
                                            <td><i style="color: red;"> --</i></td>
                                        @endif
                                        <td>{{ $ctdp->sophong }}</td>
                                        <td> {{ $ctdp->songuoi }}</td>
                                        <td>{{ $ctdp->chuthich }}</td>
                                    </tr>
                                @endforeach --}}
                            </tbody>
                        </table>
                    </div>
            </div>
            <div class="modal-footer">
                <a type="button" class="btn btn-default" data-dismiss="modal">OK</a>
            </div>
        </div>
    </div>
</div>
