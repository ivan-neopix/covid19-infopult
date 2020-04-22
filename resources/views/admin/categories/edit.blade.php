@php
    /** @var \App\Models\Category $category */
    /** @var \Illuminate\Pagination\LengthAwarePaginator|\App\Models\Post[] $posts */
    /** @var int $postsCount */
@endphp
@extends('layouts.admin', ['activeItem' => 'categories'])

@section('page_title', $category->name)

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-3">
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.categories.update', $category) }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('PUT')

                            @include('admin.categories.partials.fields')

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-success">Izmeni</button>
                                    <a href="{{ route('admin.categories.index') }}" class="btn btn-danger">Odustani</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-5">
            <div class="card-header">Postovi ({{ $postsCount }})</div>

            <div class="card-body">
                @foreach($posts as $post)
                    <x-post :post="$post" :forAdmin="true"/>
                @endforeach
            </div>

            <div class="row mt-2">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection

