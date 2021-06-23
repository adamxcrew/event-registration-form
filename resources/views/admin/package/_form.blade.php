<div class="form-group row">
    <label for="name" class="col-md-3 col-form-label text-md-right">Package <span class="text-danger">*</span></label>
    <div class="col-md-6">
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $package->name ?? '') }}" required placeholder="Package name...">
        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="description" class="col-md-3 col-form-label text-md-right">Description</label>
    <div class="col-md-6">
        <textarea name="description" id="description" rows="5" class="form-control @error('description') is-invalid @enderror" placeholder="Package description (optional)...">{{ old('description', $package->description ?? '') }}</textarea>
        @error('description')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>


<div class="form-group row">
    <label class="offset-md-3 col-md-6 col-form-label text-secondary">Price (Early & Normal)</label>
</div>

@foreach ($categories as $category)
    <div class="form-group row">
        <label for="prices" class="col-md-3 col-form-label text-md-right">{{ $category->name }}</label>
        @foreach (['early', 'normal'] as $item)
            @php
                $price = optional($package ?? null, fn ($package) => optional($package->prices->where('category_id', $category->id)->first())->{$item});
            @endphp
            <div class="col-md-3 col-6">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text bg-white border-right-0">Rp.</div>
                    </div>
                    <input id="prices" type="number" class="border-left-0 form-control @error('prices') is-invalid @enderror" name="prices[{{ $category->id }}][{{ $item }}]" placeholder="Free ({{ ucfirst($item) }})"
                        value="{{ old('prices')[$category->id][$item] ?? $price }}"
                    >
                </div>
            </div>
        @endforeach
    </div>
@endforeach
