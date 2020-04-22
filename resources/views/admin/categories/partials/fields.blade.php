@php
    /** @var \App\Models\Category $category */
@endphp

<div class="form-group row">
    <label for="name" class="col-md-4 col-form-label text-md-right" for="name">Ime kategorije</label>

    <div class="col-md-6">
        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
               value="{{ old('name', $category->name) }}" autofocus>

        @error('name')
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label class="col-md-4 col-form-label text-md-right" for="upload">Slika Kategorije (SVG)</label>

    <div class="col-md-6">
        @if($category->image)
            <div class="mb-2">
                <img src="{{ old('image', $category->image) }}" height="44">
            </div>
        @endif
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Upload</span>
            </div>
            <div class="custom-file">
                <input type="file" name="image" class="@error('image') is-invalid @enderror custom-file-input" id="upload">
                <label class="custom-file-label" for="upload">Choose file</label>
            </div>
        </div>

        @error('image')
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
        @enderror
    </div>
</div>
