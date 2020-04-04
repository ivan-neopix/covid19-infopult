@php
    /** @var \App\Models\Category $category */
@endphp

<div class="form-group">
    <label for="name">Ime kategorije</label>
    <input type="text"
           name="name"
           class="form-control"
           id="name"
           value="{{ old('name', $category->name)}}"
           autofocus
    >
    @error('name')<label class="error-message" for="name">{{ $message }}</label>@enderror
</div>
