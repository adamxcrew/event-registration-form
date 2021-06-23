<div class="row mb-3">
    <div class="col">
        <form action="{{ url()->full() }}" class="form-row">
            <div class="col-12 col-md-4">
                <select name="room" class="form-control mb-3 mb-md-0 mr-sm-2 border-0 shadow-sm" id="room" required>
                    <option value="" hidden>Lab / Simulator</option>
                    @foreach ($rooms as $room)
                        <option value="{{ $room->id }}" {{ request('room') == $room->id ? 'selected' : '' }}>{{ $room->name }}</option>
                    @endforeach
                </select>
            </div>

            {{ $slot }}

            <div class="col-auto">
                <button type="submit" class="btn btn-primary app-shadow">
                    <svg style="width: 1.1em; height: 1.1em;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </div>
            <div class="col-auto ml-auto">
                <div class="btn-group rounded app-shadow" role="group" aria-label="Action Button">
                    <button type="submit" name="print" value="true" class="btn btn-primary" formtarget="_blank">
                        Print
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
