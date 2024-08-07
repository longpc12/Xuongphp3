@extends('layouts.admin')

@section('css')
    <style>
        .chart-container {
            position: relative;
            height: 300px; /* Đặt chiều cao cố định cho biểu đồ */
            width: 100%; /* Đảm bảo biểu đồ chiếm toàn bộ chiều rộng của cột */
        }

        canvas {
            width: 100% !important;
            height: 100% !important;
        }

        .content-wrapper {
            margin-left: 250px; /* Khoảng cách từ sidebar */
            padding: 20px;
        }
    </style>
@endsection

@section('content')
<div class="content-wrapper">
    @if($statistics->isEmpty())
        <h1>Không có thống kê cho khoảng thời gian này</h1>
    @else
        @php
            $statistic = $statistics->first();
        @endphp
        <h1>Thông Tin Thống Kê Từ 1/7/2024 Đến {{ \Carbon\Carbon::today()->format('d/m/Y') }}</h1>
        <p>Tổng Doanh Thu: {{ number_format($statistic->total_revenue, 0, ',', '.') }} VNĐ</p>
        <p>Tổng Số Đơn Hàng: {{ $statistic->total_orders }}</p>
        <p>Tổng Số Người Dùng: {{ $statistic->total_users }}</p>

        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Tổng Doanh Thu</h5>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="revenueChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Tổng Số Đơn Hàng</h5>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="ordersChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Tổng Số Người Dùng</h5>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="usersChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@if(!$statistics->isEmpty())
<script>
    // Biểu đồ cột: Tổng Doanh Thu
    const revenueCtx = document.getElementById('revenueChart').getContext('2d');
    new Chart(revenueCtx, {
        type: 'bar',
        data: {
            labels: ['Tháng'],
            datasets: [{
                label: 'Tổng Doanh Thu',
                data: [{{ $statistic->total_revenue }}],
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Biểu đồ đường: Tổng Số Đơn Hàng
    const ordersCtx = document.getElementById('ordersChart').getContext('2d');
    new Chart(ordersCtx, {
        type: 'line',
        data: {
            labels: ['Tháng'],
            datasets: [{
                label: 'Tổng Số Đơn Hàng',
                data: [{{ $statistic->total_orders }}],
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Biểu đồ hình tròn: Tổng Số Người Dùng
    const usersCtx = document.getElementById('usersChart').getContext('2d');
    new Chart(usersCtx, {
        type: 'pie',
        data: {
            labels: ['Người Dùng'],
            datasets: [{
                label: 'Tổng Số Người Dùng',
                data: [{{ $statistic->total_users }}],
                backgroundColor: ['rgba(255, 159, 64, 0.2)'],
                borderColor: ['rgba(255, 159, 64, 1)'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
</script>
@endif
@endsection
