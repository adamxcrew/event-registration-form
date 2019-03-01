@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <h1 class="display-4">Hi, {{ explode(" ", Auth::user()->name)[0] }}!</h1>
        <p class="lead mb-1 d-none d-md-block">
            8th Annual Scientific Meeting Indonesia Society of Thoracic Radiology
            <b class="text-uppercase">Comprehensive Thoracic Imaging</b>.
        </p>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    Billing
                </h5>
            </div>
            <div class="card-body p-0 table-responsive">
                <table class="table mb-2">
                    <tbody>
                        <tr>
                            <td nowrap class="border-top-0" width="20%">Kode Registrasi <span class="float-right">:</span></td>
                            <td class="border-top-0 pl-2">{{ $user->registration->code }}</td>
                        </tr>
                        <tr>
                            <td nowrap>Tanggal Registrasi <span class="float-right">:</span></td>
                            <td class="pl-2">{{ $user->registration->created_at->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <td nowrap>Paket <span class="float-right">:</span></td>
                            <td class="pl-2">{{ $user->registration->package->description }} - <b>{{ $user->registration->category->name }}</b></td>
                        </tr>
                        <tr>
                            <td nowrap>Biaya <span class="float-right">:</span></td>
                            <td class="pl-2">Rp. {{ number_format($user->registration->paybill) }}</td>
                        </tr>
                        <tr>
                            <td nowrap>Status <span class="float-right">:</span></td>
                            <td class="pl-2">
                                {!! $user->registration->status() !!}
                                <a href="#" class="text-decoration-none text-muted" data-toggle="modal" data-target="#paymentInformation">
                                    <i class="far fa-question-circle"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td nowrap>Pembayaran <span class="float-right">:</span></td>
                            <td class="pl-2">
                                @if ($user->registration->receipt()->exists())
                                    <a href="#" class="text-decoration-none text-muted" data-toggle="modal" data-target="#paymentConfirmation">
                                        <i class="far fa-image mr-1"></i>
                                        {{ $user->registration->receipt->paid_at->format('d/m/Y') }}
                                    </a>
                                @else
                                    <button class="btn btn-sm btn-primary px-4" data-toggle="modal" data-target="#paymentConfirmation">Upload</button>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<section id="modal-area">
    <div class="modal fade" id="paymentInformation" role="dialog" aria-labelledby="paymentInformationLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title" id="paymentInformationLabel">Metode Pembayaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <h5><u>Bank Mandiri</u> :</h5>
                        <p>
                            dr. Erlin Sjahril, Sp.Rad(K) <br>
                            152-00-5223240-8
                        </p>
                    </div>
                </div>
                <div class="modal-footer border-top-0">
                    {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="paymentConfirmation" role="dialog" aria-labelledby="paymentConfirmationLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentConfirmationLabel">Upload Bukti Pembayaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('payment.receipt') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">A/N Rekening</label>
                            <input type="text" name="name" id="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name', $user->registration->receipt->name ?? '') }}" placeholder="A/N Rekening" required>
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="bank">Bank</label>
                            <input type="text" name="bank" id="bank" class="form-control{{ $errors->has('bank') ? ' is-invalid' : '' }}" value="{{ old('bank', $user->registration->receipt->bank ?? '') }}" placeholder="Nama Bank" required>
                            @if ($errors->has('bank'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('bank') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="paid_at">Tanggal Transfer</label>
                            <input type="text" name="paid_at" id="paid_at" class="form-control{{ $errors->has('paid_at') ? ' is-invalid' : '' }}" value="{{ old('paid_at', $user->registration->receipt ? $user->registration->receipt->paid_at->format('d/m/Y') : '') }}" placeholder="Format: DD/MM/YYYY" required>
                            @if ($errors->has('paid_at'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('paid_at') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="struk">Bukti Transfer <small class="text-muted"><i>(maks: 2048 KB)</i></small></label>
                            <input id="struk" type="file" class="{{ $errors->has('struk') ? 'form-control is-invalid' : '' }}" accept=".png,.jpeg,.jpg" name="struk" value="{{ old('struk') }}" placeholder="Foto Bukti Pembayaran" required>
                            @if ($errors->has('struk'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('struk') }}</strong>
                                </span>
                            @endif
                            @if ($user->registration->receipt)
                                <br>
                                <img src="{{ asset($user->registration->receipt->file) }}" v-on:click.prevent="showPhoto('{{ asset($user->registration->receipt->file) }}')" class="img-fluid mt-3" style="height: 200px; cursor:pointer">
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        @if ($user->registration->status < 2)
                            <button type="submit" class="btn btn-primary btn-block-xs"><i class="fas {{ $user->registration->receipt ? 'fa-check' : 'fa-upload' }} mr-1"></i> {{ $user->registration->receipt ? 'Update' : 'Upload' }}</button>
                        @else
                            <button type="button" class="btn btn-secondary btn-block-xs" data-dismiss="modal">Close</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<light-box ref="lightbox"></light-box>
@endsection

@section('scripts')
    @if ($errors->any())
        <script>
            $('#paymentConfirmation').modal('show')
        </script>
    @endif
    <script>
        new Vue({
            el: '#app',
            methods: {
                showPhoto(src) {
                    let image = {
                        src: src
                    }
                    this.$refs.lightbox.open(image)
                }
            }
        })
    </script>
@endsection