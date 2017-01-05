<?php
/**
 * Created by PhpStorm.
 * User: nilse
 * Date: 03.01.2017
 * Time: 22:49
 */

namespace App\Core\Transformers;


use Plank\Mediable\Media;

class FileTransformer
{
    /**
     * transform files and directories
     *
     * @param Media $repository
     * @param string $path
     * @return array
     */
    public function transform($repository, $path = null, $tag = null)
    {
//        $path = implode('/', $path);
        $pathToFolder = public_path('uploads') . '/' . $path;
        if (\File::exists($pathToFolder)) {
            $directories = \File::directories($pathToFolder);
        } else {
            $directories = [];
        }
        $searchpath = implode("_", explode("/", $path));

        $count = $repository->inDirectory('local', $searchpath)->count();
        $media = $this->filesPreRender($repository, $searchpath, $tag);

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
     * @param $$repository
     * @param string $path
     * @return mixed
     */
    protected function filesPreRender($repository, $path = "", $tag = "")
    {
            if ($tag) {
                $media = $repository->inDirectory('local', $path)->where('aggregate_type', $tag)->get();

            } else {
                $media = $repository->inDirectory('local', $path)->get();
            }

        $media = $this->filesRender($media, $path, $tag);
        return $media;
    }

    protected function filesRender($media, $path, $tag) {

        $path = implode("/", explode("_", $path));

        return view('admin.media.files-builder', compact('media', 'path', 'tag'));
    }

}