@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark display-4">Module</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Module</li>
                </ol>
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
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">
                                    <i>Belum ada materi yang diupload...</i>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection