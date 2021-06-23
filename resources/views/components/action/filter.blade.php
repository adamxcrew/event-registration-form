<a href="#" class="text-secondary text-decoration-none ml-3" data-toggle="modal" data-target="#filterModal">
    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" class="far fa-fw align-text-top">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
    </svg>
    {{ $title ?? '' }}
</a>

<div class="modal fade" id="filterModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filterModalLabel">
                    Filter
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="filterForm">
                    {{ $slot }}
                </form>
            </div>
            <div class="modal-footer">
                <a href="{{ url()->current() }}" class="btn text-secondary"><u>Reset</u></a>
                <v-button type="submit" form="filterForm" class="btn btn-primary">Filter</v-button>
            </div>
        </div>
    </div>
</div>
