<?php

namespace App\Http\Controllers\Admin;

use App\Core\Models\Folder;
use App\Core\Repositories\FolderRepository;
use App\Core\Repositories\MediaRepository;
use Arcanedev\LogViewer\Exceptions\FilesystemException;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Plank\Mediable\Exceptions\MediaUploadException;
use Plank\Mediable\HandlesMediaUploadExceptions;
use Plank\Mediable\Media;
use Plank\Mediable\MediaUploaderFacade;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use That0n3guy\Transliteration\Facades\Transliteration; //use the facade

/**
 * Class MediaController
 * @package App\Http\Controllers
 */
class MediaController extends BaseController
{
    use HandlesMediaUploadExceptions;
    /**
     * @var string
     */
    public $viewPathBase = "admin.media.";
    /**
     * @var string
     */
    public $errorRedirectPath = "admin/media";
    /**
     * @var MediaRepository
     */
    public $repository;
    /**
     * @var FolderRepository
     */
    public $folder;

    /**
     * @var
     */
    public $defaultFolder;

    /**
     * MediaController constructor.
     * @param MediaRepository $repository
     * @param FolderRepository $folder
     */
    public function __construct(MediaRepository $repository, FolderRepository $folder)
    {
        $this->repository = $repository;
        $this->folder = $folder;
        $this->defaultFolder = Folder::first();
    }

    /**
     * @param $request
     * @param null $folder
     * @return array
     */
    private function preDefineIndexPart($request, $folder = null)
    {
        try {
            $folder = $folder ? $this->folder->find($folder) : $this->defaultFolder;
            $files = $this->repository->transform($request, $folder, null);
            $media = $files['media'];
            $directories = $files['directories'];
            $count = $files['count'];
            $path = $this->folder->getParentFoldersPath($folder);
            $folderName = $folder->name ? $folder->name : '';
            $path = $path ? $path . "/" . $folderName : $folderName;
            return ['media' => $media, 'directories' => $directories, 'path' => $path, 'folder' => $folder, 'count' => $count];
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        } catch (\Exception $exception) {
            return redirect()->to($this->errorRedirectPath)->withErrors($exception);
        }
    }

    /**
     * @param Request $request
     * @param null $folder
     * @return View|Response|Redirect
     */
    public function index(Request $request, $folder = null)
    {

        $predefined = $this->preDefineIndexPart($request, $folder);
        $media = $predefined['media'];
        $directories = $predefined['directories'];
        $path = $predefined['path'];
        $folder = $predefined['folder'];
        $count = $predefined['count'];

        return $this->view('index', compact('media', 'directories', 'path', 'folder', 'count'));

    }


    /**
     * get folder structure and response for json requests
     *
     * @param Request $request
     * @param null $folder
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function getIndex(Request $request, $folder = null)
    {
        try {
            $predefined = $this->preDefineIndexPart($request, $folder);
            $media = $predefined['media'];
            $directories = $predefined['directories'];
            $path = $predefined['path'];
            $folder = $predefined['folder'];
            $count = $predefined['count'];
            return $this->view('getIndex', compact('media', 'directories', 'path', 'folder', 'count'));
        } catch
        (ModelNotFoundException $e) {
            return response()->json($e->getMessage(), $e->getCode());
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), $exception->getCode());
        }
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
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), $exception->getCode());
        }
    }

    /**
     * upload files
     *
     * @param Request $request
     * @return $this|\Illuminate\Http\JsonResponse
     */
    public function upload(Request $request)
    {
        try {
            $folder = $request->folder ? $this->folder->find($request->folder) : $this->defaultFolder;

            $parentFoldersPath = $this->folder->getParentFoldersPath($folder);
            $folderPath = $parentFoldersPath ? $parentFoldersPath . '/' . $folder->name : $folder->name;
            $folderFullPath = public_path('uploads') . '/' . $folderPath;
            $file = $request->file('file');
            if (class_exists('That0n3guy\Transliteration\Transliteration')) {
                $filename = Transliteration::clean_filename($file->getClientOriginalName());  // You can see I am cleaning the filename
            }
            $media = MediaUploaderFacade::fromSource($file)->toDirectory($folderPath)->useFilename($filename)->upload();
            $media->directory = $folderPath;
            $media->directory_id = $folder->id;
            $media->save();

        } catch (MediaUploadException $e) {
            throw $this->transformMediaUploadException($e);
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), $exception->getCode());
        } catch (FilesystemException $exception) {
            return response()->json($exception->getMessage(), $exception->getCode());
        }
    }

    /**
     * get folders and response
     * for json requests
     * to reload
     *
     * @param Request $request
     * @param null $folder
     * @return mixed
     */
    public function getIndexFolders(Request $request, $folder = null)
    {
        $folder = $folder ? $this->folder->find(intval($folder)) : $this->defaultFolder;
        $path = $this->folder->getParentFoldersPath($folder);
        $folderName = $folder->name ? $folder->name : '';
        $path = $path ? $path . "/" . $folderName : $folderName;
        $directoryTransformed = $this->repository->transformFolders($request, $folder, $path);
        return $directoryTransformed;

    }

    /** make folder && store the
     * folder in table
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function makeFolder(Request $request)
    {

        try {
            if (class_exists('That0n3guy\Transliteration\Transliteration')) {
                $new_path = Transliteration::clean_filename(trim($request->new_path));  // You can see I am cleaning the filename
            }
            $parentFolderId = $request->folder ? $request->folder : $this->defaultFolder->unique_id;
            $parentFolder = $this->folder->find($parentFolderId);
            $parentFoldersPath = $this->folder->getParentFoldersPath($parentFolder);
            $parentPath = $parentFoldersPath ? $parentFoldersPath . '/' . $parentFolder->name : $parentFolder->name;
            $newFolder = $parentPath ? public_path('uploads') . '/' . $parentPath . '/' . $new_path : public_path('uploads') . '/' . $new_path;
            if (!\File::isDirectory($newFolder)) {

                \File::makeDirectory($newFolder, 0775, true);
                $folder = Folder::create([
                    'name' => $new_path,
                    'path_on_disk' => $newFolder,
                    'parent_id' => $parentFolder->id
                ]);
                return redirect()->route('admin::media::index', $folder->unique_id);
            } else {
                return redirect()->route('admin::media::index');
            }
        } catch (ModelNotFoundException $e) {
            return response()->json($e->getMessage(), $e->getCode());
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), $exception->getCode());
        } catch (FilesystemException $exception) {
            return response()->json($exception->getMessage(), $exception->getCode());
        }
    }


    /**
     * rename folder and sync
     * media files
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public
    function renameFolder(Request $request)
    {
        try {
            if (class_exists('That0n3guy\Transliteration\Transliteration')) {
                $new_name = Transliteration::clean_filename(trim($request->new_name));  // You can see I am cleaning the filename
            }
                $renameFolder = $this->folder->find($request->folder);
            $parentFoldersPath = $this->folder->getParentFoldersPath($renameFolder);
            $renamedPath = $parentFoldersPath ? $parentFoldersPath . '/' . $renameFolder->name : $renameFolder->name;
            $beRenamedToPath = $parentFoldersPath ? $parentFoldersPath . '/' . $new_name : $new_name;
            $selectedFolder = public_path('uploads') . '/' . $renamedPath;
            $newFolder = public_path('uploads') . '/' . $beRenamedToPath;

            if (\File::isDirectory($selectedFolder)) {
                $medias = Media::inDirectory('local', $renamedPath)->get();
                $renamed = \File::move($selectedFolder, $newFolder);
                foreach ($medias as $media) {
                    $media->directory = $beRenamedToPath;
                    $media->save();
                }
                $renameFolder->name = $new_name;
                $renameFolder->path_on_disk = $beRenamedToPath;
                $renameFolder->save();
            }

            return redirect()->route('admin::media::index', $request->folder);
        } catch
        (ModelNotFoundException $e) {
            return response()->json($e->getMessage(), $e->getCode());
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), $exception->getCode());
        } catch (FilesystemException $exception) {
            return response()->json($exception->getMessage(), $exception->getCode());
        }
    }

    /** rename file
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function renameFile(Request $request)
    {
        try {
            if (class_exists('That0n3guy\Transliteration\Transliteration')) {
                $new_name = Transliteration::clean_filename(trim($request->new_name));  // You can see I am cleaning the filename
            }
            $selected_id = trim($request->selected_id);
            $file = $this->repository->find($selected_id);

            $folderFile = $this->folder->find($file->directory_id);
            $parentFoldersPath = $this->folder->getParentFoldersPath($folderFile);

            $renamedPath = $parentFoldersPath ? $parentFoldersPath . '/' . $folderFile->name : $folderFile->name;
            $selectedFolder = public_path('uploads') . '/' . $renamedPath;

            if (\File::isDirectory($selectedFolder)) {
                \File::move($selectedFolder . '/' . $file->filename . '.' . $file->extension, $selectedFolder . '/' . $new_name . '.' . $file->extension);

                $file->filename = $new_name;
                $file->save();
            }
            return redirect()->to('admin/media/' . $folderFile->unique_id);
        } catch (ModelNotFoundException $e) {
            return response()->json($e->getMessage(), $e->getCode());
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), $exception->getCode());
        } catch (FilesystemException $exception) {
            return response()->json($exception->getMessage(), $exception->getCode());
        }
    }

    /**
     * download file link
     *
     * @param $id
     * @param $folder
     * @return Response|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download($id, $folder)
    {
        try {

            $file = $this->repository->find($id);
            $folder = $folder ? $this->folder->find($folder) : $this->defaultFolder;
            $parentFoldersPath = $this->folder->getParentFoldersPath($folder);
            $folderPath = $parentFoldersPath ? $parentFoldersPath . '/' . $folder->name : $folder->name;
            $folderFullPath = public_path('uploads') . '/' . $folderPath;
            return response()->download($folderFullPath . '/' . $file->filename . '.' . $file->extension);

        } catch (ModelNotFoundException $e) {

            return $this->redirectNotFound();
        }
    }

    /**
     * Remove the specified media
     * from storage.
     *
     * @param $id
     * @return Response|\Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            $media = Media::find($id);
            $mediaFolder = $media->directory_id;

            $media->delete();
            return redirect()->to('admin/media/' . $mediaFolder);
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * remove folder
     *
     * @param $folder
     * @return Response|\Illuminate\Http\RedirectResponse
     */
    public function folderDestroy($folder)
    {
        try {
            if (intval($folder) == 1) {
                return redirect()->back();
            }

            $folder = $this->folder->find($folder);
            $parentFoldersPath = $this->folder->getParentFoldersPath($folder);
            $folderPath = $parentFoldersPath ? $parentFoldersPath . '/' . $folder->name : $folder->name;
            $folderFullPath = public_path('uploads') . '/' . $folderPath;
            if (\File::isDirectory($folderFullPath)) {
                $medias = Media::inDirectory('local', $folderPath)->get();
                foreach ($medias as $media) {
                    $media->delete();
                }
                $result = \File::deleteDirectory($folderFullPath);
                $this->folder->delete($folder->id);
            }

            return redirect()->back();
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }
}
