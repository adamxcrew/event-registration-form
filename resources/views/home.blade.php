@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <h1 class="display-4">Hi, {{ explode(" ", Auth::user()->name)[0] }}!</h1>
        <p class="lead mb-1 d-none d-md-block">
            {{ config('app.desc') }}
        </p>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header font-weight-bold"><i class="far fa-money-bill-alt"></i> Bill</div>
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
                                    <td nowrap>Paket Workshop<span class="float-right">:</span></td>
                                    <td class="pl-2">
                                        {{ IDR($user->registration->paybill) }} - "{{ $user->registration->package->name ?? $user->registration->package->name }}"
                                    </td>
                                </tr>
                                @if ($user->registration->booking)
                                    <tr>
                                        <td nowrap>Akomodasi <span class="float-right">:</span></td>
                                        <td class="pl-2">
                                            Rp. {{ $user->registration->booking->fee }} -
                                            {{ $user->registration->booking->roomType->accommodation->hotel }}.
                                            Tipe <i><u>{{ $user->registration->booking->roomType->type }}</u></i>.
                                            Selama {{ $user->registration->booking->duration }} malam.
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td nowrap>Workshop + Akomodasi <span class="float-right">:</span></td>
                                        <td class="pl-2">
                                            <b>Rp. {{ number_format(($user->registration->booking->getOriginal('fee') + $user->registration->getOriginal('paybill')), 0,',','.') }},-</b>
                                        </td>
                                    </tr>
                                @endif
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
                                    <td nowrap class="pl-2">
                                        @if ($user->registration->receipt()->exists())
                                            @if ($user->registration->receipt->fileInfo()['extension'] == 'pdf')
                                                <a href="{{ asset($user->registration->receipt->file) }}" class="text-decoration-none text-muted" target="_blank">
                                                    <i class="far fa-file-pdf"></i>
                                                    {{ $user->registration->receipt->fileInfo()['filename'] }} ({{ strtoupper($user->registration->receipt->fileInfo()['extension']) }})
                                                </a>
                                            @else
                                                <a href="#" class="text-decoration-none text-muted" v-on:click.prevent="showPhoto('{{ asset($user->registration->receipt->file) }}')">
                                                    <i class="far fa-image"></i>
                                                    {{ $user->registration->receipt->fileInfo()['filename'] }} ({{ strtoupper($user->registration->receipt->fileInfo()['extension']) }})
                                                </a>
                                            @endif
                                            @if ($user->registration->status <= 2)
                                                | <a href="#" class="ml-1 text-decoration-none text-muted" data-toggle="modal" data-target="#paymentConfirmation">
                                                    <i class="far fa-edit"></i> edit
                                                </a>
                                            @endif
                                        @else
                                            <button class="btn btn-sm btn-primary px-4" data-toggle="modal" data-target="#paymentConfirmation">
                                                <i class="fas fa-upload mr-1"></i> Upload Bukti Pembayaran
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                                @if ($user->registration->status > 2)
                                    <tr>
                                        <td nowrap>Kupon <span class="float-right">:</span></td>
                                        <td nowrap class="pl-2">
                                            <a href="{{ route('my.ticket') }}" class="text-decoration-none text-muted">
                                                <i class="fas fa-print mr-1"></i>
                                                Cetak Kupon
                                            </a>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header font-weight-bold"><i class="far fa-calendar-check"></i> Workshop</div>
                    <div class="card-body p-2">
                        <ol>
                            @foreach ($user->registration->events as $item)
                                <li>{{ $item->name }}</li>
                            @endforeach
                        </ol>
                    </div>
                </div>
                @if ($user->registration->booking)
                    <div class="card">
                        <div class="card-header font-weight-bold"><i class="far fa-calendar-check"></i> Accommodation</div>
                        <div class="card-body">
                            <b>{{ $user->registration->booking->roomType->accommodation->hotel }}</b>
                            <p>{{ $user->registration->booking->roomType->accommodation->address }}</p>
                            <table>
                                <tr>
                                    <th>Room Type <span class="float-right ml-4"> :</span></th>
                                    <td class="px-2">{{ $user->registration->booking->roomType->type }}</td>
                                </tr>
                                <tr>
                                    <th>Durasi <span class="float-right"> :</span></th>
                                    <td class="px-2">{{ $user->registration->booking->duration }} malam</td>
                                </tr>
                                <tr>
                                    <th>Check In <span class="float-right"> :</span></th>
                                    <td class="px-2">{{ date('d/m/Y', strtotime($user->registration->booking->check_in)) }}</td>
                                </tr>
                                <tr>
                                    <th>Check Out <span class="float-right"> :</span></th>
                                    <td class="px-2">{{ date('d/m/Y', strtotime($user->registration->booking->check_out)) }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                @endif
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
                            <input type="date" name="paid_at" id="paid_at" class="form-control{{ $errors->has('paid_at') ? ' is-invalid' : '' }}" value="{{ old('paid_at', $user->registration->receipt ? $user->registration->receipt->getOriginal('paid_at') : '') }}" placeholder="Tanggal Transfer sesuai dengan struk." required>
                            @if ($errors->has('paid_at'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('paid_at') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="struk">Bukti Transfer <small class="text-muted">(JPG/PDF, maks: 2048 KB)</small></label>
                            <input id="struk" type="file" class="{{ $errors->has('struk') ? 'form-control is-invalid' : '' }}" accept=".png,.jpeg,.jpg,.pdf" name="struk" value="{{ old('struk') }}" placeholder="Foto Bukti Pembayaran" {{ !$user->registration->receipt ? 'required' : '' }}>
                            @if ($errors->has('struk'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('struk') }}</strong>
                                </span>
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
            // $('#paymentConfirmation').modal('show')
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