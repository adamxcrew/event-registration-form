<table>
    <thead>
        <tr>
            <td>No.</td>
            <td style="text-align: center">Kode Reg.</td>
            <td style="text-align: center">Tanggal</td>
            <td>Peserta</td>
            <td>Kontak</td>
            <td>Email</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($registrations as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td style="text-align: center">{{ $item->code }}</td>
                <td style="text-align: center">{{ $item->created_at->format('d/m/Y') }}</td>
                <td>{{ $item->user->participant->name }}</td>
                <td>{{ $item->user->participant->phone }}</td>
                <td>{{ $item->user->email }}</td>
            </tr>
        @endforeach
    </tbody>
</table>