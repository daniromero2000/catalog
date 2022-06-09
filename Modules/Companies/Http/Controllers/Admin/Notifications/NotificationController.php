<?php

namespace Modules\Companies\Http\Controllers\Admin\Notifications;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Companies\Entities\Notifications\Notification;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\Companies\Entities\Notifications\Repositories\NotificationRepository;
use Modules\Companies\Entities\Notifications\Repositories\Interfaces\NotificationRepositoryInterface;

use function GuzzleHttp\json_decode;

class NotificationController extends Controller
{
    private $notificationInterface;
    private $permissionInterface;

    public function __construct(
        NotificationRepositoryInterface $notificationRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface
    ) {
        // $this->middleware(['permission:notifications, guard:employee']);
        $this->toolsInterface           = $toolRepositoryInterface;
        $this->notificationInterface    = $notificationRepositoryInterface;
    }

    public function index(Request $request)
    {
        //
    }

    public function list(Request $request)
    {
        $data = $this->notificationInterface->listNotifications(auth()->guard('employee')->user()->id);

        $list = $data->map(function (Notification $item) {
            $item->data = json_decode($item->data, TRUE);
            return $item;
        })->all();

        return $list;
    }

    public function store(Request $request)
    {
        $data = array();
        $data['data'] = json_encode($request->input());
        $notification = $this->notificationInterface->createNotification($data);
        $notification->data = json_decode($notification->data, TRUE);
        return $notification;
    }

    public function show(int $id)
    {
        return redirect()->route('admin.dashboard')
            ->with('error', config('messaging.not_found'));
    }

    public function destroy(Request $request, $id)
    {
        return $this->notificationInterface->deleteNotificationById($id);
    }
}
