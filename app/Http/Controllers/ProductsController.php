<?php

namespace App\Http\Controllers;

use App\Core\Models\Category;
use App\Core\Repositories\CategoryRepository;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use Laracasts\Flash\Flash;
use App\Core\Repositories\ProductsRepository;
use App\Core\Validators\Product\ProductsFormRequest as Create;
use App\Core\Validators\Product\ProductsUpdateFormRequest as Update;

/**
 * Class ProductsController
 * @package App\Http\Controllers
 */
class ProductsController extends BaseController
{
    /**
     * @var ProductsRepository
     */
    protected $repository;
    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;
    /**
     * @var string
     */
    public $viewPathBase = "admin.products.";
    /**
     * @var string
     */
    public $errorRedirectPath = "admin/products";

    /**
     * ProductsController constructor.
     * @param ProductsRepository $repository
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(ProductsRepository $repository, CategoryRepository $categoryRepository)
    {
        $this->repository = $repository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $products = $this->repository->allOrSearch(Input::get('q'));
        $no = $products->firstItem();
        return $this->view('index', compact('products', 'no'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $categories = Category::all();
        $chosenCategory = null;
        return $this->view('create', compact('categories', 'chosenCategory'));
    }

    /**
     * @param Create $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Create $request)
    {
        $data = $request->all();
        unset($data['image']);

        $data['user_id'] = \Auth::id();

        $data['slug'] = Str::slug($data['title']);

        $category = $request->get('category_id');

        $data['category_id'] = $category;

        $product = $this->repository->create($data);

        if (Input::hasFile('image')) {
            // upload image
            $images = Input::file('image');

            foreach ($images as $image) {

                $this->uploader->upload($image)->save('images/products');


                $picture = Picture::create(['path' => $this->uploader->getFilename()]);

                $product->picture()->attach($picture);

            }

        }

        return redirect('admin/products');
    }

    /**
     * @param $id
     * @return Response|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        try {
            $product = $this->repository->getmodel()->find($id);;
            return $this->view('show', compact('product'));
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * @param $id
     * @return Response|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        try {
            $product = $this->repository->getmodel()->find($id);

            $categories = Category::all()->lists("slug", 'id');

            $pictures = array();

            $chosenCategory = $product->categories()->first();

            return $this->view('edit', compact('product', 'categories', 'pictures', 'chosenCategory'));

        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * Update the specified article in storage.
     *
     * @param Update $request
     * @param $id
     * @return Response|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Update $request, $id)
    {
        try {

            $product = $this->repository->getmodel()->find($id);

            $data = $request->all();

            unset($data['image']);

            unset($data['type']);

            $data['user_id'] = \Auth::id();

            $data['slug'] = Str::slug($data['title']);

            if (Input::hasFile('image')) {
                // upload image
                $images = Input::file('image');

                $paths = array();

                foreach ($product->picture()->get() as $pictures) {

                    $this->repository->getmodel()->deleteImage($pictures->path);

                }
                $product->picture()->detach();

                $product->update($data);

                foreach ($images as $key => $image) {

                    $this->uploader->upload($image)->save('images/products');

                    $product = $this->repository->getmodel()->indBySlug($data['slug']);

                    $picture = Picture::create(['path' => $this->uploader->getFilename()]);

                    $product->picture()->attach($picture);

                }


            }
            $product->update($data);


            return redirect('admin/products');

        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * Remove the specified article from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        try {
            $this->repository->delete($id);
            return redirect('admin/products');
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }


}
