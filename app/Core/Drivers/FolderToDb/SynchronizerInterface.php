<?php

namespace App\Drivers\FolderToDb;

use App\Core\Models\Folder;

interface SynchronizerInterface {

    public function findOrCreateByFolderPath(string $folderPath) : Folder ;

    public function synchronize(string $path) : void;

    public function synchronizeWithFiles(string $path): void;

    public function directoriesIterate(string $root, bool $withFolderName = false ) : array;

}