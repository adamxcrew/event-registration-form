@extends('layouts.app')

@section('title', 'Package')

@section('content')
<section class="content-header">
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="m-0 text-dark display-4 d-inline">Resource</h1>
                <small>/ Package</small>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container">
        <div class="row mb-3">
            <div class="col">
                <x-search />
            </div>
            <div class="col-auto">
                <div class="btn-group rounded shadow-sm" role="group" aria-label="Action Button">
                    <a href="{{ route('package.create') }}" class="btn btn-primary">
                        Create
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header border-bottom-0 px-3">
                        Total: {{ $packages->count() }}
                    </div>

                    <div class="table-responsive">
                        <table class="table">
                            @if ($packages->count())
                                <thead class="thead-light">
                                    <tr>
                                        <th width="1%">#</th>
                                        <th width="1%">Event</th>
                                        <th>Description</th>
                                        <th>Choiceable Events</th>
                                        <th></th>
                                    </tr>
                                </thead>
                            @endif
                            <tbody>
                                @forelse ($packages as $package)
                                    <tr>
                                        <td>{{ $loop->iteration }}.</td>
                                        <td nowrap>{{ ($package->name) }}</td>
                                        <td>{{ $package->description ?? '-' }}</td>
                                        <td>
                                            {{ $package->min }}
                                            {{ $package->max > $package->min ? ' - ' . $package->max : '' }}
                                        </td>
                                        <td class="text-right">
                                            <x-action
                                                :edit="route('package.edit', $package->id)"
                                                :delete="route('package.destroy', $package->id)"
                                            />
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
@endsection

@push('scripts')
    <script>
        new Vue({
            el: '#app',
            data() {
                return {
                    checked: [],
                    checkAll: false
                }
            },
            watch: {
                checkAll(value) {
                    if (value) {
                        this.checked = @json($packages->pluck('id'));
                    } else {
                        this.checked = []
                    }
                }
            }
        })
    </script>
@endpush
