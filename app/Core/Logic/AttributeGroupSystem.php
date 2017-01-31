<?php

namespace App\Core\Logic;


use App\Core\Contracts\AttributeGroupSystemContract;
use App\Core\Repositories\AttributeGroupDescriptionRepository;
use App\Core\Repositories\AttributeGroupRepository;

class AttributeGroupSystem implements AttributeGroupSystemContract
{
    public $group;
    public $description;

    /**
     * AttributeGroupSystem constructor.
     * @param $group
     * @param $description
     */
    public function __construct(AttributeGroupRepository $group, AttributeGroupDescriptionRepository $description)
    {
        $this->group = $group;
        $this->description = $description;
    }

    public function presentGroup(array $data, $id = null, array $with = [])
    {

    }

    public function presentDescription(array $data, $id = null, array $with = [])
    {
    }

    public function createGroup(array $data)
    {
    }

    public function createDescription(array $data)
    {
    }

    public function updateGroup(array $data, $id)
    {
    }

    public function updateDescription(array $data, $id)
    {
    }

    public function deleteGroup($id, array $data = []): int
    {
    }

    public function deleteDescription($id, array $data = []): int
    {
    }
}