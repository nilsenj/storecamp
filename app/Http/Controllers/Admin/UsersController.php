<?php

namespace App\Http\Controllers\Admin;

use App\Core\Models\Role;
use App\Core\Repositories\RolesRepository;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Core\Models\User;
use Illuminate\Support\Facades\Input;
use App\Core\Repositories\UserRepository;
use App\Core\Validation\User\UsersUpdateFormRequest;
use App\Core\Validation\User\UsersFormRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

/**
 * Class UsersController
 * @package App\Http\Controllers
 */
class UsersController extends BaseController
{
    /**
     * @var string
     */
    public $viewPathBase = "admin.users.";
    /**
     * @var string
     */
    public $errorRedirectPath = "admin/users";
    /**
     * @var User
     */
    protected $users;


    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * @var RolesRepository
     */
    protected $rolesRepository;

    /**
     * UsersController constructor.
     * @param UserRepository $repository
     * @param RolesRepository $rolesRepository
     */
    public function __construct(UserRepository $repository, RolesRepository $rolesRepository)
    {
        $this->repository = $repository;
        $this->rolesRepository = $rolesRepository;
        $this->middleware('role:Admin');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $users = $this->repository->paginate();

        $no = $users->firstItem();

        return $this->view('index', compact('users', 'no'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $roles = $this->rolesRepository->all()->pluck('name', 'id');
        return $this->view('create', compact('roles'));
    }

    /**
     * @param UsersFormRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(UsersFormRequest $request)
    {
        $data = $request->all();
        $user = $this->repository->create($data);
        $user->addRole($request->get('role'));
        return redirect('admin/users');
    }

    /**
     * @param $id
     * @return Response|\Illuminate\View\View
     */
    public function show($id)
    {
        try {
            $user = $this->repository->find($id);
            $role = $user->getRole();
            return $this->view('show', compact('user', 'role'));
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * @param $id
     * @return Response|\Illuminate\View\View
     */
    public function edit($id)
    {
        try {
            $user = $this->repository->find($id);

            $roles = $this->rolesRepository->all()->pluck('name', 'id');
            $roleEntity = $user->getRole();
            $role['name'] = $roleEntity->name;
            $role['id'] = $roleEntity->id;

            return $this->view('edit', compact('user', 'roles', 'role'));
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * @param UsersUpdateFormRequest $request
     * @param $id
     * @return Response|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UsersUpdateFormRequest $request, $id)
    {
        try {
            $data = ! $request->has('password') ? $request->except('password') : $request->all();

            $user = $this->repository->find($id);

            $user->update($data);

            $user->roles()->sync((array) $request->role);
            return redirect('admin/users');
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * @param $id
     * @return Response|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $this->repository->delete($id);
            return redirect('admin/users');
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }
}
