@php
    /** @var \Illuminate\Pagination\LengthAwarePaginator|\App\Models\Post[] $posts */
@endphp
@extends('layouts.web')

@section('page_title', 'Objave')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Objave</div>

            <div class="card-body">
                <form action="{{ route('homepage') }}" method="GET" class="form-group row mt-3">
                    <div class="col-3">
                        <input type="text" name="search" class="form-control" value="{{ $searchTerm }}"
                               placeholder="Pretraga naslova">
                    </div>
                    <div class="col-md-3">
                        <select name="category" class="form-control @error('category') is-invalid @enderror">
                            <option value="" @if ($category == '') selected @endif>Sve kategorije</option>
                            @foreach ($categories as $item)
                                <option value="{{ $item->id }}"
                                        @if (old('category', $category) == $item->id) selected @endif>{{ $item->name }}</option>
                            @endforeach
                        </select>

                        @error('category')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>
                    <div class="col-3">
                        <button type="submit" class="btn btn-primary">Pretraži</button>
                        @if(!empty($searchTerm))
                            <a href="{{ route('admin.posts.index') }}" class="ml-3">Prikaži sve</a>
                        @endif
                    </div>
                </form>

                <div class="mt-4 justify-content-center">
                    @foreach($posts as $post)
                        <x-post :post="$post"/>
                    @endforeach
                </div>

                <div class="row mt-2 justify-content-center">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

