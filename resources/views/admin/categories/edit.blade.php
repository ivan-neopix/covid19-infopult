@php
    /** @var \App\Models\Category $category */
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
    </div>
@endsection

