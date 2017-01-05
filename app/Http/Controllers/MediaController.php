<?php

namespace App\Http\Controllers;

use App\Core\Repositories\MediaRepository;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Plank\Mediable\Exceptions\MediaUploadException;
use Plank\Mediable\HandlesMediaUploadExceptions;
use Plank\Mediable\Media;
use Plank\Mediable\MediaUploaderFacade; //use the facade

class MediaController extends Controller
{
    use HandlesMediaUploadExceptions;

    public $repository;

    /**
     * MediaController constructor.
     * @param $repository
     */
    public function __construct(MediaRepository $repository)
    {
        $this->repository = $repository;
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
     * Redirect not found.
     *
     * @return Response
     */
    protected function redirectNotFound()
    {
        return redirect('admin/media')
            ->with(\Flash::error('Item Not Found!'));
    }

    /**
     * @param string $path
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, $path = '')
    {
//        dd($this->repository);
        $tag = '';
        $path = explode("_", $path);
        $path = implode('/', $path);
//        $fileTransformer = new FileTransformer();
//        $media = $this->repository->allOrSearch($request->get('q'));
//        dd($media);
        $files = $this->repository->transform($request, $path, $tag);
        $media = $files['media'];
        $directories = $files['directories'];
        $count = $files['count'];
        $path = implode("_", explode("/", $path));
        return $this->view('index', compact('media', 'directories', 'path', 'count', 'tag'));
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
//            $path = implode("/", explode("_", $path));
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

    public function getByTag($path = "", $tag)
    {
        $path = explode("_", $path);
        $path = implode('/', $path);
        $fileTransformer = new FileTransformer();

        $files = $fileTransformer->transform(new Media(), $path);
        $media = $files['media'];
        $directories = $files['directories'];
        $count = $files['count'];

        return $this->view('index', compact('media', 'directories', 'path', 'count', 'tag'));
    }

    public function makeFolder(Request $request)
    {

        $new_path = ruTolat(trim($request->new_path));
        $path = ruTolat(trim($request->path));
        $path = implode("/", explode("-", $path));
        $newFolder = public_path('uploads') . '/' . $path . '/' . $new_path;
        if (!\File::isDirectory($newFolder)) {
            $result = \File::makeDirectory($newFolder, 0775, true);
        }
        $reirectPath = $path != "" ? implode("_", explode("/", $path)) . '_' . $new_path : $new_path;

        return redirect()->route('admin::media::index', $reirectPath);

    }

    public function renameFolder(Request $request)
    {
        $new_path = ruTolat(trim($request->new_path));
        $selected_path = ruTolat(trim($request->selected_path));
        $path = ruTolat(trim($request->path));
        $renamedPath = $path. '_' . $selected_path;
        $old_path = $path;
        $path = implode("/", explode("_", $path));
        $newFolder = public_path('uploads') . '/' . $path . '/' . $new_path;
        $selectedFolder = public_path('uploads') . '/' . $path . '/' . $selected_path;
        if (\File::isDirectory($selectedFolder)) {
            $renamed = \File::move($selectedFolder, $newFolder);

            $medias = Media::inDirectory('local', $renamedPath)->get();
            foreach ($medias as $media) {
                $media->directory = $old_path . '_' . $new_path;
                $media->save();
            }
        }
        $reirectPath = $path != "" ? implode("_", explode("/", $path)) . '_' . $new_path : $new_path;

        return redirect()->route('admin::media::index', $reirectPath);

    }

    /**
     * download file
     *
     * @param $id
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download($id)
    {

        $file = Media::find($id);
        $directory = implode("/", explode("_", $file->directory));
        return response()->download(public_path('uploads/' . $directory . '/' . $file->filename . '.' . $file->extension));
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
            $mediaPath = $media->directory;
            $media->delete();
            return redirect()->to('admin/media/' . $mediaPath);
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * Remove the specified media from storage.
     *
     **/
    public function folderDestroy($folder)
    {
        try {
//            dd($folder);
            $search = implode("/", explode("_", $folder));
            $newFolder = public_path('uploads') . '/' . $search;

            if (\File::isDirectory($newFolder)) {
                $result = \File::deleteDirectory($newFolder);
            }
            $medias = Media::inDirectory('local', $folder)->get();
            foreach ($medias as $media) {
                $media->delete();
            }
            return redirect()->back();
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }
}
