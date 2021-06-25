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
    <label class="col-md-3 col-form-label text-md-right">Choiceable Events</label>
    <div class="col-md-3 col-6">
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text bg-white border-right-0">Min : </div>
            </div>
            <input type="number" class="border-left-0 form-control @error('min') is-invalid @enderror" name="min" placeholder="0"
                value="{{ old('min', $package->min ?? '') }}">
        </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text bg-white border-right-0">Max : </div>
            </div>
            <input type="number" class="border-left-0 form-control @error('max') is-invalid @enderror" name="max" placeholder="0"
                value="{{ old('max', $package->max ?? '') }}">
        </div>
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
                        <div class="input-group-text bg-white border-right-0">
                            <span class="d-none d-md-inline-block mr-1">{{ ucfirst($item) }} | </span>
                            Rp.
                        </div>
                    </div>
                    <input id="prices" type="number" class="border-left-0 form-control @error('prices') is-invalid @enderror" name="prices[{{ $category->id }}][{{ $item }}]" placeholder="Free ({{ ucfirst($item) }})"
                        value="{{ old('prices')[$category->id][$item] ?? $price }}"
                    >
                </div>
            </div>
        @endforeach
    </div>
@endforeach
