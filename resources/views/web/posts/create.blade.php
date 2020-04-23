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


            <button type="submit" class="button">Objavite</button>
            <a href="{{ route('homepage') }}" class="btn btn-danger">Odustanite</a>
        </form>
    </div>


{{--    <div class="container">--}}
{{--        <div class="row justify-content-center">--}}
{{--            <div class="col-sm-8">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-header">Dodajte objavu</div>--}}
{{--                    <div class="card-body">--}}
{{--                        <form action="{{ route('posts.store') }}" method="POST">--}}
{{--                            @csrf--}}

{{--                            <div class="form-group row">--}}
{{--                                <label for="title" class="col-md-4 col-form-label text-md-right">Naslov</label>--}}

{{--                                <div class="col-md-6">--}}
{{--                                    <input type="text" class="form-control @error('title') is-invalid @enderror"--}}
{{--                                           name="title" value="{{ old('title') }}" autofocus>--}}

{{--                                    @error('title')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="form-group row">--}}
{{--                                <label for="description" class="col-md-4 col-form-label text-md-right">Opis</label>--}}

{{--                                <div class="col-md-6">--}}
{{--                                    <textarea type="text"--}}
{{--                                              class="form-control @error('description') is-invalid @enderror"--}}
{{--                                              name="description"--}}
{{--                                              value="{{ old('description') }}">{{ old('description') }}</textarea>--}}

{{--                                    @error('description')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="form-group row">--}}
{{--                                <label for="link" class="col-md-4 col-form-label text-md-right">Link/kontakt</label>--}}

{{--                                <div class="col-md-6">--}}
{{--                                    <input type="text" class="form-control @error('link') is-invalid @enderror"--}}
{{--                                           name="link" value="{{ old('link') }}">--}}

{{--                                    @error('link')--}}
{{--                                        <span class="invalid-feedback" role="alert">--}}
{{--                                            <strong>{{ $message }}</strong>--}}
{{--                                        </span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="form-group row">--}}
{{--                                <label for="tags" class="col-md-4 col-form-label text-md-right">Tagovi</label>--}}

{{--                                <div class="col-md-6">--}}
{{--                                    <input id="tags-output" type="hidden" name="tags" value="{{ old('tags') }}">--}}
{{--                                    <input id="tags-input" type="text" class="@error('tags') is-invalid @enderror"--}}
{{--                                           value="{{ old('tags') }}" data-role="tagsinput" data-type="create">--}}

{{--                                    @error('tags')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                            <strong>{{ $message }}</strong>--}}
{{--                                        </span>--}}
{{--                                    @enderror--}}

{{--                                    <div id="tags-autocomplete"></div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="form-group row">--}}
{{--                                <label for="category_id"--}}
{{--                                       class="col-md-4 col-form-label text-md-right">Kategorija</label>--}}

{{--                                <div class="col-md-6">--}}
{{--                                    <select name="category_id"--}}
{{--                                            class="form-control @error('category_id') is-invalid @enderror">--}}
{{--                                        <option value="" disabled selected>Odaberite kategoriju</option>--}}
{{--                                        @foreach ($categories as $category)--}}
{{--                                            <option value="{{ $category->id }}"--}}
{{--                                                    @if (old('category_id') == $category->id) selected @endif>{{ $category->name }}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}

{{--                                    @error('category_id')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                            <strong>{{ $message }}</strong>--}}
{{--                                        </span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="form-group row justify-content-center mt-4">--}}
{{--                                --}}
{{--                            </div>--}}

{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    <script type="text/javascript">
        ALGOLIA_APP_ID = `<?php echo env('ALGOLIA_APP_ID', '') ?>`;
        ALGOLIA_PUBLIC_SECRET = `<?php echo env('ALGOLIA_PUBLIC_SECRET', '') ?>`;
    </script>
@endsection
