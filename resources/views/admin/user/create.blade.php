@extends('layouts.app')

@section('title', 'Users')

@section('conditions')
    @php
        $goBack = route('users.index');
    @endphp
@endsection

@section('content')
<section class="content-header">
    <div class="container">
        <div class="row">
            <div class="col-sm-auto d-none d-sm-block">
                <h1 class="m-0 text-dark display-4 d-inline">User</h1>
                <small>/ Create</small>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <form action="{{ route('users.store') }}" method="POST" id="user">
                        <div class="card-body pb-0">
                            @csrf
                            @include('admin.user._form')
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md offset-md-4">
                                    <button type="submit" class="btn btn-default">
                                        Create
                                    </button>
                                    <a href="{{ $goBack }}" class="btn btn-link mr-1">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
