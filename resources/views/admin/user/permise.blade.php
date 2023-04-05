@extends('admin.layouts.footer')
@extends('admin.layouts.master')
@extends('admin.layouts.header')
@section('content')
    <button type="button" class="btn btn-primary"><a class="text-danger" href="create">Thêm mới</a></button>
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
                <th scope="col">Tên người dùng</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Avatar</th>
                <th scope="col">Thời gian tạo</th>
                <th scope="col">Chức năng</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($user as $key => $us)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $us->name }}</td>
                    <td>{{ $us->email }}</td>
                    <td>{{ $roles[$us->role] ?? '' }}
                    </td>
                    <td><img src="../../../uploads/{{ $us->avatar }}" width="30px" alt=""></td>
                    <td>{{ $us->created_at }}</td>
                    <td>
                        @if ($us->role != 0)
                            @if ($us->role != 3)
                                <button type="button" class="btn btn-success"><a
                                        onclick=" return confirm('Bạn có chắc chắn?')"
                                        href="{{ route('users.permise1', ['id' => $us->id, 'stt' => 3]) }}">Kiểm
                                        duyệt</a></button>
                            @endif
                            @if ($us->role == 1||$us->role ==3 )
                                <button type="button" class="btn btn-danger"><a
                                        onclick=" return confirm('Bạn có chắc chắn block?')"
                                        href="{{ route('users.permise1', ['id' => $us->id, 'stt' => 2]) }}">Block</a></button>
                            @endif
                            @if ($us->role !==2&&$us->role !==1)
                                <button type="button" class="btn btn-info"><a
                                        onclick=" return confirm('Bạn có chắc chắn block?')"
                                        href="{{ route('users.permise1', ['id' => $us->id, 'stt' => 1]) }}">Thành
                                        viên</a></button>
                            @endif
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $user->links() }}
@endsection
