@php
    /** @var \Illuminate\Pagination\LengthAwarePaginator|\App\Models\Tag[] $tags */
    /** @var string $searchTerm */
@endphp
@extends('layouts.admin', ['activeItem' => 'tags'])

@section('page_title', 'Tagovi')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Tagovi
                <a href="{{ route('admin.tags.create') }}" class="float-right">Dodaj tag</a>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.tags.index') }}" method="GET" class="form-group row">
                    <div class="col-6">
                        <input type="text" name="search" class="form-control" value="{{ $searchTerm }}">
                    </div>
                    <div class="col-6">
                        <button type="submit" class="btn btn-primary">Pretraži</button>
                        @if(!empty($searchTerm))
                            <a href="{{ route('admin.tags.index') }}" class="ml-3">Prikaži sve</a>
                        @endif
                    </div>
                </form>

                <div class="mt-2 justify-content-start">
                    <ul class="list-group flex-row">
                        @foreach($tags as $tag)
                            <li class="list-group-item d-inline-flex justify-content-between align-items-center mr-2 mb-2">
                                <a class="card-link" href="{{ route('admin.tags.show', $tag) }}">#{{ $tag->name }}</a>
                                <span class="badge badge-primary badge-pill ml-3">{{ $tag->posts_count }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="row mt-2 justify-content-center">
                    {{ $tags->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

