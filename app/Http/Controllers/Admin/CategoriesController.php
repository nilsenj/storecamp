<?php

namespace App\Http\Controllers\Admin;

use App\Core\Contracts\CategorySystemContract;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Core\Repositories\CategoryRepository;
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
     * @var CategorySystemContract
     */
    protected $categorySystem;

    /**
     * CategoriesController constructor.
     * @param CategorySystemContract $categorySystem
     */
    public function __construct(CategorySystemContract $categorySystem)
    {
        $this->categorySystem = $categorySystem;
        $this->repository = $this->categorySystem->categoryRepository;

        $this->middleware('role:Admin');
    }

    /**
     * Display a listing of categories
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $data = $request->all();
        $categories = $this->categorySystem->present($data, null, ['parent', 'children']);
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
        try {
            $data = $request->all();
            $data['top'] = $request->top ? $request->top == "on" ? true : false : false;
            $category = $this->categorySystem->create($data);
            return redirect('admin/categories');

        } catch (\Exception $exception) {
            return redirect()->back($this->errorRedirectPath)->withErrors(\Flash::error($exception->getCode(), $exception->getMessage()));
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|Redirect|\Illuminate\View\View
     * @return Response|Redirect
     */
    public function show(Request $request, $id)
    {
        try {
            $data = $request->all();
            $category = $this->categorySystem->present($data, $id);
            $categories = $this->repository->all();
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
     * @return Response|Redirect
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
     * @return Response|Redirect
     */
    public function update(CategoriesUpdateFormRequest $request, $id)
    {
        try {
            $data = $request->all();
            $category = $this->categorySystem->update($data, $id);
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
            $deleted = $this->categorySystem->delete($id);
            return redirect('admin/categories');
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }
}
