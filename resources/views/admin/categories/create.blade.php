@php
    /** @var \App\Models\Category $category */
@endphp
@extends('layouts.admin', ['activeItem' => 'categories'])

@section('page_title', 'Dodaj kategoriju')

@section('content')
    <div class="container">
        <div class="h1 text-center">
            Dodaj kategoriju
        </div>

        <div class="row mt-5 justify-content-center">
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf

                @include('admin.categories.partials.fields')

                <button type="submit" class="btn btn-success">Dodaj</button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-danger">Odustani</a>
            </form>
        </div>
    </div>
@endsection

