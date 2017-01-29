<?php

namespace App\Core\Repositories;

use App\Core\Models\Media;
use Illuminate\Container\Container as Application;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use RepositoryLab\Repository\Contracts\CacheableInterface;
use RepositoryLab\Repository\Eloquent\BaseRepository;
use RepositoryLab\Repository\Criteria\RequestCriteria;
use App\Core\Repositories\FolderRepository;
use App\Core\Models\Folder;
use \Illuminate\Filesystem\Filesystem;
use RepositoryLab\Repository\Traits\CacheableRepository;

/**
 * Class FolderRepositoryEloquent
 * @package namespace App\Core\Repositories;
 */
class FolderRepositoryEloquent extends BaseRepository implements FolderRepository, CacheableInterface
{
    use CacheableRepository;

    /**
     * @var Media
     */
    protected $media;
    /**
     * @var Filesystem
     */
    protected $file;
    /**
     * @var string
     */
    public $disk = 'local';

    /**
     * @var mixed
     */
    public $diskRoot;

    /**
     * @var mixed
     */
    public $rootFromProject;

    /**
     * FolderRepositoryEloquent constructor.
     * @param Application $app
     * @param Dispatcher $dispatcher
     * @param Media $media
     * @param Filesystem $file
     */
    public function __construct(Application $app, Dispatcher $dispatcher, Media $media, Filesystem $file)
    {
        parent::__construct($app, $dispatcher);
        $this->media = $media;
        $this->file = $file;
        $this->disk;
        $this->diskRoot = config('filesystems.disks.local.root');
        $this->rootFromProject = config('filesystems.disks.local.rootFromProject');
    }

    /**
     * @return mixed
     */
    public function getDisk()
    {
        return $this->disk;
    }

    /**
     * @param $disk
     * @return FolderRepositoryEloquent
     */
    public function setDisk($disk) : FolderRepositoryEloquent
    {
        $this->disk = $disk;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDiskRoot() : string
    {
        return $this->diskRoot;
    }

    /**
     * @param $diskRoot
     * @return FolderRepositoryEloquent
     */
    public function setDiskRoot($diskRoot) : FolderRepositoryEloquent
    {
        $this->diskRoot = $diskRoot;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRootFromProject() : string
    {
        return $this->rootFromProject;
    }

    /**
     * @param mixed $rootFromProject
     */
    public function setRootFromProject($rootFromProject) : void
    {
        $this->rootFromProject = $rootFromProject;
    }

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
     * @param string $name
     * @return FolderRepositoryEloquent
     */
    public function disk(string $name): FolderRepositoryEloquent
    {
        if (!empty($name)) {
            $that = $this->setDisk($name);
            $that->setDiskRoot(config('filesystems.disks.' . $name . '.root'));
            $that->setRootFromProject(config('filesystems.disks.' . $name . '.rootFromProject'));
            return $that;
        }
        return $this;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * rewrite of delete method
     *
     * @param $id
     * @return int
     */
    public function delete($id)
    {
        $folder = $this->find($id);
        $parentFoldersPath = $this->getParentFoldersPath($folder);
        $folderPath = $parentFoldersPath ? $parentFoldersPath . '/' . $folder->name : $folder->name;
        $folderFullPath = $this->getDiskRoot() . '/' . $folderPath;
        if ($this->file->isDirectory($folderFullPath)) {
            $medias = $this->media->inDirectory($this->getDisk(), $folderPath)->get();
            foreach ($medias as $media) {
                $media->delete();
            }
            $result = $this->file->deleteDirectory($folderFullPath);
            if ($result) {
                parent::delete($folder->id);
            }
        }
    }

    /**
     * Rewrite of a find method
     * Find data by id or unique_id
     *
     * @param       $id
     * @param array $columns
     *
     * @return mixed
     */
    public function find($id, $columns = ['*'])
    {
        $this->applyCriteria();
        $this->applyScope();
        if (is_numeric($id)) {
            $model = $this->model->where('disk', '=', $this->getDisk())->where('id', $id)->first();
        } else {
            $model = $this->model->where('disk', '=', $this->getDisk())->where('unique_id', $id)->first();
        }
        if (is_array($id)) {
            if (count($model) == count(array_unique($id))) {
                $this->resetModel();

                return $this->parserResult($model);
            }
        } elseif (!is_null($model)) {
            $this->resetModel();
            return $this->parserResult($model);
        }
        throw (new ModelNotFoundException())->setModel(get_class($this->model), $id);
    }

    /**
     * @param $key
     * @param $value
     * @param string $operator
     * @return mixed
     */
    public function where($key, $value, $operator = '=')
    {
        $this->applyCriteria();
        $this->applyScope();

        $model = $this->model->where("disk", '=', $this->getDisk())
            ->where($key, $operator, $value)->get($columns = ['*']);

        $this->resetModel();

        return $this->parserResult($model);
    }

    /**
     * @return string
     */
    public function getDiskUrls()
    {

        $rootFolders = $this->getDiskRoots();
        $diskUrls = [];
        foreach ($rootFolders as $key => $item) {
            $item = link_to_route("admin::media::index", $item->disk,
                [$item->disk, $item->unique_id], ["style" => "margin-left: 10px", "class" => $this->getDisk() == $item->disk ? "active btn btn-xs btn-default" : "btn btn-xs btn-default"]);
            array_unshift($diskUrls, $item);
        }
        return implode("", $diskUrls);
    }

    /**
     * @return mixed
     */
    public function getDiskRoots()
    {
        $rootFolders = $this->findWhere([
            ['parent_id', '=', null],
            ["name", "=", ""],
            ["path_on_disk", "=", null]
        ]);
        return $rootFolders;
    }

    /*TODO replace prepareParentFolderLinks to folder partial builder */
    /**
     * @param $folder
     * @param array $array
     * @return array
     */
    public function getParentFolders($folder, $array = [])
    {
        while ($folder->parent_id != null) {
            $newParent = $this->find($folder->parent_id);
            $array[] = $newParent;
            return $this->getParentFolders($newParent, $array);
        }
        return $array;
    }

    /*TODO replace prepareParentFolderLinks to folder partial builder */
    /**
     * @param $folder
     * @param array $array
     * @return string
     */
    public function getParentFoldersPath($folder, array $array = [])
    {
        while ($folder->parent_id != null) {
            $newParent = $this->find($folder->parent_id);
            array_unshift($array, $newParent->name);
            return $this->getParentFoldersPath($newParent, $array);
        }
        return implode("/", array_filter($array));
    }

    /*TODO replace prepareParentFolderLinks to folder partial builder */
    /**
     * @param $folder
     * @param array $array
     * @return string
     */
    public function getParentFoldersPathLinks($folder, $array = [])
    {
        $array = $this->prepareParentFolderLinks($folder);
        $item = link_to_route("admin::media::index", $folder->name ? $folder->name : "../", [$this->getDisk(), $folder->unique_id],
            ["class" => "active", "style" => "margin-left: 10px"]);
        array_push($array, $item);

        return implode("", $array);
    }
    /*TODO replace prepareParentFolderLinks to folder partial builder */
    /**
     * @param $folder
     * @param array $array
     * @return array
     */
    private function prepareParentFolderLinks($folder, $array = [])
    {
        while ($folder->parent_id != null) {
            $newParent = $this->find($folder->parent_id);
            $item = link_to_route("admin::media::index", $newParent->name ? $newParent->name : "../",
                [$this->getDisk(), $newParent->unique_id], ["style" => "margin-left: 10px"]);
            array_unshift($array, $item);
            return $this->prepareParentFolderLinks($newParent, $array);
        }
        return array_filter($array);
    }

    /**
     * @param $disk
     * @param null $folder
     * @return null
     */
    public function defaultFolder($disk, $folder = null)
    {
        if ($folder) {
            $newFolder = $this->disk($disk)->find($folder);
        } else {
            $newFolder = $this->disk($disk)->findByField('disk', $disk)->first();
        }
        return $newFolder;
    }
}
