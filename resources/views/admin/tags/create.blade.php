@php
    /** @var \App\Models\Tag $tag */
@endphp
@extends('layouts.admin', ['activeItem' => 'tags'])

@section('page_title', 'Dodaj tag')

@section('content')
    <div class="container">
        <div class="h1 text-center">
            Dodaj tag
        </div>

        <div class="row mt-5 justify-content-center">
            <form action="{{ route('admin.tags.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="name">Ime taga</label>
                    <input type="text"
                           name="name"
                           class="form-control"
                           id="name"
                           value="{{ old('name', $tag->name)}}"
                           autofocus
                    >
                    @error('name')<label class="error-message" for="name">{{ $message }}</label>@enderror
                </div>

                <button type="submit" class="btn btn-success">Dodaj</button>
                <a href="{{ route('admin.tags.index') }}" class="btn btn-danger">Odustani</a>
            </form>
        </div>
    </div>
@endsection

