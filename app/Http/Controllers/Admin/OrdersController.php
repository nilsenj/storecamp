<?php

namespace App\Http\Controllers;

use App\Core\Contracts\OrdersSystemContract;
use App\Core\Repositories\OrdersRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

/**
 * Class OrdersControllersController
 * @package App\Http\Controllers
 */
class OrdersController extends Controller {

    /**
     * @var OrdersSystemContract
     */
    private $ordersSystem;
    /**
     * @var OrdersRepository
     */
    protected $ordersRepository;

    /**
     * OrdersController constructor.
     * @param OrdersSystemContract $ordersSystem
     */
    public function __construct(OrdersSystemContract $ordersSystem)
    {
        $this->ordersSystem = $ordersSystem;
        $this->ordersRepository = $ordersSystem->ordersRepository;
    }

    /**
     * @param Request $request
     */
    public function index(Request $request)
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function show(Request $request)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Request $request, $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        //
    }
}
