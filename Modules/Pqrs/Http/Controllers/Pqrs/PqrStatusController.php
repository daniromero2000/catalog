<?php

namespace Modules\Pqrs\Http\Controllers\Pqrs;


use Modules\Pqrs\Entities\PqrStatuses\Repositories\Interfaces\PqrStatusRepositoryInterface;
use Modules\Pqrs\Entities\PqrStatuses\Repositories\PqrStatusRepository;
use Modules\Pqrs\Entities\PqrStatuses\Requests\CreatePqrStatusRequest;
use Modules\Pqrs\Entities\PqrStatuses\Requests\UpdatePqrStatusRequest;
use App\Http\Controllers\Controller;

class PqrStatusController extends Controller
{
    private $pqrStatusInterface;

    public function __construct(
        PqrStatusRepositoryInterface $pqrStatusRepositoryInterface
    ) {
        $this->middleware(['permission:pqrs, guard:employee']);
        $this->pqrStatusInterface = $pqrStatusRepositoryInterface;
    }

    public function index()
    {
        return view('pqrs::pqr-statuses.list', [
            'pqrStatuses' => $this->pqrStatusInterface->listPqrStatuses(),
            'user'        => auth()->guard('employee')->user(),
            'module'             => 'Estados Pqrs',
            'optionsRoutes' =>  config('generals.optionRoutes'),
            'headers'       => ['ID', 'Nombre', 'Color', 'Opciones']
        ]);
    }

    public function create()
    {
        return view('pqrs::pqr-statuses.create');
    }

    public function store(CreatePqrStatusRequest $request)
    {
        $this->pqrStatusInterface->createPqrStatus($request->except('_token', '_method'));
        $request->session()->flash('message', 'Creación Exitosa');
        return redirect()->route('admin.pqr-statuses.list');
    }

    public function edit(int $id)
    {
        return view('pqrs::pqr-statuses.edit', [
            'pqrStatus' => $this->pqrStatusInterface->findPqrStatusById($id)
        ]);
    }

    public function update(UpdatePqrStatusRequest $request, int $id)
    {
        $update    = new PqrStatusRepository($this->pqrStatusInterface->findPqrStatusById($id));
        $update->updatePqrStatus($request->all());
        $request->session()->flash('message', 'Actualización Exitosa!');

        return redirect()->route('admin.pqr-statuses.index');
    }

    public function destroy(int $id)
    {
        $pqrStatus = new PqrStatusRepository($this->pqrStatusInterface->findPqrStatusById($id));
        $pqrStatus->deletePqrStatus();
        request()->session()->flash('message', 'Eliminado Satisfactoriamente');

        return redirect()->route('admin.pqr-statuses.index');
    }
}
