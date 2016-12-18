<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Core\Entities\Category;
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
        $this->middleware('isAdmin');
    }
    /**
     * Redirect not found.
     *
     * @return Response
     */
    protected function redirectNotFound()
    {
        return redirect('admin.categories.index');
    }
    /**
     * Display a listing of categories
     *
     * @return Response
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
     * @return Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * @param CategoriesFormRequest $request
     * @return Redirect
     */
    public function store(CategoriesFormRequest $request)
    {
        $data = $request->all();

        $category = Category::create($data);

        return redirect('admin/categories');
    }

    /**
     * @param $slug
     * @return Response|\Illuminate\View\View
     */
    public function show($slug)
    {
        try {
            $category = Category::findBySlug($slug);
            $categories = Category::all();
            return view('admin.categories.show', compact('category', 'categories'));
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * @param $slug
     * @return Response
     */
    public function edit($slug)
    {
        try {
            $category = Category::findBySlug($slug);
            $categories = Category::all();

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
            $category = Category::findBySlug($slug);
            $category->update($data);
            return redirect('admin/categories');
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }
    /**
     * Remove the specified category from storage.
     *
     * @param  int $id
     * @return Response
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
