<div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center justify-content-md-end">
    <div style="position: fixed; min-width: 300px; z-index: 9999;" class="p-3">
        <div class="toast shadow-lg" id="success" data-delay="3000" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <svg class="mr-1 text-success" style="height: 1.5em; width: 1.5em;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <strong class="mr-auto">Success</strong>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">
                {{ session('success') }}
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(function () {
            $('.toast').toast('show').addClass("animate__animated animate__jello")
        })
    </script>
@endpush
