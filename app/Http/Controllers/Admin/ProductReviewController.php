<?php

namespace App\Http\Controllers\Admin;

use App\Core\Contracts\ProductReviewSystemContract;
use App\Core\Repositories\ProductReviewRepository;
use App\Core\Validators\ProductReview\ReplyProductReviewFormRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Core\Repositories\ProductsRepository;
use App\Core\Repositories\UserRepository;

/**
 * Class ProductReviewController
 * @package App\Http\Controllers\Admin
 */
class ProductReviewController extends BaseController
{
    /**
     * @var ProductsRepository
     */
    protected $product;
    /**
     * @var UserRepository
     */
    protected $user;

    /**
     * @var ProductReviewRepository
     */
    protected $productReview;

    /**
     * @var
     */
    protected $productReviewSystem;

    /**
     * ProductReviewController constructor.
     * @param ProductReviewSystemContract $productReviewSystem
     * @param ProductsRepository $product
     * @param UserRepository $user
     * @param ProductReviewRepository $productReview
     */
    public function __construct(ProductReviewSystemContract $productReviewSystem, ProductsRepository $product, UserRepository $user, ProductReviewRepository $productReview)
    {
        $this->productReviewSystem = $productReviewSystem;
        $this->product = $productReviewSystem->product;
        $this->user = $productReviewSystem->user;
        $this->productReview = $productReviewSystem->productReview;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        try {
            $data = $request->all();
            $productReviews = $this->productReviewSystem->present($data, null, ['product', 'user', 'thread']);
            $no = $productReviews->firstItem();

            return view('admin.productReview.index', compact('productReviews', 'no'));

        } catch (\Throwable $e) {
            return $this->redirectError($e);
        }

    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show(Request $request, $id)
    {
        try {
            $data = $request->all();
            $productReview = $this->productReviewSystem->present($data, $id, ['product', 'user', 'thread']);;
            $currentUserId = \Auth::user()->id;
            $productReview->thread->first()->markAsRead($currentUserId);

            return view('admin.productReview.show', compact('productReview', 'currentUserId'));

        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound($e);
        } catch (\Throwable $e) {
            return $this->redirectError($e);
        }
    }

    /*TODO implement create form for productReview functionality*/
    /**
     * @param Request $request
     */
    public function create(Request $request)
    {

    }

    /*TODO implement store productReview functionality*/
    /**
     * @param Request $request
     */
    public function store(Request $request)
    {

    }

    /**
     * @param ReplyProductReviewFormRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function replyFeedback(ReplyProductReviewFormRequest $request, $id)
    {
        try {
            $data = $request->all();
            $productReviews = $this->productReviewSystem->replyProductReview($id, $data);

            return redirect()->to(route("admin::reviews::show", $productReviews->id));
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound($e);
        } catch (\Throwable $e) {
            return $this->redirectError($e);
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function visibility(Request $request, $id)
    {
        try {
            $data = $request->all();
            $productReview = $this->productReviewSystem->toggleVisibility($id, $data);
            return redirect()->back();
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound($e);
        } catch (\Throwable $e) {
            return $this->redirectError($e);
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function markAsRead(Request $request, $id)
    {
        try {
            $data = $request->all();
            if ($request->ajax()) {
                $this->productReviewSystem->markAsRead($id, $data);
                return response()->json(['message' => 'productReview marked as read', 'messages_count' => \Auth::user()->newMessagesCount()], 200);
            } else {
                return response()->json('not allowed', 400);
            }
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound($e);
        } catch (\Throwable $e) {
            return $this->redirectError($e);
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete(Request $request, $id)
    {
        try {
            $data = $request->all();
            $deleted = $this->productReviewSystem->delete($id, $data);
            if (!$deleted) {
                \Flash::error('Error appeared! Review not deleted!');
            }
            return redirect('admin/reviews/index');
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound($e);
        } catch (\Throwable $e) {
            return $this->redirectError($e);
        }
    }
}
