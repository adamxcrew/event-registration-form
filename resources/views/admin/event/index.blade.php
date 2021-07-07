@extends('layouts.app')

@section('title', 'Event')

@section('content')
<section class="content-header">
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="m-0 text-dark display-4 d-inline">Resource</h1>
                <small>/ Event</small>
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
                    <a href="{{ route('event.create') }}" class="btn btn-primary">
                        Create
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header border-bottom-0 px-3">
                        Total: {{ $events->count() }}
                    </div>

                    <div class="table-responsive">
                        <table class="table">
                            @if ($events->count())
                                <thead class="thead-light">
                                    <tr>
                                        <th width="1%">#</th>
                                        <th width="1%">Event</th>
                                        <th>Description</th>
                                        <th width="1%">Category</th>
                                        <th width="1%">Zone</th>
                                        <th width="1%"></th>
                                    </tr>
                                </thead>
                            @endif
                            <tbody>
                                @forelse ($events as $event)
                                    <tr>
                                        <td>{{ $loop->iteration }}.</td>
                                        <td nowrap>{{ ($event->name) }}</td>
                                        <td>{{ $event->description ?? '...' }}</td>
                                        <td nowrap>{{ ucfirst($event->category ?? '-') }}</td>
                                        <td nowrap>{{ ucfirst($event->time ?? '-') }}</td>
                                        <td nowrap class="text-right">
                                            <x-action
                                                :edit="route('event.edit', $event->id)"
                                                :delete="route('event.destroy', $event->id)"
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
                        this.checked = @json($events->pluck('id'));
                    } else {
                        this.checked = []
                    }
                }
            }
        })
    </script>
@endpush
