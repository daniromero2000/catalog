<?php

namespace Modules\CamStudio\Http\Controllers\Admin\Fouls;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CamStudio\Entities\Fouls\Requests\CreateFoulRequest;
use Modules\CamStudio\Entities\Fouls\Requests\UpdateFoulRequest;
use Modules\CamStudio\Entities\Fouls\UseCases\Interfaces\FoulUseCaseInterface;

class FoulsController extends Controller
{
    private $foulServiceInterface;

    public function __construct(
        FoulUseCaseInterface $foulUseCaseInterface
    ) {
        $this->middleware(['permission:fouls, guard:employee']);
        $this->foulServiceInterface = $foulUseCaseInterface;
    }

    public function index(Request $request): View
    {
        $response = $this->foulServiceInterface->listFouls(['search' => $request->input()]);

        if ($response['search']) {
            $request->session()->flash('message', config('messaging.searching'));
        }

        return view('camstudio::admin.fouls.list', $response['data']);
    }

    public function create(): View
    {
        return view('camstudio::admin.fouls.create', $this->foulServiceInterface->createFoul());
    }

    public function store(CreateFoulRequest $request)
    {
        $this->foulServiceInterface->storeFoul($request->except('_token', '_method'));

        return redirect()->route('admin.fouls.index')
            ->with('message', config('messaging.create'));
    }

    public function show(int $foulId)
    {
        return redirect()->route('admin.fouls.index')
            ->with('error', config('messaging.not_found'));
    }

    public function update(UpdateFoulRequest $request, $foulId)
    {
        $this->foulServiceInterface->updateFoul($request, $foulId);
        return back()->with('message', config('messaging.update'));
    }

    public function destroy(int $foulId)
    {
        $this->foulServiceInterface->destroyFoul($foulId);
        return back()->with('message', config('messaging.delete'));
    }
}
