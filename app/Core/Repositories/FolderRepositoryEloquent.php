<?php

namespace App\Core\Repositories;

use Illuminate\Container\Container as Application;
use Illuminate\Contracts\Bus\Dispatcher;
use RepositoryLab\Repository\Eloquent\BaseRepository;
use RepositoryLab\Repository\Criteria\RequestCriteria;
use App\Core\Repositories\FolderRepository;
use App\Core\Models\Folder;

/**
 * Class FolderRepositoryEloquent
 * @package namespace App\Core\Repositories;
 */
class FolderRepositoryEloquent extends BaseRepository implements FolderRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Folder::class;
    }

    public function getModel()
    {

        return $this->model;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getFolders($folder)
    {

        $folders = [];

        return $folders;

    }

    protected function selectChild($id)
    {
        $folders = $this->model->where('parent_id', $id)->get();
        $folders = $this->addRelation($folders);
        return $folders;

    }

    protected function addRelation($folders)
    {

        $folders->map(function ($item, $key) {

            $sub = $this->selectChild($item->id);

            return $item = array_add($item, 'subFolder', $sub);

        });

        return $folders;
    }

    public function getParentFolders($folder, $array = [])
    {
        while ($folder->parent_id != null) {
            $newParent = $this->find($folder->parent_id);
            $array[] = $newParent;
            return $this->getParentFolders($newParent, $array);
        }
        return $array;
    }

    public function getParentFoldersPath($folder, $array = [])
    {
        while ($folder->parent_id != null) {
            $newParent = $this->find($folder->parent_id);
            $array[] = $newParent->name;
            return $this->getParentFoldersPath($newParent, $array);
        }
        return implode("/", array_filter($array));
    }

}
