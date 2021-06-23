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
        <div class="col">
            <form method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}
                <div class="card">
                    <div class="card-header border-bottom-0">
                        <h5 class="m-0 font-weight-normal">Personal Information</h5>
                    </div>
                    <div class="card-body bg-light">
                        <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label text-md-right">Name</label>
                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="Name" required autofocus>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="title" class="col-md-3 col-form-label text-md-right">Academic Title</label>
                            <div class="col-md-8">
                                <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}" placeholder="Academic Title" required>
                                @if ($errors->has('title'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-3 col-form-label text-md-right">Email</label>
                            <div class="col-md-8">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email" required>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="company" class="col-md-3 col-form-label text-md-right">Company</label>
                            <div class="col-md-8">
                                <input id="company" type="text" class="form-control{{ $errors->has('company') ? ' is-invalid' : '' }}" name="company" value="{{ old('company') }}" placeholder="Company" required>
                                @if ($errors->has('company'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('company') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-md-3 col-form-label text-md-right">Address</label>
                            <div class="col-md-8">
                                <textarea name="address" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" id="address" rows="4" required placeholder="Address">{{ old('address') }}</textarea>
                                @if ($errors->has('address'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-md-3 col-form-label text-md-right">Phone / WA</label>
                            <div class="col-md-8">
                                <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" placeholder="Ex: 08xxxxxxxxxx" required>
                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="p-3">
                        <h5 class="m-0 font-weight-normal">
                            Registration
                            @if ($date->isEarlyBird())
                                <span class="badge badge-pill badge-warning float-right ml-2">Early Bird</span>
                            @endif
                            <a href="#" class="text-decoration-none text-muted float-right" data-toggle="modal" data-target="#registrationFeeModal">
                                <i class="far fa-question-circle"></i>
                            </a>
                        </h5>
                    </div>
                    <div class="card-body bg-light">
                        <div class="form-group row">
                            <label for="category_id" class="col-md-3 col-form-label text-md-right">Category</label>
                            <div class="col-md-8">
                                <select v-model="category" name="category_id" id="category_id" class="form-control" required>
                                    <option value="" hidden>Pilih</option>
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}" {{ old('category_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row" v-if="category">
                            <label for="package_id" class="col-md-3 col-form-label text-md-right">Package</label>
                            <div class="col-md-9 pt-2">
                                <template v-if="category == {{ $categories[0]->id }}">
                                    @foreach ($packages as $item)
                                        <div class="custom-control custom-radio pb-2">
                                            <input id="category{{ $loop->iteration }}" v-model="package" class="custom-control-input" type="radio" name="package_id" value="{{ $item->id }}" {{ $loop->first ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="category{{ $loop->iteration }}">
                                                {{ $item->description }} (<b>Rp. {{ number_format($item->fee[0]->fee) }}</b>)
                                            </label>
                                        </div>
                                    @endforeach
                                </template>
                                <template v-if="category == {{ $categories[1]->id }}">
                                    @foreach ($packages as $item)
                                        <div class="custom-control custom-radio pb-2">
                                            <input id="category{{ $loop->iteration }}" v-model="package" class="custom-control-input" type="radio" name="package_id" value="{{ $item->id }}" {{ $loop->first ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="category{{ $loop->iteration }}">
                                                {{ $item->description }} (<b>Rp. {{ number_format($item->fee[1]->fee) }}</b>)
                                            </label>
                                        </div>
                                    @endforeach
                                </template>
                                @if ($errors->has('package_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('package_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <template v-if="category && package">
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-md-right">Profession</label>
                                <div class="col-md-8">
                                    <select v-model="level" name="level_id" class="form-control" v-on:change="getWorkshop()" required>
                                        <option value="" hidden>Pilih</option>
                                        @foreach ($levels as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row" v-if="haveWorkshop">
                                <label class="col-md-3 col-form-label text-md-right">Workshop</label>
                                <div class="col-md-8 pt-2">
                                    <div class="custom-control custom-checkbox" v-for="item in workshops">
                                        <input class="custom-control-input" :class="[item.category, item.time]" v-model="form.workshop" name="workshop[]" type="checkbox" :value="item.id" :id="item.id" v-on:change="checkElement" :onclick="item.id == 1 ? 'return false' : ''">
                                        <label class="custom-control-label" :for="item.id">
                                            @{{ item.name }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </template>
                        <hr>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-3">
                                <button type="submit" class="btn btn-primary btn-block-xs">
                                    Register
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

    @include('auth.register.registration_fee')
</div>
@endsection

@section('scripts')
    <script>
        new Vue({
            el: '#app',
            data: {
                category: '{{ old('category_id') }}',
                package: '{{ old('package_id', '1') }}',
                level: '',
                workshops: [],
                form: {
                    workshop: [1],
                }
            },
            watch: {
                package() {
                    this.getWorkshop()
                },
                'form.workshop'(value) {
                    if (this.maxWorkshop < 3) {
                        if (value.length >= this.maxWorkshop) {
                            $('.workshop:not(:checked)').attr('disabled', 'disabled');
                        } else {
                            $('.workshop').removeAttr('disabled');
                        }
                    } else {
                        let dayWorkshop = $('.day').length
                        let nightWorkshop = $('.night').length

                        if (dayWorkshop > 1) {
                            let dayInCheck = $('.day:checked').length
                            if (dayInCheck > 0) {
                                $('.day:not(:checked)').attr('disabled', 'disabled');
                            } else {
                                $('.day:disabled').removeAttr('disabled');;
                            }
                        }

                        if (nightWorkshop > 1) {
                            let nightInCheck = $('.night:checked').length
                            if (nightInCheck > 0) {
                                $('.night:not(:checked)').attr('disabled', 'disabled');
                            } else {
                                $('.night:disabled').removeAttr('disabled');;
                            }
                        }
                    }
                }
            },
            computed: {
                haveWorkshop() {
                    return Object.keys(this.workshops).length > 0
                },
                maxWorkshop() {
                    let value = parseInt(this.package)
                    if (value > 1) {
                        value = value-1
                    }
                    return value;
                }
            },
            methods: {
                getWorkshop() {
                    this.form.workshop = []
                    if (this.package != 2) {
                        this.form.workshop = [1]
                    }
                    if (this.package && this.level) {
                        axios.get('/workshops', {
                            params: {
                                package: this.package,
                                level: this.level,
                            }
                        })
                        .then(({ data }) => {
                            this.workshops = data
                        });
                    }
                },
                checkElement() {
                    // let el = event.target
                    // let inDay = $(el).hasClass('day')
                    // let inNight = $(el).hasClass('night')
                    // if (inDay) {
                    //     $('.day:not(:checked)').attr('disabled', 'disabled')
                    // }
                    // if (inNight) {
                    //     $('.night:not(:checked)').attr('disabled', 'disabled')
                    // }
                }
            }
        });
    </script>
@endsection