<?php

namespace App\Core\Repositories;

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

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
