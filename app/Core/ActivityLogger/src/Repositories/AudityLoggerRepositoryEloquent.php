<?php
/**
 * Copyright (c) 2016.  Property of Combird.
 * All rights reserved.
 */

/**
 * Created by PhpStorm.
 * User: nilse
 * Date: 3/3/2016
 * Time: 11:43 AM
 */

namespace App\Core\Auditing\Repositories;

use App\Core\Auditing\Log;
use App\Core\Entities\User;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Auth;

class AudityLoggerRepositoryEloquent extends BaseRepository implements AudityLoggerRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Log::class;
    }

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'owner_id' => '=',
        'owner_type' => 'like',
        'old_value' => 'like',
        'new_value' => 'like',
        'type' => 'like'
    ];

    public function getModel()
    {
        $model = Log::class;

        return new $model;

    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getAllExcept($id)
    {

    }

    public function getAll()
    {

    }

    public function todayLogs()
    {

    }

    public function getUsersLogs(){
        $user = User::find(Auth::user()->id); // Get team
        $logs  = $user->first()->logs()->orderBy('created_at', 'desc')->paginate(8); // Get all logs
        return $logs;
    }

    public function getUserLogs($id){
        $user = User::find($id); // Get team
        $logs  = $user->logs()->orderBy('created_at', 'desc')->paginate(8); // Get all logs
        return $logs;
    }
    /*TODO needs implementation of Company instance*/
    public function getCompanyUsersLogs($id){

//        $company = Company::find($id);
//        $companyLogs = $company->logs;
//        return $companyLogs;
    }
    /*TODO needs implementation of Company instance*/
    public function getCompanyUserResponsibleLogs($id){
//        $logs = Company::logs->with(['user'])->get();
//        return $logs;
    }

    public function getAllUsersAdmin()
    {
        $logs = Log::paginate();
        return $logs;
    }


}