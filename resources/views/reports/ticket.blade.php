<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kupon</title>
    <link rel="stylesheet" href="css/ticket.css">
    <style>
        .ticket {
            background-image: url('/images/polygon.png');
            background-color: #f8f9fa;
        }

        .table th, .table td {
            padding: 0.25rem;
        }

        .table tr {
            border-bottom: black 1px dashed;
        }
    </style>
</head>
<body>
    <div class="container mt-3">
        <div id="ticket" class="row m-0 p-0 ticket border" style="width: 900px">
            <div class="col-4 p-3" style="height: 280px">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="img-fluid">
                <span class="d-block text-center mt-3 mb-1 font-weight-bold">
                    <u>KUPON</u>
                </span>
                <div class="form-group" style="border-bottom: grey 1px dashed">
                    <input type="text" class="form-control form-control-sm border-0 font-weight-bold text-center" placeholder="No. {{ $registration->code }}">
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
                    <div class="col-12">
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
                                    <td></td>
                                </tr>
                                <tr>
                                    <th nowrap>BIAYA REGISTRASI <span class="float-right">:</span></th>
                                    <td>Rp. {{ $registration->paybill }},-</td>
                                    <td></td>
                                </tr>
                                @if ($registration->booking)
                                    <tr>
                                        <th>AKOMODASI <span class="float-right">:</span></th>
                                        <td>Rp. {{ $registration->booking->fee }},-</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th>TOTAL <span class="float-right">:</span></th>
                                        <td>Rp. {{ number_format(($registration->getOriginal('paybill') + $registration->booking->getOriginal('fee')), '0', ',', '.') }},-</td>
                                        <td></td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.min.js"></script>
    <script>
        var ticket = document.getElementById('ticket');
        domtoimage.toPng(ticket)
        .then(function (dataUrl) {
            var link = document.createElement('a');
            link.download = "{{ $registration->code }}" + '.jpeg';
            link.href = dataUrl;
            link.click();
        })
        .catch(function (error) {
            console.error('oops, something went wrong!', error);
        })
        .then(function () {
            window.close()
        });
    </script>
</body>
</html>