<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

    /**
     * @param $search
     * @return null
     */
    protected function parserSearchValue($search)
    {

        if (stripos($search, ';') || stripos($search, ':')) {
            $values = explode(';', $search);
            foreach ($values as $value) {
                $s = explode(':', $value);
                if (count($s) == 1) {
                    return $s[0];
                }
            }

            return null;
        }

        return '%'.trim($search).'%';
    }

}
