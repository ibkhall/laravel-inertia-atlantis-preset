<?php

namespace App\Http\Controllers;

use App\Repositories\RoleRepository;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{

    /**
     * @var RoleRepository
     */
    private $repository;

    /**
     * RolesController constructor.
     * @param RoleRepository $repository
     */
    public function __construct(RoleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request) {

        return inertia('Roles/Index', [
            'roles' => $this->repository->search($request->q)->with('permissions')->paginate($request->limit),
            'title' => 'Les rôles'
        ]);
    }

    public function create() {
        $permissions = Permission::all();

        return inertia('Roles/Create', [
            'permissions' => $permissions
        ]);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required|string'
        ]);
        $role = $this->repository->insert(['name' => $request->name]);
        $role->syncPermissions($request->permission);
        return redirect(route('roles.index'))->with('success', 'Opération effectuée !');
    }

    public function edit(int $id) {

        $permissions = Permission::all();

        return inertia('Roles/Edit', [
            'role' => $this->repository->find($id)->load('permissions'),
            'permissions' => $permissions
        ]);
    }


    /**
     * @param int $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(int $id, Request $request) {
        $this->validate($request, [
            'name' => 'required|string'
        ]);
        $role = $this->repository->find($id);
        $role->update(['name' => $request->name ]);
        $role->syncPermissions($request->permission);

        return redirect(route('roles.index'))->with('success', 'Opération effectuée !');
    }


    /**
     * @param Role $role
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy(Role $role) {
        $role->delete();
        return redirect(route('roles.index'))->with('success', 'Opération effectuée !');
    }
}
