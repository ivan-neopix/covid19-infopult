@php
    /** @var \Illuminate\Pagination\LengthAwarePaginator|\App\Models\Tag[] $tags */
    /** @var string $searchTerm */
@endphp
@extends('layouts.admin')

@section('page_title', 'Tagovi')

@section('content')
    <div class="container">
        <div class="h1 text-center">
            Tagovi
        </div>

        <form action="{{ route('admin.tags.index') }}" method="GET">
            <div class="form-group row mt-5">
                <div class="col-9">
                    <input type="text" name="search" class="form-control" value="{{ $searchTerm }}">
                </div>
                <div class="col-3">
                    <button type="submit" class="btn btn-primary">Pretraži</button>
                </div>
            </div>
        </form>

        <div class="row mt-2 justify-content-end">
            @if(!empty($searchTerm))
                <a href="{{ route('admin.tags.index') }}" class="btn btn-primary mr-2">Prikaži sve</a>
            @endif
            <a href="{{ route('admin.tags.create') }}" class="btn btn-primary">Dodaj tag</a>
        </div>

        <div class="row mt-2 justify-content-center">
            @foreach($tags as $tag)
                <div class="card mr-2 mb-2">
                    <li class="list-group-item justify-content-between d-flex">
                        <a class="card-link" href="{{ route('admin.tags.show', $tag) }}">#{{ $tag->name }}</a>
                    </li>
                </div>
            @endforeach
        </div>

        <div class="row mt-2 justify-content-center">
            {{ $tags->links() }}
        </div>
    </div>
@endsection

