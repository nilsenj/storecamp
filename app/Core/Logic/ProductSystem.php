<?php

namespace App\Core\Logic;


use App\Core\Contracts\ProductSystemContract;
use App\Core\Repositories\AttributeGroupDescriptionRepository;
use App\Core\Repositories\ProductsRepository;

/**
 * Class ProductSystem
 * @package App\Core\Logic
 */
class ProductSystem implements ProductSystemContract
{

    /**
     * @var ProductsRepository
     */
    public $productRepository;
    /**
     * @var AttributeGroupDescriptionRepository
     */
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

    /**
     * @param $data
     * @param null $id
     * @param array $with
     * @return mixed
     */
    public function present(array $data, $id = null, array $with = [])
    {
        if ($id) {
            $products = $this->productRepository->find($id);
        } else {
            if (!empty($with)) {
                $products = $this->productRepository->with($with)->newest()->paginate();
            } else {
                $products = $this->productRepository->newest()->paginate();
            }
        }
        return $products;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function create(array $data)
    {
        $formAttributes = $data['product_attribute'];
        unset($data['product_attribute']);
        $product = $this->productRepository->create($data);
        $categoryId = isset($data['category_id']) ? $data['category_id'] : null;
        $product->categories()->attach($categoryId);
        $attributes = [];
        if (isset($formAttributes)) {
            foreach ($formAttributes as $key => $attr) {
                $attribute = $product->attributeGroupDescription()->save(
                    $this->attributeGroupDescriptionRepository->find(intval($attr["attr_description_id"])), ["value" => $formAttributes[$key]["value"]]);
                $attributes[] = $attribute;
            }
        }
        return $product;
    }

    /**
     * @param $data
     * @param $id
     * @return mixed
     */
    public function update(array $data, $id)
    {
        $formAttributes = $data['product_attribute'];
        unset($data['product_attribute']);
        $product = $this->productRepository->update($data, $id);
        $categoryId = isset($data['category_id']) ? $data['category_id'] : null;
        if ($categoryId) {
            $product->categories()->detach();
            $product->categories()->attach($categoryId);
        }
        $attributes = [];
        $productAttributes = $product->attributeGroupDescription();
        if ($productAttributes->count() > 0) {
            $product->attributeGroupDescription()->sync([]);
        }
        if (isset($formAttributes)) {
            foreach ($formAttributes as $key => $attr) {
                $attribute = $product->attributeGroupDescription()->save(
                    $this->attributeGroupDescriptionRepository->find($attr["attr_description_id"]), ["value" => $formAttributes[$key]["value"]]);
                $attributes[] = $attribute;
            }
        }
        return $product;
    }

    /**
     * @param $id
     * @param array $data
     * @return int
     */
    public function delete($id, array $data = []): int
    {
        $deleted = $this->productRepository->delete($id);
        return $deleted;
    }

}