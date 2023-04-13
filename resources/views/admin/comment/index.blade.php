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
    <form action="{{ route('delete.Mulcomments') }}" method="POST">
        @csrf
        @method('DELETE')
        <table class="table">
            <thead>
                <tr>
                    <th>Check</th>
                    <th scope="col">STT</th>
                    <th scope="col">Nội dung</th>
                    <th scope="col">Thời gian đăng</th>
                    <th scope="col">Trạng thái</th>
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
                        <th>
                            @if ($cmt->user->role != 0 || $cmt->user->id == Auth::id())
                                <input type="checkbox" name="ids[]" value="{{ $cmt->id }}">
                            @else
                                <h4 class="text-danger">ADMIN</h4>
                            @endif
                        </th>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $cmt->content }}</td>
                        <td>{{ $cmt->created_at }}</td>
                        <td>{{ $cmt->status == 0 ? 'Đợi Duyệt' : 'Đã Duyệt' }}</td>
                        <td>{{ $cmt->updated_at }}</td>
                        <td>{{ $cmt->parent_id }}</td>
                        <td>{{ $cmt->user->name }}</td>
                        <td>{{ $cmt->post_id }}</td>
                        @if ($cmt->user->role != 0 || Auth::user()->id == $cmt->user->id)
                            <td class="whitespace-nowrap">
                                <button type="button" class="btn btn-danger"><a
                                        onclick=" return confirm('Bạn có chắc chắn xoá?')"
                                        href="delete/{{ $cmt->id }}">Xoá</a></button>


                                @if ($cmt->status == 0)
                                    <button type="button" class="btn btn-success"><a
                                            onclick=" return confirm('Bạn có chắc chắn công khai?')"
                                            href="{{ route('comments.update_stt', ['id' => $cmt->id, 'status' => 1]) }}">Công
                                            Khai</a></button>
                                @endif
                                @if ($cmt->status == 1)
                                    <button type="button" class="btn btn-success"><a
                                            onclick=" return confirm('Bạn có chắc chắn bỏ công khai?')"
                                            href="{{ route('comments.update_stt', ['id' => $cmt->id, 'status' => 0]) }}">Bỏ
                                            Công
                                            Khai</a></button>
                                @endif
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
        <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xoá?')">Xoá mục đã
            chọn</button>
    </form>
    {{ $comments->links() }}
@endsection
