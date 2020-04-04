@php
    /** @var \Illuminate\Pagination\LengthAwarePaginator|\App\Models\Post[] $posts */
@endphp
@extends('layouts.admin')

@section('page_title', 'Postovi')

@section('content')
    <div class="container">
        <div class="h1 text-center">
            Postovi
        </div>

        <form action="{{ route('admin.posts.index') }}" method="GET">
            <div class="form-group row mt-5">
                <div class="col-9">
                    <input type="text" name="search" class="form-control" value="{{ $searchTerm }}">
                </div>
                <div class="col-3">
                    <button type="submit" class="btn btn-primary">Pretraži</button>
                </div>
            </div>
        </form>

        @if(!empty($searchTerm))
            <div class="row mt-2 justify-content-end">
                <a href="{{ route('admin.posts.index') }}" class="btn btn-primary mr-2">Prikaži sve</a>
            </div>
        @endif

        <div class="row mt-2 justify-content-center">
            @foreach($posts as $post)
                <x-post :post="$post"/>
            @endforeach
        </div>

        <div class="row mt-2 justify-content-center">
            {{ $posts->links() }}
        </div>
    </div>
@endsection

