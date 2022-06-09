<?php

namespace Modules\XisfoPay\Http\Controllers\Admin\ChaseTransfers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\XisfoPay\Entities\ChaseTransfers\Requests\CreateChaseTransferRequest;
use Modules\XisfoPay\Entities\ChaseTransfers\Requests\UpdateChaseTransferRequest;
use Modules\XisfoPay\Entities\ChaseTransfers\UseCases\Interfaces\ChaseTransferUseCaseInterface;

class ChaseTransfersController extends Controller
{
    private $chaseTransferServiceInterface;

    public function __construct(
        ChaseTransferUseCaseInterface $chaseTransferUseCaseInterface
    ) {
        $this->middleware(['permission:chase_transfers, guard:employee']);
        $this->chaseTransferServiceInterface = $chaseTransferUseCaseInterface;
    }

    public function index(Request $request)
    {
        $response = $this->chaseTransferServiceInterface->listChaseTransfers(['search' => $request->input()]);

        if ($response['search']) {
            $request->session()->flash('message', config('messaging.searching'));
        }

        return view('xisfopay::admin.chase-transfers.list', $response['data']);
    }

    public function create()
    {
        return view('xisfopay::admin.chase-transfers.create', $this->chaseTransferServiceInterface->createChaseTransfer());
    }

    public function store(CreateChaseTransferRequest $request)
    {
        $this->chaseTransferServiceInterface->storeChaseTransfer($request->except('_token', '_method'));

        return redirect()->route('admin.chase-transfers.index')
            ->with('message', config('messaging.create'));
    }

    public function show($id)
    {
        $response =  $this->chaseTransferServiceInterface->showChaseTransfer($id);


        return view('xisfopay::admin.chase-transfers.show', $response);
    }

    public function update(UpdateChaseTransferRequest $request, int $id)
    {
        $this->chaseTransferServiceInterface->updateChaseTransfer($request->except('_token', '_method'), $id);
        return back()->with('message', config('messaging.update'));
    }

    public function destroy(int $id)
    {
        $this->chaseTransferServiceInterface->destroyChaseTransfer($id);

        return redirect()->route('admin.chase-transfers.index')
            ->with('message', config('messaging.delete'));
    }

    public function legalizeView()
    {
        $response = $this->chaseTransferServiceInterface->legalizeViewData();
        return view('xisfopay::admin.chase-transfers.legalize', $response);
    }

    public function legalize(Request $request)
    {
        $this->chaseTransferServiceInterface->legalizeChaseTransfers($request->except(['_token', '_method']));
        return back()->with('message', 'Giros legalizados exitosamenta');
    }
}
