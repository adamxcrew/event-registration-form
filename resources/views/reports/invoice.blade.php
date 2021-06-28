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

        hr.header {
            border: 0;
            height: 2px;
            border-top: solid black 2px;
            border-bottom: solid black 0.5px;
            margin-top: 20px;
        }

        .float-right {
            display: inline-block;
            float: right;
        }

        .personal td {
            padding: 1px 0px;
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
            padding: 5px 10px;
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
        <img src="{{ public_path("images/logo2.png") }}" alt="" style="height: 80px; float: left">
        <img src="{{ public_path("images/logo3.png") }}" alt="" style="height: 80px; float: left; margin-left: 10px">
        <div style="margin-left: -80px">
            <h3 class="text-center" style="margin-bottom: 5px; margin-top: 5px;">
                8<sup>th</sup> Annual Scientific Meeting <br> Indonesia Society of Thoracic Radiology <br>
            </h3>
            <small class="text-center" style="display: block">
                <span class="font-italic">23-24<sup>th</sup> AGUSTUS 2019,
                CLARO HOTEL, MAKASSAR.</span>
            </small>
        </div>
    </div>
    <hr class="header" style="clear: both;">
    <div>
        <h3 style="margin-top: 10px; margin-bottom: 5px">Invoice / Kwitansi</h3>
        <table class="personal">
            <tr>
                <td width="30%">No. Invoice <span class="float-right" style="padding-right: 10px">:</span></td>
                <td>{{ $registration->code }}</td>
                <td style="text-align: right">Date : {{ $registration->updated_at->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <td nowrap>Full Name <span class="float-right" style="padding-right: 10px">:</span></td>
                <td colspan="2">{{ $registration->participant->name }}</td>
            </tr>
            <tr>
                <td nowrap>Academic Title <span class="float-right" style="padding-right: 10px">:</span></td>
                <td colspan="2">{{ $registration->participant->title ?? '-' }}</td>
            </tr>
            <tr>
                <td nowrap>Company <span class="float-right" style="padding-right: 10px">:</span></td>
                <td colspan="2">{{ $registration->participant->company }}</td>
            </tr>
            <tr>
                <td nowrap style="vertical-align: top">Address <span class="float-right" style="padding-right: 10px">:</span></td>
                <td colspan="2">{{ $registration->participant->address }}</td>
            </tr>
            <tr>
                <td nowrap>Contact <span class="float-right" style="padding-right: 10px">:</span></td>
                <td colspan="2">{{ $registration->participant->phone }}</td>
            </tr>
            <tr>
                <td nowrap>Email <span class="float-right" style="padding-right: 10px">:</span></td>
                <td colspan="2">{{ $registration->user->email }}</td>
            </tr>
            <tr>
                <td nowrap style="vertical-align: top">Registration <span class="float-right" style="padding-right: 10px">:</span></td>
                <td colspan="2">
                    {{ $registration->package->description }} <br>
                    @foreach ($registration->events->groupBy('category') as $key => $item)
                        {{ $loop->iteration }}. {{ ucwords($key) }} <br>
                        @if ($key == 'workshop')
                            @foreach ($item as $workshop)
                                <div style="padding-left: 20px">- {{ $workshop->name }}</div>
                            @endforeach
                        @endif
                    @endforeach
                </td>
            </tr>
            <tr>
                <td nowrap>Registration Fee <span class="float-right" style="padding-right: 10px">:</span></td>
                <td colspan="2">{{ IDR($registration->paybill) }}</td>
            </tr>
        </table>

        <h3 style="margin-bottom: 5px">Detail Payment</h3>
        <table class="table">
            <thead>
                <tr>
                    <th width="1%">No.</th>
                    <th width="1%" nowrap>Payment Date</th>
                    <th>Bank</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">1.</td>
                    <td class="text-center">{{ $registration->receipt->paid_at->format('d/m/Y') }}</td>
                    <td class="text-center">{{ $registration->receipt->bank }} - A/N: {{ $registration->receipt->name }}</td>
                    <td class="text-center"  width="1%" nowrap>{{ IDR($registration->paybill) }}</td>
                </tr>
                <tr>
                    <td class="text-right" colspan="3"><b>Total :</b></td>
                    <td class="text-center"  width="1%" nowrap><b>{{ IDR($registration->paybill) }}</b></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="absolute">
        <table>
            <tr>
                <td></td>
                <td width="1%" class="text-center" nowrap>
                    Bendahara
                    <div style="margin: 8px 0 0">
                        <img src="{{ public_path("images/marker.png") }}" alt="" style="height: 80px;">
                    </div>
                    dr. Erlin Sjahril, Sp.Rad(K)TR
                </td>
            </tr>
        </table>

        <hr style="margin: 15px -50px 10px; border-style: dashed">

        <table>
            <tr>
                <td width="160px">
                    <div style="margin-top: 20px">
                        <img src="{{ public_path('/images/logo2.png') }}" alt="" style="width: 75px">
                        <img src="{{ public_path('/images/logo3.png') }}" alt="" style="width: 75px">
                    </div>
                </td>
                <td style="padding:10px; vertical-align: top">
                    <h3 style="text-align: left; margin: 0">KUPON</h3>
                    <sup>*</sup>ket: harap bawa kupon ini untuk ditukarkan dengan seminar kit.
                </td>
                <td width="1%" nowrap style="padding:10px; vertical-align: top">
                    <div class="box"></div> ID Card <br>
                    <div class="box"></div> Seminar Kit <br>
                    <div class="box"></div> Certificate <br>
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td width="25%">No. Invoice <span class="float-right" style="padding-right: 10px">:</span></td>
                <td>{{ $registration->code }}</td>
                <td style="vertical-align: bottom" rowspan="7" width="1%" class="text-center" nowrap>
                    Bendahara
                    <div style="margin: 8px 0 0">
                        <img src="{{ public_path("images/marker.png") }}" alt="" style="height: 80px;">
                    </div>
                    dr. Erlin Sjahril, Sp.Rad(K)TR
                </td>
            </tr>
            <tr>
                <td nowrap>Full Name <span class="float-right" style="padding-right: 10px">:</span></td>
                <td>{{ $registration->participant->name }}</td>
            </tr>
            <tr>
                <td nowrap>Academic Title <span class="float-right" style="padding-right: 10px">:</span></td>
                <td>{{ $registration->participant->title ?? '-' }}</td>
            </tr>
            <tr>
                <td nowrap>Company <span class="float-right" style="padding-right: 10px">:</span></td>
                <td>{{ $registration->participant->company }}</td>
            </tr>
            <tr>
                <td nowrap style="vertical-align: top">Address <span class="float-right" style="padding-right: 10px">:</span></td>
                <td>{{ $registration->participant->address }}</td>
            </tr>
            <tr>
                <td nowrap>Contact <span class="float-right" style="padding-right: 10px">:</span></td>
                <td>{{ $registration->participant->phone }}</td>
            </tr>
            <tr>
                <td nowrap>Email <span class="float-right" style="padding-right: 10px">:</span></td>
                <td>{{ $registration->user->email }}</td>
            </tr>
        </table>
    </div>
</body>
</html>