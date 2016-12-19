<?php

namespace App\Http\Controllers;

use App\Core\Entities\Role;
use App\Core\Repositories\RolesRepository;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Core\Entities\User;
use Illuminate\Support\Facades\Input;
use App\Core\Repositories\UserRepository;
use App\Core\Validation\User\UsersUpdateFormRequest;
use App\Core\Validation\User\UsersFormRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * @var \User
     */
    protected $users;

    /**
     * @var UserRepository
     */
    protected $repository;

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
     * Redirect not found.
     *
     * @return Response
     */
    private function redirectNotFound()
    {
        return redirect('admin.users.index');
    }
    /**
     * Display a listing of users
     *
     * @return Response
     */
    public function index()
    {
        $users = $this->repository->allOrSearch(Input::get('q'));

        $no = $users->firstItem();

        return view('admin.users.index', compact('users', 'no'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $roles = $this->rolesRepository->all()->pluck('name', 'id');
        return view('admin.users.create', compact('roles'));
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
            $role = $this->repository->getRole($user);
            return view('admin.users.show', compact('user', 'role'));
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

            $role = $this->repository->getRole($user);

            return view('admin.users.edit', compact('user', 'roles', 'role'));
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

            $user->roles()->sync((array) \Input::get('role'));
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
