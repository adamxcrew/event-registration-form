@extends('layouts.app')

@section('title', 'Event')

@php
    $back = route('event.index');
@endphp

@section('content')
<section class="content-header">
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="m-0 text-dark display-4 d-inline">Setting</h1>
                <small>/ Edit Event</small>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <form action="{{ route('event.update', $event->id) }}" method="POST" id="event">
                        <div class="card-body pb-0">
                            @csrf @method('patch')
                            @include('admin.event._form')
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md offset-md-3">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-check mr-1"></i> Update
                                    </button>
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
