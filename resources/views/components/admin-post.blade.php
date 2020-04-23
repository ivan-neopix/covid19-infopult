<div class="card flex-row w-100 mb-3">
    <div class="card-body">
        <h5 class="card-title justify-content-between">
            {{ $post->title }}
            <span class="float-right font-italic text-muted h6">{{ $post->created_at->format('d.m.Y H:i') }}</span>
        </h5>
        <h6 class="card-subtitle mb-2 text-muted">{{ $tags }}</h6>
        <p class="card-text with-line-breaks">{{ $post->description }}</p>
        @if($hasLink)
            <a href="{{ $post->link }}" class="card-link" target="_blank">Više informacija</a>
        @else
            <p class="card-text">Kontakt: {{ $post->link }}</p>
        @endif
    </div>
    @if($forAdmin)
        <div class="card-footer d-flex flex-column justify-content-center">
            @if($post->status === \App\Models\Post::STATUS_PENDING)
                <form action="{{ route('admin.posts.approve', $post) }}" method="POST" class="w-100">
                    @csrf
                    @method('PATCH')

                    <button type="submit" class="btn btn-success w-100 mb-2">Odobri</button>
                </form>
                <form action="{{ route('admin.posts.deny', $post) }}" method="POST" class="w-100">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger w-100 mb-2">Odbij</button>
                </form>
                <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-primary w-100">Izmeni</a>
            @else
                <span class="post-status-{{ $post->status }}">{{ __("post.status.{$post->status}") }}</span>
                <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-primary w-100 mt-2">Izmeni</a>
            @endif
        </div>
    @endif
</div>
