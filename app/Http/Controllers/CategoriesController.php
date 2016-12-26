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

class CategoriesController extends Controller
{
    protected $repository;
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
        $categories = $this->repository->allOrSearch($request->get('q'));

        $no = $categories->firstItem();

        return view('admin.categories.index', compact('categories', 'no'));
    }

    /**
     * Show the form for creating a new category
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * @param CategoriesFormRequest $request
     * @return Redirect
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $category = $this->repository->create($data);

        return redirect('admin/categories');
    }

    /**
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|Redirect|\Illuminate\View\View
     */
    public function show($slug)
    {
        try {
            $category = $this->repository->findByField('slug', $slug);
            $categories = Category::all();
            return view('admin.categories.show', compact('category', 'categories'));
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|Redirect|\Illuminate\View\View
     */
    public function edit($slug)
    {
        try {
            $category = $this->repository->findByField('slug', $slug)->first();
            $categories = $this->repository->all();

            return view('admin.categories.edit', compact('category', 'categories'));
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * @param CategoriesUpdateFormRequest $request
     * @param $slug
     * @return Response|Redirect
     */
    public function update(CategoriesUpdateFormRequest $request, $slug)
    {
        try {
            $data = $request->all();
            $category = $this->repository->findByField('slug', $slug);
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
