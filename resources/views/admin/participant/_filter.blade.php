<div class="form-group">
    <label for="status">Status</label>
    <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
        <option value="">Tampil semua</option>
        @foreach (['Unpaid','Waiting / Verifying', 'Paid / Complete'] as $status => $label)
            <option value="{{ $status+=1 }}" {{ request('status') == $status ? 'selected' : '' }}>
                {{ $label }}
            </option>
        @endforeach
    </select>
</div>