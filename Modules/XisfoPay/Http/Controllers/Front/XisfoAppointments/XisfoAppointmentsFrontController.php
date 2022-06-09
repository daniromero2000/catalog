<?php

namespace Modules\XisfoPay\Http\Controllers\Front\XisfoAppointments;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class XisfoAppointmentsFrontController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        return view('xisfopay::index');
    }

    public function create()
    {
        return view('xisfopay::create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return view('xisfopay::show');
    }

    public function edit($id)
    {
        return view('xisfopay::edit');
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
