@extends('layouts.app')

@section('title', 'Setting')

@section('content')
<section class="content-header">
    <div class="container">
        <div class="row">
            <div class="col-sm-auto d-none d-sm-block">
                <h1 class="m-0 text-dark display-4 d-inline">Setting</h1>
                <small>/ General</small>
            </div>
        </div>
    </div>
</section>
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col">
                <p class="lead mb-0">Event Information</p>
                <p class="text-secondary">Update the event information like title, location, schedules, early and normal registration session.</p>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <form method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-md">
                                    <label for="about">About <span class="text-danger">*</span></label>
                                    <textarea name="about" id="about" rows="10" class="form-control @error('about') is-invalid @enderror" placeholder="Detail information about the event.." required>{{ old('about', $config['about'] ?? '') }}</textarea>
                                    @error('about')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mt-4">
                                <label>Registration Schedule :</label>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="early">Early</label>
                                    <input type="date" name="early" class="form-control @error('early') is-invalid @enderror" value="{{ old('early', $config['early'] ?? '') }}">
                                    @error('early')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="normal">Normal <span class="text-danger">*</span></label>
                                    <input type="date" name="normal" class="form-control @error('normal') is-invalid @enderror" value="{{ old('normal', $config['normal'] ?? '') }}" required>
                                    @error('normal')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col">
                <p class="lead mb-0">Site Information</p>
                <p class="text-secondary">Update site information, like name, description and icon.</p>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('site.store') }}">
                        @csrf
                        <div class="card-body pb-2">
                            <div class="form-group row">
                                <div class="col-md-7">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Name.." value="{{ old('name', site('name', null, true)) }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-7">
                                    <label for="description">Description</label>
                                    <input type="text" name="description" class="form-control" id="description" placeholder="Description.." value="{{ old('description', site('description', null, true)) }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-7">
                                    <label for="logo">Logo / Icon (PNG)</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="logo" class="form-control" id="logo" accept=".png">
                                        <label class="custom-file-label" for="logo">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection