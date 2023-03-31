<div id="post_an_article" style="display:none">
    <form action="{{ route('user_post') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        <input type="hidden" name="status" value="{{ Auth::user()->role == 0 || Auth::user()->role == 3 ? 1 : 0 }}">
        <div class="post-upload-textarea">
            <div class="title">
                <input width="300px" name="title" class="mb-3 w-100 border-0" value="{{ old('title') }}"
                    type="text" placeholder="Tiêu đề">
            </div>
            <div class="error">
                @if ($errors->has('title'))
                    <span class="text-danger fs-5">
                        {{ $errors->first('title') }}
                    </span>
                @endif
            </div>
            <div class="mb-2">
                <label class="d-block mt-2" for="">Ảnh</label>
                <input type="file" name="image">
            </div>
            <div class="error">
                @if ($errors->has('image'))
                    <span class="text-danger fs-5">
                        {{ $errors->first('image') }}
                    </span>
                @endif
            </div>
            <textarea name="content" id="content" value="{{ old('content') }}" placeholder="What's on your mind, Alex?"
                cols="20" rows="1"></textarea>
            <div class="error">
                @if ($errors->has('content'))
                    <span class="text-danger fs-5">
                        {{ $errors->first('content') }}
                    </span>
                @endif
            </div>
            <select class="form-select mt-3" name="categories_id" aria-label="Default select example">
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
            <div class="add-post">
                <button class="btn text-white mt-3 bg-success border-0 rounded">Đăng</button>
            </div>
        </div>
    </form>
    <div id="cancel_post" class="cancel-post d-flex justify-content-between">
        <button class="btn text-white mt-3 bg-danger border-0 rounded">Hủy</button>
    </div>
</div>
