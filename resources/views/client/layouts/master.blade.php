<nav class="navbar">
    <div class="nav-left"><a href="{{ route('client.home') }}"><img class="logo" src="../../../client/images/logo.png"
                alt=""></a>
        @if (Auth::check())
            <div class="dropdown">
                <button type="button" class="position-relative">
                    <img data-bs-toggle="dropdown" src="../../../client/images/notification.png">
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        {{ DB::table('notify')->where([['user_id', '=', Auth::user()->id], ['watched', '=', 0]])->count() }}
                    </span>
                    <ul class="dropdown-menu">
                        <a href="{{ route('client.updateAllNotification', ['user_id' => Auth::user()->id]) }}"
                            class="text-primary">Đánh dấu tất cả đã đọc</a>
                        @foreach ($notify = DB::table('notify')->where('user_id', Auth::user()->id)->latest()->take(5)->get() as $nt)
                            <li @if ($nt->watched == 1) class="bg-info-subtle" @endif>
                                <a class="dropdown-item"
                                    href="{{ route('client.updateNotification', ['id' => $nt->id]) }}"><span
                                        class="text-danger">{{ $nt->userComment }}</span>
                                    @if ($nt->reply == 0)
                                        đã bình
                                        luận
                                        bài
                                        viết
                                    @else
                                        trả lời bình luận
                                    @endif <br> của bạn lúc {{ $nt->dateComment }}
                                </a>
                            </li>
                        @endforeach


                    </ul>
                </button>

            </div>
        @endif
    </div>
    <div class="pages">
        <div class="">
            <ul class="list-unstyled mb-0 flex justify-around">
                @if (Auth::check())
                    <a href="{{ route('client.postCreated') }}">
                        <li class="px-[10px] text-white">Các bài viết đã tạo</li>
                    </a>

                    <a href="{{ route('client.dashboard') }}">
                        <li class="px-[10px] text-white">Thống kê xếp hạng</li>
                    </a>
                @endif
                <a href="{{ route('client.contact') }}">
                    <li class="px-[10px] text-white">Liên hệ</li>
                </a>
                <a href="{{ route('client.introduce') }}">
                    <li class="px-[10px] text-white">Giới thiệu</li>
                </a>
            </ul>
        </div>
    </div>
    <div class="nav-right">
        <div class="search-box">
            <form action="{{ route('client.searchPost') }}" method="Post">
                @csrf
                <input type="text" name="search_post" placeholder="Search">
                <button type="submit"><i class="fas fa-search"></i></button>
            </form>

        </div>

        @if (Auth::check())
            <div class="profile-image online" onclick="UserSettingToggle()">
                <img src="../../../uploads/{{ Auth::user()->avatar }}" alt="">
            </div>
        @else
            <a class="bg-warning border-0 rounded p-1 ml-5" href="{{ route('login') }}"><button> Đăng nhập</button></a>
        @endif


    </div>
    @if (Auth::check())
        <div class="user-settings">
            <div class="profile-darkButton">
                <div class="user-profile">
                    <img src="../../../uploads/{{ Auth::user()->avatar }}" alt="">
                    <div>
                        <a href="{{ route('client.showProfile') }}">
                            <p> {{ Auth::user()->name }}</p>
                        </a>
                        <a href="#">See your profile</a>
                    </div>
                </div>
                <div id="dark-button" onclick="darkModeON()">
                    <span></span>
                </div>
            </div>
            <hr>
            @if (Auth::user()->role == 0 || Auth::user()->role == 3)
                <div class="user-profile">
                    <img src="../../../client/images/admin.jpg" alt="">
                    <div>
                        <p> Quản trị website</p>
                        <a href="{{ route('admin.index') }}">Giúp quản lý website dễ dàng</a>
                    </div>
                </div>
            @endif
            <hr>
            <div class="settings-links">
                <img src="../../../client/images/setting.png" alt="" class="settings-icon">
                <a href="#">Lên đầu trang <img src="../../../client/images/arrow.png" alt=""></a>
            </div>

            <div class="settings-links">
                <img src="../../../client/images/logout.png" alt="" class="settings-icon">
                <a href="{{ route('logout') }}">Logout <img src="../../../client/images/arrow.png" alt=""></a>
            </div>

        </div>
    @endif
</nav>

<!-- content-area------------ -->

<div class="container-fluild">


    <div class="left-sidebar border-top">

        <div>
            <p class="fs-4 mt-2 mb-2">Danh mục</p>
            <div class="important-links" id="category">
                {{-- @foreach ($categories as $category)
                    <a href="{{ route('client.showCategory', $category->id) }}"><img src="/{{ $category->image }}"
                            alt="">{{ $category->category_name }}</a>
                @endforeach --}}
            </div>
        </div>


        <div class="shortcut-links">
            <p class="fs-4 mt-2 mb-2">Bài viết nổi bật</p>
            @foreach ($top_posts_outstanding as $item)
                <div>
                    <a href="{{ route('client.postDetail', $item->id) }}"> <img src="../../../{{ $item->image }}"
                            alt="">{{ $item->title }}</a>
                </div>
            @endforeach

        </div>
    </div>

    <!-- main-content------- -->


    <div class="content-area">
        @if (Auth::check())
            @yield('story')
        @endif
        @yield('add-post')
        @yield('content')
    </div>


    <!-- sidebar------------ -->
    <div class="right-sidebar">
        <div class="content-right">
            <div>
                <hr>
                <div class="heading-link">
                    <h3 class="fs-4 py-2"> Top Thành Viên </h3>
                </div>
                @foreach ($top_users as $top)
                    <div class="online-list">
                        <div class="online">
                            <img src="../../../uploads/{{ $top->user->avatar }}" alt="">
                        </div>
                        <p>{{ $top->user->name }}</p>
                    </div>
                @endforeach
            </div>
            <hr>
            <h3 class="fs-4 pt-2">Tin mới</h3>
            @foreach ($latestPosts as $item)
                <div class="post_new block-post-right  border w-100 h-25">
                    <div>
                        <img src="../../../{{ $item->image }}" alt="">
                    </div>
                    <div>
                        <p>{{ $item->title }}</p>
                    </div>
                    <div class="text-right">
                        <a href="{{ route('client.postDetail', $item->id) }}">
                            <p class="text-danger">
                                << Xem thêm>>
                            </p>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
