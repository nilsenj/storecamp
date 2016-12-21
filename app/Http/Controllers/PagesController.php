<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
    /**
     * Update the settings.
     *
     * @return mixed
     */
    public function updateSettings()
    {
        $settings = \Input::all();
        foreach ($settings as $key => $value) {
            $option = str_replace('_', '.', $key);
            Option::findByKey($option)->update([
                'value' => $value
            ]);
        }
        return \Redirect::back()->withFlashMessage('Settings has been successfully updated!');
    }

    /**
     * @param $id
     * @param $slug
     */
    public function showGood($id,$slug)
    {
        try {
            $good = Product::with('user', 'category')
                ->whereId(intval($id))
                ->orWhere('slug', $slug)
                ->firstOrFail();

            return view('site.product',compact('product'));

        } catch (ModelNotFoundException $e) {

            return abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
