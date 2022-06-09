<?php

namespace Modules\XisfoPay\Http\Controllers\Admin\XisfoSchedulers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\XisfoPay\Entities\XisfoServices\Repositories\XisfoServiceRepository;
use Modules\Companies\Entities\Employees\Repositories\Interfaces\EmployeeRepositoryInterface;
use Modules\XisfoPay\Entities\XisfoServices\Repositories\Interfaces\XisfoServiceRepositoryInterface;

class XisfoSchedulersController extends Controller
{
    private $toolsInterface, $employeeInterface;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        XisfoServiceRepositoryInterface $xisfoServiceRepositoryInterface,
        EmployeeRepositoryInterface $employeeRepositoryInterface
    ) {
        $this->middleware(['permission:contracts, guard:employee']);
        $this->toolsInterface        = $toolRepositoryInterface;
        $this->xisfoServiceInterface = $xisfoServiceRepositoryInterface;
        $this->employeeInterface     = $employeeRepositoryInterface;
    }

    public function index(Request $request)
    {
        return view('xisfopay::admin.xisfo-schedulers.list', [
            'module' => 'Agendador de Citas Xisfo',
            'services'     => $this->xisfoServiceInterface->getAllXisfoServiceNames()
        ]);
    }
    public function verifyService(Request $request)
    {
        $idService = $request->get('idservice');
        $xisfoService                = $this->xisfoServiceInterface->findXisfoServiceById($idService);
        $xisfoServiceRepo            = new XisfoServiceRepository($xisfoService);
        $attachedEmployeesArrayIds   = $xisfoServiceRepo->listEmployees()->pluck('id')->all();
        return response()->json([
            'attachedEmployeesArrayIds' => $attachedEmployeesArrayIds,
            'employees' => $this->employeeInterface->getAllEmployeesNames(),
            'xisfoService' => $xisfoService
        ]);
    }
}
