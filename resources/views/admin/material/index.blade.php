@extends('layouts.app')

@section('title', 'Package')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <h1 class="m-0 text-dark display-4 d-inline">Resource</h1>
                <small>/ File</small>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col">
                <x-search />
            </div>
            <div class="col-auto">
                <a href="{{ route('package.create') }}" class="btn btn-primary shadow-sm" data-toggle="modal" data-target="#uploadModal">
                    Upload
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header border-bottom-0 px-3">
                        Total: {{ $modules->count() }}
                    </div>

                    <div class="table-responsive">
                        <table class="table">
                            @if ($modules->count())
                                <thead class="thead-light">
                                    <tr>
                                        <th width="1%">#</th>
                                        <th>File</th>
                                        <th></th>
                                    </tr>
                                </thead>
                            @endif
                            <tbody>
                                @forelse ($modules as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}.</td>
                                        <td>
                                            {{ $item->name }}
                                            <div class="text-secondary text-sm">
                                                {{ $item->description }}
                                            </div>
                                        </td>
                                        <td nowrap class="text-right">
                                            <x-action :delete="route('modules.destroy', $item->id)">
                                                <a href="{{ $item->download() }}" target="_blank" class="text-decoration-none text-secondary mx-2">
                                                    <i class="fas fa-external-link-alt"></i>
                                                </a>
                                                <a href="{{ $item->download() }}" download class="text-decoration-none text-secondary mx-2">
                                                    <i class="fas fa-download"></i>
                                                </a>
                                            </x-action>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td>
                                            <x-is-empty />
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="uploadModal" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadModalLabel">Upload</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('modules.store') }}" method="POST" enctype="multipart/form-data">
                <div class="modal-body pb-0">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <label for="name" class="col-md-3 col-form-label">Name</label>
                        <div class="col-md-9">
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="Name" required>
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-md-3 col-form-label">Description</label>
                        <div class="col-md-9">
                            <textarea name="description" id="description" rows="3" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" placeholder="Description">{{ old('description') }}</textarea>
                            @if ($errors->has('description'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="file" class="col-md-3 col-form-label">File</label>
                        <div class="col-md-9">
                            <input id="file" type="file" accept=".pdf,.ppt,.pptx" class="{{ $errors->has('file') ? 'form-control is-invalid' : '' }}" name="file" required>
                            <small class="text-muted d-block mt-1">File must be in PDF or PowerPoint</small>
                            @if ($errors->has('file'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('file') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary btn-block-xs">
                        <i class="fas fa-upload mr-1"></i> Upload
                    </button>
                    <button type="button" class="btn btn-outline-secondary d-none d-sm-inline-block" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection