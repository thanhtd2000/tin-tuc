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
<div class="container emp-profile">
    <a href="{{ route('client.home') }}"><button class="border-0 rounded bg-warning mb-3">
            <- Trở về trang chủ</button></a>
    <div class="row">
        <div class="col-md-4">
            <div class="profile-img">
                <img src="../../../uploads/{{ Auth::user()->avatar }}" alt="" />

            </div>
        </div>
        <div class="col-md-6">
            <div class="profile-head">
                <h5>
                    {{ $user_profile->name }}
                </h5>
                <h6>
                    {{ $user_profile->role == 0 ? 'Quản trị viên' : 'user' }}
                </h6>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                            aria-controls="home" aria-selected="true">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                            aria-controls="profile" aria-selected="false">Timeline</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-2">
            <a href="{{ route('client.editProfile', $user_profile->id) }}"><button
                    class="border-0 rounded bg-primary">Edit
                    profile</button></a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="profile-work">
                <p>WORK LINK</p>
                <a href="">Website Link</a><br />
                <a href="">Bootsnipp Profile</a><br />
                <a href="">Bootply Profile</a>
                <p>SKILLS</p>
                <a href="">Web Designer</a><br />
                <a href="">Web Developer</a><br />
                <a href="">WordPress</a><br />
                <a href="">WooCommerce</a><br />
                <a href="">PHP, .Net</a><br />
            </div>
        </div>
        <div class="col-md-8">
            <div class="tab-content profile-tab" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Name</label>
                        </div>
                        <div class="col-md-6">
                            <p>{{ $user_profile->name }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Emal</label>
                        </div>
                        <div class="col-md-6">
                            <p>{{ $user_profile->email }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Ngày đăng kí</label>
                        </div>
                        <div class="col-md-6">
                            <p>{{ $user_profile->created_at }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Vai trò</label>
                        </div>
                        <div class="col-md-6">
                            <p>{{ $user_profile->role == 0 ? 'Quản trị viên' : 'user' }}</p>
                        </div>
                    </div>


                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Experience</label>
                        </div>
                        <div class="col-md-6">
                            <p>Expert</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Hourly Rate</label>
                        </div>
                        <div class="col-md-6">
                            <p>10$/hr</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Total Projects</label>
                        </div>
                        <div class="col-md-6">
                            <p>230</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>English Level</label>
                        </div>
                        <div class="col-md-6">
                            <p>Expert</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Availability</label>
                        </div>
                        <div class="col-md-6">
                            <p>6 months</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Your Bio</label><br />
                            <p>Your detail description</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
