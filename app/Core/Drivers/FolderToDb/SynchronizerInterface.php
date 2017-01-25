<?php

namespace App\Drivers\FolderToDb;

use App\Core\Models\Folder;

interface SynchronizerInterface {

    public function findOrCreateByFolderPath(string $folderPath, $disk = 'local') : Folder ;

    public function synchronize(string $path, $disk = 'local') : void;

    public function synchronizeWithFiles(string $path, $disk = 'local'): void;

    public function directoriesIterate(string $root, bool $withFolderName = false ) : array;

}