@php
    /** @var \Illuminate\Support\Collection|\App\Models\Category[] $categories */
    /** @var \App\Models\Post $post */
@endphp
@extends('layouts.admin', ['activeItem' => 'posts'])

@section('page_title', 'Izmeni objavu')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header">Izmeni objavu</div>
                    <div class="card-body">
                        <form action="{{ route('admin.posts.update', $post) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">Naslov</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="title" value="{{ $post->title }}" disabled>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-md-4 col-form-label text-md-right">Opis</label>

                                <div class="col-md-6">
                                    <textarea type="text" class="form-control" name="description"  disabled>{{ $post->description }}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="link" class="col-md-4 col-form-label text-md-right">Link/kontakt</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="link" value="{{ $post->link }}" disabled>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="tags" class="col-md-4 col-form-label text-md-right">Tagovi</label>

                                <div class="col-md-6">
                                    <input id="tags-output" type="hidden" name="tags" value="{{ old('tags') }}">
                                    <input id="tags-input" type="text" class="@error('tags') is-invalid @enderror"
                                           value="{{ old('tags', $post->tags->implode(' ')) }}" data-role="tagsinput">

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
                                                    @if (old('category_id', $post->category_id) == $category->id) selected @endif>{{ $category->name }}</option>
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
                                <button type="submit" class="btn btn-success mr-3">Izmeni</button>
                                <a href="{{ route('homepage') }}" class="btn btn-danger">Odustani</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
