<?php

namespace App\Core\Repositories;

use Illuminate\Container\Container as Application;
use Illuminate\Contracts\Bus\Dispatcher;
use RepositoryLab\Repository\Contracts\CacheableInterface;
use RepositoryLab\Repository\Eloquent\BaseRepository;
use RepositoryLab\Repository\Criteria\RequestCriteria;
use App\Core\Repositories\MediaRepository;
use App\Core\Models\Media;
use RepositoryLab\Repository\Traits\CacheableRepository;

/**
 * Class MediaRepositoryEloquent
 * @package namespace App\Core\Repositories;
 */
class MediaRepositoryEloquent extends BaseRepository implements MediaRepository, CacheableInterface
{
    use CacheableRepository;

    /**
     * @var FolderRepository
     */
    public $folder;
    /**
     * @var int
     */
    protected $perPage = 100;
    /**
     * @var bool
     */
    protected $skipPaginate = false;
    /**
     * @var
     */
    protected $dataTypes;

    /**
     * MediaRepositoryEloquent constructor.
     * @param Application $app
     * @param Dispatcher $dispatcher
     * @param FolderRepository $folder
     */
    public function __construct(Application $app, Dispatcher $dispatcher, FolderRepository $folder)
    {
        parent::__construct($app, $dispatcher);
        $this->folder = $folder;
    }

    /**
     * @return bool
     */
    public function isSkipPaginate(): bool
    {
        return $this->skipPaginate;
    }

    /**
     * @param bool $skipPaginate
     */
    public function setSkipPaginate(bool $skipPaginate)
    {
        $this->skipPaginate = $skipPaginate;
    }

    /**
     * @return mixed
     */
    public function getDataTypes()
    {
        return $this->dataTypes;
    }

    /**
     * @param mixed $dataTypes
     */
    public function setDataTypes(array $dataTypes)
    {
        $types = [];
        foreach ($dataTypes as $type) {
            $types[] = trim($type);
        }
        $this->dataTypes = $types;
    }

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'filename' => 'like',
        'extension' => 'like',
        'aggregate_type' => 'like'
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Media::class;
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        $model = Media::class;

        return new $model;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @param $request
     * @param null $folder
     * @param null $tag
     * @param string $disk
     * @param bool $getAll
     * @param array $dataTypes
     * @return array
     */
    public function transform($request, $folder = null, $tag = null, $disk = '', bool $getAll = false, array $dataTypes = [])
    {
        $model = $this->getModel();
        $parentsPath = $this->folder->disk($disk)->getParentFoldersPath($folder);
        $folderPath = $parentsPath ? $parentsPath . '/' . $folder->name : $folder->name;
        $count = $folder->files->count();
        if ($getAll) {
            $this->setSkipPaginate(true);
        }
        if (!empty($dataTypes)) {
            $this->setDataTypes($dataTypes);
        }
        $media = $this->filesPreRender($model, $folderPath, $tag, $request, $folder, $disk);

        $directories = $folder->children;

        return [
            'directories' => $directories,
            'media' => $media,
            'count' => $count,
            'path' => $folder->name
        ];
    }

    /**
     * @param $request
     * @param null $folder
     * @param $path
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function transformFolders($request, $folder = null, $path)
    {
        $directories = $folder->children;
        $disk = $folder->disk;
        return view('admin.media.folders-list', compact('directories', 'path', 'disk'));

    }


    /**
     * preRender files
     *
     * @param $model
     * @param string $path
     * @param string $tag
     * @param $request
     * @param $folder
     * @param string $disk
     * @return array
     */
    private function filesPreRender($model, $path = "", $tag = "", $request, $folder, $disk = '')
    {
        $folderInstance = $this->folder->disk($disk);
        if ($tag) {
            $media = $this->inDirectory($folderInstance->getDisk(), $path, $tag);

        } else {
            $media = $this->inDirectory($folderInstance->getDisk(), $path);
        }
        $media = ["media" => $media, "path" => $path, "tag" => $tag, "folderInstance" => $folder, 'disk' => $disk];
        return $media;
    }

    /**
     * method rewrite from
     * Media scopeInDirectory()
     *
     * @param $disk
     * @param $directory
     * @param null $tag
     * @param bool $recursive
     * @return mixed
     */
    public function inDirectory($disk, $directory, $tag = null, $recursive = false)
    {
        $this->applyCriteria();
        $this->applyScope();
        $model = $this->model->where('disk', $disk);
        $dataTypes = $this->getDataTypes();
        if ($tag) {
            $model = $this->model->where('aggregate_type', 'like', $tag);
        }
        if ($recursive) {
            $directory = str_replace(['%', '_'], ['\%', '\_'], $directory);
            $model = $model->where('directory', 'like', $directory . '%');
        } else {
            $model = $model->where('directory', '=', $directory);
        }
        if (!empty($dataTypes)) {
            $model = $model->whereIn('aggregate_type', $dataTypes);
        }
        if ($this->isSkipPaginate()) {
            $model = $model->get();
        } else {
            $model = $model->paginate($this->perPage);
        }
        $this->resetModel();
        return $this->parserResult($model);
    }
}
