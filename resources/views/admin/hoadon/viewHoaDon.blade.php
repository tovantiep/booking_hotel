<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        @font-face {
            font-family: 'arial';
            src: url( {{ url('font-end/font/arial.ttf') }} ) format("truetype");
            font-weight: normal;
            font-style: normal;
        }
        body {
            font-family: "arial";
            font-size: 12px;
            line-height: 11px;
        }
        table, td, th {
            border: 1px solid black;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        }
        th {
            line-height: 30px;
        }
        .header {
            margin: 20px 20px;
        }
        .tonghop {
            width: 100%;
            margin-bottom: 10%;
        }
        .chitiet {
            width: 100%;
        }
        .tonghop_title,
        .tonghop_content {
            text-align: center;
        }
        .chuky-tonghop {

            float: right;
            text-align: center;
            margin-right: 200px;
        }
        .info {
            text-align: left;
            padding: 0 100px;
        }
        .tongtien {
            text-align: right;
            padding-right: 50px;
            margin-top: 10px;
        }
        .chu-ky {


        }
        .chuky-chitiet {
            float: right;
        }

        .table-chitiet {
            border: none;
        }
    </style>

</head>
<body>
    <div class="header">
        <h4>UTT HOTEL</h4>
    </div>
    <div class="content">
        <div class="tonghop">
            <div class="tonghop_title">
                <h3>HOÁ ĐƠN THANH TOÁN TỔNG HỢP</h3>
            </div>
            <div class="tonghop_content">
                <p>Tên khách hàng:...............................................................</p>
                <p>Số phòng:..........................................................................</p>
                <p>Địa chỉ:..............................................................................</p>
                <p>Ngày đến:........................... / Ngày đi:...............................</p>
                <div class="tonghop_content-table">
                    <table>
                        <tr>
                            <th rowspan="2">Dịch vụ</th>
                            <th colspan="9">Ngày</th>
                            <th rowspan="2">Tổng</th>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>2</td>
                            <td>3</td>
                            <td>4</td>
                            <td colspan="4">................................................</td>
                            <td>31</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="4">................................................</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="4">................................................</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="4">................................................</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="4">................................................</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="4">................................................</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="4">................................................</td>
                            <td></td>
                            <td></td>
                        </tr>

                    </table>
                </div>
                <p> Số tiền bằng chữ:....................................................................................</p>
                <div class="chuky-tonghop">
                    <p>Ngày....... tháng ........ năm .........</p>
                    <p>CHỮ KÝ NHÂN VIÊN</p>
                </div>
            </div>
        </div>
        <div class="chitiet">
            <div class="tonghop_title">
                <h3>HOÁ ĐƠN THANH TOÁN CHI TIẾT</h3>
            </div>
            <div class="tonghop_content">
                <div class="info">
                <p>Tên khách hàng:&nbsp;&nbsp;&nbsp;&nbsp; <b> {{ $hoadon->datphong->user->name }} </b></p>
                <p>Điện thoại: &nbsp;&nbsp;&nbsp;&nbsp; <b>{{ $hoadon->datphong->user->kh->sdt }} </b></p>
                <p>Địa chỉ: &nbsp;&nbsp;&nbsp;&nbsp; <b>{{ $hoadon->datphong->user->kh->dia_chi }} </b></p>
                <p>Ngày đến: &nbsp;&nbsp;&nbsp;&nbsp; <b>{{ $hoadon->datphong->start_date }} </b></p>
                <p>Ngày đi: &nbsp;&nbsp;&nbsp;&nbsp; <b>{{ $hoadon->datphong->end_date }} </b></p>
                <p>Tổng số phòng: &nbsp;&nbsp;&nbsp;&nbsp; <b>{{ $hoadon->datphong->tongsophong }} </b></p>
                <p>Số ngày thuê: &nbsp;&nbsp;&nbsp;&nbsp; <b>{{ $hoadon->datphong->songay }} </b></p>
                <p>Tổng tiền: &nbsp;&nbsp;&nbsp;&nbsp; <b>{{ $hoadon->datphong->tongtien }} </b></p>
                </div>
                <table style="margin-top: 10px; border: none;" id="table-chitiet">
                    <tr style="border: none;">
                        <td style="border: none;"><p>KHÁCH HÀNG</p>
                            <p><i>(Ký và ghi rõ họ tên)</i></p>
                        </td>
                        <td style="border: none">
                            <p>Ngày....... tháng ........ năm .........</p>
                        <p>CHỮ KÝ NHÂN VIÊN</p>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
