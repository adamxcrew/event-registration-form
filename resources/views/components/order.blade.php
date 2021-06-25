@props(['by'])

@php
    use Illuminate\Support\Arr;
    // $route = request()->route()->getName();
    // $queries = request()->input();
    // $queries['order'] = $by;
    // $queries['sort'] = request('sort') === 'asc' ? 'desc' : 'asc';

    // $link = route($route, $queries);

    $url = url()->current();
    $queries = request()->input();
    $queries['order'] = $by;
    $queries['sort'] = request('sort') === 'asc' ? 'desc' : 'asc';

    $link = $url ."?". Arr::query($queries);
@endphp

<a href="{{ $link }}" class="text-reset text-nowrap">
    {{ $slot }}
    @if (request('order') == $by)
        <svg style="height: 1.2em" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
        </svg>
    @endif
</a>
