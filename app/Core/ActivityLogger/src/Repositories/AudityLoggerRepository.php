<?php
/**
 * Created by PhpStorm.
 * User: nilse
 * Date: 3/3/2016
 * Time: 11:41 AM
 */

namespace App\Core\Auditing\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

interface AudityLoggerRepository extends RepositoryInterface
{
    public function getAllExcept($id);
    public function getAll();
    public function todayLogs();
    public function getUsersLogs();
    public function getUserLogs($id);
    public function getCompanyUsersLogs($id);
    public function getCompanyUserResponsibleLogs($id);
    public function getAllUsersAdmin();
}