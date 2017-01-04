<?php
/**
 * Created by PhpStorm.
 * User: nilse
 * Date: 03.01.2017
 * Time: 22:49
 */

namespace App\Transformers;


use Plank\Mediable\Media;

class FileTransformer
{
    /**
     * transform files and directories
     *
     * @param Media $model
     * @param string $path
     * @return array
     */
    public function transform(Media $model, $path = null, $tag = null)
    {
//        $path = implode('/', $path);
        $pathToFolder = public_path('uploads') . '/' . $path;
        if (\File::exists($pathToFolder)) {
            $directories = \File::directories($pathToFolder);
        } else {
            $directories = [];
        }
        $count = $model->inDirectory('local', $path)->count();
        $media = $this->filesPreRender($model, $path, $tag);

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
     * @return mixed
     */
    protected function filesPreRender($model, $path = "", $tag = "")
    {
        if ($path) {
            if ($tag) {
                $media = $model->inDirectory('local', $path)->where('aggregate_type', $tag)->get();

            } else {
                $media = $model->inDirectory('local', $path)->get();
            }
        } else {
            if($tag) {
                $media = $model->where('aggregate_type', $tag)->get();
            } else {
                $media = $model->all();
            }
        }
        $media = $this->filesRender($media, $path, $tag);
        return $media;
    }

    protected function filesRender($media, $path, $tag) {

        return view('admin.media.files-builder', compact('media', 'path', 'tag'));
    }

}