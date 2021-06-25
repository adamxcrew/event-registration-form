@component('mail::message')
# @lang('Halo'), {{ explode(" ", $name)[0] }} !

Kamu terdaftar sebagai calon peserta dalam kegiatan <b>"8th Annual Scientific Meeting Indonesia Society of Thoracic Radiology"</b>.
<br>

Kami mengingatkan, <br>
Besar tagihan yang perlu kamu bayar adalah :
@component('mail::panel')
Paket Workshop : <b>{{ $registration->package->description }} (<i>{{ $registration->category->name }}</i>)</b> <br>
Biaya : <b>{{ IDR($registration->paybill) }}</b>

Total tagihan : <b>{{ IDR($registration->paybill) }}</b>
@endcomponent


<p style="text-align: center; margin-bottom: 0">
    Segera lakukan pembayaran dengan tranfer melalui
</p>
<h1 style="text-align: center"><u>Bank Mandiri</u></h1>
<p style="text-align: center">
    dr. Erlin Sjahril, Sp.Rad(K) <br>
    152-00-5223240-8
</p>

<p style="text-align: center">
    Setelah itu, <a href="{{ config('app.url') }}login">Login</a> dan konfirmasi pembayaran kamu segera menggunakan akun berikut.
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
