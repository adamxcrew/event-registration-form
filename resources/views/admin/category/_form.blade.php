<div class="form-group row">
    <label for="name" class="col-md-3 col-form-label text-md-right">Category <span class="text-danger">*</span></label>
    <div class="col-md-6">
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $category->name ?? '') }}" required placeholder="Category name...">
        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

