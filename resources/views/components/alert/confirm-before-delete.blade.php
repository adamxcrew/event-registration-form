<div class="modal" id="confirmBeforeDelete" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="confirmationLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="d-flex flex-column flex-sm-row align-items-start">
                    <div class="d-flex flex-shrink-0 mx-auto align-items-center justify-content-center rounded-circle" style="width:4rem; height: 4rem; background-color: rgba(253,232,232,1);">
                        <svg style="width: 2rem" class="text-danger" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>

                    <div class="text-center text-sm-left ml-sm-3 mt-2 mt-sm-0 w-100">
                        <p class="lead mb-1">Delete</p>
                        <p class="mb-2">Are you sure you want to delete this?</p>
                        @if (Auth::user()->hasRole(['admin', 'superadmin']))
                            <hr>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="forceDelete" name="force">
                                <label class="custom-control-label" for="forceDelete">Delete permanent</label>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light border-top-0">
                <button type="button" class="btn btn-link text-reset" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" delete>Delete</button>
            </div>
        </div>
    </div>
</div>

@push('styles')
    <style>
        .animate__zoomIn {
            --animate-duration: 0.8s;
        }
    </style>
@endpush
