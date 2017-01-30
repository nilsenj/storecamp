<?php

namespace App\Components\MediaSystem;

use App\Core\Models\Folder;
use App\Core\Repositories\FolderRepository;
use App\Core\Repositories\MediaRepository;

class MediaSystemBuilder
{
    protected $folder;
    protected $media;

    /**
     * MediaSystemBuilder constructor.
     * @param $folder
     * @param $media
     */
    public function __construct(FolderRepository $folder, MediaRepository $media)
    {
        $this->folder = $folder;
        $this->media = $media;
    }

    /**
     * @param Folder $folder
     * @param string $disk
     * @param array $array
     * @return string
     */
    public function getParentFoldersPathLinks($folder, string $disk, $array = [])
    {
        $disk = $this->folder->disk($disk);
        $array = $this->prepareParentFolderLinks($folder, $disk->getDisk());
        $item = link_to_route("admin::media::index", $folder->name ? $folder->name : "../", [$disk->getDisk(), $folder->unique_id],
            ["class" => "active", "style" => "margin-left: 10px"]);
        array_push($array, $item);

        return implode("", $array);
    }

    /**
     * @param string $disk
     * @return string
     */
    public function getDiskUrls(string $disk)
    {

        $disk = $this->folder->disk($disk);
        $rootFolders = $disk->getDiskRoots();
        $diskUrls = [];
        foreach ($rootFolders as $key => $item) {
            $item = link_to_route("admin::media::index", $item->disk,
                [$item->disk, $item->unique_id], ["style" => "margin-left: 10px", "class" => $disk->getDisk() == $item->disk ? "active btn btn-xs btn-default" : "btn btn-xs btn-default"]);
            array_unshift($diskUrls, $item);
        }
        return implode("", $diskUrls);
    }

    /**
     * @param $request
     * @param null $folder
     * @param $path
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function presentFolders($request, $folder = null, $path)
    {
        $directories = $folder->children;
        $disk = $folder->disk;
        return view('admin.media.folders-list', compact('directories', 'path', 'disk'));

    }

    /**
     * @param Folder $folder
     * @param string $disk
     * @param array $array
     * @return array
     */
    private function prepareParentFolderLinks($folder, string $disk, $array = [])
    {
        while ($folder->parent_id != null) {
            $newParent = $this->folder->find($folder->parent_id);
            $item = link_to_route("admin::media::index", $newParent->name ? $newParent->name : "../",
                [$this->folder->disk($disk)->getDisk(), $newParent->unique_id], ["style" => "margin-left: 10px"]);
            array_unshift($array, $item);
            return $this->prepareParentFolderLinks($newParent, $disk, $array);
        }
        return array_filter($array);
    }
}