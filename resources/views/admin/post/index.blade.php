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
    <form action="{{ route('delete.Mulposts') }}" method="POST">
        @csrf
        @method('DELETE')
        <table class="table">
            <thead>
                <tr>
                    <th>Check</th>
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
                @foreach ($posts as $key => $post)
                    <tr>
                        <th>
                            @if ($post->user->role != 0 || $post->user->id == Auth::id())
                                <input type="checkbox" name="ids[]" value="{{ $post->id }}">
                            @else
                                <h4 class="text-danger">ADMIN</h4>
                            @endif
                        </th>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>
                            <p
                                style=" white-space: nowrap;
                        width: 100px;
                        overflow: hidden;">
                                {{ $post->title }}</p>
                        </td>
                        <td>
                            <p
                                style=" white-space: nowrap;
                        width: 200px;
                        overflow: hidden;">
                                {{ $post->content }}</p>
                        </td>
                        <td>{{ $post->status == 0 ? 'Đợi duyệt' : 'Đã duyệt' }}</td>
                        <td><img src="../../{{ $post->image }}" width="50px" alt=""></td>
                        <td>{{ $post->created_at }}</td>
                        <td>{{ $post->updated_at }}</td>
                        <td>{{ $post->user->name }}</td>
                        <td>{{ $post->Category->category_name }}</td>
                        <td class="whitespace-nowrap">
                            @if ($post->user->role != 0 || Auth::user()->id == $post->user->id)
                                <button type="button" class="btn btn-success"><a
                                        href="edit/{{ $post->id }}">Sửa</a></button>
                                <button type="button" class="btn btn-danger"><a
                                        onclick=" return confirm('Bạn có chắc chắn xoá?')"
                                        href="delete/{{ $post->id }}">Xoá</a></button>
                                @if ($post->status == 0)
                                    <button type="button" class="btn btn-success"><a
                                            onclick=" return confirm('Bạn có chắc chắn công khai?')"
                                            href="{{ route('posts.updatestt', ['id' => $post->id, 'status' => 1]) }}">Công
                                            Khai</a></button>
                                @endif
                                @if ($post->status == 1)
                                    <button type="button" class="btn btn-success"><a
                                            onclick=" return confirm('Bạn có chắc chắn bỏ công khai?')"
                                            href="{{ route('posts.updatestt', ['id' => $post->id, 'status' => 0]) }}">Bỏ
                                            Công
                                            Khai</a></button>
                                @endif
                            @endif



                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table> <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xoá?')">Xoá
            mục đã
            chọn</button>
    </form>
    {{ $posts->links() }}
@endsection
