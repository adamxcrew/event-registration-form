@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <form action="{{ url()->full() }}" method="GET">
                    <div class="form-inline">
                        <div class="input-group app-shadow">
                            <input type="search" name="k" placeholder="Search" aria-label="Search" class="form-control form-control-navbar border-0" value="{{ request()->k }}">
                            <div class="input-group-append">
                                <div class="input-group-text bg-white border-0">
                                    <i class="fa fa-search"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-auto pl-0">
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target=".modal">
                    <i class="fas fa-upload"></i> <span class="ml-1 d-none d-sm-inline">Upload</span>
                </button>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-body p-0 table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th width="1%">#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th class="text-center">Uploaded By</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($modules as $item)
                            <tr>
                                <td>{{ $loop->iteration }}.</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->description }}</td>
                                <td class="text-center">{{ $item->createdBy->name }}</td>
                                <td class="text-right">
                                    <a href="{{ $item->download() }}" target="_blank" class="text-decoration-none text-secondary mx-2">
                                        <i class="fas fa-external-link-alt"></i>
                                    </a>
                                    <a href="{{ $item->download() }}" download class="text-decoration-none text-secondary mx-2">
                                        <i class="fas fa-download"></i>
                                    </a>
                                    <form action="{{ route('modules.destroy', $item->id) }}" method="POST" class="d-inline">
                                        {{ method_field('delete') }}
                                        <a href="#" class="text-secondary ml-2 text-decoration-none">
                                            <i class="far fa-trash-alt"></i>
                                        </a>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">
                                    <i>Tidak ada data ditemukan...</i>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="materialModal" role="dialog" aria-labelledby="materialModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="materialModalLabel">Upload</h5>
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

@section('scripts')
    @if ($errors->any())
        <script>
            $('.modal').modal('show')
        </script>
    @endif
@endsection