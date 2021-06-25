<div class="form-group row">
    <label for="role_id" class="col-md-4 col-form-label text-md-right">Role <span class="text-danger">*</span></label>
    <div class="col-md-4">
        <select v-model="role" name="role_id" id="role_id" class="form-control @error('role_id') is-invalid @enderror" required>
            @foreach ($roles as $role)
                <option value="{{ $role->id }}" {{ old('role_id', $user->role_id ?? '') == $role->id ? 'selected' : '' }}>
                    {{ $role->display_name }}
                </option>
            @endforeach
        </select>
        @error('role_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<template style="display: none" v-show="role == 3">
    <div class="form-group row" v-if="role == 3">
        <label for="department_id" class="col-md-4 col-form-label text-md-right">Department <span class="text-danger">*</span></label>
        <div class="col-md-4">
            <select name="department_id" id="department_id" class="form-control @error('department_id') is-invalid @enderror" required>
                @foreach ($departments as $department)
                    <option value="{{ $department->id }}" {{ old('department_id', $user->department_id ?? '') == $department->id ? 'selected' : '' }}>
                        {{ $department->name }}
                    </option>
                @endforeach
            </select>
            @error('department_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</template>
<template style="display: none" v-show="role == 4">
    <div class="form-group row" v-if="role == 4">
        <label for="room_id" class="col-md-4 col-form-label text-md-right">Ruangan <span class="text-danger">*</span></label>
        <div class="col-md-4">
            <select name="room_id" id="room_id" class="form-control @error('room_id') is-invalid @enderror" required>
                <option value="" hidden>Pilih :</option>
                @foreach ($rooms->groupBy('department') as $label => $lists)
                    <optgroup label="{{ $label }}">
                        @foreach ($lists as $room)
                            <option value="{{ $room->id }}" {{ old('room_id', $user->room_id ?? '') == $room->id ? 'selected' : '' }}>
                                {{ $room->name }}
                            </option>
                        @endforeach
                    </optgroup>
                @endforeach
            </select>
            @error('room_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</template>
<hr>
<div class="form-group row">
    <label for="name" class="col-md-4 col-form-label text-md-right">Name <span class="text-danger">*</span></label>
    <div class="col-md-4">
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name ?? '') }}" required placeholder="Name..">
        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
@role('superadmin')
<div class="form-group row">
    <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
    <div class="col-md-4">
        <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email ?? '') }}" required placeholder="(optional)">
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
@endrole
<div class="form-group row">
    <label for="username" class="col-md-4 col-form-label text-md-right">Username <span class="text-danger">*</span></label>
    <div class="col-md-4">
        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username', $user->username ?? '') }}" required placeholder="Username..">
        @error('username')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="password" class="col-md-4 col-form-label text-md-right">
        Password
        @unless ($user ?? null)
            <span class="text-danger">*</span>
        @endunless
    </label>
    <div class="col-md-4">
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" {{ !isset($user) ? 'required' : '' }} placeholder="Password..">
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

@push('scripts')
    <script>
        new Vue({
            el: 'form#user',
            data() {
                return {
                    role: @json(old('role_id', $user->role_id ?? $roles->first()->id))
                }
            }
        })
    </script>
@endpush
