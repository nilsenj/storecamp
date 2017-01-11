<?php

namespace App\Core\Repositories;

use Illuminate\Container\Container as Application;
use Illuminate\Contracts\Bus\Dispatcher;
use RepositoryLab\Repository\Eloquent\BaseRepository;
use RepositoryLab\Repository\Criteria\RequestCriteria;
use App\Core\Repositories\MediaRepository;
use App\Core\Models\Media;

/**
 * Class MediaRepositoryEloquent
 * @package namespace App\Core\Repositories;
 */
class MediaRepositoryEloquent extends BaseRepository implements MediaRepository
{
    public $folder;

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
     * @param null $searchQuery
     * @return mixed
     */
    public function allOrSearch($searchQuery = null)
    {
        if (is_null($searchQuery)) {
            return $this->getAll();
        }
        return $this->search($searchQuery);
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->getModel()->all();
    }

    /**
     * @param $searchQuery
     * @return mixed
     */
    public function search($searchQuery)
    {
        $search = "%{$searchQuery}%";

        return $this->getModel()->where('filename', 'like', $search)
            ->orWhere('aggregate_type', '=', $search)
            ->orWhere('directory', '=', $search)
            ->get();
    }

    public function specificSearch($model, $request)
    {
        $search = "%{$request->get('q')}%";
        $tagSearch = $request->get('tag');
        if ($tagSearch) {
            $specificTag = "%{$tagSearch}%";
            return $model->where('aggregate_type', 'like', $specificTag)
                ->get();
        } else {
            return $model->where('filename', 'like', $search)
                ->get();
        }

    }

    /**
     * transform files and directories
     *
     * @param $request
     * @param null $folder
     * @param null $tag
     * @return array
     */
    public function transform($request, $folder = null, $tag = null)
    {
        $model = $this->getModel();
        $parentsPath = $this->folder->getParentFoldersPath($folder);
        $folderPath = $parentsPath ? $parentsPath . '/' . $folder->name : $folder->name;
        $count = $model->inDirectory('local', $folderPath)->count();
        $media = $this->filesPreRender($model, $folderPath, $tag, $request, $folder);
        $directories = $folder->children;
        return [
            'directories' => $directories,
            'media' => $media,
            'count' => $count,
            'path' => $folder->name
        ];
    }
    public function transformFolders($request, $folder = null, $path) {

        $directories = $folder->children;
        return view('admin.media.folders_part', compact('directories', 'path'));

    }


    /**
     * preRender files
     *
     * @param $model
     * @param string $path
     * @param string $tag
     * @param $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    private function filesPreRender($model, $path = "", $tag = "", $request, $folder)
    {
        if ($tag) {
            $media = $this->specificSearch($model->inDirectory('local', $path), $request);

        } else {
            $media = $this->specificSearch($model->inDirectory('local', $path), $request);
        }
        $media = $this->filesRender($media, $path, $tag, $folder);
        return $media;
    }

    /**
     * @param $media
     * @param $path
     * @param $tag
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    private function filesRender($media, $path, $tag, $folder)
    {
        return view('admin.media.files-builder', compact('media', 'path', 'tag', 'folder', 'specificMediaFilesCount', 'audioFilesCount', 'videoFilesFilesCount'));
    }
}
