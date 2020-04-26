<article class="card">
    <header class="card__header">
        <h1 class="card__title">
            @if($hasLink)
                <a href="{{ $post->link }}" target="_blank" rel="nofollow noopener">
            @endif
            {{ $post->title }}
            @if($hasLink)
                <svg class="icon"><use xlink:href="#i-external-link"></use></svg>
                </a>
            @endif
        </h1>
        <a href="{{ route('homepage', ['category' => $post->category->slud ]) }}#rezultati" class="badge {{ $post->category->slug }}">
            <span>{{ $post->category->name }}</span>
            <span class="badge__icon">
                {!! $post->category->image_contents !!}
            </span>
        </a>
    </header>

    <div class="card__content">
        <p>{{ $post->description }}</p>
        @if(!$hasLink)
            <p class="card-text">Kontakt: {{ $post->link }}</p>
        @endif
    </div>

    <footer class="card__footer">
        <div class="tags">
            @foreach($tags as $tag)
                <a href="{{ route('homepage', ['tags' => $tag->name ]) }}#rezultati" class="tags__link">#{{ $tag->name }}</a>
            @endforeach
        </div>
        <time datetime="{{ $post->created_at->format(DATE_W3C) }}">{{ $post->created_at->format('d.m.Y H:i') }}</time>
    </footer>
</article>
