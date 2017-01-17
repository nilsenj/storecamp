<?php

namespace App\Core\Repositories;

use RepositoryLab\Repository\Contracts\RepositoryInterface;

/**
 * Interface FeedBackRepository
 * @package namespace SXC\Repositories;
 */
interface ProductReviewRepository extends RepositoryInterface
{

    /**
     * @return mixed
     */
    public function getModel();

    /**
     * get all Feedbacks
     * @return mixed
     */
    public function getAll();

    /**
     * @return mixed
     */
    public function getAllUsers();


    /**
     * @param $request
     * @return mixed
     */
    public function createProductReview(\App\Core\Validators\ProductReview\ProductReviewFormRequest $request);

    /**
     * @param $request
     * @param $product
     * @return mixed
     */
    public function updateProductReview(\App\Core\Validators\ProductReview\UpdateProductReviewFormRequest $request, $product);

    /**
     * @param $id
     * @param $message
     * @return mixed
     */
    public function replyProductReview($id, $message);
    /**
     * @param $id
     * @return mixed
     */
    public function deleteAll($id);


    /**
     * @return mixed
     */
    public function countUserProductReviews();


    /**
     * get all feedbacks by user id
     * @param $id
     * @return mixed
     */
    public function getAllUserById($id);

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id);
}
