<form action="{{ $href }}" method="POST" class="d-inline">
    @csrf @method('delete')
    <a href="{{ $href }}" class="text-secondary text-danger-hover text-decoration-none ml-3" confirm="delete">
        <i class="far fa-trash-alt"></i>
    </a>
</form>
