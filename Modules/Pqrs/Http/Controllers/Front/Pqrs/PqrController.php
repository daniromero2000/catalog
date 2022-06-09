<?php

namespace Modules\Pqrs\Http\Controllers\Front\Pqrs;

use App\Http\Controllers\Controller;
use Modules\Pqrs\Entities\Pqrs\Repositories\Interfaces\PqrRepositoryInterface;
use Modules\Pqrs\Entities\Pqrs\Requests\CreatePqrRequest;
use Modules\Pqrs\Entities\Pqrs\Transformations\PqrTransformable;
use Modules\Pqrs\Entities\PqrStatuses\Repositories\Interfaces\PqrStatusRepositoryInterface;
use Modules\Generals\Entities\Cities\Repositories\Interfaces\CityRepositoryInterface;
use Modules\Pqrs\Entities\PqrsStatusesLogs\Repositories\Interfaces\PqrsStatusesLogRepositoryInterface;

class PqrController extends Controller
{
    use PqrTransformable;
    private $pqrInterface, $pqrStatusInterface, $cityInterface, $pqrsStatusesLogInterface;

    public function __construct(
        PqrRepositoryInterface $pqrRepositoryInterface,
        PqrStatusRepositoryInterface $pqrStatusRepositoryInterface,
        CityRepositoryInterface $cityRepositoryInterface,
        PqrsStatusesLogRepositoryInterface $pqrsStatusesLogRepositoryInterface
    ) {
        $this->middleware(['permission:pqrs, guard:guest']);
        $this->pqrInterface             = $pqrRepositoryInterface;
        $this->pqrStatusInterface       = $pqrStatusRepositoryInterface;
        $this->cityInterface            = $cityRepositoryInterface;
        $this->pqrsStatusesLogInterface = $pqrsStatusesLogRepositoryInterface;
    }

    public function pqr()
    {
        return view('front.pqr.pqr');
    }

    public function index()
    {
    }

    public function create()
    {
        return view('front.pqrs.create', [
            'statuses' => $this->pqrStatusInterface->listPqrStatuses(),
            'cities'   => $this->cityInterface->getAllCityNames()
        ]);
    }

    public function store(CreatePqrRequest $request)
    {
        $pqr                    = $this->pqrInterface->createPqr($request->except('_token', '_method'));
        $pqrStatusLog           = [];
        $pqrStatusLog['pqr_id'] = $pqr->id;
        $pqrStatusLog['status'] = 'Creado';
        $pqrStatusLog['user']   = $pqr->name;
        $this->pqrsStatusesLogInterface->createPqrsStatusesLog($pqrStatusLog);
        $request->session()->flash('message', 'Hemos recibido tu PQR satisfactoriamente.');

        return view('pqrs::front.pqrs.pqrtkspage', [
            'pqr' => $pqr
        ]);
    }

    public function show(int $id)
    {
    }

    public function edit()
    {
    }

    public function update()
    {
    }

    public function destroy($id)
    {
    }
}
