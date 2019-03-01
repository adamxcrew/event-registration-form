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
                            <label for="profession" class="col-md-3 col-form-label text-md-right">Profession</label>
                            <div class="col-md-8">
                                <input id="profession" type="text" class="form-control{{ $errors->has('profession') ? ' is-invalid' : '' }}" name="profession" value="{{ old('profession') }}" placeholder="Profession" required>
                                @if ($errors->has('profession'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('profession') }}</strong>
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
                        <h5 class="m-0 font-weight-normal">Billing</h5>
                        <a href="#" class="text-decoration-none text-muted ml-auto" data-toggle="modal" data-target="#registrationFeeModal">
                            <i class="far fa-question-circle"></i>
                        </a>
                        <div class="modal fade" id="registrationFeeModal" role="dialog" aria-labelledby="registrationFeeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header border-bottom-0">
                                        <h5 class="modal-title" id="registrationFeeModalLabel">Registration Fee</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body p-0 table-responsive">
                                        <table class="table table-bordered mb-0">
                                            <thead>
                                                <tr>
                                                    <th class="align-middle" nowrap rowspan="2">Package</th>
                                                    <th class="text-center" nowrap colspan="2">
                                                        Early Bird <br>
                                                        <span class="font-weight-light">(Until {{ $date->early_bird->format("j M Y") }})</span>
                                                    </th>
                                                    <th class="text-center" nowrap colspan="2">
                                                        Normal <br>
                                                        <span class="font-weight-light">(Start from {{ $date->normal->format("j M Y") }})</span>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th class="text-center" nowrap>Specialist</th>
                                                    <th class="text-center" nowrap>GP & Resident</th>
                                                    <th class="text-center" nowrap>Specialist</th>
                                                    <th class="text-center" nowrap>GP & Resident</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($packages as $package)
                                                    <tr>
                                                        <td>{{ $package->description }}</td>
                                                        <td class="text-center">Rp. {{ number_format($package->fee[0]->early_fee) }}</td>
                                                        <td class="text-center">Rp. {{ number_format($package->fee[1]->early_fee) }}</td>
                                                        <td class="text-center">Rp. {{ number_format($package->fee[0]->normal_fee) }}</td>
                                                        <td class="text-center">Rp. {{ number_format($package->fee[1]->normal_fee) }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="modal-footer border-top-0">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body bg-light">
                        <div class="form-group row">
                            <label for="category_id" class="col-md-3 col-form-label text-md-right">Category</label>
                            <div class="col-md-8">
                                <select v-model="category" name="category_id" id="category_id" class="form-control" required>
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="package_id" class="col-md-3 col-form-label text-md-right">Package</label>
                            <div class="col-md-9">
                                <template v-if="category == {{ $categories[0]->id }}">
                                    @foreach ($packages as $item)
                                        <div class="form-check pb-2">
                                            <input id="category{{ $loop->iteration }}" class="form-check-input" type="radio" name="package_id" value="{{ $item->id }}" {{ $loop->first ? 'checked' : '' }}>
                                            <label class="form-check-label pl-2" for="category{{ $loop->iteration }}">
                                                {{ $item->description }} (<b>Rp. {{ number_format($item->fee[0]->fee) }} - {{ $item->fee[0]->category->name }}</b>)
                                            </label>
                                        </div>
                                    @endforeach
                                </template>
                                <template v-if="category == {{ $categories[1]->id }}">
                                    @foreach ($packages as $item)
                                        <div class="form-check pb-2">
                                            <input id="category{{ $loop->iteration }}" class="form-check-input" type="radio" name="package_id" value="{{ $item->id }}" {{ $loop->first ? 'checked' : '' }}>
                                            <label class="form-check-label pl-2" for="category{{ $loop->iteration }}">
                                                {{ $item->description }} (<b>Rp. {{ number_format($item->fee[1]->fee) }} - {{ $item->fee[1]->category->name }}</b>)
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
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-3">
                                <button type="submit" class="btn btn-primary btn-block-xs">
                                    {{ __('Register') }}
                                </button>
                                <span class="ml-sm-2 d-block d-sm-inline text-center">
                                    <a href="{{ url('/login') }}">If you have already registered, Login here.</a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        var category_id = "{{ $categories[0]->id }}"
        new Vue({
            el: '#app',
            data: {
                category: category_id
            }
        });
    </script>
@endsection