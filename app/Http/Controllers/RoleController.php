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
        $role = Role::all();
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
            'created_by' => 'nullable|integer',
            'level' => 'required|integer',
            'is_employe' => 'required|boolean',
            'permission' => 'required|array', // multi-select will be an array
        ]);

        Role::create([
            'name' => $request->name,
            'created_by' => $request->created_by,
            'level' => $request->level,
            'is_employe' => $request->is_employe,
            'permission' => implode(',', $request->permission), // store as comma-separated string
        ]);

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
