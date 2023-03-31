@extends('admin.layouts.footer')
@extends('admin.layouts.master')
@extends('admin.layouts.header')
@section('content')
    <button type="button" class="btn btn-primary"><a class="text-danger" href="create">Thêm mới</a></button>
    <div class="message text-center">
        @if (session('message'))
            <h4 class="aler alert-danger pt-3 pb-3">
                <strong>{{ session('message') }}</strong>
            </h4>
        @endif
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">STT</th>
                <th scope="col">Tên</th>
                <th scope="col">Ảnh</th>
                <th scope="col">Chức năng</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $key => $cate)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $cate->category_name }}</td>
                    <td><img src="../../{{ $cate->image }}" alt="" width="50px"></td>
                    <td><button type="button" class="btn btn-success"><a href="edit/{{ $cate->id }}">Sửa</a></button>
                        <button type="button" class="btn btn-danger"><a onclick=" return confirm('Bạn có chắc chắn xoá?')"
                                href="delete/{{ $cate->id }}">Xoá</a></button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
