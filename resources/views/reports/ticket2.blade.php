<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
        }

        table {
			width: 100%;
            border-collapse: collapse;
        }

        .float-right {
            display: inline-block;
            float: right;
        }

        .personal td {
            padding: 3px 0px;
        }

        td.divider {
            padding: 10px 0;
        }

        .table thead > tr {
			height: 100px;
		}

        .table th {
            border: 1px solid black;
			text-align: center;
            padding: 10px 10px;
            background-color: lightsteelblue;
        }

        .table td {
            padding: 5px 15px;
            border: 1px solid black;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        div.absolute {
            position: absolute;
            bottom: 0;
            width: 100%;
            border-top: 2px dashed black;
            padding: 20px 50px;
        }

        .box {
            display: inline-block;
            border: 1px solid black;
            width: 10px;
            height: 10px
            margin-right: 5px;
            margin-left: 5px;
        }
    </style>
</head>
<body>
    <div class="header">
        {{-- <p><b>ACCREDTED BY</b></p> --}}
        <img src="{{ public_path("images/logo2.png") }}" alt="" style="height: 80px; float: left">
        <div>
            <h3 class="text-center" style="margin-bottom: 5px; margin-top: 5px;">
                8<sup>th</sup> Annual Scientific Meeting <br> Indonesia Society of Thoracic Radiology <br>
            </h3>
            <small class="text-center" style="display: block">
                <span class="font-italic">23-24<sup>th</sup> AGUSTUS 2019,
                CLARO HOTEL, MAKASSAR.</span>
            </small>
        </div>
    </div>
    <br style="clear: both">
    <div>
        <h3>Invoice / Kwitansi</h3>
        <table class="personal">
            <tr>
                <td width="30%">No. Invoice <span class="float-right" style="padding-right: 10px">:</span></td>
                <td>{{ $registration->code }}</td>
                <td style="text-align: right">Date : {{ $registration->created_at->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <td nowrap>Full Name <span class="float-right" style="padding-right: 10px">:</span></td>
                <td>{{ $registration->user->participant->name }}</td>
            </tr>
            <tr>
                <td nowrap>Company <span class="float-right" style="padding-right: 10px">:</span></td>
                <td>{{ $registration->user->participant->company }}</td>
            </tr>
            <tr>
                <td nowrap>Address <span class="float-right" style="padding-right: 10px">:</span></td>
                <td>{{ $registration->user->participant->address }}</td>
            </tr>
            <tr>
                <td nowrap>Contact <span class="float-right" style="padding-right: 10px">:</span></td>
                <td>{{ $registration->user->participant->phone }}</td>
            </tr>
            <tr>
                <td nowrap>Email <span class="float-right" style="padding-right: 10px">:</span></td>
                <td>{{ $registration->user->email }}</td>
            </tr>
            <tr>
                <td class="divider" colspan="2"></td>
            </tr>
            <tr>
                <td nowrap>Registration <span class="float-right" style="padding-right: 10px">:</span></td>
                <td>{{ $registration->package->description }}</td>
            </tr>
            <tr>
                <td nowrap>Registration Fee <span class="float-right" style="padding-right: 10px">:</span></td>
                <td>Rp. {{ $registration->paybill }},-</td>
            </tr>
            <tr>
                <td nowrap style="vertical-align: top">Workshop <span class="float-right" style="padding-right: 10px">:</span></td>
                <td>
                    @foreach ($registration->events as $item)
                        {{ $loop->iteration }}. {{ $item->name }} <br>
                    @endforeach
                </td>
            </tr>
        </table>

        <br>
        <h3>Detail Payment</h3>
        <table class="table">
            <thead>
                <tr>
                    <th width="1%">No.</th>
                    <th>Payment Date</th>
                    <th>Bank</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">1.</td>
                    <td class="text-center">{{ $registration->receipt->paid_at->format('d/m/Y') }}</td>
                    <td class="text-center" nowrap>{{ $registration->receipt->bank }} - A/N: {{ $registration->receipt->name }}</td>
                    <td class="text-center">Rp. {{ $registration->paybill }},-</td>
                </tr>
                <tr>
                    <td class="text-right" colspan="3">Total :</td>
                    <td class="text-center">Rp. {{ $registration->paybill }},-</td>
                </tr>
            </tbody>
        </table>
    </div>



    <br><br><br><br><br>
    <div class="absolute" style="margin: 0 -50px">
        <table>
            <tr>
                <td width="1%" nowrap>
                    <img src="{{ public_path('/images/logo2.png') }}" alt="" style="height: 80px">
                </td>
                <td style="padding:10px">
                    <h3 style="text-align: left; margin: 0">KUPON</h3>
                    <sup>*</sup>ket: harap bawa kupon ini untuk ditukarkan dengan seminar kit.
                </td>
                <td width="1%" nowrap>
                    <div class="box"></div> ID Card <br>
                    <div class="box"></div> Seminar Kid <br>
                    <div class="box"></div> Certificate <br>
                    <div class="box"></div> Materi Presentasi <br>
                    <div class="box"></div> Invoice <br>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>