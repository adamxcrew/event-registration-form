@component('mail::message')

# @lang('Halo'), {{ explode(" ", $user->name)[0] }} !

Ini adalah email sampel dari sistem kami, silahkan diabaikan.

<br>
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
