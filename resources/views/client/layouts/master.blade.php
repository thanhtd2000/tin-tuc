<nav class="navbar">
    <div class="nav-left"><a href="{{ route('client.home') }}"><img class="logo" src="../../../client/images/logo.png"
                alt=""></a>
        <ul class="navlogo">
            <li><img src="../../../client/images/notification.png"></li>

        </ul>
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
                        <p> {{ Auth::user()->name }}</p>
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
                <a href="#">Settings & Privary <img src="../../../client/images/arrow.png" alt=""></a>
            </div>

            <div class="settings-links">
                <img src="../../../client/images/help.png" alt="" class="settings-icon">
                <a href="#">Help & Support <img src="../../../client/images/arrow.png" alt=""></a>
            </div>

            <div class="settings-links">
                <img src="../../../client/images/Display.png" alt="" class="settings-icon">
                <a href="#">Display & Accessibility <img src="../../../client/images/arrow.png"
                        alt=""></a>
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
        <p class="fs-4 mt-2 mb-2">Danh mục</p>
        <div class="important-links">
            @foreach ($categories as $category)
                <a href="{{ route('client.showCategory', $category->id) }}"><img src="/{{ $category->image }}"
                        alt="">{{ $category->category_name }}</a>
            @endforeach
            <a href="#">See More</a>
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
            <h3 class="fs-4 ">Tin mới</h3>
            @foreach ($latestPosts as $item)
                <div class="post_new block-post-right  border w-100">
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
        <div class="advertisement">
            <img src="../../../client/images/advertisement.png" class="advertisement-image" alt="">
        </div>

        <div class="heading-link">
            <h3 class="fs-4 "> Top người dùng</h3>
        </div>

        <div class="online-list">
            <div class="online">
                <img src="../../../client/images/member-1.png" alt="">
            </div>
            <p>Alison Mina</p>
        </div>

        <div class="online-list">
            <div class="online">
                <img src="../../../client/images/member-2.png" alt="">
            </div>
            <p>Jackson Aston</p>
        </div>
        <div class="online-list">
            <div class="online">
                <img src="../../../client/images/member-3.png" alt="">
            </div>
            <p>Samona Rose</p>
        </div>
    </div>
</div>
