@php
    /** @var \Illuminate\Support\Collection|\App\Models\Category[] $categories */
@endphp
@extends('layouts.create')

@section('page_title', 'Dodajte objavu')

@section('content')
    <div class="container">
        <h2 class="heading-line">Dodajte objavu</h2>

        <form action="{{ route('posts.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="title">Nasov</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror"
                       name="title" value="{{ old('title') }}" id="title" autofocus>

                @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Opis</label>
                <textarea type="text"
                          id="description"
                          class="form-control @error('description') is-invalid @enderror"
                          name="description"
                          value="{{ old('description') }}">{{ old('description') }}</textarea>

                @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="link">Link/kontakt</label>
                <input type="text" id="link" class="form-control @error('link') is-invalid @enderror"
                       name="link" value="{{ old('link') }}">

                @error('link')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="tags-input">Tagovi</label>
                <input id="tags-output" type="hidden" name="tags" value="{{ old('tags') }}">
                <input id="tags-input" type="text" class="@error('tags') is-invalid @enderror"
                       value="{{ old('tags') }}" data-role="tagsinput" data-type="create">

                @error('tags')
                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                @enderror

                <div id="tags-autocomplete"></div>
            </div>

            <div class="form-group">
                <label for="category">Kategorija</label>
                <select name="category_id"
                        id="category"
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

            <div class="form__footer">
                <a href="{{ route('homepage') }}" class="button button--clear">Odustanite</a>
                <button type="submit" class="button">Objavite</button>
            </div>
        </form>
    </div>

    <script type="text/javascript">
        ALGOLIA_APP_ID = `<?php echo env('ALGOLIA_APP_ID', '') ?>`;
        ALGOLIA_PUBLIC_SECRET = `<?php echo env('ALGOLIA_PUBLIC_SECRET', '') ?>`;
    </script>
@endsection
