@extends('layouts.auth')

@section('body', 'register')

@section('content')
<div class="container">
    <div class="register-logo">
        <a href="{{ url('/') }}" class="font-weight-bold">Registration </a>
        <p class="lead">
            {!! config('app.desc') !!}
        </p>
    </div>
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-body text-center">
                    <h3 class="mb-4">Terimakasih, telah melakukan registrasi.</h3>
                    <p class="mb-4">
                        Kami telah mengirimkan informasi biaya pendaftaran kegiatan <br>
                        beserta informasi akun kamu melalui Email. <br>
                        Silahkan login menggunakan akun tersebut dan upload bukti pembayaran kamu.
                    </p>
                    <p class="mb-1">
                        <a href="{{ url('/login') }}" class="btn btn-outline-primary">
                            Login sekarang <i class="fas fa-sign-in-alt ml-1"></i>
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
