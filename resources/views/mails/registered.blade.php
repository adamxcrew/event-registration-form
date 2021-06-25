@component('mail::message')
# @lang('Halo'), {{ explode(" ", $name)[0] }} !

Kamu telah terdaftar sebagai calon peserta dalam kegiatan <b>"{{ config('app.desc') }}"</b>.
<br>

Besar tagihan yang perlu kamu bayar adalah :
@component('mail::panel')
Paket Workshop : <b>{{ $registration->package->description }} (<i>{{ $registration->category->name }}</i>)</b> <br>
Biaya : <b>{{ IDR($registration->paybill) }}</b>
@endcomponent


<p style="text-align: center; margin-bottom: 0">
    Pembayaran dapat dilakukan dengan tranfer melalui
</p>
<h1 style="text-align: center"><u>Nama Bank</u></h1>
<p style="text-align: center">
    Atas nama pemilik rekening bank <br>
    xxxxxxxxxxx
</p>

<p style="text-align: center">
    Setelah itu, <a href="{{ config('app.url') }}login">Login</a> dan konfirmasi pembayaran kamu menggunakan akun berikut.
</p>
@component('mail::panel')
Username : {{ $username }}<br>
Password : {{ $password }}
@endcomponent


<br>
@lang('Regards'),<br>Admin, {{ config('app.name') }}.

@component('mail::subcopy')
{{ config('app.name') }} : {{ config('app.url') }}
@endcomponent
@endcomponent
