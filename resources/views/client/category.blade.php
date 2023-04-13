@extends('client.layouts.footer')
@extends('client.layouts.master')
@extends('client.layouts.header')
@section('content')
    <div class="text-center text-danger">
        <h3 class="fs-1 fst-"> Danh mục {{ $category_name }}</h3>
    </div>

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
                                <button type="submit" class="btn btn-link">
                                    <i class="fa fa-heart{{ Auth::user()->hasLikedPost($item) ? '' : '-o' }}"></i>
                                    {{ $item->likesCount() }}
                                </button>
                            </form>
                        </div>
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
@endsection
