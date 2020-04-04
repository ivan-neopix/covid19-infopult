@php
    /** @var \Illuminate\Pagination\LengthAwarePaginator|\App\Models\Category[] $categories */
@endphp
@extends('layouts.admin')

@section('page_title', 'Kategorije')

@section('content')
    <div class="container">
        <div class="h1 text-center">
            Kategorije
        </div>

        <div class="row mt-5 justify-content-end">
            <a class="btn btn-primary" href="{{ route('admin.categories.create') }}">Dodaj kategoriju</a>
        </div>
        <div class="row mt-2 justify-content-center">
            <div class="card w-75">
                <ul class="list-group list-group-flush">
                    @foreach($categories as $category)
                        <li class="list-group-item justify-content-between d-flex">
                            <a class="card-link" href="{{ route('admin.categories.edit', $category) }}">{{ $category->name }}</a>
                            <a class="btn btn-danger" href="{{ route('admin.categories.destroy', $category) }}">Izbriši</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="row mt-2 justify-content-center">
            {{ $categories->links() }}
        </div>
    </div>
@endsection

