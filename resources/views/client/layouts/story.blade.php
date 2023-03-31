<div class="story-gallery">
    @foreach ($posts as $Key => $post)
        <div class="story story{{ $Key + 1 }}">
            <img src="/{{ $post->image }}" alt="">
        </div>
    @endforeach

</div>
