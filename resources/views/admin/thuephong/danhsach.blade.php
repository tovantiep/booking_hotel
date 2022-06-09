@extends('admin.layouts.index')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Lịch sử thuê phòng</h1>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            Danh sách lịch sử thuê phòng
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Mã đặt phòng</th>
                            <th>Tên phòng</th>
                            <th>Số lượng phòng thuê</th>
                            <th>Ngày Checkin</th>
                            <th>Ngày Checkout</th>
                            <th>Thanh toán</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody id="content-table">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>

       $(document).ready(function() {
        function test(now, start, end, stt) {
            status = ''
            if (stt == 1) {
                status = '<td style="color: green">Phòng đã thanh toán</td>'
            }
            else if (new Date(now) < new Date(start)) {
                status = '<td style="color: red">Phòng được đặt trước</td>'
            } else if (new Date(now) >= new Date(start) && new Date(now) <= new Date(end)) {
                status = '<td style="color: blue">Phòng đang thuê</td>'
            } else if (new Date(now) > new Date(end)) {
                status = '<td style="color: green">Phòng trống</td>'
            }
            return status
        }

        function joinArray(array) {
            if (array.length > 0) {
                return array.toString();
            } else {
                return ' - '
            }

        }

        function checkTT(data) {
            if (data == 1) {
                return '<span style="color: green;">Đã thanh toán</span>';
            } else {
                return '<span style="color: red;">Chưa thanh toán</span>';
            }

        }


        $.ajax({
                url: '/admin/lich-su/lichsuthuephong',
                type: 'GET',
            }).done(function(response) {
                date_now = response.date_now;
                $("#content-table").empty();
                response.chitietdp.forEach( function(element, index){
                    console.log(element.so_phong)
                    html = `
                            <tr>
                                <td>${index+1}</td>
                                <td>${element.datphong_id}</td>
                                <td>${element.phong.tenphong}</td>
                                <td>${element.sophong}</td>
                                <td>${element.datphong.start_date}</td>
                                <td>${element.datphong.end_date}</td>
                                <td>${checkTT(element.datphong.trang_thai)}</td>
                                ${test(date_now, element.datphong.start_date, element.datphong.end_date, element.datphong.trang_thai)}
                            </tr>
                        `
                    $("#content-table").append(html);
                });


            })
       })

</script>
@endsection
