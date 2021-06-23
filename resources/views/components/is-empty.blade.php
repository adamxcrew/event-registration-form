<div class="row justify-content-center" style="height: {{ $height ?? '60vh' }}; place-items: center;">
    <div class="col-7 col-md-2 {{ $attributes['class'] }}">
        <img src="{{ $src ?? asset('svg/no_data.svg') }}" alt="Empty" class="img-fluid">
        {{ $slot }}
    </div>
</div>
