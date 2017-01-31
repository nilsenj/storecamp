<?php

namespace App\Core\Logic;


use App\Core\Contracts\ProductSystemContract;
use App\Core\Models\Product;
use App\Core\Repositories\AttributeGroupDescriptionRepository;
use App\Core\Repositories\ProductsRepository;

class ProductSystem implements ProductSystemContract
{

    public $productRepository;
    public $attributeGroupDescriptionRepository;
    /**
     * ProductSystem constructor.
     *
     * @param ProductsRepository $productRepository
     * @param AttributeGroupDescriptionRepository $attributeGroupDescriptionRepository
     */
    public function __construct(ProductsRepository $productRepository, AttributeGroupDescriptionRepository $attributeGroupDescriptionRepository)
    {
        $this->productRepository = $productRepository;
        $this->attributeGroupDescriptionRepository = $attributeGroupDescriptionRepository;
    }

    public function present($request, $id = null, array $with = [])
    {
        if ($id) {
            $products = $this->productRepository->find($id);
        } else {
            if(!empty($with)) {
                $products = $this->productRepository->with($with)->newest()->paginate();
            } else {
                $products = $this->productRepository->paginate();
            }
        }
        return $products;
    }

    public function create($request)
    {
        $data = $request->all();
        $product = $this->productRepository->create($data);
        $categoryId = $request->category_id ? $request->category_id : null;
        $product->categories()->attach($categoryId);
        $attributes = [];
        if(isset($attr["attr_description_id"])) {
            foreach ($data['product_attribute'] as $key => $attr) {
                $attribute = $product->attributeGroupDescription()->save($this->attributeGroupDescriptionRepository->find(intval($attr["attr_description_id"])), ["value" => $data['product_attribute'][$key]["value"]]);
                $attributes[] = $attribute;
            }
        }
        return $product;
    }

    public function update($request, $id)
    {

    }

    public function delete($request, $id)
    {

    }

}