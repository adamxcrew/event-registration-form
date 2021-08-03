@extends('layouts.auth')

@section('body', 'register')

@section('content')
<div class="container">
    <div class="register-logo">
        <a href="{{ url('/') }}" class="font-weight-bold">Registration</a>
        <p class="lead">
            {!! site('description', config('app.desc'), true) !!}
        </p>
    </div>

    <div class="row justify-content-center">
        <div class="col">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong>
                    <br>
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="card">
                <div class="card-header border-bottom-0">
                    <h5 class="m-0 font-weight-normal">Konfirmasi Pembayaran</h5>
                </div>
                <div class="card-body bg-light">
                    <form method="POST" action="{{ route('confirm') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="code" class="col-md-3 col-form-label text-md-right">Kode Registrasi</label>
                            <div class="col-md-8">
                                <input type="text" name="code" id="code" class="form-control @error('code') is-invalid @enderror" value="{{ old('code') }}" placeholder="Kode Registrasi" required>
                                @error('code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <small class="form-text text-info">
                                    <i class="fas fa-info-circle mr-1"></i> Kode registrasi ini bisa kamu dapatkan melalui email pemberitahuan setelah melakukan registrasi.
                                </small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label text-md-right">A/N Rekening</label>
                            <div class="col-md-8">
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid' @enderror" value="{{ old('name') }}" placeholder="A/N Rekening" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="bank" class="col-md-3 col-form-label text-md-right">Bank</label>
                            <div class="col-md-8">
                                <input type="text" name="bank" id="bank" class="form-control @error('bank') is-invalid' @enderror" value="{{ old('bank') }}" placeholder="Nama Bank" required>
                                @error('bank')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="paid_at" class="col-md-3 col-form-label text-md-right">Tanggal Transfer</label>
                            <div class="col-md-8">
                                <input type="date" name="paid_at" id="paid_at" class="form-control @error('paid_at') is-invalid' @enderror" value="{{ old('paid_at') }}" placeholder="Tanggal Transfer" required>
                                @error('paid_at')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="paid_at" class="col-md-3 col-form-label text-md-right">
                                Bukti Transfer
                            </label>
                            <div class="col-md-8">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @error('struk') is-invalid @enderror" name="struk" id="struk" accept=".png,.jpeg,.jpg,.pdf" required>
                                    <label class="custom-file-label" for="struk">
                                        <small class="text-muted">.jpg/.pdf, maks: 2048 KB</small>
                                    </label>
                                    @error('struk')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-3">
                                <button type="submit" class="btn btn-primary btn-block-xs">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            @guest
                <div class="text-center mt-2">
                    <a href="{{ url('/login') }}">If you have already registered, <b>Login here!</b></a>
                </div>
            @endguest
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
    <script>
        bsCustomFileInput.init()
    </script>
@endsection