@extends('layouts.app')

@section('title', 'Users')

@section('content')
<section class="content-header">
    <div class="container">
        <div class="row">
            <div class="col-sm-auto d-none d-sm-block">
                <h1 class="m-0 text-dark display-4 d-inline">Users</h1>
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
                <div class="btn-group rounded app-shadow" role="group" aria-label="Action Button">
                    <a href="{{ route('users.create') }}" class="btn btn-default">
                        Create
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card shadow-sm">
                    <div class="card-header border-bottom-0 px-3">
                        <x-mass-delete total="{{ $users->total() }}" action="{{ route('users.destroy', 'mass-delete') }}"/>
                    </div>

                    <div class="table-responsive">
                        <table class="table mb-0">
                            @if ($users->count())
                                <thead class="thead-light">
                                    <tr>
                                        <th width="1%" class="pr-0"></th>
                                        <th width="1%">#</th>
                                        <th><x-order by="name">Name</x-order></th>
                                        <th><x-order by="username">Username</x-order></th>
                                        <th><x-order by="role_id">Role</x-order></th>
                                        <th><x-order by="room_id">Dept / Room</x-order></th>
                                        <th><x-order by="last_login_at">Last Login</x-order></th>
                                        <th></th>
                                    </tr>
                                </thead>
                            @endif
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <td class="pr-0">
                                            <div class="custom-control custom-checkbox">
                                                <input v-model="checked" value="{{ $user->id }}" type="checkbox" class="custom-control-input" id="{{ $user->id }}">
                                                <label class="custom-control-label" for="{{ $user->id }}"></label>
                                            </div>
                                        </td>
                                        <td>
                                            {{ ($users->perPage() * ($users->currentPage() - 1)) + $loop->iteration }}.
                                        </td>
                                        <td nowrap>
                                            <a href="{{ route('users.edit', $user->username) }}">{{ $user->name }}</a>
                                        </td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->role->display_name }}</td>
                                        <td><x-shorten>{{ $user->department->name ?? ($user->room->name ?? 'All') }}</x-shorten></td>
                                        <td>{{ optional($user->last_login_at)->diffForHumans() }}</td>
                                        <td class="text-right" nowrap>
                                            <x-action-dropdown edit="{{ route('users.edit', $user->username) }}" delete="{{ route('users.destroy', $user->id) }}" />
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

                <x-pagination :model="$users" />
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
                        this.checked = @json($users->pluck('id'));
                    } else {
                        this.checked = []
                    }
                }
            }
        })
    </script>
@endpush
