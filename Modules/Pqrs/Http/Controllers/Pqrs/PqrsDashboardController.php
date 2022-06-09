<?php

namespace Modules\Pqrs\Http\Controllers\Pqrs;

use App\Http\Controllers\Controller;
use Modules\Pqrs\Entities\Pqrs\Pqr;
use Modules\Pqrs\Entities\Pqrs\Repositories\Interfaces\PqrRepositoryInterface;
use Modules\Pqrs\Entities\Pqrs\Transformations\PqrTransformable;


class PqrsDashboardController extends Controller
{
    use PqrTransformable;
    private $pqrRepositoryInterface;

    public function __construct(
        PqrRepositoryInterface $pqrRepositoryInterface
    ) {
        $this->pqrRepositoryInterface = $pqrRepositoryInterface;
    }

    public function index()
    {
        // CRM PQRS
        $listLead                 = Pqr::where('pqr_status_id', 3)->get();
        $listTramite              = Pqr::where('pqr_status_id', 2)->get();
        $listAtendido             = pqr::where('pqr_status_id', 1)->get();
        $listTramitePendienteInfo = pqr::where('pqr_status_id', 4)->get();

        return view('pqrs::pqrsdashboard', [
            'pqrGlobalCount'           => pqr::count(),
            'user'                     => auth()->guard('employee')->user(),
            'pqrLeads'                 => $listLead,
            'pqrTramites'              => $listTramite,
            'pqrAtendidos'             => $listAtendido,
            'pqrTramitePendienteInfos' => $listTramitePendienteInfo,
            'listLeadCount'            => $listLead->count(),
            'listTramiteCount'         => $listTramite->count(),
            'listAtendidoCount'        => $listAtendido->count(),
            'listTramitePendienteInfo' => $listTramitePendienteInfo->count(),
            'headers'       => ['Código', 'Pqrs', 'Usuario', 'Teléfono']
        ]);
    }

    public function create()
    {
    }

    public function store(CreatePqrRequest $request)
    {
    }

    public function show()
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
