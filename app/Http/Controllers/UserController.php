<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $users = User::whereNotNull('role_id')->where('created_by',auth()->id())->latest()->get();
            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('created_at', function ($user) {
                    return $user->created_at ?? '-';
                })
                ->addColumn('role', function ($user) {
                    return $user->role ? $user->role->name : 'No Role';
                })
                ->addColumn('actions', function ($user) {
                    return view('users.partials.actions', compact('user'));
                })
                ->rawColumns(['created_at', 'role', 'actions'])
                ->make(true);
        }
        return view('users.index');
    }

    public function create()
    {
        $roles = \App\Models\Role::all();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role_id' => 'required|exists:roles,id',
            'phone' => 'required|numeric',
            'address' => 'nullable|string|max:255',
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'phone' => $request->phone,
            'address' => $request->address,
            'created_by' => auth()->id(),
        ]);
        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = \App\Models\Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role_id' => 'required|exists:roles,id',
            'phone' => 'required|string|max:15',
            'address' => 'nullable|string|max:255',
        ]);
        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);
        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    public function changePassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ]);
        $user = User::findOrFail($id);
        $user->update(['password' => Hash::make($request->password)]);
        return redirect()->route('users.index')->with('success', 'Password changed successfully.');
    }
}
