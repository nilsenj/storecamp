<?php

namespace App\Core\Repositories;

use RepositoryLab\Repository\Contracts\RepositoryInterface;

/**
 * Interface FolderRepository
 * @package namespace App\Core\Repositories;
 */
interface FolderRepository extends RepositoryInterface
{
    public function disk(string $name) : FolderRepositoryEloquent;
    public function defaultFolder($disk, $folder = null);
    public function getParentFolders($folder);
    public function getParentFoldersPath($folder);
    public function getParentFoldersPathLinks($folder, $array = []);
}
