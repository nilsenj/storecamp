<?php

namespace App\Http\Controllers;

use App\Transformers\FileTransformer;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Plank\Mediable\Exceptions\MediaUploadException;
use Plank\Mediable\HandlesMediaUploadExceptions;
use Plank\Mediable\Media;
use Plank\Mediable\MediaUploaderFacade; //use the facade
class MediaManagement extends Controller
{
    use HandlesMediaUploadExceptions;

    public function __constructor()
    {
    }

    /**
     * @param $view
     * @param array $data
     * @param array $mergeData
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function view($view, $data = [], $mergeData = [])
    {
        return view('admin.media.' . $view, $data, $mergeData);
    }

    /**
     * @param string $path
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($path = '')
    {
        $path = explode("_", $path);
        $path = implode('/', $path);
        $fileTransformer = new FileTransformer();

        $files = $fileTransformer->transform(new Media(), $path);
        $media = $files['media'];
        $directories = $files['directories'];
        $count = $files['count'];
        return $this->view('index', compact('media', 'directories', 'path', 'count'));
    }


    public function edit(Request $request, $id)
    {

    }

    /**
     * get media description for json
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function getDescription($id)
    {
        try {
            $file = Media::find($id);
            return response()->view('admin.media.description', compact('file'));
        } catch (ModelNotFoundException $e) {
            return response()->json($e->getMessage(), $e->getCode());
        }
    }

    public function upload(Request $request)
    {
        try {
            $path = isset($request->path) && $request->path != "" ? ruTolat($request->path) : '';
            MediaUploaderFacade::
            fromSource($request->file('file'))->toDirectory($path)->upload();
        } catch (MediaUploadException $e) {
            throw $this->transformMediaUploadException($e);
        }
    }

    public function getMediaFolders()
    {

        $media = Media::select('directory')->get();
        return response()->json($media, 200);
    }

    public function makeFolder(Request $request)
    {

        $new_path = ruTolat(trim($request->new_path));
        $path = ruTolat(trim($request->path));
        $newFolder = public_path('uploads') . '/' . $path . '/' . $new_path;
        if (!\File::extension($newFolder)) {
            $result = \File::makeDirectory($newFolder, 0775, true);
        }
        $reirectPath = $path != "" ? $path . '/' . $new_path : $new_path;

        return redirect()->route('admin::$this->media->index', $reirectPath);

    }

    /**
     * @param Request $request
     */
    public function update(Request $request)
    {

        $media = MediaUploaderFacade::getMedia();
        MediaUploaderFacade::update($media);
    }

    /**
     * Remove the specified media from storage.
     *
     **/
    public function destroy($id)
    {
        try {
            $media = Media::find($id);
            $media->delete();
            return redirect()->back();
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }
}
