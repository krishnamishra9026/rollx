<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:administrator');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::paginate(30);
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions        = Permission::where('guard_name', 'administrator')->get();
        return view('admin.roles.form', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string'],
        ]);

        $role = Role::create([
            'name'      => $request->name,
        ]);

        $role->syncPermissions($request->permission);

        return redirect()->route('admin.roles.index')->with('success', 'Role created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role               = Role::find($id);
        $role->permissions  = $role->getPermissionNames()->toArray();
        $permissions        = Permission::where('guard_name', 'administrator')->get();
        return view('admin.roles.form', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => ['required', 'string'],
        ]);

        Role::where('id', $id)->update([
            'name'      => $request->name,
        ]);
        $role = Role::find($id);
        $role->syncPermissions($request->permission);

        return redirect()->route('admin.roles.index')->with('success', 'Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {              
        Role::find($id)->delete();
        return redirect()->route('admin.roles.index')->with('success', 'Role deleted successfully');
    }

    public function bulkDelete(Request $request)
    {
        Role::whereIn('id', $request->roles)->delete();
        return response()->json(['success' => 'Roles deleted successfully!'], 200);
    }
}
