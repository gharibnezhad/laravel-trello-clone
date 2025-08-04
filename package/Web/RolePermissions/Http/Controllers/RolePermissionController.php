<?php
namespace Web\RolePermissions\Http\Controllers;

use App\Http\Controllers\Controller;
use Web\RolePermissions\Http\Requests\RoleRequest;
use Web\RolePermissions\Http\Requests\RoleUpdateRequest;
use Web\RolePermissions\Models\Role;
use Web\RolePermissions\Services\RolePermissionService;

class RolePermissionController extends Controller
{
    protected $rolePermissionService;

    public function __construct(RolePermissionService $rolePermissionService)
    {
        $this->rolePermissionService = $rolePermissionService;
    }

    public function index()
    {
        $this->authorize('index',Role::class);
        $roles = $this->rolePermissionService->getRole();
        $permissions = $this->rolePermissionService->getPermission();
        return view('RolePermissions::index',compact('roles','permissions'));
    }

    public function store(RoleRequest $request)
    {
        $this->authorize('create',Role::class);
        $this->rolePermissionService->store($request);
        return redirect()->route('role-permissions.index');
    }

    public function edit($id)
    {
        $this->authorize('edit',Role::class);
        $role = $this->rolePermissionService->findRole($id);
        $permissions = $this->rolePermissionService->getPermission();
        return view('RolePermissions::edit',compact('role','permissions'));
    }

    public function update(RoleUpdateRequest $request,$id)
    {
        $this->rolePermissionService->update($request,$id);
        return redirect()->route('role-permissions.index');
    }

    public function destroy($id)
    {
        $this->authorize('delete',Role::class);
        $this->rolePermissionService->delete($id);
        return redirect()->route('role-permissions.index');
    }


}
