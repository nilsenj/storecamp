<?php

namespace App\Core\Logic;

use App\Core\Contracts\ProductReviewSystemContract;
use App\Core\Models\User;
use App\Core\Repositories\ProductReviewRepository;
use App\Core\Repositories\ProductsRepository;
use App\Core\Repositories\UserRepository;
use Illuminate\Http\Request;

/**
 * Class ProductReviewSystem
 * @package App\Core\Logic
 */
class ProductReviewSystem implements ProductReviewSystemContract
{
    /**
     * @var ProductsRepository
     */
    public $product;

    /**
     * @var UserRepository
     */
    public $user;

    /**
     * @var ProductReviewRepository
     */
    public $productReview;

    /**
     * ProductReviewSystem constructor.
     * @param ProductsRepository $product
     * @param UserRepository $user
     * @param ProductReviewRepository $productReview
     */
    public function __construct(ProductsRepository $product, UserRepository $user, ProductReviewRepository $productReview)
    {
        $this->product = $product;
        $this->user = $user;
        $this->productReview = $productReview;
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
            $products = $this->productReview->find($id);
        } else {
            if (!empty($with)) {
                $products = $this->productReview->with($with)->paginate();
            } else {
                $products = $this->productReview->paginate();
            }
        }
        return $products;
    }

    /**
     * @param $id
     * @param $data
     * @return mixed
     */
    public function replyProductReview($id, array $data)
    {
        $productReview = $this->productReview->replyProductReview($id, $data['reply_message']);
        return $productReview;
    }

    /**
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function toggleVisibility($id, array $data)
    {
        $productReview = $this->productReview->find($id);
        if ($productReview->hidden == 0) {
            $productReview->hidden = 1;
        } else {
            $productReview->hidden = 0;
        }
        return $productReview->save();
    }

    /**
     * @param $id
     * @param $data
     */
    public function markAsRead($id, $data)
    {
        $productReview = $this->productReview->find($id);
        $currentUser = \Auth::user();
        $productReview->thread->first()->markAsRead($currentUser->id);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        $thread = new \App\Core\Components\Messenger\Models\Thread();
        $product = $this->product->find($data['product_id']);
        unset($data['product_id']);
        $review = $product->productReview()->create($data);
        $subject = $product->title;
        $thread = $thread->create(
            [
                'product_reviews_id' => $review->id,
                'subject' => $subject
            ]);
        $user = new User();
        $adminArr = $user->getUsersByRole("Admin");
        if($adminArr) {
            $thread->addParticipants($adminArr);
        }
        return $review;
    }

    /**
     * @param array $data
     * @param $reviewId
     * @return mixed
     */
    public function update(array $data, $reviewId)
    {
        $review = $this->productReview->update($data, $reviewId);
        return $review;
    }

    /**
     * @param $id
     * @param array $data
     * @return int
     */
    public function delete($id, array $data = []): int
    {
        $deleted = $this->productReview->delete($id);
        return $deleted;
    }
}