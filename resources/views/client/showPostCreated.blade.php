@extends('client.layouts.footer')
@extends('client.layouts.master')
@extends('client.layouts.header')
@section('content')
    <h1 class="fs-2 m-4">Các bài viết của bạn</h1>

    <div class="message text-center">
        @if (session('message'))
            <h4 class="aler alert-danger pt-3 pb-3">
                <strong class="text-danger">{{ session('message') }}</strong>
            </h4>
        @endif
    </div>
    @foreach ($postCreateds as $item)
        <div class="d-flex row mt-2">
            <div class="col-lg-4">
                <img src="../../../{{ $item->image }}" alt="ảnh không">
            </div>
            <div class="col-lg-8 border-bottom">
                <p>{{ $item->title }}</p>
                <a class="" href="{{ route('client.postDetail', $item->id) }}">
                    <p class="text-danger">
                        << Xem chi tiết>>
                    </p>

                </a>
                <a href="{{ route('client.editPostCreated', $item->id) }}">
                    <button class="bg-warning  border-0 rounded p-1 ">Sửa bài viết</button>
                </a>
                <a onclick=" return confirm('Bạn có chắc chắn xoá ?')"
                    href="{{ route('client.deletePostCreated', ['id' => $item->id]) }}">
                    <button class="bg-danger  border-0 rounded p-1 ">Xóa bài viết</button>
                </a>

            </div>
        </div>
    @endforeach
@endsection
