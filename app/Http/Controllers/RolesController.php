<?php

namespace App\Http\Controllers;

use App\Core\Models\Permission;
use App\Core\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Core\Repositories\RolesRepository;
use App\Core\Models\User;
use App\Core\Validation\Role\RolesFormRequest;
use App\Core\Validation\Role\RolesUpdateFormRequest;

class RolesController extends Controller
{
    protected $repository;

    /**
     * @param RolesRepository $repository
     */
    public function __construct(RolesRepository $repository){

        $this->repository = $repository;
        $this->middleware('isAdmin');

    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    protected function redirectNotFound()
    {
        return redirect('admin.roles.index');
    }

    /**
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $roles = $this->repository->allOrSearch($request->get('q'));
        $no = $roles->firstItem();

        return view('admin.roles.index', compact('roles', 'no'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $permissions = Permission::all()->pluck('name', 'id');
        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * @param RolesFormRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(RolesFormRequest $request)
    {
        $data = $request->all();

        $this->repository->store($data);

        return redirect('admin/roles');
    }

    /**
     * @param $id
     */
    public function show($id)
    {
        //
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function edit($id)
    {
        try {
            $role = Role::find($id);
            $permissions = Permission::all()->pluck('name');
            return view('admin.roles.edit', compact('role', 'permissions'));
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * @param RolesUpdateFormRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(RolesUpdateFormRequest $request, $id)
    {
        try {
            $data = $request->except('permissions');

            $dataPerm = $request->only('permissions');

            $role = Role::find($id);
            $this->repository->renew($data, $dataPerm, $role);

            return redirect('admin/roles');

        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }


    /**
     * @param $id
     */
    public function destroy($id)
    {
        //
    }
}
