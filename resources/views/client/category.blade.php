@extends('client.layouts.footer')
@extends('client.layouts.master')
@extends('client.layouts.header')
@section('content')
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
                <h3>{{ $item->title }}... <a href="{{ route('client.postDetail', $item->id) }}">Xem thêm</a></h3>
                <img src="../../../{{ $item->image }}" alt="">

            </div>
            <div class="post-reaction">
                <div class="activity-icons">
                    <div><img src="../../../client/images/like-blue.png" alt="">120</div>
                    <div><img src="../../../client/images/comments.png" alt="">52</div>
                    <div><img src="../../../client/images/share.png" alt="">35</div>
                </div>
                <div class="post-profile-picture">
                    <img src="../../../client/images/profile-pic.png " alt=""> <i class=" fas fa-caret-down"></i>
                </div>
            </div>
        </div>
    @endforeach
    <button type="button" class="btn-LoadMore" onclick="LoadMoreToggle()">Load More</button>
@endsection
