<?php

namespace App\Http\Controllers;

use App\Core\Entities\Permission;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Core\Validation\Permission\PermissionsFormRequest;
use App\Core\Validation\Permission\PermissionsUpdateFormRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PermissionsController extends Controller
{
    protected $repository;

    /**
     * PermissionsController constructor.
     * @param \App\Core\Repositories\PermissionRepository $repository
     */
    public function __construct(\App\Core\Repositories\PermissionRepository $repository){

        $this->repository = $repository;
        $this->middleware('role:Admin');

    }
    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    protected function redirectNotFound()
    {
        return redirect('admin.permissions.index');
    }

    /**
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $permissions = $this->repository->allOrSearch($request->get('q'));

        $no = $permissions->firstItem();

        return view('admin.permissions.index', compact('permissions', 'no'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $permissions = Permission::all()->pluck('slug', 'id');
        return view('admin.permissions.create')->with('permissions', $permissions);
    }

    /**
     * @param PermissionsFormRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(PermissionsFormRequest $request)
    {
        $data = $request->all();

        $this->repository->create($data);

        return redirect('admin/permissions');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * @param $slug
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function edit($id)
    {
        try {
            $permission = Permission::find($id);

            return view('admin.permissions.edit', compact('permission'));
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * @param PermissionsUpdateFormRequest $request
     * @param $slug
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(PermissionsUpdateFormRequest $request, $slug)
    {
        try {
            $data = $request->all();

            $permission = Permission::findBySlug($slug);

            $this->repository->update($data, $permission);

            return redirect('admin/permissions');

        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
