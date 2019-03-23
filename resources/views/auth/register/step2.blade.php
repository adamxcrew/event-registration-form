@extends('layouts.auth')

@section('body', 'register-page')

@section('content')
<div class="container" style="margin: 2% auto">
    <div class="register-logo">
        <a href="{{ url('/') }}" class="font-weight-bold">Event Registration</a>
        <p class="lead">
            8 Annual Scientific Meeting Indonesia Society of Thoracic Radiology <br>
            <b class="text-uppercase">Comprehensive Thoracic Imaging</b>
        </p>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <form method="POST" action="{{ url('/register/final') }}">
                {{ csrf_field() }}
                <div class="card">
                    <div class="card-header border-bottom-0">
                        <h5 class="m-0 font-weight-normal">
                            Accommodation
                        </h5>
                    </div>
                    <div class="card-body bg-light">
                        <div class="form-group row">
                            <label for="hotel" class="col-md-4 col-form-label text-md-right">Hotel :</label>
                            <div class="col-md-8">
                                <span class="form-control-plaintext">
                                    <b>{{ $accommodations[0]->hotel }}</b>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Room Type :</label>
                            <div class="col-md-8 pt-2">
                                @foreach ($accommodations as $item)
                                    <div class="custom-control custom-radio pb-2">
                                        <input id="accommodation{{ $loop->iteration }}" v-on:change="price={{ str_replace('.', '',$item->price) }}" v-model="accommodation_id" name="accommodation_id" class="custom-control-input" type="radio" name="accommodation_id" value="{{ $item->id }}">
                                        <label class="custom-control-label" for="accommodation{{ $loop->iteration }}">
                                            {{ $item->rate }} - Rp. {{ $item->price }}/R/N
                                        </label>
                                    </div>
                                @endforeach
                                @if ($errors->has('accommodation_id'))
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $errors->first('accommodation_id') }}</strong>
                                    </span>
                                @endif
                                <a href="#" class="text-secondary" v-if="accommodation_id" v-on:click.prevent="clear()">
                                    <small class="font-italic"><i class="fas fa-times"></i> Clear selection</small>
                                </a>
                            </div>
                        </div>
                        <div v-if="accommodation_id" class="form-group row">
                            <label for="check_in" class="col-md-4 col-form-label text-md-right">Check-in :</label>
                            <div class="col-md-4">
                                <input type="date" v-model="check_in" name="check_in" id="check_in" class="form-control{{ $errors->has('check_in') ? ' is-invalid' : '' }}" placeholder="Check-in.." :required="accommodation_id != ''">
                                @if ($errors->has('check_id'))
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $errors->first('check_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div v-if="accommodation_id" class="form-group row">
                            <label for="check_out" class="col-md-4 col-form-label text-md-right">Check-out :</label>
                            <div class="col-md-4">
                                <input type="date" v-model="check_out" name="check_out" id="check_out" class="form-control{{ $errors->has('check_out') ? ' is-invalid' : '' }}" placeholder="Check-out.." :required="accommodation_id != ''">
                                @if ($errors->has('check_out'))
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $errors->first('check_out') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row" v-if="duration">
                            <label class="col-md-4 col-form-label text-md-right">Booking Duration :</label>
                            <div class="col-md-8">
                                <span class="form-control-plaintext">
                                    @{{ duration }} nights - Rp. @{{ bill }}
                                </span>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-block-xs">
                                    Next <i class="fas fa-arrow-right ml-1"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <div class="text-center">
                <a href="{{ url('/login') }}">If you have already registered, <b>Login here!</b></a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        new Vue({
            el: '#app',
            data: {
                accommodation_id: '{{ old('accommodation_id') }}',
                check_in: '{{ old('check_in') }}',
                check_out: '{{ old('check_out') }}',
                price: 0,
            },
            watch: {
                //
            },
            computed: {
                duration() {
                    if (this.check_in && this.check_out) {
                        var dateFirst = new Date(this.check_in);
                        var dateSecond = new Date(this.check_out);

                        var timeDiff = Math.abs(dateSecond.getTime() - dateFirst.getTime());
                        var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
                        return diffDays;
                    }
                },
                bill() {
                    if (this.price && this.duration) {
                        let total = this.price * this.duration
                        return new Intl.NumberFormat('nl-NL').format(total);
                    }
                }
            },
            methods: {
                clear() {
                    this.accommodation_id = ''
                    this.price = 0
                    this.check_in = '',
                    this.check_out = ''
                }
            },
        });
    </script>
@endsection