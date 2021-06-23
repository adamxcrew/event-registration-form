<div class="d-inline-block">
    <button type="button" class="btn btn-link border-0 p-0 text-secondary text-right" style="width: 1.5rem" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-ellipsis-v"></i>
    </button>

    <div class="dropdown-menu">
        <h6 class="dropdown-header text-left">Action</h6>
        @isset($show)
            <a href="{{ $show }}" class="dropdown-item">
                <i class="fas fa-eye fa-fw mr-2"></i> Show
            </a>
        @endisset

        @isset($edit)
            <a href="{{ $edit }}" class="dropdown-item">
                <i class="far fa-edit fa-fw mr-2"></i> Edit
            </a>
        @endisset

        @isset($delete)
            <form action="{{ $delete }}" method="POST">
                @csrf @method('delete')
                <a href="{{ $delete }}" class="dropdown-item text-danger-hover" confirm="delete">
                    <i class="far fa-trash-alt fa-fw mr-2"></i> Delete
                </a>
            </form>
        @endisset

        {{ $slot }}
    </div>
</div>
