<?php

namespace App\Core\Repositories;

use RepositoryLab\Repository\Contracts\RepositoryInterface;

/**
 * Interface FolderRepository
 * @package namespace App\Core\Repositories;
 */
interface FolderRepository extends RepositoryInterface
{
    public function getFolders($folder);
    public function getParentFolders($folder);
    public function getParentFoldersPath($folder);
}
