<?php

namespace Modules\PawnShop\Http\Controllers\Admin\PawnItemStatuses;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\PawnShop\Entities\PawnItems\Requests\CreatePawnItemRequest;
use Modules\PawnShop\Entities\PawnItems\Requests\UpdatePawnItemRequest;
use Modules\PawnShop\Entities\PawnItemStatuses\UseCases\Interfaces\PawnItemStatusUseCaseInterface;

class PawnItemStatusesController extends Controller
{
    private $pawnItemStatusUseCaseInterface;

    public function __construct(
        PawnItemStatusUseCaseInterface $pawnItemStatusUseCaseInterface
    ) {
        //  $this->middleware(['permission:pawn_item_statuses, guard: employee']);
        $this->pawnItemStatusUseCaseInterface = $pawnItemStatusUseCaseInterface;
    }

    public function index(Request $request)
    {
        $response = $this->pawnItemStatusUseCaseInterface->listPawnItemStatuses(['search' => $request->input()]);

        if ($response['search']) {
            $request->session()->flash('message', config('messaging.searching'));
        }

        return view('generals::layouts.admin.entity-estatuses.list', $response['data']);
    }

    public function create()
    {
        return view('generals::layouts.admin.entity-estatuses.create', $this->pawnItemStatusUseCaseInterface->createPawnItemStatus());
    }

    public function store(CreatePawnItemRequest $request)
    {
        $this->pawnItemStatusUseCaseInterface->storePawnItemStatus($request->except('_token', '_method'));

        return redirect()->route('admin.pawn-item-statuses.index')
            ->with('message', config('messaging.create'));
    }

    public function show(int $id)
    {
        return redirect()->route('admin.pawn-item-statuses.index')
            ->with('error', config('messaging.not_found'));
    }

    public function update(UpdatePawnItemRequest $request, int $id)
    {
        $this->pawnItemStatusUseCaseInterface->updatePawnItemStatus($request->except('_token', '_method'), $id);

        return redirect()->route('admin.pawn-item-statuses.index')
            ->with('message', config('messaging.update'));
    }

    public function destroy(int $id)
    {
        $this->pawnItemStatusUseCaseInterface->destroyPawnItem($id);

        return redirect()->route('admin.pawn-item-statuses.index')
            ->with('message', config('messaging.delete'));
    }
}
