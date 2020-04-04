@php
    /** @var \App\Models\Category $category */
    /** @var \Illuminate\Pagination\LengthAwarePaginator|\App\Models\Post[] $posts */
    /** @var int $postsCount */
@endphp
@extends('layouts.admin')

@section('page_title', $category->name)

@section('content')
    <div class="container">
        <div class="h1 text-center">
            {{ $category->name }}
        </div>

        <div class="row mt-5 justify-content-center">
            <form action="{{ route('admin.categories.update', $category) }}" method="POST">
                @csrf
                @method('PUT')

                @include('admin.categories.partials.fields')

                <button type="submit" class="btn btn-success">Izmeni</button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-danger">Odustani</a>
            </form>
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

