<?php

namespace App\Core\Contracts;


interface ProductReviewSystemContract
{
    /**
     * @param $data
     * @param null $id
     * @param array $with
     * @return mixed
     */
    public function present($data, $id = null, array $with = []);

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
    public function markAsRead($id, $data) : void;

    /**
     * @param $data
     * @param $id
     * @return mixed
     */
    public function update($data, $id);

    /**
     * @param array $data
     * @param $id
     * @return mixed
     */
    public function delete($id, array $data = []) : int;
}