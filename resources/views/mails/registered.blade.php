@component('mail::message')
# @lang('Halo'), {{ explode(" ", $name)[0] }} !

Kamu telah terdaftar sebagai calon peserta dalam kegiatan <b>"8th Annual Scientific Meeting Indonesia Society of Thoracic Radiology"</b>.
<br>

Besar tagihan yang perlu kamu bayar adalah :
@component('mail::panel')
Paket : <b>{{ $package }} (<i>{{ $category }}</i>)</b> <br>
Biaya : <b>Rp. {{ number_format($paybill) }}</b>
@endcomponent

Segera lakukan pembayaran dengan jumlah seperti yang tertera diatas.

Setelah itu, <a href="{{ config('app.url') }}login">Login</a> dan konfirmasi pembayaran kamu menggunakan akun berikut:
@component('mail::panel')
Username : {{ $username }}<br>
Password : {{ $password }}
@endcomponent

{{-- Sebelum itu, harap lakukan verifikasi email anda, sebelum akun anda siap digunakan. Dengan klik tombol dibawah ini.

@component('mail::button', ['url' => '#', 'color' => 'primary'])
@lang('Verifikasi Email')
@endcomponent

Jika anda merasa tidak pernah melakukan pendaftaran, silahkan abaikan pesan ini. --}}

@lang('Regards'),<br>Admin, {{ config('app.name') }}.

{{-- Subcopy --}}
{{-- @isset($actionText)
@component('mail::subcopy')
@lang(
"If you’re having trouble clicking the \":actionText\" button, copy and paste the URL below\n".
'into your web browser: [:actionURL](:actionURL)',
[
'actionText' => $actionText,
'actionURL' => $actionUrl,
]
)
@endcomponent
@endisset --}}
@component('mail::subcopy')
{{ config('app.name') }} : {{ config('app.url') }}
@endcomponent
@endcomponent
