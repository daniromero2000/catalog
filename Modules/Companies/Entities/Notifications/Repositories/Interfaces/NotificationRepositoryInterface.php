<?php

namespace Modules\Companies\Entities\Notifications\Repositories\Interfaces;

use Modules\Companies\Entities\Notifications\Notification;
use Illuminate\Support\Collection;

interface NotificationRepositoryInterface
{
    public function listNotifications(int $totalView): Collection;
    
    public function createNotification(array $data): Notification;

    public function findNotificationById(int $id): Notification;

    public function deleteNotificationById($id): bool;

}
