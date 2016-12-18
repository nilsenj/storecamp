<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 6/19/2015
 * Time: 1:08 PM
 */

namespace App\Core\Repositories;

use Prettus\Repository;

interface RolesRepository extends Repository\Contracts\RepositoryInterface {

    public function renew($data, $dataPerm, $role);
    public function getModel();
}