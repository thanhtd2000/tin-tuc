@extends('client.layouts.footer')
@extends('client.layouts.master')
@extends('client.layouts.header')
@section('content')
    <div class="user-profile-box">
        <div class="user-profile mb-3">
            <img src="../../../uploads/{{ $post_id->user->avatar }}" alt="">
            <div>
                <p>{{ $post_id->user->name }}</p>
                <small>{{ $post_id->created_at }}</small>
            </div>
        </div>
        <div>
            <a href="#"><i class="fas fa-ellipsis-v"></i></a>
        </div>
    </div>
    <div>
        <h4 class="text-danger">Danh mục > <a
                href="/category/{{ $post_id->category->id }}">{{ $post_id->category->category_name }}</a> >
            {{ $post_id->title }} </h4>
        <h1 class="fs-1 mb-3">{!! $post_id->title !!}</h1>
        <div class="content-post">
            <p>{!! $post_id->content !!}</p>
        </div>
    </div>
    <div class="container border-top mt-5 mb-5">
        <div class="d-flex justify-content-center row">
            <div class="d-flex flex-column col-md-12">
                <h3 class="fs-3 fw-bolder mt-5">
                    Comment({{ DB::table('comments')->Where('post_id', $post_id->id)->where('status', 1)->count() }})</h3>
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
                            <form action="{{ route('client.userComment') }}" method="POST" class="w-100">
                                @csrf
                                <input type="hidden" name="id" value="{{ $post_id->id }}">
                                <input type="hidden" name="status"
                                    value="{{ Auth::user()->role == 0 || Auth::user()->role == 3 ? 1 : 0 }}">
                                <input type="hidden" name="parent"
                                    value="{{ $post_id->user->id == Auth::id() ? 0 : 1 }}">
                                <input type="hidden" name="post_id" value="{{ $post_id->id }}">
                                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                <div class="d-flex flex-row add-comment-section mt-4 mb-4 w-100">
                                    <input type="text" name="content_comment" class="form-control flex-grow-1 mr-2"
                                        placeholder="Add comment">
                                    <button class="btn bg-success btn-success" type="submit">Comment</button>
                                </div>
                            </form>
                        </div>

                        @foreach ($comments as $key => $comment)
                            @if ($comment->parent_id == 0 && $comment->status == 1)
                                <div class="commented-section rounded bg-light mt-2">
                                    <div class="d-flex flex-row align-items-center commented-user">
                                        <img style="border-radius: 50%" class="rounded-circle"
                                            src="../../../uploads/{{ $comment->user->avatar }}" width="30">
                                        <h5 class="mr-2">{{ $comment->user->name }}</h5><span
                                            class="dot mb-1"></span><span
                                            class="mb-1 ml-2">{{ $comment->created_at }}</span>
                                    </div>
                                    <div class="comment-text-sm"><span>{{ $comment->content }}.</span>
                                        <div class="reply-section">
                                            <div class="d-flex flex-row align-items-center voting-icons">
                                                <button type="submit" onclick="toggleElement{{ $key + 1 }}()"><i
                                                        class="fa fa-sort-down fa-2x mb-3 hit-voting"></i></button>
                                                <span
                                                    class="ml-2">{{ DB::table('comments')->Where('parent_id', $comment->id)->where('status', 1)->count() }}</span><span
                                                    class="dot ml-2"></span>
                                                @if (Auth::user()->role == 0 || Auth::user()->role == $comment->user->role)
                                                    @if ($comment->user->role != 0 || Auth::id() == $comment->user->id)
                                                        <a href="{{ route('client.deleteComment', $comment->id) }}">
                                                            <button onclick=" return confirm('Bạn có chắc chắn xoá?')"
                                                                class="btn  bg-danger btn-success mr-3"
                                                                type="submit">xóa</button>
                                                        </a>
                                                    @endif
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
                                                        <input type="hidden" name="id" value="{{ $comment->id }}">
                                                        <input type="hidden" name="reply" value="1">
                                                        <input type="hidden" name="parent"
                                                            value="{{ $comment->user->id == Auth::id() ? 0 : 1 }}">
                                                        <input type="hidden" name="status"
                                                            value="{{ Auth::user()->role == 0 || Auth::user()->role == 3 ? 1 : 0 }}">
                                                        <input type="hidden" name="post_id" value="{{ $post_id->id }}">
                                                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
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
                                    <div id="cmt_child{{ $key + 1 }}" style="display: none">
                                        @foreach ($comments as $key => $value)
                                            @if ($value->parent_id == $comment->id && $value->status == 1)
                                                <div class="cmt-child ml-3 mt-2">
                                                    <div class="d-flex flex-row align-items-center commented-user ml-5">
                                                        <img style="border-radius: 50%" class="rounded-circle"
                                                            src="../../../uploads/{{ $value->user->avatar }}"
                                                            width="20">
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
                                                                    @if ($value->user->role != 0 || Auth::id() == $value->user->id)
                                                                        <a
                                                                            href="{{ route('client.deleteComment', $value->id) }}">
                                                                            <button
                                                                                onclick=" return confirm('Bạn có chắc chắn xoá?')"
                                                                                class="btn border-0  bg-light text-danger btn-success mr-3"
                                                                                type="submit">Xóa</button>
                                                                        </a>
                                                                    @endif
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    {{-- điều kiện k login --}}
                @else
                    <div class="container border-top mt-5 mb-5">
                        <div class="d-flex justify-content-center row">
                            @foreach ($comments as $key => $comment)
                                @if ($comment->parent_id == 0 && $comment->status == 1)
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

                                                    <button type="submit"
                                                        onclick="toggleElement{{ $key + 1 }}()"><i
                                                            class="fa fa-sort-down fa-2x mb-3 hit-voting"></i></button>
                                                    <span
                                                        class="ml-2">{{ DB::table('comments')->Where('parent_id', $comment->id)->where('status', 1)->count() }}</span><span
                                                        class="dot ml-2"></span>

                                                </div>
                                            </div>
                                        </div>
                                        <div id="cmt_child{{ $key + 1 }}" style="display: none">
                                            @foreach ($comments as $key => $value)
                                                @if ($value->parent_id == $comment->id && $value->status == 1)
                                                    <div class="cmt-child ml-3 mt-2">
                                                        <div
                                                            class="d-flex flex-row align-items-center commented-user ml-5">
                                                            <img style="border-radius: 50%" class="rounded-circle"
                                                                src="../../../uploads/{{ $value->user->avatar }}"
                                                                width="20">
                                                            <h5 class="mr-2">{{ $value->User->name }}</h5><span
                                                                class="dot mb-1"></span><span
                                                                class="mb-1 ml-2">{{ $value->created_at }}</span>
                                                        </div>
                                                        <div class="d-flex">
                                                            <div class="comment-text-sm ml-4 align-items-center">
                                                                <span>{{ $value->content }}.</span>

                                                            </div>
                                                        </div>

                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <h4 class="text-danger mt-4"> Bạn cần đăng nhập để đăng bài <a class="text-primary"
                            href="{{ route('login') }}">Đăng
                            nhập</a></h4>
                @endif
            </div>
        </div>
    </div>
    <div class="border-top">
        <hr>
        <h3 class="fs-3 fw-bolder mt-3 mb-5">Bài viết cùng chuyên mục</h3>
        @foreach ($post_categories as $item)
            <div class="d-flex row mt-2 mb-2">
                <div class="col-lg-4">
                    <img style="height: 200px; width: 100%;" src="../../../{{ $item->image }}" alt="ảnh không">
                </div>
                <div class="col-lg-8 border-bottom">
                    <p>{{ $item->title }}</p>
                    <a class="" href="{{ route('client.postDetail', $item->id) }}">
                        <p class="text-danger">
                            << Xem chi tiết>>
                        </p>
                    </a>
                </div>
            </div>
        @endforeach
        {{ $post_categories->links() }}
    </div>

    <script>
        @foreach ($comments as $key => $comment)

            @if ($comment->status == 1 && $comment->parent_id == 0)
                var replyForm{{ $key + 1 }} = document.getElementById('replyform{{ $key + 1 }}');
                var reply_button{{ $key + 1 }} = document.getElementById('replycmt{{ $key + 1 }}')
                reply_button{{ $key + 1 }}.addEventListener('click', function(event) {
                    replyForm{{ $key + 1 }}.style.display = 'block';
                    reply_button{{ $key + 1 }}.style.display = 'none';
                });
            @endif
        @endforeach ;
        @foreach ($comments as $key => $comment)
            @if ($comment->status == 1)
                function toggleElement{{ $key + 1 }}() {
                    var element{{ $key + 1 }} = document.getElementById("cmt_child{{ $key + 1 }}");
                    if (element{{ $key + 1 }}.style.display == "none") {
                        element{{ $key + 1 }}.style.display = "block";
                    } else {
                        element{{ $key + 1 }}.style.display = "none";
                    }
                }
            @endif
        @endforeach ;
    </script>

@endsection
