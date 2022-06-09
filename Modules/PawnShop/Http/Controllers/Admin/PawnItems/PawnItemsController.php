<?php

namespace Modules\PawnShop\Http\Controllers\Admin\PawnItems;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\PawnShop\Entities\PawnItems\Requests\CreatePawnItemRequest;
use Modules\PawnShop\Entities\PawnItems\Requests\UpdatePawnItemRequest;
use Modules\PawnShop\Entities\PawnItems\UseCases\Interfaces\PawnItemUseCaseInterface;

class PawnItemsController extends Controller
{
    private $pawmItemUseCaseInterface;

    public function __construct(
        PawnItemUseCaseInterface $pawnItemUseCaseInterface
    ) {
        $this->middleware(['permission:pawn_items, guard:employee']);
        $this->pawnItemUseCaseInterface    = $pawnItemUseCaseInterface;
    }

    public function index(Request $request)
    {
        $response = $this->pawnItemUseCaseInterface->listPawnItems(['search' => $request->input()]);

        if ($response['search']) {
            $request->session()->flash('message', 'Resultado de la busqueda');
        }

        return view('pawnshop::admin.pawn-items.list', $response['data']);
    }

    public function create()
    {
        return view('pawnshop::admin.pawn-items.create', $this->pawnItemUseCaseInterface->createPawnItem());
    }

    public function store(CreatePawnItemRequest $request)
    {
        $this->pawnItemUseCaseInterface->storePawnItem($request->except('_token', '_method'));

        return redirect()->route('admin.pawn-items.index')
            ->with('message', config('messaging.create'));
    }

    public function show(int $id)
    {
        return redirect()->route('admin.pawn-items.index')
            ->with('error', config('messaging.not_found'));
    }

    public function update(UpdatePawnItemRequest $request, int $id)
    {
        $this->pawnItemUseCaseInterface->updatePawmItem($request->except('_token', '_method'), $id);

        return redirect()->route('admin.pawn-items.index')
            ->with('message', config('messaging.update'));
    }

    public function destroy(int $id)
    {
        $this->pawnItemUseCaseInterface->destroyPawnItem($id);

        return redirect()->route('admin.pawn-items.index')
            ->with('message', config('messaging.delete'));
    }
}
