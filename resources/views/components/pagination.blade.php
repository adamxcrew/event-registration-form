<div class="d-flex mt-3">
    @if ($model->total() > 10)
        <div class="mr-auto mb-3">
            <form action="{{ url()->current() }}">
                @foreach (request()->input() as $name => $value)
                    <x-input-hidden :name="$name" :value="$value" />
                @endforeach
                <div class="input-group shadow-sm">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-white border-left-0 border-top-0 border-bottom-0">
                            <svg style="height: 1.1rem" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="text-secondary">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                            </svg>
                        </span>
                    </div>
                    <select name="perPage" id="perPage" class="form-control border-top-0 border-right-0 border-bottom-0" onchange="this.form.submit()">
                        @foreach ([10, 15, 25, 50, 100] as $items)
                            <option value="{{ $items }}" {{ $items == $model->perPage() ? 'selected' : '' }}>
                                {{ $items }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>
    @endif

    {{ $model->appends(request()->input())->links() }}
</div>
