@extends('layouts.auth')

@section('body', 'register-page')

@section('content')
<div class="container" style="margin: 7% auto">
    <div class="register-logo">
        <a href="{{ url('/') }}" class="font-weight-bold">Event Registration </a>
        <p class="lead">
            8 Annual Scientific Meeting Indonesia Society of Thoracic Radiology <br>
            <b class="text-uppercase">Comprehensive Thoracic Imaging</b>
        </p>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-8">
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
