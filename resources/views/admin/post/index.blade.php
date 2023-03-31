@extends('admin.layouts.footer')
@extends('admin.layouts.master')
@extends('admin.layouts.header')
@section('content')
    <div class="d-flex align-items-center justify-content-between"> <button type="button" class="btn btn-primary"><a
                class="text-danger" href="create">Thêm mới</a></button>
        <div class="row g-3 align-items-center">
            <form action="{{ route('posts.search') }}" method="POST" class="d-flex">
                @csrf
                <div class="col-auto">
                    <input type="text" name="keywords" id="inputEmail6" class="form-control" placeholder="Nhập từ khoá">
                </div>
                <button type="button" class="btn btn-primary text-black ms-3">Tìm kiếm</button>
            </form>
        </div>
    </div>
    <div class="message text-center">
        @if (session('message'))
            <h4 class="aler alert-danger pt-3 pb-3">
                <strong class="text-danger">{{ session('message') }}</strong>
            </h4>
        @endif
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">STT</th>
                <th scope="col">Tiêu đề</th>
                <th scope="col">Nội dung</th>
                <th scope="col">Trạng thái</th>
                <th scope="col">Ảnh</th>
                <th scope="col">Thời gian đăng</th>
                <th scope="col">Thời gian sửa</th>
                <th scope="col">Người đăng</th>
                <th scope="col">Chuyên mục</th>
                <th scope="col">Chức năng</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $key => $cate)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>
                        <p
                            style=" white-space: nowrap;
                        width: 100px;
                        overflow: hidden;">
                            {{ $cate->title }}</p>
                    </td>
                    <td>
                        <p
                            style=" white-space: nowrap;
                        width: 200px;
                        overflow: hidden;">
                            {{ $cate->content }}</p>
                    </td>
                    <td>{{ $cate->status == 0 ? 'Đợi duyệt' : 'Đã duyệt' }}</td>
                    <td><img src="../../{{ $cate->image }}" width="50px" alt=""></td>
                    <td>{{ $cate->created_at }}</td>
                    <td>{{ $cate->updated_at }}</td>
                    <td>{{ $cate->user->name }}</td>
                    <td>{{ $cate->Category->category_name }}</td>
                    <td class="whitespace-nowrap">
                        <button type="button" class="btn btn-success"><a href="edit/{{ $cate->id }}">Sửa</a></button>
                        <button type="button" class="btn btn-danger"><a onclick=" return confirm('Bạn có chắc chắn xoá?')"
                                href="delete/{{ $cate->id }}">Xoá</a></button>

                        @if ($cate->status == 0)
                            <button type="button" class="btn btn-success"><a
                                    onclick=" return confirm('Bạn có chắc chắn công khai?')"
                                    href="update-stt/{{ $cate->id }}">Công Khai</a></button>
                        @endif

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $posts->links() }}
@endsection
