@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $allRegistrations }}</h3>
                        <p>User Registration</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <a href="{{ route('participants.index') }}" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $waitingVerifications }}</h3>
                        <p>Waiting Verification</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-clock"></i>
                    </div>
                    <a href="{{ route('participants.index') }}?filter=1" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-6 col-12 d-none d-sm-inline-block">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>Rp. {{ number_format($totalPayments, '0', ',', '.') }},-</h3>
                        <p>Total Payment</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-money-check-alt"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        Total Payment
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container">
        <div class="card">
            <div class="card-header border-bottom-0 d-flex">
                <h5 class="card-title d-inline-block text-muted">
                    About!
                </h5>
                <a href="{{ route('config.index') }}" class="text-muted ml-auto">
                    <i class="fas fa-cog ml-auto"></i>
                </a>
            </div>
            <div class="card-body bg-light">
                <p>
                    {!! linkify(eventInfo('about')) !!}
                </p>
            </div>
        </div>
    </div>
</section>
@endsection
