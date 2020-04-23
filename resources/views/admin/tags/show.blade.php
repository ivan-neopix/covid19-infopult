@php
    /** @var \App\Models\Tag $tag */
    /** @var \Illuminate\Pagination\LengthAwarePaginator|\App\Models\Post[] $posts */
    /** @var int $postsCount */
@endphp
@extends('layouts.admin', ['activeItem' => 'tags'])

@section('page_title', $tag->name)

@section('content')
    <div class="container">
        <div class="h1 text-center mb-3">
            #{{ $tag->name }}
        </div>

        <div class="card">
            <div class="card-header">Postovi ({{ $postsCount }})</div>

            <div class="card-body">
                @foreach($posts as $post)
                    <x-admin-post :post="$post" :forAdmin="true"/>
                @endforeach
            </div>

            <div class="row mt-2">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection

