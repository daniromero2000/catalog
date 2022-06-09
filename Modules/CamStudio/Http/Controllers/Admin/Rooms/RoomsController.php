<?php

namespace Modules\CamStudio\Http\Controllers\Admin\Rooms;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CamStudio\Entities\Rooms\Requests\CreateRoomRequest;
use Modules\CamStudio\Entities\Rooms\Requests\UpdateRoomRequest;
use Modules\CamStudio\Entities\Rooms\UseCases\Interfaces\RoomUseCaseInterface;

class RoomsController extends Controller
{
    private $roomServiceInterface;

    public function __construct(
        RoomUseCaseInterface $roomUseCaseInterface
    ) {
        $this->middleware(['permission:rooms, guard:employee']);
        $this->roomServiceInterface = $roomUseCaseInterface;
    }

    public function index(Request $request): View
    {
        $response = $this->roomServiceInterface->listRooms(['search' => $request->input()]);

        if ($response['search']) {
            $request->session()->flash('message', config('messaging.searching'));
        }

        return view('camstudio::admin.rooms.list', $response['data']);
    }

    public function create(): View
    {
        return view('camstudio::admin.rooms.create', $this->roomServiceInterface->createRoom());
    }

    public function store(CreateRoomRequest $request)
    {
        $this->roomServiceInterface->storeRoom($request->except('_token', '_method'));

        return redirect()->route('admin.rooms.index')
            ->with('message', config('messaging.create'));
    }

    public function show(int $id)
    {
        return redirect()->route('admin.rooms.index')
            ->with('error', config('messaging.not_found'));
    }

    public function update(UpdateRoomRequest $request, $id)
    {
        $this->roomServiceInterface->updateRoom($request, $id);
        return back()->with('message', config('messaging.update'));
    }

    public function destroy(int $id)
    {
        $this->roomServiceInterface->destroyRoom($id);
        return back()->with('message', config('messaging.delete'));
    }
}
