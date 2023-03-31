@extends('layouts.signup.footer')
@extends('layouts.signup.master')
@extends('layouts.signup.header')

@section('content')
    <div class="signup">
        <div class="message text-center">
            @if (session('message'))
                <h4 class="aler alert-danger pt-3 pb-3">
                    <strong>{{ session('message') }}</strong>
                </h4>
            @endif
        </div>

        <h1 class="signup-heading">Đăng ký</h1>
        <button class="signup-social">
            <i class="fa fa-google signup-social-icon"></i>
            <span class="signup-social-text">Sign up with Google</span>
        </button>
        <div class="signup-or"><span>Or</span></div>
        <form action="{{ route('user.dangky') }}" method="POST" enctype="multipart/form-data" class="signup-form"
            autocomplete="on">
            @csrf
            <div class="name">
                <label for="" class="signup-label">Full name</label>
                <input type="text" class="signup-input" name="name" placeholder="Eg: John Doe"
                    value="{{ old('name') }}">
                @if ($errors->has('name'))
                    <span class="text-danger fs-3">
                        {{ $errors->first('name') }}
                    </span>
                @endif
            </div>
            <div class="email">
                <label for="" class="signup-label">Email</label>
                <input type="email" class="signup-input" name="email" placeholder="Eg: johndoe@gmai.com"
                    value="{{ old('email') }}">
                @if ($errors->has('email'))
                    <span class="text-danger fs-3">
                        {{ $errors->first('email') }}
                    </span>
                @endif
            </div>
            <div class="avata">
                <label for="" class="signup-label">Avatar</label>
                <input type="file" class="signup-input" name="avatar">
                @if ($errors->has('avatar'))
                    <span class="text-danger fs-3">
                        {{ $errors->first('avatar') }}
                    </span>
                @endif
            </div>
            <div class="password">
                <label for="" class="signup-label">Password</label>
                <input type="password" class="signup-input" name="password" placeholder="Password: ">
                @if ($errors->has('password'))
                    <span class="text-danger fs-3">
                        {{ $errors->first('password') }}
                    </span>
                @endif
            </div>
            <div class="confirm-password">
                <label for="" class="signup-label">Re-enter new password</label>
                <input type="password" class="signup-input" name="password_confirmation"
                    placeholder="Re-enter new password: ">
                @if ($errors->has('password_confirmation'))
                    <span class="text-danger fs-3">
                        {{ $errors->first('password_confirmation') }}
                    </span>
                @endif
            </div>
            <input type="hidden" value="1" name="role">
            <button type="submit " class="signup-submit">Sign up</button>
        </form>
        <p class="signup-already">
            <span>Already have an account ?</span>
            <a href="{{route('login')}}" class="signup-login-link">Login</a>
        </p>
    </div>
@endsection
