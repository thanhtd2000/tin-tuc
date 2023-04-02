@extends('client.layouts.footer')
@extends('client.layouts.master')
@extends('client.layouts.header')
@section('content')
    <div>
        <h1 class="fs-1 m-3">{!! $post_id->title !!}</h1>
        <div class="content-post">
            <p>{!! $post_id->content !!}</p>
        </div>
    </div>

    <div class="container border-top mt-5 mb-5">
        <div class="d-flex justify-content-center row">
            <div class="d-flex flex-column col-md-12">
                <h3 class="fs-3 fw-bolder mt-5">
                    Comment({{ DB::table('comments')->Where('post_id', $post_id->id)->count() }})</h3>
                <div class="message text-center">
                    @if (session('message'))
                        <h4 class="aler alert-success pt-3 pb-3">
                            <strong>{{ session('message') }}</strong>
                        </h4>
                    @endif
                </div>
                @if (Auth::check())
                    <div class="coment-bottom bg-white p-2 px-4">
                        <div class="d-flex w-100">
                            <img style="width: 50px;
                            height: 50px;
                            object-fit: cover;
                            border-radius: 50%;"
                                class="img-fluid align-self-center img-responsive rounded-circle mr-2 img-small"
                                src="/uploads/{{ Auth::user()->avatar }}" alt="avatar">
                            <form action="{{ route('client.userComment', $post_id->id) }}" method="POST" class="w-100">
                                @csrf
                                <input type="hidden" name="post_id" value="{{ $post_id->id }}">
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <div class="d-flex flex-row add-comment-section mt-4 mb-4 w-100">
                                    <input type="text" name="content_comment" class="form-control flex-grow-1 mr-2"
                                        placeholder="Add comment">
                                    <button class="btn bg-success btn-success" type="submit">Comment</button>
                                </div>
                            </form>
                        </div>

                        @foreach ($comments as $key => $comment)
                            @if ($comment->parent_id == 0)
                                <div class="commented-section rounded bg-light mt-2">
                                    <div class="d-flex flex-row align-items-center commented-user">
                                        <img style="border-radius: 50%" class="rounded-circle"
                                            src="../../../uploads/{{ $comment->user->avatar }}" width="30">
                                        <h5 class="mr-2">{{ $comment->User->name }}</h5><span
                                            class="dot mb-1"></span><span
                                            class="mb-1 ml-2">{{ $comment->created_at }}</span>
                                    </div>
                                    <div class="comment-text-sm"><span>{{ $comment->content }}.</span>
                                        <div class="reply-section">
                                            <div class="d-flex flex-row align-items-center voting-icons">
                                                <i class="fa fa-sort-up fa-2x mt-3 hit-voting"></i>
                                                <i class="fa fa-sort-down fa-2x mb-3 hit-voting"></i><span
                                                    class="ml-2">{{ DB::table('comments')->Where('parent_id', $comment->id)->count() }}</span><span
                                                    class="dot ml-2"></span>
                                                @if (Auth::user()->role == 0 || Auth::user()->role == $comment->user->role)
                                                    <a href="{{ route('client.deleteComment', $comment->id) }}">
                                                        <button onclick=" return confirm('Bạn có chắc chắn xoá?')"
                                                            class="btn  bg-danger btn-success mr-3"
                                                            type="submit">xóa</button>
                                                        <button onclick=" return confirm('Bạn có chắc chắn xoá?')"
                                                            class="btn  bg-warning btn-success mr-3"
                                                            type="submit">sửa</button>
                                                    </a>
                                                @endif
                                                <div id="replycmt{{ $key + 1 }}">
                                                    <button type="submit" class="  btn bg-success btn-success">Trả
                                                        lời</button>
                                                </div>

                                                <div id="replyform{{ $key + 1 }}" class="reply_comment_form"
                                                    style="display: none">
                                                    <form action="{{ route('client.userComment', $comment->id) }}"
                                                        method="POST" class="w-100">
                                                        @csrf
                                                        <input type="hidden" name="post_id" value="{{ $post_id->id }}">
                                                        <input type="hidden" name="user_id"
                                                            value="{{ Auth::user()->id }}">
                                                        <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                                        <div class="d-flex flex-row add-comment-section mt-4 mb-4 w-100">
                                                            <input type="text" name="content_comment"
                                                                class="form-control flex-grow-1 mr-2"
                                                                placeholder="Phản hồi ">
                                                            <button
                                                                class="reply_comment_complete btn bg-success btn-success"
                                                                type="submit">Gửi</button>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    @foreach ($comments as $key => $value)
                                        @if ($value->parent_id == $comment->id)
                                            <div class="cmt-child ml-3 mt-2">
                                                <div class="d-flex flex-row align-items-center commented-user ml-5">
                                                    <img style="border-radius: 50%" class="rounded-circle"
                                                        src="../../../uploads/{{ $value->user->avatar }}" width="20">
                                                    <h5 class="mr-2">{{ $value->User->name }}</h5><span
                                                        class="dot mb-1"></span><span
                                                        class="mb-1 ml-2">{{ $value->created_at }}</span>
                                                </div>
                                                <div class="d-flex">
                                                    <div class="comment-text-sm ml-4 align-items-center">
                                                        <span>{{ $value->content }}.</span>

                                                    </div>
                                                    <div class="reply-section pt-0">
                                                        <div class="  ">
                                                            @if (Auth::user()->role == 0 || Auth::user()->role == $value->user->role)
                                                                <a href="{{ route('client.deleteComment', $value->id) }}">
                                                                    <button
                                                                        onclick=" return confirm('Bạn có chắc chắn xoá?')"
                                                                        class="btn border-0  bg-light text-danger btn-success mr-3"
                                                                        type="submit">Xóa</button>
                                                                    <button
                                                                        onclick=" return confirm('Bạn có chắc chắn xoá?')"
                                                                        class="btn text-warning bg-light btn-success mr-3"
                                                                        type="submit">sửa</button>
                                                                </a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        @endif
                                    @endforeach


                                </div>
                            @endif
                        @endforeach
                    </div>


            </div>
        </div>
    </div>
@else
    <h3 class="fs-3 fw-bolder">Comment</h3>
    @foreach ($comments as $comment)
        <div class="commented-section rounded bg-light mt-2">
            <div class="d-flex flex-row align-items-center commented-user">
                <img style="border-radius: 50%" class="rounded-circle"
                    src="../../../uploads/{{ $comment->user->avatar }}" width="30">
                <h5 class="mr-2">{{ $comment->User->name }}</h5><span class="dot mb-1"></span><span
                    class="mb-1 ml-2">{{ $comment->created_at }}</span>
            </div>

            <div class="comment-text-sm"><span>{{ $comment->content }}.</span>
            </div>

        </div>
    @endforeach
    <h4 class="text-danger"> Bạn cần đăng nhập để đăng bài<a href="{{ route('login') }}">Đăng nhập</a></h4>
    @endif

    <script>
        @foreach ($comments as $key => $comment)

            var replyForm{{ $key + 1 }} = document.getElementById('replyform{{ $key + 1 }}');
            var reply_button{{ $key + 1 }} = document.getElementById('replycmt{{ $key + 1 }}')
            reply_button{{ $key + 1 }}.addEventListener('click', function(event) {
                replyForm{{ $key + 1 }}.style.display = 'block';
                reply_button{{ $key + 1 }}.style.display = 'none';
            });
        @endforeach
    </script>

@endsection
