<?php

namespace App\Core\Repositories;

use App\Events\MailSentTOReceiver;
use App\Jobs\SendCampaignEmails;
use App\Core\Models\User;
use RepositoryLab\Repository\Contracts\CacheableInterface;
use RepositoryLab\Repository\Eloquent\BaseRepository;
use RepositoryLab\Repository\Criteria\RequestCriteria;
use RepositoryLab\Repository\Traits\CacheableRepository;
use App\Core\Repositories\SubscribersRepository;
use App\Core\Models\Subscribers;

use Illuminate\Container\Container as Application;
use Illuminate\Contracts\Bus\Dispatcher;
use League\Csv\Writer;
use League\Csv\Reader;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Mail\Mailer;

/**
 * Class SubscribersRepositoryEloquent
 * @package namespace SXC\Repositories;
 */
class SubscribersRepositoryEloquent extends BaseRepository implements \App\Core\Repositories\SubscribersRepository, CacheableInterface
{

    use CacheableRepository;
    /**
     * @var RolesRepository
     */
    protected $roleRepository;
    protected $newsLetterListRepository;
    protected $user;
    protected $dispatcher;

    public function __construct(Application $app, Dispatcher $dispatcher,
                                RolesRepository $roleRepository,
                                NewsLetterListRepository $newsLetterListRepository
    )
    {
        parent::__construct($app, $dispatcher);

        $this->roleRepository = $roleRepository;
        $this->newsLetterListRepository = $newsLetterListRepository;
        $this->user = new User();
        $this->dispatcher = $dispatcher;
    }
    /*
     * MAIN Logic OF Subscribes management
     */
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Subscribers::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * get the model
     *
     * @return mixed
     */
    public function getModel()
    {
        $model = new Subscribers();

        return $model;
    }

//    public function getnewsLetterList($type){}
    /**
     * @param $listName
     * @param bool $uid
     * @return mixed
     */
    public function findOrCreateList($listName, $uid = FALSE)
    {
        $field = $uid ? 'unique_id' : 'listName';
        $list = $this->newsLetterListRepository->getModel()->where($field, $listName)->first();
        if (is_null($list)) return $this->createList($listName);
        return $list;
    }

    public function findList($uid)
    {

        if (!is_null($uid)) {
            $field = $uid ? 'unique_id' : 'listName';

            $list = $this->newsLetterListRepository->getModel()->where($field, $uid)->first();
            return $list;

        } else {
            return null;
        }
    }

    /**
     * @param $listName
     * @return mixed
     */
    public function createList($listName)
    {
        $list = $this->newsLetterListRepository->getModel();
        $list->listName = $listName;
        $list->save();
        return $list;
    }

    private function createSubscriber($data, $list)
    {
        $subscriber = $this->getModel();
        foreach ($data as $key => $value) $subscriber->{$key} = $value;
        $subscriber->save();
        if (!is_null($list)) {
            $list->subscribers()->attach($subscriber);
            $list->save();
        }
        return true;
    }

    public function createSubscription($request, $type)
    {
        $mail = $request->get('subscriber_email');
        $info = NULL;
        // So we can pass a list as second value without userinfo
        if (func_num_args() == 2 && is_string($info)) {
            list($info, $type) = [[], $info];
        }

        if (!is_null($type)) {
            $list = $this->findOrCreateList($type);
        } else {
            $list = NULL;
        }

        if (is_null($info)) {
            $info = [];
        }

        $info = array_merge($info, ['email' => $mail]);

        if (is_null($subscriber = $this->getModel()->where('email', $mail)->first())) {
            if (!is_null($list)) {
                $list->subscribers()->attach($subscriber);
                $list->save();
                $this->createSubscriber($info, $list);
                return true;
            } else {
                return false;
            }
        } else {
            $countListEmail = $list->subscribers()->where("email", $mail)->count();

            if ($countListEmail == 0) {
                $subscriber = $this->getModel()->mails($mail)->first();

                $list->subscribers()->sync([$subscriber->id]);

                return true;

            } else return false;
        }
    }

    public function deleteSubscription($request, $type, $subscription_id)
    {
        $mail = $request->get('subscriber_email');
        $subscriber = $this->getModel()->where('email', $mail)->first();

        if (is_null($subscriber)) {
            \Toastr::warning("Subscriber Not Found. Sorry!!!");
            return redirect()->back();
        }

        foreach ($subscriber->newsList as $list) {
            if ($list->name == $type || $type === NULL) {
                $list->subscribers()->detach($subscriber);
            }
        }

        if (is_null($type)) {
            $subscriber->delete();
            return true;
        }

    }

    /**
     * @param $email
     * @return mixed
     */
    public function findSubscriber($email)
    {

        $subscriber = $this->getModel()->where('email', $email)->first();

        return $subscriber;
    }

    /**
     * @param null $type
     * @return mixed
     */
    public function getNewsList($type = null)
    {
        if (is_null($type)) {

            return $this->newsLetterListRepository->all();

        } else {

            return $this->newsLetterListRepository->findByField("listName", $type);

        }
    }

    /**
     * @return array
     */
    public function resolveTmpMails()
    {
        $mails = [];

        $emailArr = \File::allFiles(base_path('resources/views/tmp_mails'));

        foreach ($emailArr as $path) {
            $mails[] = pathinfo($path);
        }

        return $mails;
    }

    public function resolveMailHistory($uid)
    {
        $mailHistory = [];
        $pathToHistory = base_path('resources/views/storage/tmp_mails/' . $uid);
        if (\File::exists($pathToHistory)) {
            $emailArr = \File::allFiles($pathToHistory);

            foreach ($emailArr as $path) {
                if (pathinfo($path)['extension'] == 'php') {
                    $mailHistory[] = pathinfo($path);
                }
            }
        }
        return $mailHistory;
    }

    /**
     * @param $file
     * @return mixed
     */
    public function getTmpMail($file)
    {
        $path = base_path('resources/views/tmp_mails/');

        try {
            $path = $path . $file . ".html";

            return \File::get($path);

        } catch (\Error $e) {
            return back()->withErrors($e);
        }
    }

    public function getHistoryTmpMail($folder, $filename)
    {
        $path = base_path('resources/views/storage/tmp_mails/');

        try {
            $path = $path . '/' . $folder . '/' . $filename . ".php";

            if (\File::exists($path)) {
                return \File::get($path);
            } else {
                return null;
            }

        } catch (\Error $e) {

            return back()->withErrors($e);
        }

    }


    private function putMail($request, $uid)
    {
        $root = base_path('resources/views/storage/tmp_mails') . "/" . $uid . "/";
        if (!\File::exists($root)) {

            \File::makeDirectory($root, 0775, true, true);
        }
        $randomStr = str_random(5);
        $filename = $randomStr . ".blade.php";
        $path = $root . $filename;
        $viewFolder = "storage/tmp_mails" . "/" . $uid . "/" . $randomStr;
        \File::put($path, $request->mail);

        return array($root, $path, $viewFolder);

    }

    private function putCSV($root)
    {
        if (!\File::exists($root)) {

            \File::makeDirectory($root, 0775, true, true);
        }

        $path = $root . str_random(5) . ".csv";
        \File::put($path, null);

        return $path;

    }

    private function mailFromFile($file)
    {
        $reader = Reader::createFromPath($file, 'r');
        $reader->setOffset(1);
        $result = $reader->fetchAll();
        return $result;
    }

    /**
     * @param $type
     * @param $sender_email
     * @param $sender_name
     * @param $viewFolder
     * @param $csvPath
     */
    protected function handleCampaign($type, $sender_email, $sender_name, $viewFolder, $csvPath)
    {
        $file = $csvPath;
        $mails = $this->mailFromFile($file);
        $c = count($mails);
        echo "total : " . $c . "\n";
        $emails = [];
        $start = 0;
        $end = $c - 1;
        $view = $viewFolder;
        $senderAddr = $sender_email;
        $senderName = $sender_name;
        $subject = $type;
        foreach (range($start, $end) as $num) {
            if ($num > count($mails) - 1) {
                echo "\n Maximum reached";
                break;
            }
            $name = isset($mails[$num][1]) ? trim($mails[$num][1]) : null;
            $receiverMail = trim($mails[$num][0]);

            $this->dispatcher->dispatch(new SendCampaignEmails($view, $subject, $receiverMail, $senderAddr, $senderName, $name));
            \Event::fire(new MailSentTOReceiver ("<br>" . " send email: " . $receiverMail . "<strong>" . " finished " . "</strong>" . "<br>"));
        }
        echo "\n <h3 class='text-info'>All done</h3>";
    }

    /**
     * @param $request
     * @param $uid
     * @param $type
     */
    public function generateCampaign($request, $uid, $type)
    {
        $pathArr = $this->putMail($request, $uid);
        $path = $pathArr[1];
        $root = $pathArr[0];
        $viewFolder = $pathArr[2];
        $rows = $this->findList($uid)->subscribers();
        $csvPath = $this->putCSV($root);
        $csv = Writer::createFromPath($csvPath);
        //we insert the CSV header
        $csv->insertOne(['email']);

        foreach ($rows->get(['email']) as $person) {
            $personArr = $person->toArray();
            unset($personArr['pivot']);
            $csv->insertOne($personArr);
        }

        $sender_email = env('MAIL_FROM');
        $sender_name = strstr($sender_email, '@', true); // As of PHP 5.3.0
        $typeArr = explode(" ", $type);
        $type = implode("_", $typeArr);
//      echo $type;
//      $cmd = "mail:campaign " . $csvPath . " --view=" . $viewFolder . " -f=" . $sender_email . " --sender_name=" . $sender_name . " -t=" . ".$type." . "";

        $this->handleCampaign($type, $sender_email, $sender_name, $viewFolder, $csvPath);

//        return \Artisan::call("mail:campaign", [
//                '-t' => "$type",
//                '-f' => "$sender_email",
//                '--sender_name' => "$sender_name",
//                '-b' => "$viewFolder",
//                "file" => $csvPath
//            ]);
    }

}
