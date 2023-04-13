@extends('client.layouts.footer')
@extends('client.layouts.master')
@extends('client.layouts.header')
@section('content')
    <h2>Thống kê thành viên có nhiều bài Post nhất</h2>
    <canvas id="myChart1"></canvas>
    <h2>Thống kê bài viết có nhiều lượt thích</h2>
    <canvas id="myChart2"></canvas>
    <script>
        const ctx1 = document.getElementById('myChart1').getContext('2d');
        const ctx2 = document.getElementById('myChart2').getContext('2d');
        var data = @json($data);
        var data2 = @json($data2);
        new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: data.labels,
                datasets: [{
                    label: 'Số bài viết',
                    data: data.data,
                    borderWidth: 1,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                    ]
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: data2.labels,
                datasets: [{
                    label: 'Số lượt like',
                    data: data2.data,
                    borderWidth: 1,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                    ]
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
