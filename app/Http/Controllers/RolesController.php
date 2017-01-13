<?php

namespace App\Http\Controllers;

use App\Core\Models\Permission;
use App\Core\Models\Role;
use App\Core\Repositories\PermissionRepository;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Core\Repositories\RolesRepository;
use App\Core\Models\User;
use App\Core\Validation\Role\RolesFormRequest;
use App\Core\Validation\Role\RolesUpdateFormRequest;

/**
 * Class RolesController
 * @package App\Http\Controllers
 */
class RolesController extends BaseController
{
    /**
     * @var string
     */
    public $viewPathBase = "admin.roles.";

    /**
     * @var string
     */
    public $errorRedirectPath = "admin/roles";

    /**
     * @var RolesRepository
     */
    protected $repository;
    /**
     * @var PermissionRepository
     */
    protected $permissionRepository;


    /**
     * RolesController constructor.
     * @param RolesRepository $repository
     * @param PermissionRepository $permissionRepository
     */
    public function __construct(RolesRepository $repository, PermissionRepository $permissionRepository)
    {

        $this->repository = $repository;
        $this->permissionRepository = $permissionRepository;
        $this->middleware('isAdmin');

    }

    /**
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $roles = $this->repository->paginate();
        $no = $roles->firstItem();

        return $this->view('index', compact('roles', 'no'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $permissions = Permission::all()->pluck('name', 'id');
        $selectedPerms = [];

        return $this->view('create', compact('permissions', 'selectedPerms'));
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
     * @return Response|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        try {
            $role = $this->repository->find($id);
            $permissions = Permission::all()->pluck('name', 'id');
            $selectedPerms = $role->perms()->orderBy("id")->pluck("name", "id");
            return $this->view('edit', compact('role', 'permissions', 'selectedPerms'));
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * @param RolesUpdateFormRequest $request
     * @param $id
     * @return Response|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(RolesUpdateFormRequest $request, $id)
    {
        try {
            $data = $request->except('permissions');

            $dataPerm = $request->only('permissions');
            $role = $this->repository->find($id);

            $this->repository->renew($data, $dataPerm, $role);

            return redirect('admin/roles');

        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * get permissions name in json format
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function getPermsJson(Request $request)
    {
        $query = $this->parserSearchValue($request->get('search'));
        $permGroup = $this->permissionRepository->getModel()->where("name", "like", $query)->select('name', 'id')->get();
        $permGroupArr = [];
        foreach ($permGroup as $key => $attrGroupItem) {
            $permGroupArr[$key]['text'] = $attrGroupItem['name'];
            $permGroupArr[$key]['id'] = $attrGroupItem['id'];
        }
        return \Response::json($permGroupArr);
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        //
    }
}
