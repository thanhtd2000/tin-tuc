@extends('layouts.login2.footer')
@extends('layouts.login2.master')
@extends('layouts.login2.header')

@section('content')
    <div class="message text-center">
        @if (session('message'))
            <h4 class="aler text-danger pt-3 pb-3">
                <strong>{{ session('message') }}</strong>
            </h4>
        @endif
    </div>
    <div class="bg-light min-vh-100 d-flex flex-row align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card mb-4 mx-4">

                        <div class="card-body p-4">
                            <h1>Tạo tài khoản</h1>
                            <p class="text-medium-emphasis">Tạo tài khoản để sử dụng nhiều chức năng</p>
                            <form action="{{ route('user.dangky') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="input-group mb-3"><span class="input-group-text">
                                        <svg class="icon">
                                            <use xlink:href="../../../dist/vendors/@coreui/icons/svg/free.svg#cil-user">
                                            </use>
                                        </svg></span>
                                    <input class="form-control" type="text" placeholder="Họ và Tên" name="name">
                                </div>
                                @if ($errors->has('name'))
                                    <span class="text-danger fs-7">
                                        {{ $errors->first('name') }}
                                    </span>
                                @endif
                                <div class="input-group mb-3"><span class="input-group-text">
                                        <svg class="icon">
                                            <use
                                                xlink:href="../../../dist/vendors/@coreui/icons/svg/free.svg#cil-envelope-open">
                                            </use>
                                        </svg></span>
                                    <input class="form-control" type="text" placeholder="Email" name="email">
                                </div>
                                @if ($errors->has('email'))
                                    <span class="text-danger fs-7">
                                        {{ $errors->first('email') }}
                                    </span>
                                @endif
                                <div class="input-group mb-3">
                                    <input class="form-control" type="file" name="avatar" placeholder="Ảnh">
                                </div>
                                @if ($errors->has('avatar'))
                                    <span class="text-danger fs-7">
                                        {{ $errors->first('avatar') }}
                                    </span>
                                @endif
                                <div class="input-group mb-3"><span class="input-group-text">
                                        <svg class="icon">
                                            <use
                                                xlink:href="../../../dist/vendors/@coreui/icons/svg/free.svg#cil-lock-locked">
                                            </use>
                                        </svg></span>
                                    <input class="form-control" type="password" placeholder="Mật khẩu" name="password">
                                </div>
                                @if ($errors->has('password'))
                                    <span class="text-danger fs-7">
                                        {{ $errors->first('password') }}
                                    </span>
                                @endif
                                <div class="input-group mb-4"><span class="input-group-text">
                                        <svg class="icon">
                                            <use
                                                xlink:href="../../../dist/vendors/@coreui/icons/svg/free.svg#cil-lock-locked">
                                            </use>
                                        </svg></span>
                                    <input class="form-control" type="password" name="password_confirmation"
                                        placeholder="Xác nhận lại mật khẩu">
                                </div>
                                @if ($errors->has('password_confirmation'))
                                    <span class="text-danger fs-7">
                                        {{ $errors->first('password_confirmation') }}
                                    </span>
                                @endif
                                <button class="btn btn-block btn-success" type="submit">Tạo ngay</button>
                        </div>
                        </form>
                        <div class="m-2"><p class="signup-already">
                            <span>Đã có tài khoản ?</span>
                            <a href="{{ route('login') }}" class="signup-login-link">Login</a>
                        </p></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
