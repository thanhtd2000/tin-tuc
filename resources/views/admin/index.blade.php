@extends('admin.layouts.dashboard-footer')
@extends('admin.layouts.master')
@extends('admin.layouts.header')
@section('content')
    <h2>Thống kê thành viên có nhiều bài Post nhất</h2>
    <canvas id="myChart1"></canvas>
    <h2>Thống kê bài viết có nhiều lượt thích</h2>
    <canvas id="myChart2"></canvas>
@endsection
