<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kupon</title>
    <style>
        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: left;
            background-color: #fff;
        }
        .ticket {
            background-image: url('/images/polygon.png')
        }

        .table th,
        .table td {
            padding: 0.25rem;
        }

        .container {
            max-width: 960px;
        }

        .container {
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }

        .pt-5,
        .py-5 {
            padding-top: 3rem !important;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }

        .col,
        .col-3, .col-auto {
            position: relative;
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
        }

        .col-auto {
            flex: 0 0 auto;
            width: auto;
            max-width: 100%;
        }

        .col-3 {
            flex: 0 0 25%;
            max-width: 25%;
        }

        .col {
            flex-basis: 0;
            flex-grow: 1;
            max-width: 100%;
        }

        .shadow-lg {
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175) !important;
        }

        .rounded {
            border-radius: 0.25rem !important;
        }

        .bg-light {
            background-color: #f8f9fa !important;
        }

        .border {
            border: 1px solid #dee2e6 !important;
        }

        .p-3 {
            padding: 1rem !important;
        }

        .img-fluid {
            max-width: 100%;
            height: auto;
        }

        img {
            vertical-align: middle;
            border-style: none;
        }

        .font-weight-bold {
            font-weight: 700 !important;
        }

        .text-center {
            text-align: center !important;
        }

        .mt-3,
        .my-3 {
            margin-top: 1rem !important;
        }

        .mb-3,
        .my-3 {
            margin-bottom: 1rem !important;
        }

        .mb-1,
        .my-1 {
            margin-bottom: 0.25rem !important;
        }

        .d-block {
            display: block !important;
        }

        h5,
        .h5 {
            font-size: 1.25rem;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        .h1,
        .h2,
        .h3,
        .h4,
        .h5,
        .h6 {
            margin-bottom: 0.5rem;
            font-weight: 500;
            line-height: 1.2;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin-top: 0;
            margin-bottom: 0.5rem;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
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
                <div class="mb-3" style="border-bottom: grey 1px dashed; background-color: white; padding: 5px; text-align: center">
                    <b>No: {{ $registration->code }}</b>
                </div>
                <div class="text-center font-weight-bold">
                    <i>23-24<sup>th</sup> AGUSTUS 2019</i> <br>
                    CLARO HOTEL, MAKASSAR
                </div>
            </div>
            <div class="col p-3" style="border-left: dashed black 2px">
                <div class="row">
                    <div class="col-auto">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" height="60px">
                    </div>
                    <div class="col text-center">
                        <h5 style="margin-bottom: 0">
                            8<sup>th</sup> Annual Scientific Meeting <br> Indonesia Society of Thoracic Radiology
                        </h5>
                        <small>
                            <i>23-24<sup>th</sup> AGUSTUS 2019, CLARO HOTEL, MAKASSAR.</i>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>