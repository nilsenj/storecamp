<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Input;
use Redirect;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Logout.
     *
     * @return \Response
     */
    public function logout()
    {
        \Auth::logout();
        unset($_SESSION['admin']);
        return redirect('login.index');
    }
    /**
     * Settings Page.
     *
     * @return \Response
     */
    public function settings()
    {
        if (! defined('STDIN')) {
            $stdin = fopen("php://stdin", "r");
        }
        return view('settings');
    }
    /**
     * Reinstall the application.
     *
     * @return mixed
     */
    public function reinstall()
    {
        \Artisan::call('migrate:reset');
        \Artisan::call('db:seed');
        return redirect('settings')->with(\Flash::info('Reinstalled success!'));
    }
    /**
     * Clear the application cache.
     *
     * @return mixed
     */
    public function clearCache()
    {
        \Artisan::call('cache:clear');
        return redirect('settings')->with(\Flash::info('Application cache cleared!'));
    }
}
