<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> --}}
    {{-- <meta http-equiv="X-UA-Compatible" content="ie=edge"> --}}
    <title>Kupon</title>
    <link rel="stylesheet" href="css/ticket.css">
    <style>
        @media print {
        .ticket {
            background-image: url('/images/polygon.png');
            background-color: #f8f9fa;
        }
        }

        .table th, .table td {
            padding: 0.25rem;
        }
    </style>
</head>
<body>
    <div class="container pt-5">
        <div class="row shadow-lg bg-light rounded ticket border">
            <div class="col-3 p-3" style="height: 270px">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="img-fluid">
                <span class="d-block text-center mt-3 mb-1 font-weight-bold">
                    <u>KUPON</u>
                </span>
                <div class="input-group input-group-sm mb-3" style="border-bottom: grey 1px dashed">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-white border-0">No.</span>
                    </div>
                    <input type="text" class="form-control border-0 font-weight-bold" placeholder="{{ $registration->code }}">
                </div>
                <div class="text-center font-weight-bold">
                    <span class="font-italic">23-24<sup>th</sup> AGUSTUS 2019</span> <br>
                    CLARO HOTEL, MAKASSAR
                </div>
            </div>
            <div class="col p-3" style="border-left: dashed black 2px">
                <div class="row">
                    <div class="col-auto">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" height="60px">
                    </div>
                    <div class="col text-center">
                        <h5 class="mb-0">
                            8<sup>th</sup> Annual Scientific Meeting <br> Indonesia Society of Thoracic Radiology
                        </h5>
                        <small>
                            <span class="font-italic">23-24<sup>th</sup> AGUSTUS 2019,
                            CLARO HOTEL, MAKASSAR.</span>
                        </small>
                    </div>
                </div>
                <div class="row justify-content-end">
                    <div class="col-11">
                        <hr>
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <th>NO. REG <span class="float-right">:</span></th>
                                    <td>{{ $registration->code }}</td>
                                    <td class="text-right"><b>TANGGAL :</b> {{ $registration->created_at->format('d/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <th>NAMA <span class="float-right">:</span></th>
                                    <td>{{ $registration->user->participant->name }}</td>
                                </tr>
                                <tr>
                                    <th nowrap width="25%">BIAYA REGISTRASI <span class="float-right">:</span></th>
                                    <td>Rp. {{ $registration->paybill }},-</td>
                                </tr>
                                <tr>
                                    <th>AKOMODASI <span class="float-right">:</span></th>
                                    <td>Rp. {{ $registration->booking->fee }},-</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>