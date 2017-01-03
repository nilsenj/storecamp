<?php

namespace App\Http\Controllers;

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

    public function view($view, $data = [], $mergeData = [])
    {
        return view('admin.media.' . $view, $data, $mergeData);
    }

    public function index()
    {
        $media = Media::all();
        return $this->view('index', compact('media'));
    }

    public function create()
    {
        $media = Media::all();
        return $this->view('create', compact('media'));
    }

    public function edit(Request $request, $id) {

    }
    public function upload(Request $request)
    {
        try {

            $path = 'assets';
//            dd($request->file('file'));

            MediaUploaderFacade::
                fromSource($request->file('file'))->upload();
            return null;
        } catch (MediaUploadException $e) {
            throw $this->transformMediaUploadException($e);
        }
    }

    public function getMediaFolders() {

        $media = Media::select('directory')->get();
        return response()->json($media, 200);

    }

    public function update(Request $request) {

        $media = MediaUploaderFacade::getMedia();
        MediaUploaderFacade::update($media);
    }
}
