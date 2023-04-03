@extends('client.layouts.footer')
@extends('client.layouts.master')
@extends('client.layouts.header')
@section('content')
    <h1 class="fs-2">Kết quả tìm kiếm</h1>
    @foreach ($search_posts as $search_post)
        <div class="d-flex row mt-2">
            <div class="col-lg-4">
                <img src="../../../{{ $search_post->image }}" alt="ảnh không">
            </div>
            <div class="col-lg-8 border-bottom">
                <p>{{ $search_post->title }}</p>
                <a class="" href="{{ route('client.postDetail', $search_post->id) }}">
                    <p class="text-danger">
                        << Xem chi tiết>>
                    </p>
                </a>
            </div>
        </div>
    @endforeach
@endsection
