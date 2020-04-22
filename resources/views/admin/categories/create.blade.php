@php
    /** @var \App\Models\Category $category */
@endphp
@extends('layouts.admin', ['activeItem' => 'categories'])

@section('page_title', 'Dodaj kategoriju')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header">Dodaj kategoriju</div>

                    <div class="card-body">
                        <form action="{{ route('admin.categories.store') }}" enctype="multipart/form-data" method="POST">
                            @csrf

                            @include('admin.categories.partials.fields')

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-success">Dodaj</button>
                                    <a href="{{ route('admin.categories.index') }}" class="btn btn-danger">Odustani</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

