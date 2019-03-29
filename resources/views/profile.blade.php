@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark display-4">Profile</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header p-2 border-bottom-0">
                <ul class="nav nav-tabs">
                    <li class="nav-item"><a class="nav-link {{ $errors->any() ? '' : 'active' }}" href="#personal" data-toggle="tab">Personal Information</a></li>
                    <li class="nav-item"><a class="nav-link {{ $errors->any() ? 'active' : '' }}" href="#setting" data-toggle="tab"><i class="far fa-edit"></i></a></li>
                </ul>
            </div>
            <div class="card-body px-2 py-0">
                <div class="tab-content">
                    <div class="tab-pane {{ $errors->any() ? '' : 'active' }}" id="personal">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td class="border-top-0" width="25%">Nama <span class="float-right">:</span></td>
                                        <td class="border-top-0 pl-2">{{ $user->participant->name }}</td>
                                    </tr>
                                    <tr>
                                        <td nowrap>Gelar <span class="float-right">:</span></td>
                                        <td class="pl-2">{{ $user->participant->title }}</td>
                                    </tr>
                                    <tr>
                                        <td nowrap>Email <span class="float-right">:</span></td>
                                        <td class="pl-2">{{ $user->email }}</td>
                                    </tr>
                                    <tr>
                                        <td nowrap>
                                            <span class="d-none d-sm-inline">Tempat, Tanggal Lahir</span>
                                            <span class="d-inline d-sm-none">TTL</span>
                                            <span class="float-right">:</span>
                                        </td>
                                        <td class="pl-2">{{ $user->participant->birth ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td nowrap>Jenis Kelamin <span class="float-right">:</span></td>
                                        <td class="pl-2">{{ $user->participant->gender() }}</td>
                                    </tr>
                                    <tr>
                                        <td nowrap>Alamat <span class="float-right">:</span></td>
                                        <td class="pl-2">{{ $user->participant->address }}</td>
                                    </tr>
                                    <tr>
                                        <td nowrap>Telp <span class="float-right">:</span></td>
                                        <td class="pl-2">{{ $user->participant->phone }}</td>
                                    </tr>
                                    <tr>
                                        <td nowrap>Organisasi <span class="float-right">:</span></td>
                                        <td class="pl-2">{{ $user->participant->company }}</td>
                                    </tr>
                                    <tr>
                                        <td nowrap>Keterangan <span class="float-right">:</span></td>
                                        <td class="pl-2">{!! $user->participant->information ?? '<i class="text-muted">Kosong</i>' !!}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane p-3 {{ $errors->any() ? 'active' : '' }}" id="setting">
                        <div class="row justify-content-center">
                            <div class="col-12">
                                <form action="{{ route('profile.update') }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('patch') }}
                                    <div class="form-group row">
                                        <label for="name" class="col-md-3 col-form-label text-md-right">Nama Lengkap</label>
                                        <div class="col-md-7">
                                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $user->participant->name }}" placeholder="Nama" required autofocus>
                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="title" class="col-md-3 col-form-label text-md-right">Gelar</label>
                                        <div class="col-md-7">
                                            <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ $user->participant->title }}" placeholder="Gelar" required>
                                            @if ($errors->has('title'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('title') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-md-3 col-form-label text-md-right">Email</label>
                                        <div class="col-md-7">
                                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $user->email }}" placeholder="Email" required>
                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="birth_place" class="col-md-3 col-form-label text-md-right">Tempat, Tgl Lahir</label>
                                        <div class="col-md-4">
                                            <input id="birth_place" type="text" class="mb-3 mb-md-0 form-control{{ $errors->has('birth_place') ? ' is-invalid' : '' }}" name="birth_place" value="{{ $user->participant->birth_place }}" placeholder="Tempat Lahir" required>
                                            @if ($errors->has('birth_place'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('birth_place') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-md-3">
                                            <input id="birth_date" type="date" class="form-control{{ $errors->has('birth_date') ? ' is-invalid' : '' }}" name="birth_date" value="{{ $user->participant->birth_date ? $user->participant->birth_date->format('Y-m-d') : '' }}" placeholder="Tanggal: DD/MM/TTTT" required>
                                            @if ($errors->has('birth_date'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('birth_date') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label text-md-right">Jenis Kelamin</label>
                                        <div class="col-md-7 pt-md-2">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gender" id="gender1" value="L"{{ $user->participant->gender == 'L' ? ' checked' : '' }}>
                                                <label class="form-check-label" for="gender1">Laki-laki</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gender" id="gender2" value="P"{{ $user->participant->gender == 'P' ? ' checked' : '' }}>
                                                <label class="form-check-label" for="gender2">Perempuan</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="address" class="col-md-3 col-form-label text-md-right">Alamat</label>
                                        <div class="col-md-7">
                                            <textarea name="address" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" id="address" rows="3" required placeholder="Alamat Lengkap">{{ $user->participant->address }}</textarea>
                                            @if ($errors->has('address'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('address') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="phone" class="col-md-3 col-form-label text-md-right">Telp</label>
                                        <div class="col-md-7">
                                            <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ $user->participant->phone }}" placeholder="Ex: 08xxxxxxxxxx">
                                            @if ($errors->has('phone'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('phone') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="company" class="col-md-3 col-form-label text-md-right">Organisasi</label>
                                        <div class="col-md-7">
                                            <input id="company" type="text" class="form-control{{ $errors->has('company') ? ' is-invalid' : '' }}" name="company" value="{{ $user->participant->company }}" placeholder="Organisasi" required>
                                            @if ($errors->has('company'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('company') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row mb-0">
                                        <label for="information" class="col-md-3 col-form-label text-md-right">Informasi Tambahan</label>
                                        <div class="col-md-7">
                                            <textarea name="information" class="form-control{{ $errors->has('information') ? ' is-invalid' : '' }}" id="information" rows="3" placeholder="Informasi Tambahan">{{ $user->participant->information }}</textarea>
                                            @if ($errors->has('information'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('information') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-7 offset-md-3">
                                            <hr>
                                            <button type="submit" class="btn btn-primary btn-block-xs">
                                                <i class="fas fa-check mr-1"></i> Update
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection