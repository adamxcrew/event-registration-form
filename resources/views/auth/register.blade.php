@extends('layouts.auth')

@section('body', 'register')

@php
    $schedule = $date->isEarlyBird() ? 'early' : 'normal';
@endphp

@section('content')
<div class="container">
    <div class="register-logo">
        <a href="{{ url('/') }}" class="font-weight-bold">Event Registration</a>
        <p class="lead">
            {!! config('app.desc') !!}
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

                    <div class="p-3 d-flex">
                        <h5 class="my-0 font-weight-normal mr-auto">
                            Registration
                            @if ($date->isEarlyBird())
                                <span class="badge badge-pill badge-warning float-right ml-2">Early Bird</span>
                            @endif
                        </h5>

                        @includeWhen($packages->count(), 'auth._pricing')
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

                        @if (isset($packages) && $packages->count())
                            <div class="form-group row" v-if="category">
                                <label for="package_id" class="col-md-3 col-form-label text-md-right">Package</label>
                                <div class="col-md-9 pt-2">
                                    @foreach ($categories as $category)
                                        <template v-if="category == {{ $category->id }}">
                                            @foreach ($packages as $package)
                                                <div class="custom-control custom-radio pb-2">
                                                    <input id="package-{{ $loop->iteration }}" v-model="package" class="custom-control-input" type="radio" name="package_id" value="{{ $package->id }}" {{ $loop->first ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="package-{{ $loop->iteration }}">
                                                        {{ $package->name ?? $package->description }}
                                                        (<b>Rp. {{ number_format($package->prices->where('category_id', $category->id)->pluck($schedule)->first()) }}</b>)
                                                    </label>
                                                </div>
                                            @endforeach
                                        </template>
                                    @endforeach

                                    @if ($errors->has('package_id'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('package_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row" v-if="category && package">
                                <label class="col-md-3 col-form-label text-md-right">Event / Workshop</label>
                                <div class="col-md-9 pt-2">
                                    @foreach ($categories as $category)
                                        <div v-if="category == {{ $category->id }}" class="@error('events') is-invalid @enderror">
                                            @foreach ($events as $event)
                                                <div class="custom-control custom-checkbox pb-2">
                                                    <input v-model="events" id="event-{{ $loop->iteration }}" class="custom-control-input event-checkbox" type="checkbox" name="events[]" value="{{ $event->id }}">
                                                    <label class="custom-control-label" for="event-{{ $loop->iteration }}">
                                                        {{ $event->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                    @error('events')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        @else
                            <div class="form-group row" v-if="category">
                                <label class="col-md-3 col-form-label text-md-right">Event / Workshop</label>
                                <div class="col-md-9 pt-2">
                                    @foreach ($categories as $category)
                                        <div v-if="category == {{ $category->id }}" class="@error('event_id') is-invalid @enderror">
                                            @foreach ($events as $event)
                                                <div class="custom-control custom-radio pb-2">
                                                    <input id="event{{ $loop->iteration }}" class="custom-control-input" type="radio" name="event_id" value="{{ $event->id }}" {{ old('event_id') == $event->id || $loop->first ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="event{{ $loop->iteration }}">
                                                        {{ $event->name }}
                                                        (<b>Rp. {{ number_format($event->prices->where('category_id', $category->id)->pluck($schedule)->first()) }}</b>)
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                    @error('event_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        @endif

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

            <div class="text-center mt-2">
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
                category: @json(old('category_id', '')),
                package: @json(old('package_id', optional($packages->first())->id)),
                events: @json(old('events', [])),
            },
            watch: {
                package() {
                    this.limitChoiceableEvent(this.events.length, this.selectedPackage.max)
                },
                events(value) {
                    this.limitChoiceableEvent(value.length, this.selectedPackage.max)
                },
            },
            computed: {
                selectedPackage() {
                    let packages = @json($packages);
                    return packages.find(package => package.id == this.package);
                }
            },
            methods: {
                limitChoiceableEvent(length, max) {
                    if (length && max != null && length >= max) {
                        $('.event-checkbox:not(:checked)').attr('disabled', 'disabled');
                    } else {
                        $('.event-checkbox:not(:checked)').removeAttr('disabled');
                    }
                }
            }
        });
    </script>
@endsection