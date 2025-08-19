<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    //

    public function index()
    {
        $role = Role::with(['permissions','user'])->get();
        // dd($role);
        return view('roles.index', compact('role'));
    }

    public function create()
    {
        $permission = Permission::all();
        return view('roles.create', compact('permission'));
        // return view('roles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'permission' => 'required|array',
        ]);
        $role = Role::create([
            'name' => $request->name,
            'created_by' => auth()->id(),
            'permission' => implode(',', $request->permission),
        ]);
        $role->permissions()->sync($request->permission);
        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    }

    public function show($id)
    {
        $role = Role::findOrFail($id);
        return view('roles.show', compact('role'));
    }

    // public function permission(){
    //     $permission=Permission::all();
    //     return view('permission.create',compact('permission'));
    // }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permission = Permission::all();
        return view('roles.edit', compact('permission', 'role'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'permission' => 'required'
        ]);
        $role=Role::findOrFail($id);
        $role->update([
            'name'=>$request->name,
            'permission'=>$request->permission,
        ]);
        return redirect()->route('roles.index')->with('success','Role Update Successfully');
    }
}
