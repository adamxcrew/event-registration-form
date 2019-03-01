@component('mail::message')

# @lang('Halo'), {{ explode(" ", $user->name)[0] }} !

Terimakasih telah melakukan pembayaran registrasi <b>"8th Annual Scientific Meeting Indonesia Society of Thoracic Radiology"</b>.

Kamu terdaftar sebagai peserta dengan info registrasi :
@component('mail::panel')
Kode Reg. : <b>{{ $user->registration->code }}</b> <br>
Paket     : <b>{{ $package }} (<i>{{ $category }}</i>)</b> <br>
Biaya     : <b>Rp. {{ number_format($paybill) }}</b>
@endcomponent

Gunakan email ini ketika dilokasi kegiatan sebagai bukti bahwa kamu terdaftar sebagai peserta.

Untuk informasi lebih lanjut seputan kegiatan ini, silahkan kunjungi website kami. <br>
Atau hubungi kontak person berikut:
- dr. Erlin Sjaril, Sp.Rad(K)TR, M.Kes. 085255148999.
- Suryani Azis, S.Kom. 081342095484 (WA).

<br>
@lang('Regards'),<br>Admin, {{ config('app.name') }}.
@component('mail::subcopy')
{{ config('app.name') }} : {{ config('app.url') }}
@endcomponent

@endcomponent
