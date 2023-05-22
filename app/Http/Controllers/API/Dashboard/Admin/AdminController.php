<?php

namespace App\Http\Controllers\Api\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Dashboard\Admin\AdminRequest;
use App\Http\Requests\General\FilterRequest;
use App\Services\Admin\AdminService\AdminService;

class AdminController extends Controller
{
    private $_admin_service;
    public function __construct(AdminService $admin_service)
    {
        $this->_admin_service = $admin_service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FilterRequest $request)
    {
        return $this->_admin_service->getAllWithPagination($request);
    }

    public function getWithoutPagination()
    {
        return $this->_admin_service->getAllWithoutPagination();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($request)
    {
        return $this->_admin_service->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->_admin_service->show($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($request, $id)
    {
        return $this->_admin_service->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->_admin_service->destroy($id);
    }
}
