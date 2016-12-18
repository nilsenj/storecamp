<?php

namespace App\Http\Controllers;

use App\Core\Entities\Category;
//use App\Good;
//use App\Picture;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use Laracasts\Flash\Flash;
use App\Core\Uploader\ImageUploader;
use App\Core\Repositories\GoodsRepository;
use App\Core\Validation\Good\GoodsFormRequest as Create;
use App\Core\Validation\Good\GoodsUpdateFormRequest as Update;

class GoodsController extends Controller
{
    protected $articles;
    /**
     * @var ImageUploader
     */
    protected $uploader;

    protected $repository;
    /**
     * @param ImageUploader $uploader
     * @param GoodsRepository $repository
     */
    public function __construct(ImageUploader $uploader, GoodsRepository $repository)
    {
        $this->uploader = $uploader;
        $this->repository = $repository;
    }


    /**
     * Redirect not found.
     *
     * @return Response
     */
    protected function redirectNotFound()
    {
        return redirect('admin/goods')
            ->with(\Flash::error('Товар не найден!'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $goods = $this->repository->allOrSearch(Input::get('q'));
        $no = $goods->firstItem();
        return view('admin.goods.index', compact('goods', 'no'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $categories = Category::all()->lists("slug", 'id');
        return view('admin.goods.create', compact('categories'));
    }

    /**
     * @param Create $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */

    public function store(Create $request)
    {
        $data = $request->all();

        unset($data['image']);

        $data['user_id'] = \Auth::id();

        $data['slug'] = Str::slug($data['title']);

        $category = $request->get('category_id');

        $data['category_id'] = $category;

        $this->repository->create($data);

        if (Input::hasFile('image')) {
            // upload image
            $images = Input::file('image');

            foreach($images as $image){

                $this->uploader->upload($image)->save('images/goods');

                $good = $this->repository->getmodel()->findBySlug($data['slug']);

                $picture = Picture::create(['path' => $this->uploader->getFilename()]);

                $good->picture()->attach($picture);

            }

        }

        return redirect('admin/goods');
    }

    /**
     * Display the specified article.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        try {
            $good = $this->repository->getmodel()->findBySlugOrId($id);;
            return view('admin.goods.show', compact('good'));
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * @param $id
     * @return Response|\Illuminate\View\View
     */
    public function edit($id)
    {
        try {
            $good = $this->repository->getmodel()->findBySlugOrId($id);

            $categories = Category::all()->lists("slug", 'id');

            $pictures = array();

            if ($good->picture()) {


                foreach ($good->picture()->get() as $key => $picture) {

                    $pictures[$key] = $picture;

                }

            }

            return view('admin.goods.edit', compact('good', 'categories', 'pictures'));

        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }
    /**
     * Update the specified article in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update(Update $request, $id)
    {
        try {

            $good = $this->repository->getmodel()->findBySlugOrId($id);

            $data = $request->all();

            unset($data['image']);

            unset($data['type']);

            $data['user_id'] = \Auth::id();

            $data['slug'] = Str::slug($data['title']);

            if (\Input::hasFile('image')) {
                // upload image
                $images = \Input::file('image');

                $paths = array();

                foreach ($good->picture()->get() as $pictures) {

                    $this->repository->getmodel()->deleteImage($pictures->path);

                }
                $good->picture()->detach();

                $good->update($data);

                foreach($images as $key => $image){

                    $this->uploader->upload($image)->save('images/goods');

                    $good = $this->repository->getmodel()->indBySlug($data['slug']);

                    $picture = Picture::create(['path' => $this->uploader->getFilename()]);

                    $good->picture()->attach($picture);

                }


            }
            $good->update($data);


            return redirect('admin/goods');

        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }
    /**
     * Remove the specified article from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        try {
            $this->repository->delete($id);
            return redirect('admin/goods');
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }


}
