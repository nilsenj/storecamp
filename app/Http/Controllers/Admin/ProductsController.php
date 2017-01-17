<?php

namespace App\Http\Controllers\Admin;

use App\Core\Models\AttributeGroupDescription;
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
        $products = $this->repository->with("categories")->paginate();
        $no = $products->firstItem();
        \Toastr::info('Hello Man Me again', $title = "Fuck The system!");
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
        $product = $this->repository->create($data);
        $categoryId = $request->category_id ? $request->category_id : null;
        $product->categories()->attach($categoryId);
        $attributes = [];
        if(isset($attr["attr_description_id"])) {
            foreach ($data['product_attribute'] as $key => $attr) {
                $attribute = $product->attributeGroupDescription()->save(AttributeGroupDescription::find(intval($attr["attr_description_id"])), ["value" => $data['product_attribute'][$key]["value"]]);
                $attributes[] = $attribute;
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
            $product = $this->repository->find($id);;
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
            $product = $this->repository->with('attributeGroupDescription')->find($id);
            $categories = $this->categoryRepository->all();
            $pictures = array();
            $chosenCategory = $product->categories()->first();
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
            $product = $this->repository->find($id);
            $data = $request->all();
            $product->update($data);
            $categoryId = $request->category_id ? $request->category_id : null;
            if ($categoryId) {
                $product->categories()->detach();
                $product->categories()->attach($categoryId);
            }
            $attributes = [];
            $productAttributes = $product->attributeGroupDescription();
            if ($productAttributes->count() > 0) {
                $product->attributeGroupDescription()->sync([]);
            }
            if(isset($data['product_attribute'])) {
                foreach ($data['product_attribute'] as $key => $attr) {
                    $attribute = $product->attributeGroupDescription()->save(AttributeGroupDescription::find($attr["attr_description_id"]), ["value" => $data['product_attribute'][$key]["value"]]);
                    $attributes[] = $attribute;
                }
            }

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
