<div class="card w-100 mb-3">
    <div class="card-body">
        <h5 class="card-title justify-content-between">
            {{ $post->title }}
            <span class="float-right font-italic text-muted h6">{{ $post->created_at->format('d.m.Y H:i') }}</span>
        </h5>
        <h6 class="card-subtitle mb-2 text-muted">{{ $tags }}</h6>
        <p class="card-text">{{ $post->description }}</p>
        @if($hasLink)
            <a href="{{ $post->link }}" class="card-link">Više informacija</a>
        @else
            <p class="card-text">Kontakt: {{ $post->link }}</p>
        @endif
    </div>
</div>
