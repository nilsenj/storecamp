<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MediaStoreController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:Admin');
    }

    public function index() {

    }
}
