@extends('admin.layouts.dashboard-footer')
@extends('admin.layouts.master')
@extends('admin.layouts.header')
@section('content')
    <h3>Thống kê thành viên có nhiều bài Post nhất</h3>
    <canvas id="myChart1"></canvas>
    <h3>Thống kê bài viết có nhiều lượt thích</h3>
    <canvas id="myChart2"></canvas>
@endsection
