<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Core\Repositories\SubscribersRepository;

class SubscriptionController extends Controller
{
    /**
     * @var SubscribersRepository
     */
    private $repository;

    /**
     * SubscriptionController constructor.
     * @param SubscribersRepository $repository
     *
     */
    public function __construct(SubscribersRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return mixed
     */
    protected function redirectNotFound()
    {
        \Toastr::error('User Not Found!', $title = 'the user might be deleted or banned', $options = []);
        return redirect()->back();
    }

    /**
     * @return mixed
     */
    protected function redirectError()
    {
        \Toastr::error("Error appeared!", $title = \Auth::user()->name, $options = []);
        return redirect()->back();
    }

    public function index(Request $request)
    {

        $lists = $this->repository->getNewsList();

        $subscribers = $this->repository->getModel()->paginate();

        return view('admin.subscribers.index', compact('subscribers', 'lists'));

    }

    /**
     * @param Request $request
     * @param $uid
     * @return mixed
     */
    public function show(Request $request, $uid)
    {

        if (!is_null($uid)) {

            $lists = $this->repository->getNewsList();

            $newslist = $this->repository->findList($uid);

            $subscribers = $newslist->subscribers()->paginate();

            return view("admin.subscribers.index", compact('lists', 'newslist', 'subscribers', 'mails'));

        } else {

            \Toastr::error("Subscriber Not found!", $title = "Try once more.", $options = []);

            return redirect()->to(route('web::admin::newsletter::subscribe::index'));
        }
    }

    /**
     * @param Request $request
     * @param $type
     * @param $email
     * @return mixed
     */
    public function showUser(Request $request, $type, $email)
    {

        if ($type) {
            $lists = $this->repository->getNewsList();

            $subscriber = $this->repository->findSubscriber($email);

            return view("admin.subscribers.showUser", compact('lists', 'subscriber'));

        } else {
            $lists = $this->repository->getNewsList();

            $subscribers = $this->repository->getModel()->all();

            \Toastr::error("Subscriber Not found!", $title = "Try once more.", $options = []);

            return view("admin.subscribers.index", compact('lists', 'subscribers'));

        }

    }

    /**
     * @param Request $request
     * @param $uid
     * @return mixed
     */
    public function showGenerate(Request $request, $uid)
    {

        if (!is_null($uid)) {

            $mails = $this->repository->resolveTmpMails();

            $mailHistory = $this->repository->resolveMailHistory($uid);

            $lists = $this->repository->getNewsList();

            $newslist = $this->repository->findList($uid);

            if (empty($newslist)) {
                \Toastr::error("News list not found", "Please specify the correct newsletter uid.");
                return \Redirect::route('web::admin::newsletter::subscribe::index');
            }
            return view("admin.subscribers.generate", compact('lists', 'newslist', 'mails', 'mailHistory'));

        } else return $this->redirectError();

    }

    /**
     * @param $file
     * @return mixed
     */
    public function getTmpMail($file)
    {

        $mail = $this->repository->getTmpMail($file);
        return $mail;
    }

    /**
     * @param $folder
     * @param $filename
     * @return mixed
     */
    public function getHistoryTmpMail($folder, $filename)
    {

        $mail = $this->repository->getHistoryTmpMail($folder, $filename);

        return view('admin.subscribers.show-campaign-history', compact('mail'));
    }

    /**
     * @param Request $request
     * @param $uid
     * @param $type
     */
    public function generate(Request $request, $uid, $type)
    {
        $this->repository->generateCampaign($request, $uid, $type);
    }


}
