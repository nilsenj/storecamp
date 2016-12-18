<?php

namespace App\Http\Controllers;

use Bican\Roles\Models\Role;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Core\Entities\User;
use Illuminate\Support\Facades\Input;
use App\Core\Repositories\UserRepository;
use App\Core\Validation\User\UsersUpdateFormRequest;
use App\Core\Validation\User\UsersFormRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use DB;
//use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;
class UsersController extends Controller
{
    /**
     * @var \User
     */
    protected $users;

    /**
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
        $this->middleware('role:admin');
    }
    /**
     * Redirect not found.
     *
     * @return Response
     */
    protected function redirectNotFound()
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
        $roles = Role::all()->lists('slug', 'id');
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
     * @param $slug
     * @return Response|\Illuminate\View\View
     */
    public function show($slug)
    {
        try {
            $user = User::findBySlug($slug);
            $role = $this->repository->getRole($user);
            return view('admin.users.show', compact('user', 'role'));
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * @param $slug
     * @return Response|\Illuminate\View\View
     */
    public function edit($slug)
    {
        try {
            $user = User::findBySlug($slug);

            $roles = Role::all()->lists('slug', 'id');

            $role = $this->repository->getRole($user);

            return view('admin.users.edit', compact('user', 'roles', 'role'));
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * @param UsersUpdateFormRequest $request
     * @param $slug
     * @return Response|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UsersUpdateFormRequest $request, $slug)
    {
        try {
            $data = ! $request->has('password') ? $request->except('password') : $request->all();

            $user = User::findBySlug($slug);

            $user->update($data);

            $user->roles()->sync((array) \Input::get('role'));
            return redirect('admin/users');
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * @param $slug
     * @return Response|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($slug)
    {
        try {
            $this->repository->delete($slug);
            return redirect('admin/users');
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }
}
