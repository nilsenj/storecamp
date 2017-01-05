<?php

namespace App\Core\Repositories;

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
     * @param Media $repository
     * @param string $path
     * @return array
     */
    public function transform($request, $path = null, $tag = null)
    {
        $model = $this->getModel();
        $pathToFolder = public_path('uploads') . '/' . $path;
        if (\File::exists($pathToFolder)) {
            $directories = \File::directories($pathToFolder);
        } else {
            $directories = [];
        }
        $searchpath = implode("_", explode("/", $path));

        $count = $model->inDirectory('local', $searchpath)->count();
        $media = $this->filesPreRender($model, $searchpath, $tag, $request);

        return [
            'directories' => $directories,
            'media' => $media,
            'count' => $count,
            'path' => $path
        ];
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
    private function filesPreRender($model, $path = "", $tag = "", $request)
    {
        if ($tag) {
            $media = $this->specificSearch($model->inDirectory('local', $path), $request);

        } else {
            $media = $this->specificSearch($model->inDirectory('local', $path), $request);
        }

        $media = $this->filesRender($media, $path, $tag);
        return $media;
    }

    /**
     * @param $media
     * @param $path
     * @param $tag
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    private function filesRender($media, $path, $tag)
    {

        $path = implode("/", explode("_", $path));

        return view('admin.media.files-builder', compact('media', 'path', 'tag'));
    }
}
