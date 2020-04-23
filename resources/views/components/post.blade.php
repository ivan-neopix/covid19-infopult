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
        <span class="badge">
            <span>{{ $post->category->name }}</span>
            <span class="badge__icon">
                 <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28" class="icon"><path d="M8.167 25.083a3.5 3.5 0 113.3-4.666h1.95V7.587L2.333 7.582a1.167 1.167 0 010-2.333H14c.953 0 1.751.742 1.751 1.718V8.75h5.837c.642 0 1.305.499 1.483 1.118l1.347 4.715h1.25c.644 0 1.166.524 1.166 1.17v5.827a1.17 1.17 0 01-1.167 1.17h-1.365a3.501 3.501 0 01-6.602 0h-6.231a3.501 3.501 0 01-3.301 2.333zm12.833-7c1.524 0 2.82.974 3.3 2.334h.2v-3.508l-8.75.009.006 3.499h1.943A3.501 3.501 0 0121 18.083zm1-3.5l-.994-3.5H15.75v3.5H22zM4.666 15.75c0-.644.52-1.167 1.168-1.167h5.247a1.166 1.166 0 110 2.333H5.835a1.165 1.165 0 01-1.168-1.166zm-1.75-4.667c0-.644.521-1.166 1.163-1.166h7.007c.642 0 1.163.518 1.163 1.166 0 .645-.522 1.167-1.163 1.167H4.08a1.162 1.162 0 01-1.163-1.167zM21 22.75a1.167 1.167 0 100-2.333 1.167 1.167 0 000 2.333zm-12.833 0a1.167 1.167 0 100-2.333 1.167 1.167 0 000 2.333z"/></svg>
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
