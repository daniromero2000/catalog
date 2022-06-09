<?php

namespace Modules\CamStudio\Entities\Rooms\UseCases;

use Carbon\Carbon;
use Modules\CamStudio\Entities\Rooms\Repositories\Interfaces\RoomRepositoryInterface;
use Modules\CamStudio\Entities\Rooms\Repositories\RoomRepository;
use Modules\CamStudio\Entities\Rooms\Room;
use Modules\CamStudio\Entities\Rooms\UseCases\Interfaces\RoomUseCaseInterface;
use Modules\Companies\Entities\Subsidiaries\Repositories\Interfaces\SubsidiaryRepositoryInterface;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;

class RoomUseCase implements RoomUseCaseInterface
{
    private $roomInterface, $toolsInterface, $module, $subsidiaryInterface;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        RoomRepositoryInterface $roomRepositoryInterface,
        SubsidiaryRepositoryInterface $subsidiaryRepositoryInterface
    ) {
        $this->toolsInterface      = $toolRepositoryInterface;
        $this->roomInterface       = $roomRepositoryInterface;
        $this->subsidiaryInterface = $subsidiaryRepositoryInterface;
        $this->module              = 'Rooms';
    }

    public function listRooms(array $data): array
    {
        $searchData = $this->toolsInterface->setSearchParameters($data);

        if ($searchData['q'] != '' && ($searchData['fromOrigin'] == '' || $searchData['toOrigin'] == '')) {
            $list     = $this->roomInterface->searchRoom($searchData['q'], $searchData['skip'] * 10);
            $paginate = $this->roomInterface->countRoom($searchData['q'], '');
            $searchData['search'] = true;
        } elseif (($searchData['q'] != '' || $searchData['fromOrigin'] != '' || $searchData['toOrigin'] != '')) {
            $from     = $searchData['fromOrigin'] != '' ? $searchData['fromOrigin'] : Carbon::now()->subMonths(1);
            $to       = $searchData['toOrigin'] != '' ? $searchData['toOrigin'] : Carbon::now();
            $list     = $this->roomInterface->searchRoom($searchData['q'], $searchData['skip'] * 10, $from, $to);
            $paginate = $this->roomInterface->countRoom($searchData['q'], $from, $to);
            $searchData['search'] = true;
        } else {
            $paginate = $this->roomInterface->countRoom(null);
            $list     = $this->roomInterface->listRooms($searchData['skip'] * 10);
        }

        $getPaginate  = $this->toolsInterface->getPaginate($paginate, $searchData['skip']);

        return [
            'data' => [
                'rooms'                 => $list,
                'subsidiaries'          => $this->subsidiaryInterface->getAllSubsidiaryNames(),
                'optionsRoutes'         => config('generals.optionRoutes'),
                'module'                => $this->module,
                'headers'               => ['Id', 'Room', 'Sede', 'Foto', 'Acciones'],
                'skip'                  => $searchData['skip'],
                'paginate'              => $getPaginate['paginate'],
                'position'              => $getPaginate['position'],
                'page'                  => $getPaginate['page'],
                'limit'                 => $getPaginate['limit']
            ],
            'search'  =>  $searchData['search']
        ];
    }

    public function createRoom(): array
    {
        return  [
            'subsidiaries'  => $this->subsidiaryInterface->getAllSubsidiaryNames(),
            'module'        => $this->module,
            'optionsRoutes' => config('generals.optionRoutes')
        ];
    }

    public function storeRoom(array $requestData): Room
    {
        return $this->roomInterface->createRoom($requestData);
    }

    public function updateRoom($request, int $roomId): bool
    {
        $streaming           = $this->getRoom($roomId);
        $requestData         = $request->except('_token', '_method');
        $requestData['photo'] = $this->saveRoomFile($request, $streaming);
        $update              = new RoomRepository($streaming);
        return $update->updateRoom($requestData);
    }

    public function destroyRoom(int $roomId)
    {
        $update = new RoomRepository($this->getRoom($roomId));
        $update->deleteRoom();
    }

    public function saveRoomFile($request, $room)
    {
        if ($request->hasFile('photo')) {
            if ($room->photo != 'No icon' && $room->photo != null) {
                $this->toolsInterface->deleteThumbFromServer($room->photo);
            }
            return $this->roomInterface->saveRoomPhoto($request->file('photo'), $room->name);
        }
    }

    private function getRoom(int $roomId)
    {
        return $this->roomInterface->findRoomById($roomId);
    }
}
