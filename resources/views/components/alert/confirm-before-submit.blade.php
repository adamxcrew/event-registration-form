<div class="modal" id="confirmBeforeSubmit" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="confirmationLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="d-flex flex-column flex-sm-row align-items-start">
                    <div class="d-flex flex-shrink-0 mx-auto align-items-center justify-content-center rounded-circle" style="width:4rem; height: 4rem; background-color:rgba(40, 167, 69, 0.1);" >
                        <svg style="width: 2rem" class="text-success" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                    </div>

                    <div class="text-center text-sm-left ml-sm-3 mt-2 mt-sm-0 w-100">
                        <p class="lead mb-1">Submit</p>
                        <p class="mb-2 message">Are you sure you want to submit this?</p>
                    </div>
                </div>
            </div>

            <div class="modal-footer bg-light border-top-0">
                <button type="button" class="btn btn-white no" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" submit>Submit</button>
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
