@extends('admin.layouts.footer')
@extends('admin.layouts.master')
@extends('admin.layouts.header')
@section('content')
    <form class="col-md-6" action="{{ route('category-update') }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $category->id }}">
        <div class="mb-3">

            <label for="exampleInputEmail1" class="form-label">Tên chuyên mục</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="name"
                value="{{ $category->category_name }}" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">Sửa tên chuyên mục hiển thị menu</div>
        </div>
        <div class="error">
            @if ($errors->has('name'))
                <span class="text-danger fs-5">
                    {{ $errors->first('name') }}
                </span>
            @endif
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Ảnh</label>
            <input type="file" class="form-control" id="exampleInputEmail1" name="image" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">Thêm ảnh hiển thị đại diện</div>
        </div>
        <div class="error">
            @if ($errors->has('image'))
                <span class="text-danger fs-5">
                    {{ $errors->first('image') }}
                </span>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Sửa</button>
    </form>
@endsection
