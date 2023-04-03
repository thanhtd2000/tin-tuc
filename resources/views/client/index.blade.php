@extends('client.layouts.footer')
@extends('client.layouts.master')
@extends('client.layouts.header')
@section('story')
    @include('client.layouts.story')
@endsection
@section('content')
    <div class="message text-center">
        @if (session('message'))
            <h4 class="aler alert-danger pt-3 pb-3">
                <strong class="text-danger">{{ session('message') }}</strong>
            </h4>
        @endif
    </div>
    @if (Auth::check())
        <div class="write-post-container">
            <div class="user-profile">
                <img src="../../../uploads/{{ Auth::user()->avatar }}" alt="">
                <div>
                    <p>{{ Auth::user()->name }}</p>
                    <small>Public <i class="fas fa-caret-down"></i></small>
                </div>
            </div>
            <div id="add_post" class="add-post">
                <button class=" btn text-white mt-3 bg-success border-0 rounded">Đăng</button>
            </div>
            @include('client.layouts.add-post-user')
        </div>
    @else
        <h4 class="text-danger"> Bạn cần đăng nhập để đăng bài <a class="text-primary" href="{{ route('login') }}">Đăng nhập</a></h4>
    @endif

    @foreach ($posts as $item)
        <div class="status-field-container write-post-container">
            <div class="user-profile-box">
                <div class="user-profile">
                    <img src="../../../uploads/{{ $item->user->avatar }}" alt="">
                    <div>
                        <p> {{ $item->user->name }}</p>
                        <small>{{ $item->created_at }}</small>
                    </div>
                </div>
                <div>
                    <a href="#"><i class="fas fa-ellipsis-v"></i></a>
                </div>
            </div>
            <div class="status-field">
                <h4 class="fs-2">{{ $item->title }}... </h4>
                <a href="{{ route('client.postDetail', $item->id) }}">
                    <p class="text-danger">Xem thêm</p>
                </a>
                <img src="../../../{{ $item->image }}" alt="">

            </div>
            <div class="post-reaction">
                <div class="activity-icons">

                    @if (Auth::check())
                        <div>
                            <form action="{{ route('posts.like', $item) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-link like-button">
                                    <i class="fa fa-heart{{ Auth::user()->hasLikedPost($item) ? '' : '-o' }}"></i>
                                    {{ $item->likesCount() }}
                                </button>
                            </form>
                        </div>
                    @else
                        <button type="submit" class="btn btn-link like-button">
                            <i class="fa fa-heart"></i>
                            {{ $item->likesCount() }}
                        </button>
                    @endif
                    <div><img src="../../../client/images/comments.png"
                            alt="">{{ DB::table('comments')->Where('post_id', $item->id)->count() }}</div>
                    <div><a
                            href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('client.postDetail', $item->id)) }}"><img
                                src="../../../client/images/share.png" alt=""></a></div>
                </div>
            </div>
        </div>
    @endforeach
    {{ $posts->links() }}
    <script>
        var add_post = document.getElementById('add_post');
        var post_an_article = document.getElementById('post_an_article');
        var cancel_post = document.getElementById('cancel_post');
        add_post.addEventListener("click", function() {
            add_post.style.display = 'none';
            post_an_article.style.display = 'block';
        })
        cancel_post.addEventListener("click", function() {
            add_post.style.display = 'block';
            post_an_article.style.display = 'none';
        })
    </script>
@endsection
