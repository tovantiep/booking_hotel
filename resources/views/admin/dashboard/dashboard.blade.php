@extends('admin.layouts.index')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Thống kê</h1>
        </div>
        <div class="col-lg-12">
            @foreach($sale_year as $total_year)
            <h4 class="page-header">Tổng doanh thu: {{number_format($total_year)}} (VND)</h4>
            @endforeach
        </div>
    </div>
    <div>
        <canvas id="myChart"></canvas>
    </div>
    <script>
        const labels = [
            '',
            'Tháng 1',
            'Tháng 2',
            'Tháng 3',
            'Tháng 4',
            'Tháng 5',
            'Tháng 6',
            'Tháng 7',
            'Tháng 8',
            'Tháng 9',
            'Tháng 10',
            'Tháng 11',
            'Tháng 12',
        ];
        var data_order = {!! json_encode($datas) !!};
        const data = {
            labels: labels,
            datasets: [{
                label: 'Doanh thu theo tháng (triệu vnd)',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: data_order,
            }]
        };

        const config = {
            type: 'line',
            data: data,
            options: {}
        };
    </script>
    <script>
        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
    </script>
@endsection

@section('script')

@endsection
