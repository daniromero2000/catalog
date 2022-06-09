<?php

namespace Modules\PawnShop\Http\Controllers\Admin\PawnItemCategories;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\PawnShop\Entities\PawnItemCategories\Requests\CreatePawnItemCategoryRequest;
use Modules\PawnShop\Entities\PawnItemCategories\Requests\UpdatePawnItemCategoryRequest;
use Modules\PawnShop\Entities\PawnItemCategories\UseCases\Interfaces\PawnItemCategoryUseCaseInterface;

class PawnItemCategoriesController extends Controller
{
    private $pawnItemCategoryServiceInterface;

    public function __construct(
        PawnItemCategoryUseCaseInterface $pawnItemCategoryUseCaseInterface
    ) {
        //$this->middleware(['permission:fasecolda_price_rates, guard:employee']);
        $this->pawnItemCategoryServiceInterface = $pawnItemCategoryUseCaseInterface;
    }

    public function index(Request $request)
    {
        $response = $this->pawnItemCategoryServiceInterface->listPawnItemCategories(['search' => $request->input()]);

        if ($response['search']) {
            $request->session()->flash('message', config('messaging.searching'));
        }

        return view('pawnshop::admin.pawn-item-categories.list', $response['data']);
    }

    public function create()
    {
        return view('pawnshop::admin.pawn-item-categories.create', $this->pawnItemCategoryServiceInterface->createPawnItemCategory());
    }

    public function store(CreatePawnItemCategoryRequest $request)
    {
        $this->pawnItemCategoryServiceInterface->storePawnItemCategory($request->except('_token', '_method'));

        return redirect()->route('admin.pawn-item-categories.index')
            ->with('message', config('messaging.create'));
    }

    public function update(UpdatePawnItemCategoryRequest $request, $id)
    {
        $this->pawnItemCategoryServiceInterface->updatePawnItemCategory($request, $id);

        return redirect()->route('admin.pawn-item-categories.index')
            ->with('message', config('messaging.update'));
    }

    public function destroy(int $id)
    {
        $this->pawnItemCategoryServiceInterface->destroyPawnItemCategory($id);

        return redirect()->route('admin.pawn-item-categories.index')
            ->with('message', config('messaging.delete'));
    }
}
