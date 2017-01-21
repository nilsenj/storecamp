<?php

namespace App\Drivers\FolderToDb;


use App\Core\Models\Folder;
use App\Core\Models\Media;

/**
 * Class Synchronizer
 * @package App\Drivers\FolderToDb
 */
class Synchronizer implements SynchronizerInterface
{
    /**
     * @var Folder
     */
    protected $folder;
    protected $media;

    /**
     * Synchronizer constructor.
     */
    public function __construct()
    {
        $this->folder = new Folder();
        $this->media = new Media();
    }

    /**
     * @param string $folderPath
     * @return Folder
     */
    public function findOrCreateByFolderPath(string $folderPath): Folder
    {
        $folder = $this->folder->where("path_on_disk", $folderPath);
        if ($folder->count() > 0) {
            return $folder->first();
        } else {
            $folderName = explode("/", $folderPath);
            $folderName = $folderName[count($folderName) - 1];
            return $this->folder->create(['name' => $folderName, "path_on_disk" => $folderPath]);
        }
    }

    /**
     * synchronize folders  with
     *
     * folder structure
     *
     * @param string $path
     */
    public function synchronize(string $path): void
    {
        $directories = $this->directoriesIterate($path, true);

        foreach ($directories as $key => $dir) {
            $folderPath = $dir["folderPath"];
            echo $folderPath . "<br>" . "\n";
            $folders = explode("/", $folderPath);
            if (count($folders) > 1) {
                array_pop($folders);
                $newFolderPath = implode("/", $folders);
                $folderParentInstance = $this->findOrCreateByFolderPath($newFolderPath);
                $newFolder = $this->findOrCreateByFolderPath($folderPath);
                $newFolder->parent_id = $folderParentInstance->id;
                $newFolder->save();
            } else {
                $newFolderPath = implode("/", $folders);
                $folderParentInstance = $this->findOrCreateByFolderPath($newFolderPath);
                $folderParentInstance->parent_id = 1;
                $folderParentInstance->save();
            }
        }
    }

    /**
     * synchronize folders  with
     *
     * folder structure
     *
     * @param string $path
     */
    public function synchronizeWithFiles(string $path): void
    {
        $directories = $this->directoriesIterate($path, true);
        $rootFolder = $this->resolveRootFolder();
        foreach ($directories as $key => $dir) {
            $folderPath = $dir["folderPath"];
            echo $folderPath . "<br>" . "\n";
            $folders = explode("/", $folderPath);
            if (count($folders) > 1) {
                array_pop($folders);
                $newFolderPath = implode("/", $folders);
                $folderParentInstance = $this->findOrCreateByFolderPath($newFolderPath);
                if ($folderParentInstance->parent_id == null) {

                    $folderParentInstance->parent_id = $rootFolder->id;
                    $folderParentInstance->save();
                }
                $newFolder = $this->findOrCreateByFolderPath($folderPath);
                $newFolder->parent_id = $folderParentInstance->id;
                $newFolder->save();
                $iter = 0;
                foreach (\File::files(public_path("uploads/" . $newFolder->path_on_disk)) as $file) {
                    $iter++;
                    $fileName = \File::basename($file);
                    $fileNameClean = explode(".", $fileName);
                    array_pop($fileNameClean);
                    $mediaFile = Media::where("directory", $folderParentInstance->path_on_disk)->where("filename", $fileNameClean);
                    if ($mediaFile->count() == 0) {

                        $media = \MediaUploader::importPath("local", $newFolder->path_on_disk . "/" . $fileName);
                        $media->directory_id = $newFolder->id;
                        $media->save();

                    }
                }
            } else {
                $newFolderPath = implode("/", $folders);
                $folderParentInstance = $this->findOrCreateByFolderPath($newFolderPath);
                $folderParentInstance->parent_id = 1;
                $folderParentInstance->save();

                foreach (\File::files(public_path("uploads/" . $folderParentInstance->path_on_disk)) as $file) {
                    $fileName = \File::basename($file);
                    $fileNameClean = explode(".", $fileName);
                    array_pop($fileNameClean);
                    $mediaFile = Media::where("directory", $folderParentInstance->path_on_disk)->where("filename", $fileNameClean);
                    if ($mediaFile->count() == 0) {
                        $media = \MediaUploader::importPath("local", $folderParentInstance->path_on_disk . "/" . $fileName);
                        $media->directory_id = $folderParentInstance->id;
                        $media->save();
                    }
                }
            }
        }
    }

    /**
     * @param string $root
     * @param bool $withFolderName
     * @return array
     */
    public function directoriesIterate(string $root, bool $withFolderName = false): array
    {
        $iter = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($root, \RecursiveDirectoryIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::SELF_FIRST,
            \RecursiveIteratorIterator::CATCH_GET_CHILD // Ignore "Permission denied"
        );

        $paths = array($root);
        foreach ($iter as $path => $dir) {
            if ($dir->isDir()) {
                $paths[] = $path;
            }
        }
        $items = [];
        foreach ($paths as $key => $item) {
            $folderPath = explode("/", implode("", explode($paths[0], $item)));
            unset($folderPath[0]);
            $folderPath = implode("/", $folderPath);

            if ($withFolderName) {

                $folderName = explode("/", $folderPath);
                $folderName = explode("/", $folderName[count($folderName) - 1]);
                if ($key == 0) {
                    if (!empty(implode("", explode($paths[0], $item)))) {
                        $items[$key]["folderPath"] = $folderPath;
                        $items[$key]["folderName"] = $folderName[0];
                    }
                } else {

                    $items[$key]["folderPath"] = $folderPath;
                    $items[$key]["folderName"] = $folderName[0];
                }
            } else {
                if ($key == 0) {
                    if (!empty(implode("", explode($paths[0], $item)))) {
                        $items[] = $folderPath;
                    }
                } else {
                    $items[] = $folderPath;
                }
            }

        }

        return $items;
    }

    private function resolveRootFolder(): Folder
    {
        $rootFolder = Folder::where("name", null)->where("path_on_disk", null);
        if ($rootFolder->count() == 0) {
            return $rootFolder = \App\Core\Models\Folder::create([
                'name' => '',
                'parent_id' => null
            ]);
        } else {
            return $rootFolder = $rootFolder->first();
        }

    }
}