<?php

namespace Modules\Companies\Http\Controllers\Admin\Shifts;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Companies\Entities\Shifts\Requests\CreateShiftRequest;
use Modules\Companies\Entities\Shifts\Requests\UpdateShiftRequest;
use Modules\Companies\Entities\Shifts\UseCases\Interfaces\ShiftUseCaseInterface;

class ShiftsController extends Controller
{
    private $shiftServiceInterface;

    public function __construct(
        ShiftUseCaseInterface $shiftUseCaseInterface
    ) {
        $this->middleware(['permission:shifts, guard:employee']);
        $this->shiftServiceInterface = $shiftUseCaseInterface;
    }

    public function index(Request $request)
    {
        $response = $this->shiftServiceInterface->listShifts(['search' => $request->input()]);

        if ($response['search']) {
            $request->session()->flash('message', config('messaging.searching'));
        }

        return view('companies::admin.shifts.list', $response['data']);
    }

    public function create()
    {
        return view('companies::admin.shifts.create', $this->shiftServiceInterface->createShift());
    }

    public function store(CreateShiftRequest $request)
    {
        $this->shiftServiceInterface->storeShift($request->except('_token', '_method'));

        return redirect()->route('admin.shifts.index')
            ->with('message', config('messaging.create'));
    }

    public function show(int $id)
    {
        return redirect()->route('admin.shifts.index')
            ->with('error', config('messaging.not_found'));
    }

    public function update(UpdateShiftRequest $request, $id)
    {
        $this->shiftServiceInterface->updateShift($request, $id);
        return back()->with('message', config('messaging.update'));
    }

    public function destroy(int $id)
    {
        $this->shiftServiceInterface->destroyShift($id);
        return back()->with('message', config('messaging.delete'));
    }
}
