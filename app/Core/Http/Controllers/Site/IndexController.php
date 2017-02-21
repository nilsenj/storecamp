<?php

namespace App\Core\Http\Controllers\Site;

use Illuminate\Http\Request;

/**
 * Class IndexsController
 * @package App\Http\Controllers
 */
class IndexController extends BaseController
{
    public $viewPathBase = "site.home.";
    public $errorRedirectPath = "site::";
    public function __construct()
    {
    }

    public function home(Request $request)
    {
        return $this->view('home');
    }
}
