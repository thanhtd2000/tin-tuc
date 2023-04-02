@extends('admin.layouts.footer')
@extends('admin.layouts.master')
@extends('admin.layouts.header')
@section('content')
    <div class="d-flex align-items-center justify-content-between">
        <div class="row g-3 align-items-center">
            <form action="{{ route('comments.search') }}" method="POST" class="d-flex">
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
                <th scope="col">Nội dung</th>
                <th scope="col">Thời gian đăng</th>
                <th scope="col">Thời gian chỉnh sửa</th>
                <th scope="col">Parent_id</th>
                <th scope="col">Người đăng</th>
                <th scope="col">Post_id</th>
                <th scope="col">Chức năng</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($comments as $key => $cmt)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $cmt->content }}</td>
                    <td>{{ $cmt->created_at }}</td>
                    <td>{{ $cmt->updated_at }}</td>
                    <td>{{ $cmt->parent_id }}</td>
                    <td>{{ $cmt->user->name }}</td>
                    <td>{{ $cmt->post_id }}</td>
                    <td class="whitespace-nowrap">
                        <button type="button" class="btn btn-danger"><a onclick=" return confirm('Bạn có chắc chắn xoá?')"
                                href="delete/{{ $cmt->id }}">Xoá</a></button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $comments->links() }}
@endsection
