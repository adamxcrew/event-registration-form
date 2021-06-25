@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container">
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
    <div class="container">
        <div class="card">
            <div class="card-header border-bottom-0 px-3">
                Total: {{ $modules->count() }}
            </div>

            <div class="table-responsive">
                <table class="table">
                    @if ($modules->count())
                        <thead class="thead-light">
                            <tr>
                                <th>File</th>
                                <th></th>
                            </tr>
                        </thead>
                    @endif
                    <tbody>
                        @forelse ($modules as $item)
                            <tr>
                                <td>
                                    {{ $item->name }}
                                    <div class="text-secondary text-sm">
                                        {{ $item->description }}
                                    </div>
                                </td>
                                <td nowrap class="text-right">
                                    <x-action>
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
</section>
@endsection