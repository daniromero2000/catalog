<?php

namespace Modules\Ecommerce\Http\Controllers\Admin\OrderStatusesLogs;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class OrderStatusesLogController extends Controller
{

    public function index()
    {
        return view('pqrs::index');
    }


    public function create()
    {
        return view('pqrs::create');
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        return view('pqrs::show');
    }


    public function edit($id)
    {
        return view('pqrs::edit');
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
