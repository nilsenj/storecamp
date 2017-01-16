<?php

namespace App\Core\Repositories;

use RepositoryLab\Repository\Contracts\RepositoryInterface;

/**
 * Interface SubscribersRepository
 * @package namespace SXC\Repositories;
 */
interface SubscribersRepository extends RepositoryInterface
{
    /**
     * @return mixed
     */
    public function getModel();

    /**
     * @param $request
     * @param $type
     * @return mixed
     */
    public function createSubscription($request, $type);

    /**
     * @param $request
     * @param $type
     * @param $subscription_id
     * @return mixed
     */
    public function deleteSubscription($request, $type, $subscription_id);

    /**
     * @param $uid
     * @return mixed
     */
    public function findList($uid);

    /**
     * @param $email
     * @return mixed
     */
    public function findSubscriber($email);

    /**
     * @param null $type
     * @return mixed
     */
    public function getNewsList($type=null);

    /**
     * @return mixed
     */
    public function resolveTmpMails();

    /**
     * @param $uid
     * @return mixed
     */
    public function resolveMailHistory($uid);
    /**
     * @param $request
     * @param $uid
     * @param $type
     * @return mixed
     */
    public function generateCampaign($request, $uid, $type);

    /**
     * @param $file
     * @return mixed
     */
    public function getTmpMail($file);

    /**
     * @param $folder
     * @param $filename
     * @return mixed
     */
    public function getHistoryTmpMail($folder, $filename);

}
