<?php

namespace App\Http\Controllers\Admin;

use App\Core\Contracts\ProductSystemContract;
use App\Core\Models\AttributeGroupDescription;
use App\Core\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
     * @var ProductSystemContract
     */
    protected $productSystem;
    /**
     * @var
     */
    protected $productRepository;

    /**
     * ProductsController constructor.
     * @param ProductSystemContract $productSystem
     * @param ProductsRepository $repository
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(ProductSystemContract $productSystem, ProductsRepository $repository, CategoryRepository $categoryRepository)
    {
        $this->repository = $repository;
        $this->categoryRepository = $categoryRepository;
        $this->productSystem = $productSystem;
        $this->productRepository= $this->productSystem->productRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $data = $request->all();
        $products = $this->productSystem->present($data, null, $with = ["categories"]);
        $no = $products->firstItem();
        return $this->view('index', compact('products', 'no'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $categories = $this->categoryRepository->all();
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
        $product = $this->productSystem->create($data);
        return redirect('admin/products');
    }

    /**
     * @param Request $request
     * @param $id
     * @return Response|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request, $id)
    {
        try {
            $data = $request->all();
            $product = $this->productSystem->present($data, $id);
            return $this->view('show', compact('product'));
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return Response|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request, $id)
    {
        try {
            $data = $request->all();
            $product = $this->productSystem->present($data, $id, ['attributeGroupDescription', 'categories']);
            $categories = $this->categoryRepository->all();
            $pictures = array();
            $chosenCategory = $product->categories->first();
            $attributesList = $product->attributeGroupDescription->pluck("name", "id");
            return $this->view('edit', compact('product', 'categories', 'pictures', 'chosenCategory', 'attributesList'));

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
            $data = $request->all();
            $this->productSystem->update($data, $id);

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
            $this->productSystem->delete($id);
            return redirect('admin/products');
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

}
