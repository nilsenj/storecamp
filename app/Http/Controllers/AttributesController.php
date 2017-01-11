<?php

namespace App\Http\Controllers;

use App\Core\Repositories\AttributeGroupDescriptionRepository;
use App\Core\Repositories\AttributeGroupRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class AttributesController extends BaseController
{
    /**
     * @var string
     */
    public $viewPathBase = "admin.attributes.";
    /**
     * @var string
     */
    public $errorRedirectPath = "admin/attributes";

    protected $groupRepository;
    protected $groupDescriptionRepository;

    function __construct(AttributeGroupRepository $groupRepository, AttributeGroupDescriptionRepository $groupDescriptionRepository)
    {
        $this->groupRepository = $groupRepository;
        $this->groupDescriptionRepository = $groupDescriptionRepository;
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $groupDescriptions = $this->groupDescriptionRepository->with('attributesGroup')->paginate();

        $no = $groupDescriptions->firstItem();

        return $this->view('index', compact('groupDescriptions', 'no'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $groupDescriptions = $this->groupDescriptionRepository->all()->pluck('name', 'id');
        return $this->view('create', compact('groupDescriptions'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $groupDescriptionRepository = $this->groupDescriptionRepository->getModel()->withTrashed()->where("name", $data["name"]);
        if($groupDescriptionRepository->count() > 0) {
            $groupDescriptionRepository->restore();
            return redirect('admin/attributes');
        }
        $groupDescriptionRepository = $this->groupDescriptionRepository->create($data);
        return redirect('admin/attributes');

    }

    /**
     * @param $id
     * @return Response|\Illuminate\View\View
     */
    public function show($id)
    {
        try {
            $groupDescriptions = $this->groupDescriptionRepository->find($id);
            return $this->view('show', compact('groupDescriptions'));
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
            $groupDescription = $this->groupDescriptionRepository->with("attributesGroup")->find($id);


            return $this->view('edit', compact('groupDescription'));
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return Response|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        try {
            $data = $request->all();

            $groupDescriptions = $this->groupDescriptionRepository->find($id);

            $groupDescriptions->update($data);

            return redirect('admin/users');
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * @param $id
     * @return Response|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $this->groupDescriptionRepository->delete($id);
            return redirect('admin/users');
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * get groups name in json format
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getJson(Request $request) {
        $query = $this->parserSearchValue($request->get('search'));
        $attrGroup = $this->groupDescriptionRepository->getModel()->where("name", "like", $query)->select('name', 'id')->get();
        $attrGroupArr = [];
        foreach ($attrGroup as $key => $attrGroupItem) {
            $attrGroupArr[$key]['text'] = $attrGroupItem['name'];
            $attrGroupArr[$key]['id'] = $attrGroupItem['id'];
        }
        return \Response::json($attrGroupArr);
    }
}
