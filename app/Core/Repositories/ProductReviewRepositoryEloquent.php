<?php

namespace App\Core\Repositories;

use App\Core\Validators\ProductReview\ProductReviewFormRequest;
use App\Core\Validators\ProductReview\UpdateProductReviewFormRequest;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use RepositoryLab\Repository\Contracts\CacheableInterface;
use RepositoryLab\Repository\Eloquent\BaseRepository;
use RepositoryLab\Repository\Criteria\RequestCriteria;
use RepositoryLab\Repository\Traits\CacheableRepository;
use App\Core\Models\Product;
use App\Core\Repositories\ProductReviewRepository;
use App\Core\Models\ProductReview;
use Illuminate\Container\Container as Application;
use Illuminate\Contracts\Bus\Dispatcher;
use App\Core\Components\Messenger\Models\Thread;
use App\Core\Components\Messenger\Models\Message;
use App\Core\Components\Messenger\Models\Participant;

/**
 * Class ProductReviewRepositoryEloquent
 * @package App\Core\Repositories
 */
class ProductReviewRepositoryEloquent extends BaseRepository implements ProductReviewRepository, CacheableInterface
{

    use CacheableRepository;
    protected $roleRepository;
    protected $product;
    protected $thread;
    protected $message;
    protected $productDescription;
    protected $participant;

    public function __construct(Application $app, Dispatcher $dispatcher, RolesRepository $roleRepository, ProductsRepository $product)
    {
        parent::__construct($app, $dispatcher);
        $this->roleRepository = $roleRepository;
        $this->product = $product;
        $this->thread = new Thread();
        $this->message = new Message();
        $this->participant = new Participant();
    }

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'rating' => '=',
        'hidden' => '='
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        $productReview = ProductReview::class;
        return $productReview;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(\RepositoryLab\Repository\Criteria\RequestCriteria::class));

    }


    public function getModel()
    {

        $model = new ProductReview();

        return $model;
    }

    /**
     * get all Products
     * @return mixed
     */
    public function getAll()
    {

        return $this->getModel()->latest('created_at')->paginate();

    }

    /**
     * get all current logged in user Feedbacks
     * @return mixed
     */
    public function getAllUsers()
    {

        return $this->getModel()->latest('created_at')->users()->paginate();

    }

    /**
     * get the specific to user id feedbacks
     * @param $id
     * @return mixed
     */
    public function getAllUserById($id)
    {

        return $this->getModel()->latest('created_at')->usersById($id)->paginate();
    }

    public function getById($id)
    {

        return $this->getModel()->find($id);
    }


    /**
     * @param ProductReviewFormRequest $request
     * @return mixed
     */
    public function createProductReview(ProductReviewFormRequest $request)
    {
        $data = $request->except(["unique_id", "rating", "hidden", "date"]);

        $message = $data['message'];
        unset($data['message']);

        $data["product"] = $request->exists('product') ? $this->product->find($request->get('product'))->name : null;
        $data['user_id'] = $request->user()->id;
        $productReview = $request->user()->productReview()->create($data);
        $thread = $this->thread->create(
            [
                'feedback_id' => $productReview->id,
                'subject' => $data["product"],
            ]);
        // Message
        $this->message->create(
            [
                'thread_id' => $thread->id,
                'user_id' => $request->user()->id,
                'body' => $message,
            ]
        );

        // Sender
        $this->participant->create(
            [
                'thread_id' => $thread->id,
                'user_id' => $request->user()->id,
                'last_read' => new \Carbon\Carbon()
            ]
        );

        $adminArr = $this->roleRepository->getRoleUsers("Admin");
        $thread->addParticipantsObjects($adminArr);

        return $productReview;
    }

    /**
     * find the current productReview
     * @param $id
     * @return mixed
     */
    public function getProductReview($id)
    {
        return $this->find($id);
    }

    /*TODO needs to be tested*/
    /**
     * @param UpdateProductReviewFormRequest $request
     * @param $product
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function updateProductReview(UpdateProductReviewFormRequest $request, $product)
    {
        try {


            $data = $request->except(["unique_id", "rating", "hidden", "date"]);

            if ($request->user()->hasRole("Admin")) {
                $extraData = $request->only(["unique_id", "rating", "hidden", "date"]);
                $data = array_merge($data, $extraData);
            }
            $data['user_id'] = $request->user()->id;
            $product->update($data);

        } catch (\Exception $e) {

            return response("error appeared can't update " . $e->getMessage(), $e->getCode());

        }
    }


    public function replyProductReview($id, $message)
    {
        try {

            $productReview = $this->getProductReview($id);
            $thread = $productReview->thread->first();

        } catch (ModelNotFoundException $e) {
            \Toastr::error('error_message', 'The thread with ID: ' . $id . ' was not found.');
            return redirect('messages');
        }

        $thread->activateAllParticipants();
        $user_id = \Auth::user()->id;
        // Message
        $this->message->create(
            [
                'thread_id' => $thread->id,
                'user_id' => $user_id,
                'body' => $message,
            ]
        );

        // Add replier as a participant
        $participant = $this->participant->firstOrCreate(
            [
                'thread_id' => $thread->id,
                'user_id' => $user_id
            ]
        );
        $participant->last_read = new Carbon();
        $participant->save();
        return $productReview;
    }

    /**
     * delete product && attached body && attached tags
     *
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function deleteAll($id)
    {
        try {
            $this->delete($id);

        } catch (\Exception $e) {
            return response("error appeared " . $e->getMessage(), $e->getCode());
        }
    }


    /**
     * return the number of user's products
     * @return mixed
     */
    public function countUserProductReviews()
    {
        return $this->with('user')->where('user_id', '=', \Auth::id())->count();
    }

}
