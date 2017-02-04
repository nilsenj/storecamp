<?php

namespace App\Core\Contracts;


interface ProductReviewSystemContract extends BaseLogicContract
{

    /**
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function replyProductReview($id, array $data);

    /**
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function toggleVisibility($id, array $data);

    /**
     * @param $id
     * @param $data
     */
    public function markAsRead($id, $data);
}