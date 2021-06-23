@isset($edit)
    <a href="{{ $edit }}" class="text-secondary text-decoration-none mx-2">
        <i class="far fa-edit"></i>
    </a>
@endisset

@isset($delete)
    <form action="{{ $delete }}" method="POST" class="d-inline">
        @csrf @method('delete')
        <a href="{{ $delete }}" class="text-secondary text-danger-hover text-decoration-none ml-2" confirm="delete">
            <i class="far fa-trash-alt"></i>
        </a>
    </form>
@endisset

{{ $slot }}
