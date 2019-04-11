<table>
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
            <tr>
                <td rowspan="{{ $item->events->count() }}">{{ $loop->iteration }}</td>
                <td rowspan="{{ $item->events->count() }}">{{ $item->code }}</td>
                <td rowspan="{{ $item->events->count() }}">{{ $item->created_at->format('d/m/Y') }}</td>
                <td rowspan="{{ $item->events->count() }}">{{ $item->user->participant->name }}</td>
                <td rowspan="{{ $item->events->count() }}">{{ $item->user->participant->phone }}</td>
                <td rowspan="{{ $item->events->count() }}">{{ $item->package->description }} - {{ $item->category->name }}</td>
                <td>1. {{ $item->events[0]->name }}</td>
                <td rowspan="{{ $item->events->count() }}">{{ $item->getOriginal('paybill') }}</td>
                <td rowspan="{{ $item->events->count() }}">
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
                <td rowspan="{{ $item->events->count() }}">
                    @if ($item->receipt)
                        {{ $item->receipt->paid_at->format('d/m/Y') }} - {{ $item->receipt->name }} ({{ $item->receipt->bank }})
                    @endif
                </td>
            </tr>
            @foreach ($item->events as $event)
                @if ($loop->index > 0)
                    <tr>
                        <td>
                            {{ $loop->iteration }}. {{ $event->name }}
                        </td>
                    </tr>
                @endif
            @endforeach
        @endforeach
    </tbody>
</table>