@php
    /** @var \Illuminate\Pagination\LengthAwarePaginator|\App\Models\Post[] $posts */
@endphp
@extends('layouts.admin', ['activeItem' => 'posts'])

@section('page_title', 'Postovi')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Postovi</div>

            <div class="card-body">
                <form action="{{ route('admin.posts.index') }}" method="GET" class="form-group row">
                    <div class="col-6">
                        <input type="text" name="search" class="form-control" value="{{ $searchTerm }}">
                    </div>
                    <div class="col-6">
                        <button type="submit" class="btn btn-primary">Pretraži</button>
                        @if(!empty($searchTerm))
                            <a href="{{ route('admin.posts.index') }}" class="ml-3">Prikaži sve</a>
                        @endif
                    </div>
                </form>

                <div class="mt-2 justify-content-center">
                    @foreach($posts as $post)
                        <x-post :post="$post" :forAdmin="true"/>
                    @endforeach
                </div>

                <div class="row mt-2 justify-content-center">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

