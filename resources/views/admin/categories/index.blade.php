@php
    /** @var \Illuminate\Pagination\LengthAwarePaginator|\App\Models\Category[] $categories */
@endphp
@extends('layouts.admin', ['activeItem' => 'categories'])

@section('page_title', 'Kategorije')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Kategorije
                <a class="float-right" href="{{ route('admin.categories.create') }}">Dodaj kategoriju</a>
            </div>

            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @foreach($categories as $category)
                        <li class="list-group-item justify-content-between d-flex align-items-center">
                            <a class="card-link"
                               href="{{ route('admin.categories.edit', $category) }}">{{ $category->name }}
                                ({{ $category->posts_count }})</a>
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="position-absolute">
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
                                data-target="#delete-{{ $category->id }}-modal">Izbriši
                            </button>
                        </li>
                    @endforeach
                </ul>

                <div class="row mt-2 justify-content-center">
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

