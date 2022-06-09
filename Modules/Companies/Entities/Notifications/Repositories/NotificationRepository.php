<?php

namespace Modules\Companies\Entities\Notifications\Repositories;

use Modules\Companies\Entities\Notifications\Repositories\Interfaces\NotificationRepositoryInterface;
use Modules\Companies\Entities\Notifications\Notification;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;

class NotificationRepository implements NotificationRepositoryInterface
{
    protected $model;
    private $columns = ['id', 'data', 'type', 'employee_id', 'created_at'];

    public function __construct(Notification $role)
    {
        $this->model = $role;
    }

    public function listNotifications($id): Collection
    {
        return  $this->model->where('type', 0)
            ->orWhere('employee_id', $id)
            ->orderBy('created_at', 'desc')
            ->get($this->columns);
    }

    public function createNotification(array $data): Notification
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function findNotificationById(int $id): Notification
    {
        try {
            return $this->model->findOrFail($id, $this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function deleteNotificationById($id): bool
    {
        try {
            $data = $this->findNotificationById($id);
            return $data->delete();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
