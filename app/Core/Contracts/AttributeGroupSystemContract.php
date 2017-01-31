<?php

namespace App\Core\Contracts;


interface AttributeGroupSystemContract
{
    public function presentGroup(array $data, $id = null, array $with = []);

    public function presentDescription(array $data, $id = null, array $with = []);

    public function createGroup(array $data);

    public function createDescription(array $data);

    public function updateGroup(array $data, $id);

    public function updateDescription(array $data, $id);

    public function deleteGroup($id, array $data = []): int;

    public function deleteDescription($id, array $data = []): int;
}