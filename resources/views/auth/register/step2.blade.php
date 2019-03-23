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
                            <label for="accommodation_id" class="col-md-4 col-form-label text-md-right">Hotel :</label>
                            <div class="col-md-6">
                                <select v-model="accommodation_id" name="accommodation_id" id="accommodation_id" class="form-control{{ $errors->has('accommodation_id') ? ' is-invalid' : '' }}" required>
                                    <option value="" hidden>Pilih</option>
                                    @foreach ($accommodations as $item)
                                        <option value="{{ $item->id }}" {{ old('accommodation_id') == $item->id ? 'selected' : '' }}>{{ $item->hotel }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row" v-if="room_types.length">
                            <label class="col-md-4 col-form-label text-md-right">Room Type :</label>
                            <div class="col-md-8 pt-2">
                                <div class="custom-control custom-radio pb-2" v-for="item in room_types" :key="item.id">
                                    <input :id="item.id" v-on:change="setPrice(item.price)" v-model="room_type_id" name="room_type_id" class="custom-control-input" type="radio" name="room_type_id" :value="item.id">
                                    <label class="custom-control-label" :for="item.id">
                                        @{{ item.type }} - Rp. @{{ item.price }}/R/N
                                    </label>
                                </div>
                                @if ($errors->has('room_type_id'))
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $errors->first('room_type_id') }}</strong>
                                    </span>
                                @endif
                                <a href="#" class="text-secondary" v-if="room_type_id" v-on:click.prevent="clear()">
                                    <small class="font-italic"><i class="fas fa-times"></i> Clear selection</small>
                                </a>
                            </div>
                        </div>
                        <div v-if="room_type_id" class="form-group row">
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
                        <div v-if="room_type_id" class="form-group row">
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
                                    <span v-html="accommodation_id && room_type_id ? 'Yes, order!' : 'Skip'"></span>
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
                room_type_id: '{{ old('room_type_id') }}',
                room_types: [],
                check_in: '{{ old('check_in') }}',
                check_out: '{{ old('check_out') }}',
                price: 0,
            },
            watch: {
                accommodation_id(value) {
                    this.getRoomTypes(value)
                }
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
                getRoomTypes(id) {
                    axios.get('/room-types', {
                        params: { id: id }
                    })
                    .then(({ data }) => {
                        this.room_type_id = ''
                        this.room_types = data
                    });
                },
                setPrice(value) {
                    this.price = value.split('.').join('')
                },
                clear() {
                    this.room_type_id = ''
                    this.price = 0
                    this.check_in = '',
                    this.check_out = ''
                }
            },
        });
    </script>
@endsection