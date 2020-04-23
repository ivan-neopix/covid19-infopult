<article class="card">
    <header class="card__header">
        <h1 class="card__title">
            @if($hasLink)
                <a href="{{ $post->link }}" target="_blank" rel="nofollow noopener">
            @endif
            {{ $post->title }}
            @if($hasLink)
                </a>
            @endif
        </h1>
        <span class="badge {{ $post->category->slug }}">
            <span>{{ $post->category->name }}</span>
            <span class="badge__icon">
                {!! $post->category->image_contents !!}
            </span>
        </span>
    </header>

    <div class="card__content">
        <p>{{ $post->description }}</p>
        @if(!$hasLink)
            <p class="card-text">Kontakt: {{ $post->link }}</p>
        @endif
    </div>

    <footer class="card__footer">
        <div>{{ $tags }}</div>
        <time datetime="{{ $post->created_at->format(DATE_W3C) }}">{{ $post->created_at->format('d.m.Y H:i') }}</time>
    </footer>
</article>
