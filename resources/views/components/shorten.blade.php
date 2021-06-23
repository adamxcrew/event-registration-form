<span class="pointer" data-toggle="popover" data-content="{{ $slot }}">
    {{ Str::words($slot ?? '-', $limit ?? '5', '...') }}
</span>
