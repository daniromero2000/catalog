<?php

namespace App\Http\Controllers;

use App\EmployeePositions;
use Illuminate\Http\Request;

class EmployeePositionsController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(int $id)
    {
        return redirect()->route('admin.dashboard')
            ->with('error', config('messaging.not_found'));
    }

    public function edit(EmployeePositions $employeePositions)
    {
        //
    }

    public function update(Request $request, EmployeePositions $employeePositions)
    {
        //
    }

    public function destroy(EmployeePositions $employeePositions)
    {
        //
    }
}
