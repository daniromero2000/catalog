<?php

namespace Modules\CamStudio\Entities\Rooms\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Modules\CamStudio\Entities\Rooms\Room;
use Modules\CamStudio\Entities\Rooms\Exceptions\RoomNotFoundException;
use Modules\CamStudio\Entities\Rooms\Exceptions\CreateRoomErrorException;
use Modules\CamStudio\Entities\Rooms\Exceptions\DeletingRoomErrorException;
use Modules\CamStudio\Entities\Rooms\Exceptions\UpdateRoomErrorException;
use Modules\CamStudio\Entities\Rooms\Repositories\Interfaces\RoomRepositoryInterface;

class RoomRepository implements RoomRepositoryInterface
{
    protected $model;
    private $columns = [
        'id',
        'name',
        'subsidiary_id',
        'photo',
        'created_at'
    ];

    public function __construct(Room $Room)
    {
        $this->model = $Room;
    }

    public function createRoom(array $data): Room
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateRoomErrorException($e->getMessage());
        }
    }

    public function updateRoom(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdateRoomErrorException($e->getMessage());
        }
    }

    public function findRoomById(int $roomId): Room
    {
        try {
            return $this->model->findOrFail($roomId, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new RoomNotFoundException($e->getMessage());
        }
    }

    public function listRooms($totalView): Collection
    {
        return  $this->model->with('subsidiary')->orderBy('id')
            ->skip($totalView)->take(10)->get($this->columns);
    }

    public function deleteRoom(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            throw new DeletingRoomErrorException($e->getMessage());
        }
    }

    public function searchRoom(string $text = null, int $totalView, $from = null, $to = null): Collection
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return $this->listRooms($totalView);
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchRoom($text)->with('subsidiary')
                ->skip($totalView)->take(10)->orderBy('id')->get($this->columns);
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->with('subsidiary')->skip($totalView)->take(10)
                ->orderBy('id')->get($this->columns);
        }

        return $this->model->searchRoom($text)->whereBetween('created_at', [$from, $to])
            ->with('subsidiary')->skip($totalView)->take(10)->orderBy('id')
            ->get($this->columns);
    }

    public function countRoom(string $text = null,  $from = null, $to = null)
    {

        if (is_null($text) && is_null($from) && is_null($to)) {
            return count($this->model->get(['id']));
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return count($this->model->searchRoom($text)->get(['id']));
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return count($this->model->whereBetween('created_at', [$from, $to])->get(['id']));
        }

        return count($this->model->searchRoom($text)->whereBetween('created_at', [$from, $to])->get(['id']));
    }

    public function saveRoomPhoto(UploadedFile $file, $room): string
    {
        return $file->store('rooms/' . $room, ['disk' => 'public']);
    }

    public function getAllRoomNames(): Collection
    {
        return $this->model->with('subsidiary')->orderBy('id')
            ->get(['id', 'name', 'subsidiary_id', 'photo']);
    }
}
