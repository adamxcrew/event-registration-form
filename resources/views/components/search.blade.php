<form class="form-inline" action="{{ url()->current() }}">
    {{ $slot }}
    @foreach (collect(request()->input())->except('q') as $name => $value)
        <x-input-hidden :name="$name" :value="$value" />
    @endforeach
    <div class="input-group rounded shadow-sm">
        <input type="search" id="keyword" name="q" placeholder="Search" aria-label="Search" class="form-control form-control-navbar border-0 shadow-none" value="{{ request('q') }}" autofocus>
        <div class="input-group-append">
            <div class="input-group-text bg-white border-0">
                <i class="fa fa-search"></i>
            </div>
        </div>
    </div>
</form>
