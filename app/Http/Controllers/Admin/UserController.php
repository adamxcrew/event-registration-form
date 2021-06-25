<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Department;
use App\Models\Role;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $roles;

    public function __construct()
    {
        $this->middleware('role:superadmin');
    }

    public function index()
    {
        $users = User::exceptSuperadmin()->with('role')->search()->order('name', 'asc')->filter()->paginate(request('perPage', 25));
        return view('pages.resource.user.index', compact('users'))->withRoles($this->roles);
    }

    public function create()
    {
        $roles = $this->roles;
        $departments = Department::orderBy('name')->get();
        $rooms = Room::whereNotNull('department_id')->orderBy('name')
                    ->join('departments', 'rooms.department_id', '=', 'departments.id')
                    ->select('rooms.*', 'departments.name as department')
                    ->get();
        return view('pages.resource.user.create', compact('roles', 'departments', 'rooms'));
    }

    public function store(UserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);

        User::create($data);

        return redirect()->route('users.index')->withSuccess('User created successfully.');
    }

    public function edit(User $user)
    {
        $roles = $this->roles;
        $departments = Department::orderBy('name')->get();
        $rooms = Room::whereNotNull('department_id')->orderBy('name')
                    ->join('departments', 'rooms.department_id', '=', 'departments.id')
                    ->select('rooms.*', 'departments.name as department')
                    ->get();
        return view('pages.resource.user.edit', compact('user', 'roles', 'departments', 'rooms'));
    }

    public function update(UserRequest $request, User $user)
    {
        $data = $request->validated();
        $data['password'] = isset($data['password']) ? Hash::make($data['password']) : $user->password;

        $user->update($data);

        return redirect()->route('users.edit', $user->username)->withSuccess('Updated successfully.');
    }

    public function destroy($id)
    {
        if ($id == 'mass-delete') {
            $id = request('ids');
        }

        $delete = request()->has('force') ? 'forceDelete' : 'delete';

        User::whereKey(
            Arr::wrap($id)
        )->{$delete}();

        return redirect()->back()->withSuccess('User deleted successfully.');
    }
}

