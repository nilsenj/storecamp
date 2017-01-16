<?php

namespace App\Http\Controllers\Admin;

use App\Core\Models\ProductReview;
use App\Core\Repositories\ProductReviewRepository;
use App\Http\Requests\ReplyProductReviewFormRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Core\Repositories\ProductsRepository;
use App\Core\Repositories\UserRepository;

class ProductReviewController extends Controller
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
     * AdminController constructor.
     *
     * @param $product
     * @param $user
     * @param $productReview
     */
    public function __construct(ProductsRepository $product, UserRepository $user, ProductReviewRepository $productReview)
    {
        $this->product = $product;
        $this->user = $user;
        $this->productReview = $productReview;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        try {

            if ($request->get('search')) {
                $fbs = $this->productReview->getModel()->byRating($request->get('search'))->simplePaginate(15);

            } else {
                $this->productReview->pushCriteria(app(\RepositoryLab\Repository\Criteria\RequestCriteria::class));

                $fbs = $this->productReview->getModel()->simplePaginate(15);
            }
            $currentUserId = \Auth::user()->id;
            return view('admin.productReview.index', compact('fbs', 'currentUserId'));

        } catch (\Error $e) {
            return response()->json(['error' => $e->getMessage(), "error_code" => $e->getCode()], $e->getCode());
        }

    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function show(Request $request, $id)
    {
        try {

            if ($request->get('search')) {

                $fbs = $this->productReview->getModel()->byRating($request->get('search'))->simplePaginate(15);
                return view('admin.productReview.index', compact('fbs'));


            } else {

                $fb = $this->productReview->getModel()->find($id);
            }

            $currentUserId = \Auth::user()->id;
            $fb->getThread()->markAsRead($currentUserId);

            return view('admin.productReview.show', compact('fb', 'currentUserId'));

        } catch (\Error $e) {
            return response()->json(['error' => $e->getMessage(), "error_code" => $e->getCode()], $e->getCode());
        }
    }

    /**
     * @param ReplyProductReviewFormRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function replyFeedback(ReplyProductReviewFormRequest $request, $id)
    {

        $fbs = $this->productReview->replyProductReview($id, $request->get('reply_message'));

        return redirect()->to(route("web::admin::showFeedback", $fbs->id));

    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function markAsRead(Request $request, $id)
    {
        try {
            if ($request->ajax()) {

                $fb = $this->productReview->getModel()->find($id);

                $currentUser = \Auth::user();

                $fb->getThread()->markAsRead($currentUser->id);

                return response()->json(['message' => 'productReview marked as read', 'messages_count' => $currentUser->newMessagesCount()], 200);
            } else {
                return response()->json('not allowed', 400);
            }
        } catch (\Error $e) {

            return response(["error"], 400);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete($id)
    {
        try {

            $this->productReview->delete($id);
            return redirect('/home');
        } catch (\ErrorException $e) {
            \Toastr::error('Can\'t ber deleted', "Error while deleting");
            return redirect()->back();
        }
    }
}
