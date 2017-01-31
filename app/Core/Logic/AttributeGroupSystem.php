<?php

namespace App\Core\Logic;


use App\Core\Contracts\AttributeGroupSystemContract;
use App\Core\Repositories\AttributeGroupDescriptionRepository;
use App\Core\Repositories\AttributeGroupRepository;

/**
 * Class AttributeGroupSystem
 * @package App\Core\Logic
 */
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

    /**
     * @param array $data
     * @param null $id
     * @param array $with
     * @return mixed
     */
    public function presentGroup(array $data, $id = null, array $with = [])
    {
        if ($id) {
            $attributes = $this->group->find($id);
        } else {
            if(!empty($with)) {
                $attributes = $this->group->with($with)->paginate();
            } else {
                $attributes = $this->group->paginate();
            }
        }
        return $attributes;
    }

    public function presentDescription(array $data, $id = null, array $with = [])
    {
    }

    /**
     * @param array $data
     * @return bool|mixed
     */
    public function createGroup(array $data)
    {
        $groupAttribute = $this->group->getModel()->withTrashed()->where("name", $data["name"]);
        if ($groupAttribute->count() > 0) {
            $groupAttribute->restore();
            return false;
        }
        $group = $this->group->create($data);
        return $group;
    }

    public function createDescription(array $data)
    {
    }

    public function updateGroup(array $data, $id)
    {
        $groupAttributeOnlyTrashed = $this->group->getModel()->onlyTrashed()->where("name", $data["name"]);
        $groupAttribute = $this->group->find($id);

        if ($groupAttributeOnlyTrashed->count() > 0) {
            $groupAttribute->restore();
            return false;
        }
        return $groupAttribute->update($data);
    }

    public function updateDescription(array $data, $id)
    {
    }

    public function deleteGroup($id, array $data = []): int
    {
        $deleted = $this->group->delete($id);
        return $deleted;
    }

    public function deleteDescription($id, array $data = []): int
    {
        $deleted = $this->description->delete($id);
        return $deleted;
    }
}