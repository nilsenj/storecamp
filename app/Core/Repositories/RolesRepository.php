<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 6/19/2015
 * Time: 1:08 PM
 */

namespace App\Core\Repositories;

use RepositoryLab\Repository\Contracts\RepositoryInterface;

interface RolesRepository extends RepositoryInterface {

    public function renew($data, $dataPerm, $role);
    public function getModel();
    public function store(array $data);
}