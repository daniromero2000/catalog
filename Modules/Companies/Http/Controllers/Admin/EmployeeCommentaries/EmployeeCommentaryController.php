<?php

namespace Modules\Companies\Http\Controllers\Admin\EmployeeCommentaries;

use App\Http\Controllers\Controller;
use Modules\Companies\Entities\EmployeeCommentaries\UseCases\Interfaces\EmployeeCommentaryUseCaseInterface;

class EmployeeCommentaryController extends Controller
{
    private $employeeCommentaryServiceInterface;

    public function __construct(
        EmployeeCommentaryUseCaseInterface $employeeCommentaryUseCaseInterface
    ) {
        $this->middleware(['permission:employees, guard:employee']);
        $this->employeeCommentaryServiceInterface = $employeeCommentaryUseCaseInterface;
    }

    public function store(CreateEmployeeCommentaryRequest $request)
    {
        $this->employeeCommentaryServiceInterface->storeEmployeeCommentary($request);
        return back();
    }

    public function show(int $id)
    {
        return redirect()->route('admin.dashboard')
            ->with('error', config('messaging.not_found'));
    }
}
