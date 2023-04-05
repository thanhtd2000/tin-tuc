<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="../client/profile.css">
<!------ Include the above in your HEAD tag ---------->
<div class="message text-center">
    @if (session('message'))
        <h4 class="aler alert-danger pt-3 pb-3">
            <strong class="text-danger">{{ session('message') }}</strong>
        </h4>
    @endif
</div>
<a href="{{ route('client.showProfile') }}"><button class="border-0 rounded bg-warning mb-3 mt-3 ml-5">
        <- Trở về </button></a>
<div class="container emp-profile ">
    <div class="text-center mb-5">
        <h1>Chỉnh sửa thông tin cá nhân</h1>
    </div>

    <form method="post" action="{{ route('client.updateProfile', $user_profile->id) }}" class=""
        enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $user_profile->id }}">
        <input type="hidden" name="role" value="{{ $user_profile->role }}">
        <input type="hidden" name="password" value="{{ $user_profile->password }}">
        <div class="row">
            <div class="profile-img col-lg-5 ">
                <img src="../../../uploads/{{ Auth::user()->avatar }}" alt="" />
                <div class="file btn btn-lg btn-primary">
                    Change Photo
                    <input type="file" name="avatar" />
                </div>

            </div>
            <div class="profile-properties col-lg-7">
                <div class="name mb-5">
                    <input class="w-100 " type="text" value="{{ $user_profile->name }}" name="name"
                        placeholder="Name" id="">
                </div>
                @if ($errors->has('name'))
                    <span class="text-danger fs-3">
                        {{ $errors->first('name') }}
                    </span>
                @endif
                <div class="email mb-5">
                    <input class="w-100 " type="email" value="{{ $user_profile->email }}" name="email"
                        placeholder="Email" id="">
                </div>
                @if ($errors->has('email'))
                    <span class="text-danger fs-3">
                        {{ $errors->first('email') }}
                    </span>
                @endif
                <div class="password mb-5">
                    <input class="w-100 " type="password" placeholder="Mật khẩu" value="{{ old('password') }}"
                        name="password" placeholder="password" id="">
                </div>
                <div>
                    <button class="rounded border-0 bg-success">Cập nhật</button>
                </div>
            </div>

        </div>
    </form>
</div>
