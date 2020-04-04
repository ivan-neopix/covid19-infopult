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
            <div class="card w-100">
                <ul class="list-group list-group-flush">
                    @foreach($categories as $category)
                        <li class="list-group-item justify-content-between d-flex">
                            <a class="card-link" href="{{ route('admin.categories.edit', $category) }}">{{ $category->name }} ({{ $category->posts_count }})</a>
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                @include('partials.confirm-modal', [
                                    'name' => "delete-{$category->id}-modal",
                                    'title' => 'Izbriši kategoriju',
                                    'text' => "Potvrdi brisanje kategorije {$category->name}",
                                ])
                            </form>
                            <button
                                type="button"
                                class="btn btn-danger"
                                data-toggle="modal"
                                data-target="#delete-{{ $category->id }}-modal">Izbriši</button>
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

