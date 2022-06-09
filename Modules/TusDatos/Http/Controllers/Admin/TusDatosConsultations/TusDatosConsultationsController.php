<?php

namespace Modules\TusDatos\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TusDatosConsultationsController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        return view('tusdatos::index');
    }

    public function create()
    {
        return view('tusdatos::create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return view('tusdatos::show');
    }


    public function edit($id)
    {
        return view('tusdatos::edit');
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
