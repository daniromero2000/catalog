<?php

namespace Modules\Customers\Http\Controllers\Admin\CustomerStatusesLogs;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CustomerStatusLogsController extends Controller
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

    public function show(int $id)
    {
        return redirect()->route('admin.pqrs.index')
            ->with('error', config('messaging.not_found'));
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
