@php
    /** @var \Illuminate\Support\Collection|\App\Models\Category[] $categories */
@endphp
@extends('layouts.web')

@section('page_title', 'Dodajte objavu')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header">Dodajte objavu</div>
                    <div class="card-body">
                        <form action="{{ route('posts.store') }}" method="POST">
                            @csrf

                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">Naslov</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                           name="title" value="{{ old('title') }}" autofocus>

                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-md-4 col-form-label text-md-right">Opis</label>

                                <div class="col-md-6">
                                    <textarea type="text"
                                              class="form-control @error('description') is-invalid @enderror"
                                              name="description"
                                              value="{{ old('description') }}">{{ old('description') }}</textarea>

                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="link" class="col-md-4 col-form-label text-md-right">Link/kontakt</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control @error('link') is-invalid @enderror"
                                           name="link" value="{{ old('link') }}">

                                    @error('link')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="tags" class="col-md-4 col-form-label text-md-right">Tagovi</label>

                                <div class="col-md-6">
                                    <input id="tags-output" type="hidden" name="tags" value="{{ old('tags') }}">
                                    <input id="tags-input" type="text" class="@error('tags') is-invalid @enderror"
                                           value="{{ old('tags') }}" data-role="tagsinput">

                                    @error('tags')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <div id="tags-autocomplete"></div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="category_id"
                                       class="col-md-4 col-form-label text-md-right">Kategorija</label>

                                <div class="col-md-6">
                                    <select name="category_id"
                                            class="form-control @error('category_id') is-invalid @enderror">
                                        <option value="" disabled selected>Odaberite kategoriju</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                    @if (old('category_id') == $category->id) selected @endif>{{ $category->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('category_id')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row justify-content-center mt-4">
                                <button type="submit" class="btn btn-success mr-3">Objavite</button>
                                <a href="{{ route('homepage') }}" class="btn btn-danger">Odustanite</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
