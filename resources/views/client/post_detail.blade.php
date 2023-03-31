@extends('client.layouts.footer')
@extends('client.layouts.master')
@extends('client.layouts.header')
@section('content')
    <div>
        <h1>{!! $post_id->title !!}</h1>
        <div class="content-post">
            <p>{!! $post_id->content !!}</p>
        </div>

    </div>
    {{-- @if (Auth::check())
        <div class="comment" style="border: 1px solid black; border-radius: 10px">
            @foreach ($comments as $comment)
                <div style="border-bottom: 1px solid black; margin-top: 20px">
                    <img width="80px" style="border: 50%" height="50px" src="/uploads/{{ $comment->User->avatar }}"
                        alt="">
                    <label style="font-weight: bold" for="">{{ $comment->User->name }}</label>
                    <p style="padding-left: 100px">{{ $comment->content }}</p>
                    <button>trả lời</button>
                    <div class="reply-form" style="display: none">
                        <form action="" method="POST">
                            <input type="text" width="150px" placeholder="Phản hồi">
                            <button class="reply-later-btn" type="submit">Gửi</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <h4 class="text-danger"> Bạn cần đăng nhập để đăng bài<a href="{{ route('login') }}">Đăng nhập</a></h4>
    @endif
    <button id="myButton">Click me</button> --}}
    @if (Auth::check())
        <div class="container  mt-5 mb-5">
            <div class="d-flex justify-content-center row">
                <div class="d-flex flex-column col-md-12">
                    <h3 class="fs-3 fw-bolder">Comment</h3>
                    <div class="coment-bottom bg-white p-2 px-4">
                        <div class="d-flex flex-row add-comment-section mt-4 mb-4"><img
                                class="img-fluid img-responsive rounded-circle mr-2" src="/uploads/{{ Auth::user()->avatar }}"
                                width="38"><input type="text" class="form-control mr-3"
                                placeholder="Add comment"><button class="btn bg-success btn-primary"
                                type="button">Comment</button>
                        </div>
                        @foreach ($comments as $comment)
                            <div class="commented-section rounded bg-light mt-2">
                                <div class="d-flex flex-row align-items-center commented-user">
                                    <img style="border-radius: 50%" class="rounded-circle"
                                        src="{{ $comment->user->avatar }}" width="30">
                                    <h5 class="mr-2">{{ $comment->User->name }}</h5><span class="dot mb-1"></span><span
                                        class="mb-1 ml-2">4
                                        hours
                                        ago</span>
                                </div>
                                <div class="comment-text-sm"><span>{{ $comment->content }}.</span>
                                </div>
                                <div class="reply-section">
                                    <div class="d-flex flex-row align-items-center voting-icons"><i
                                            class="fa fa-sort-up fa-2x mt-3 hit-voting"></i><i
                                            class="fa fa-sort-down fa-2x mb-3 hit-voting"></i><span
                                            class="ml-2">10</span><span class="dot ml-2"></span>
                                        <h6 class="ml-2 mt-1">Reply</h6>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @else
        <h4 class="text-danger"> Bạn cần đăng nhập để đăng bài<a href="{{ route('login') }}">Đăng nhập</a></h4>
    @endif
    {{-- <div class="container mt-5 mb-5">
        <div class="d-flex justify-content-center row">
            <div class="d-flex flex-column col-md-12">
                <h3 class="fs-3 fw-bolder">Comment</h3>
                <div class="coment-bottom bg-white p-2 px-4">
                    <div class="d-flex flex-row add-comment-section mt-4 mb-4"><img
                            class="img-fluid img-responsive rounded-circle mr-2"
                            src="https://2.bp.blogspot.com/-gnXUMwRHkaI/WE1VCAktNhI/AAAAAAAAjfs/CZk6jUipKXgvOKc821Rnz-fwXT0QhLEuACEw/s1600/15085502_591915637681021_5420424684372040797_n.jpg"
                            width="38"><input type="text" class="form-control mr-3" placeholder="Add comment"><button
                            class="btn bg-success btn-primary" type="button">Comment</button>
                    </div>
                    <div class="commented-section mt-2">
                        <div class="d-flex flex-row align-items-center commented-user">
                            <img style="border-radius: 50%" class="rounded-circle"
                                src="https://2.bp.blogspot.com/-gnXUMwRHkaI/WE1VCAktNhI/AAAAAAAAjfs/CZk6jUipKXgvOKc821Rnz-fwXT0QhLEuACEw/s1600/15085502_591915637681021_5420424684372040797_n.jpg"
                                width="30">
                            <h5 class="mr-2">Corey oates</h5><span class="dot mb-1"></span><span class="mb-1 ml-2">4 hours
                                ago</span>
                        </div>
                        <div class="comment-text-sm"><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                                eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                                nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></div>
                        <div class="reply-section">
                            <div class="d-flex flex-row align-items-center voting-icons"><i
                                    class="fa fa-sort-up fa-2x mt-3 hit-voting"></i><i
                                    class="fa fa-sort-down fa-2x mb-3 hit-voting"></i><span class="ml-2">10</span><span
                                    class="dot ml-2"></span>
                                <h6 class="ml-2 mt-1">Reply</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
