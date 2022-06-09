<?php

namespace Modules\XisfoPay\Http\Controllers\Admin\ChaseTransferTrms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Banking\Entities\Banks\Repositories\Interfaces\BankRepositoryInterface;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\XisfoPay\Entities\ChaseTransferTrms\Exceptions\DeletingChaseTransferTrmErrorException;
use Modules\XisfoPay\Entities\ChaseTransferTrms\Exceptions\CreateChaseTransferTrmErrorException;
use Modules\XisfoPay\Entities\ChaseTransferTrms\Exceptions\ChaseTransferTrmNotFoundException;
use Modules\XisfoPay\Entities\ChaseTransferTrms\Repositories\Interfaces\ChaseTransferTrmRepositoryInterface;
use Modules\XisfoPay\Entities\ChaseTransferTrms\Requests\CreateChaseTransferTrmRequest;
use Modules\XisfoPay\Entities\ChaseTransferTrms\Requests\UpdateChaseTransferTrmRequest;
use Modules\XisfoPay\Entities\ChaseTransferTrms\UseCases\Interfaces\ChaseTransferTrmUseCaseInterface;

class ChaseTransferTrmsController extends Controller
{
    private $toolsInterface, $chaseTransferTrmInterface, $bankInterface;
    private $chaseTransferTrmServiceInterface;

    public function __construct(
        ChaseTransferTrmRepositoryInterface $chaseTransferTrmRepositoryInterface,
        ChaseTransferTrmUseCaseInterface $chaseTransferTrmUseCaseInterface,
        ToolRepositoryInterface $toolRepositoryInterface,
        BankRepositoryInterface $bankRepositoryInterface
    ) {
        $this->middleware(['permission:chase_transfer_trms, guard:employee']);
        $this->toolsInterface                   = $toolRepositoryInterface;
        $this->chaseTransferTrmInterface        = $chaseTransferTrmRepositoryInterface;
        $this->chaseTransferTrmServiceInterface = $chaseTransferTrmUseCaseInterface;
        $this->bankInterface                    = $bankRepositoryInterface;
        $this->module                           = 'TRMS';
    }

    public function index(Request $request)
    {
        $response = $this->chaseTransferTrmServiceInterface->listChaseTransferTrms(['search' => $request->input()]);

        return view('xisfopay::admin.chase-transfer-trms.list', $response['data']);
    }

    public function create()
    {
        return view('xisfopay::admin.chase-transfer-trms.create', $this->chaseTransferTrmServiceInterface->createChaseTransferTrm());
    }

    public function store(CreateChaseTransferTrmRequest $request)
    {
        $this->chaseTransferTrmServiceInterface->storeChaseTransferTrm($request->except(['_token', '_method']));

        return redirect()->route('admin.chase-transfer-trms.index')
            ->with('message', config('messaging.create'));
    }

    public function show(int $id)
    {
        return redirect()->route('admin.chase-transfer-trms.index')
            ->with('error', config('messaging.not_found'));
    }

    public function update(UpdateChaseTransferTrmRequest $request, $id)
    {
        $this->chaseTransferTrmServiceInterface->updateChaseTransferTrm($request->except(['_token', '_method']), $id);

        return redirect()->route('admin.chase-transfer-trms.index')
            ->with('message', config('messaging.update'));
    }

    public function destroy($id)
    {
        $this->chaseTransferTrmServiceInterface->destroyChaseTransferTrm($id);

        return redirect()->route('admin.chase-transfer-trms.index')
            ->with('message', config('messaging.delete'));
    }
}
