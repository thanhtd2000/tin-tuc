@extends('client.layouts.footer')
@extends('client.layouts.master')
@extends('client.layouts.header')
@section('content')
    <div class="w-100">
        <h1 class="fs-1 m-2">Sửa bài viết</h1>
        <form class="col-md-12" action="{{ route('client.updatePostCreated', $post_created->id) }}" method="post"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{ $post_created->id }}">
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <input type="hidden" name="status" value="{{ Auth::user()->role == 0 ? 0 : 1 }}">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Tiêu đề</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="title"
                    aria-describedby="emailHelp" value="{{ $post_created->title }}">
            </div>
            <div class="error">
                @if ($errors->has('title'))
                    <span class="text-danger fs-5">
                        {{ $errors->first('title') }}
                    </span>
                @endif
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nội dung</label>
                <textarea name="content" id="editor">{{ $post_created->content }}</textarea>
            </div>
            <div class="error">
                @if ($errors->has('content'))
                    <span class="text-danger fs-5">
                        {{ $errors->first('content') }}
                    </span>
                @endif
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Ảnh</label>
                <input type="file" class="form-control" id="exampleInputEmail1" name="image"
                    aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">Thêm ảnh hiển thị đại diện</div>
            </div>
            <div class="error">
                @if ($errors->has('image'))
                    <span class="text-danger fs-5">
                        {{ $errors->first('image') }}
                    </span>
                @endif
            </div>
            <select class="form-select" name="categories_id" aria-label="Default select example">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                @endforeach
            </select>
            <div class="error">
                @if ($errors->has('categories_id'))
                    <span class="text-danger fs-5">
                        {{ $errors->first('categories_id') }}
                    </span>
                @endif
            </div>
            <br>

            <button type="submit" class="btn btn-primary">Sửa</button>
        </form>
    </div>
@endsection
