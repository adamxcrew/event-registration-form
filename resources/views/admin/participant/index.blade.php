@extends('layouts.app')

@section('title', 'Participant')

@section('content')
<section class="content-header">
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="m-0 text-dark display-4 d-inline">Participant</h1>
                <small>/ List</small>
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
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exportModal">
                        <img src="{{ asset('images/excel.png') }}" height="20px" class="mr-1"> EXPORT
                    </button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header border-bottom-0 px-3 d-flex">
                        <div class="mr-auto">
                            <b class="d-inlilne-block mr-2">
                                Total :
                            </b>
                            <span class="badge badge-secondary">{{ $counter['notpaid'] }}</span>
                            <span class="badge badge-warning">{{ $counter['waiting'] }}</span>
                            <span class="badge badge-success">{{ $counter['paid'] }}</span>
                        </div>

                        <x-action.filter>
                            @include('admin.participant._filter')
                        </x-action.filter>
                    </div>

                    <div class="table-responsive">
                        <table class="table">
                            @if ($registrations->count())
                                <thead class="thead-light">
                                    <tr>
                                        <th width="1%">#</th>
                                        <th width="1%"><x-order by="created_at">Date</x-order></th>
                                        <th><x-order by="code">Code</x-order></th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th class="text-center">Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                            @endif
                            <tbody>
                                @forelse ($registrations as $registration)
                                    <tr>
                                        <td>{{ ($registrations->perPage() * ($registrations->currentPage() - 1)) + $loop->iteration }}.</td>
                                        <td nowrap>{{ $registration->created_at->format('d/m/Y (H:i)') }}</td>
                                        <td nowrap>
                                            <a href="#" @click.prevent="showBilling('{{ route('registration.show', $registration->id) }}')">
                                                {{ $registration->code }}
                                            </a>
                                        </td>
                                        <td>{{ $registration->participant->name }}</td>
                                        <td>{{ $registration->participant->phone }}</td>
                                        <td>
                                            <a href="mailto:{{ $registration->user->email }}">
                                                {{ $registration->user->email }}
                                            </a>
                                        </td>
                                        <td class="text-center">{!! $registration->status() !!}</td>
                                        <td class="text-right">
                                            <x-action-dropdown :delete="route('participants.destroy', $registration->user->id)">
                                                <div class="dropdown-divider"></div>
                                                <a href="{{ route('participants.show', $registration->participant->id) }}" class="dropdown-item">
                                                    <svg class="icon fa-fw mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    Profile
                                                </a>
                                                <a href="#" class="dropdown-item" @click.prevent="showBilling('{{ route('registration.show', $registration->id) }}')">
                                                    <svg class="icon fa-fw mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                                    </svg>
                                                    Registration Info
                                                </a>
                                            </x-action-dropdown>
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

                <x-pagination :model="$registrations" />
            </div>
        </div>
    </div>
</section>

@include('admin.participant._registration')
@include('admin.participant._export')

<light-box ref="lightbox"></light-box>

@endsection

@push('scripts')
    <script>
        new Vue({
            el: '#app',
            data() {
                return {
                    checked: [],
                    checkAll: false,
                    exportAll: true,
                    registration: {},
                }
            },
            watch: {
                checkAll(value) {
                    if (value) {
                        this.checked = @json($registrations->pluck('id'));
                    } else {
                        this.checked = []
                    }
                }
            },
            methods: {
                showBilling(route) {
                    axios.get(route).then(({ data }) => {
                        this.registration = data
                        $('#registration').modal('show')
                        $('#registration .modal-footer form').attr('action', data.verification)
                    })
                },
                showPhoto(src, ext=null) {
                    let image = {
                        src: src,
                        ext: ext
                    }
                    this.$refs.lightbox.open(image)
                }
            }
        })
    </script>
@endpush
