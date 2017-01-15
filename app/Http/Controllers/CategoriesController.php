<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Core\Models\Category;
use App\Core\Repositories\CategoryRepository;
use App\Core\Validators\Category\CategoriesFormRequest;
use App\Core\Validators\Category\CategoriesUpdateFormRequest;
use Illuminate\Support\Facades\Redirect;

/**
 * Class CategoriesController
 * @package App\Http\Controllers
 */
class CategoriesController extends BaseController
{
    /**
     * @var string
     */
    public $viewPathBase = "admin.categories.";
    /**
     * @var string
     */
    public $errorRedirectPath = "admin/categories";

    /**
     * @var CategoryRepository
     */
    protected $repository;

    /**
     * CategoriesController constructor.
     * @param CategoryRepository $repository
     */
    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
        $this->middleware('role:Admin');
    }

    /**
     * Redirect not found.
     * @return Redirect
     */
    protected function redirectNotFound()
    {
        return redirect('admin.categories.index');
    }

    /**
     * Display a listing of categories
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $categories = $this->repository->with('parent', 'children')->paginate();

        $no = $categories->firstItem();

        return $this->view('index', compact('categories', 'no'));
    }

    /**
     * Show the form for creating a new category
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        $categories = $this->repository->all();
        $parent = null;

        return $this->view('create', compact('categories', 'parent'));
    }

    /**
     * @param Request $request
     * @return Redirect
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['top'] = $request->top ? $request->top == "on" ? true : false : false;
        $category = $this->repository->create($data);

        return redirect('admin/categories');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|Redirect|\Illuminate\View\View
     */
    public function show($id)
    {
        try {
            $category = $this->repository->find($id);
            $categories = Category::all();
            return $this->view('show', compact('category', 'categories'));
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * get category description for json
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDescription($id)
    {
        try {
            $category = $this->repository->find($id);
            $description = $category->description;
            return response()->json($description);
        } catch (ModelNotFoundException $e) {
            return response()->json($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|Redirect|\Illuminate\View\View
     */
    public function edit($id)
    {
        try {
            $category = $this->repository->find($id);
            $parent = $category->parent;
            $categories = $this->repository->with('parent')->all();
            return $this->view('edit', compact('category', 'parent', 'categories'));
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * @param CategoriesUpdateFormRequest $request
     * @param $id
     * @return Redirect
     */
    public function update(CategoriesUpdateFormRequest $request, $id)
    {
        try {
            $data = $request->all();
            $data['top'] = $request->top ? $request->top == "on" ? true : false : false;
            $data["parent_id"] = empty($data["parent_id"]) ? null : $data["parent_id"];
            $category = $this->repository->find($id);
            $category->update($data);
            return redirect('admin/categories');
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * Remove the specified category from storage.
     *
     * @param $id
     * @return Response|Redirect
     */
    public function destroy($id)
    {
        try {
            $this->repository->delete($id);
            return redirect('admin/categories');
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }
}
