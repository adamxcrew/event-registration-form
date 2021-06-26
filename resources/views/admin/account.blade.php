@extends('layouts.app')

@section('title', 'Account')

@section('content')
<section class="content-header">
    <div class="container">
        <div class="row">
            <div class="col-sm-auto d-none d-sm-block">
                <h1 class="m-0 text-dark display-4 d-inline">Setting</h1>
                <small>/ Account</small>
            </div>
        </div>
    </div>
</section>
<div class="content">
    <div class="container">
        <div class="row" id="profile">
            <div class="col">
                <p class="lead mb-0">Profile Information</p>
                <p class="text-secondary">Update your account's profile information, username and password.</p>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <form method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            @isset($profile)
                                <div class="form-group row">
                                    <div class="col-md-7">
                                        <img src="{{ $profile->profile_photo_url }}" class="profile-user-img img-circle pointer mb-3" loading="lazy" height="100x" alt="{{ $user->name }}">
                                        <div class="custom-file">
                                            <input type="file" name="photo" class="custom-file-input" id="profile_photo" accept="image/*">
                                            <label class="custom-file-label" for="profile_photo">Photo</label>
                                        </div>
                                    </div>
                                </div>
                            @endisset
                            <div class="form-group row">
                                <div class="col-md-7">
                                    <label for="name">Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Name.." value="{{ old('name', $user->name) }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-7">
                                    <label for="username">Username <span class="text-danger">*</span></label>
                                    <input type="text" name="username" class="form-control" id="username" placeholder="Username.." value="{{ old('username', $user->username) }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-7">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control" id="password" placeholder="New password..">
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