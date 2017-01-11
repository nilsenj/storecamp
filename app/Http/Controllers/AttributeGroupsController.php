<?php

namespace App\Http\Controllers;

use App\Core\Repositories\AttributeGroupDescriptionRepository;
use App\Core\Repositories\AttributeGroupRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class AttributeGroupsController extends BaseController
{
    /**
     * @var string
     */
    public $viewPathBase = "admin.attribute_groups.";
    /**
     * @var string
     */
    public $errorRedirectPath = "admin/attribute_groups";

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
        $groupAttributes = $this->groupRepository->paginate();

        $no = $groupAttributes->firstItem();

        return $this->view('index', compact('groupAttributes', 'no'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $groupAttributes = $this->groupRepository->all()->pluck('name', 'id');
        return $this->view('create', compact('groupAttributes'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $groupAttribute = $this->groupRepository->getModel()->withTrashed()->where("name", $data["name"]);
        if($groupAttribute->count() > 0) {
            $groupAttribute->restore();
            return redirect('admin/attribute_groups');
        }
        $groupDescriptionRepository = $this->groupRepository->create($data);
        return redirect('admin/attribute_groups');
    }

    /**
     * @param $id
     * @return Response|\Illuminate\View\View
     */
    public function show($id)
    {
        try {
            $groupAttributes = $this->groupRepository->find($id);
            return $this->view('show', compact('groupAttributes'));
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
            $groupAttribute = $this->groupRepository->find($id);

            return $this->view('edit', compact('groupAttribute'));
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

            $groupAttribute = $this->groupRepository->getModel()->withTrashed()->where("name", $data["name"]);
            if($groupAttribute->count() > 0) {
                $groupAttribute->restore();
                return redirect('admin/attribute_groups');
            }

            $groupAttribute->update($data);

            return redirect('admin/attribute_groups');
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
            $this->groupRepository->delete($id);
            return redirect('admin/attribute_groups');
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
        $attrGroup = $this->groupRepository->getModel()->where("name", "like", $query)->select('name', 'id')->get();
        $attrGroupArr = [];
        foreach ($attrGroup as $key => $attrGroupItem) {
            $attrGroupArr[$key]['text'] = $attrGroupItem['name'];
            $attrGroupArr[$key]['id'] = $attrGroupItem['id'];
        }
        return \Response::json($attrGroupArr);
    }
}
