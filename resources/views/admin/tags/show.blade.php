@php
    /** @var \App\Models\Tag $tag */
    /** @var \Illuminate\Pagination\LengthAwarePaginator|\App\Models\Post[] $posts */
    /** @var int $postsCount */
@endphp
@extends('layouts.admin', ['activeItem' => 'tags'])

@section('page_title', $tag->name)

@section('content')
    <div class="container">
        <div class="h1 text-center">
            #{{ $tag->name }}
        </div>

        <div class="row mt-5 justify-content-center">
            <div class="h1 text-center">
                Postovi ({{ $postsCount }})
            </div>
        </div>

        <div class="row mt-3">
            @foreach($posts as $post)
                <x-post :post="$post" :forAdmin="true"/>
            @endforeach
        </div>

        <div class="row mt-2">
            {{ $posts->links() }}
        </div>
    </div>
@endsection

