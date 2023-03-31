@extends('admin.layouts.footer')
@extends('admin.layouts.master')
@extends('admin.layouts.header')
@section('content')
    <form class="col-md-8" action="{{ route('user.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $user['id'] }}">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Tên Người Dùng</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="name" value="{{ $user['name'] }}"
                aria-describedby="emailHelp">
            @if ($errors->has('name'))
                <span class="text-danger fs-3">
                    {{ $errors->first('name') }}
                </span>
            @endif
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="email" value="{{ $user['email'] }}"
                aria-describedby="emailHelp">
            @if ($errors->has('email'))
                <span class="text-danger fs-3">
                    {{ $errors->first('email') }}
                </span>
            @endif
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Avatar</label>
            <input type="file" class="form-control" id="exampleInputEmail1" name="avatar" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Password</label>
            <input type="password" class="form-control" id="exampleInputEmail1" value="{{ old('password') }}"
                name="password" aria-describedby="emailHelp">
            @if ($errors->has('password'))
                <span class="text-danger fs-3">
                    {{ $errors->first('password') }}
                </span>
            @endif
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Reapet Password</label>
            <input type="password" class="form-control" id="exampleInputEmail1" name="password_confirmation"
                aria-describedby="emailHelp">
            @if ($errors->has('password_confirmation'))
                <span class="text-danger fs-3">
                    {{ $errors->first('password_confirmation') }}
                </span>
            @endif
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Vai trò</label>
            <select class="form-select" name="role" aria-label="Default select example">
                <option value="1">Thành viên</option>
                <option value="0">Quản trị viên</option>
            </select>
        </div>
        <br>

        <button type="submit" class="btn btn-primary">Thêm</button>
    </form>
@endsection
