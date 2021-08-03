@component('mail::message')

# @lang('Halo'), {{ explode(" ", $user->name)[0] }} !

Terimakasih telah melakukan pembayaran registrasi <b>"{{ site('description', config('app.desc')) }}"</b>.

<a href="{{ config('app.url') }}/invoice?c={{ $user->registration->code }}">Download invoice.</a>

<br>
Untuk informasi lebih lanjut seputan kegiatan ini, silahkan kunjungi website kami. <br>
Atau hubungi kontak person berikut:
<br>
- dr. Suciati Damopolii, Sp.Rad (K). 085255148999.
<br>
- Suryani Azis, S.Kom. 081342095484 (WA).

<br>
@lang('Regards'),<br>Admin, {{ config('app.name') }}.
@component('mail::subcopy')
{{ config('app.name') }} : {{ config('app.url') }}
@endcomponent

@endcomponent
