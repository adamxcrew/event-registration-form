<div class="form-group row">
    <label for="name" class="col-md-3 col-form-label text-md-right">Event <span class="text-danger">*</span></label>
    <div class="col-md-6">
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $event->name ?? '') }}" required placeholder="Event name...">
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
        <textarea name="description" id="description" rows="5" class="form-control @error('description') is-invalid @enderror" placeholder="Event description (optional)...">{{ old('description', $event->description ?? '') }}</textarea>
        @error('description')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="category" class="col-md-3 col-form-label text-md-right">Category</label>
    <div class="col-md-6">
        <input id="category" type="text" class="form-control @error('category') is-invalid @enderror" name="category" value="{{ old('category', $event->category ?? '') }}" placeholder="Event category...">
        @error('category')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="time" class="col-md-3 col-form-label text-md-right">Zone</label>
    <div class="col-md-6">
        <div class="pt-md-2 @error('time') is-invalid @enderror">
            @foreach (['none', 'day', 'night'] as $time)
                <div class="custom-control custom-radio">
                    <input type="radio" id="{{ $time }}" value="{{ $time }}" name="time" class="custom-control-input" {{ old('time', $event->time ?? 'none') == $time ? 'checked' : '' }}>
                    <label class="custom-control-label" for="{{ $time }}">
                        {{ ucfirst($time) }}
                    </label>
                </div>
            @endforeach
        </div>
        @error('time')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

@foreach ($categories as $category)
    @if ($loop->first)
        <div class="form-group row">
            <label class="offset-md-3 col-md-6 col-form-label text-secondary">Price (Early & Normal)</label>
        </div>
    @endif

    <div class="form-group row">
        <label for="prices" class="col-md-3 col-form-label text-md-right">{{ $category->name }}</label>
        @foreach (['early', 'normal'] as $item)
            @php
                $price = optional($event ?? null, fn ($event) => optional($event->prices->where('category_id', $category->id)->first())->{$item});
            @endphp
            <div class="col-md-3 col-6">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text bg-white border-right-0">Rp.</div>
                    </div>
                    <input type="number" class="border-left-0 form-control @error('prices') is-invalid @enderror" name="prices[{{ $category->id }}][{{ $item }}]" placeholder="Free ({{ ucfirst($item) }})"
                        value="{{ old('prices')[$category->id][$item] ?? $price }}"
                    >
                </div>
            </div>
        @endforeach
    </div>
@endforeach

