<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

abstract class BaseController extends Controller
{
    public $viewPathBase = "admin.";
    public $errorRedirectPath = "admin";

    /**
     * @param $view
     * @param array $data
     * @param array $mergeData
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function view($view, $data = [], $mergeData = [])
    {
        return view($this->viewPathBase . $view, $data, $mergeData);
    }

    /**
     * Redirect not found.
     *
     * @return Response
     */
    protected function redirectNotFound()
    {
        return redirect($this->errorRedirectPath)
            ->with(\Flash::error('Item Not Found!'));
    }

}
