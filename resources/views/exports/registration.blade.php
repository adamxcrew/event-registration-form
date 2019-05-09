<table style="width: 100%">
    <thead>
        <tr>
            <th>NO.</th>
            <th>REGISTRASI</th>
            <th>TANGGAL</th>
            <th>PESERTA</th>
            <th>KONTAK</th>
            <th>PAKET</th>
            <th>KEGIATAN</th>
            <th>BIAYA</th>
            <th>STATUS</th>
            <th>PEMBAYARAN</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($registrations as $item)
            @php
                $regEvents = $item->events->whereIn('id', $events);
            @endphp
            <tr>
                <td rowspan="{{ $regEvents->count() }}">{{ $loop->iteration }}</td>
                <td rowspan="{{ $regEvents->count() }}">{{ $item->code }}</td>
                <td rowspan="{{ $regEvents->count() }}">{{ $item->created_at->format('d/m/Y') }}</td>
                <td rowspan="{{ $regEvents->count() }}">{{ $item->user->participant->name }}</td>
                <td rowspan="{{ $regEvents->count() }}">{{ $item->user->participant->phone }}</td>
                <td rowspan="{{ $regEvents->count() }}">{{ $item->package->description }} - {{ $item->category->name }}</td>
                <td>{{ $regEvents->first()->name }}</td>
                <td rowspan="{{ $regEvents->count() }}">{{ $item->getOriginal('paybill') }}</td>
                <td rowspan="{{ $regEvents->count() }}">
                    @switch($item->status)
                        @case(1)
                            MENUNGGU VERIFIKASI
                            @break
                        @case(2)
                            LUNAS
                            @break
                        @default
                            BELUM MEMBAYAR
                    @endswitch
                </td>
                <td rowspan="{{ $regEvents->count() }}">
                    @if ($item->receipt)
                        {{ $item->receipt->paid_at->format('d/m/Y') }} - {{ $item->receipt->name }} ({{ $item->receipt->bank }})
                    @endif
                </td>
            </tr>
            @foreach ($regEvents as $event)
                @if (!$loop->first)
                    <tr>
                        <td>{{ $event->name }}</td>
                    </tr>
                @endif
            @endforeach
        @endforeach
    </tbody>
</table>