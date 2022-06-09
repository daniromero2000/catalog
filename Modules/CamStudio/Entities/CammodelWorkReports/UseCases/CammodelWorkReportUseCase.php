<?php

namespace Modules\CamStudio\Entities\CammodelWorkReports\UseCases;

use Modules\CamStudio\Entities\Cammodels\Repositories\Interfaces\CammodelRepositoryInterface;
use Modules\CamStudio\Entities\CammodelWorkReports\CammodelWorkReport;
use Modules\CamStudio\Entities\CammodelWorkReports\Repositories\CammodelWorkReportRepository;
use Modules\CamStudio\Entities\CammodelWorkReports\Repositories\Interfaces\CammodelWorkReportRepositoryInterface;
use Modules\CamStudio\Entities\CammodelWorkReports\UseCases\Interfaces\CammodelWorkReportUseCaseInterface;
use Modules\CamStudio\Entities\Rooms\Repositories\Interfaces\RoomRepositoryInterface;
use Modules\Companies\Entities\Shifts\Repositories\Interfaces\ShiftRepositoryInterface;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;

class CammodelWorkReportUseCase implements CammodelWorkReportUseCaseInterface
{
    private $cammodelWorkReportInterface, $toolsInterface, $module;
    private $cammodelInterface, $roomInterface, $shiftInterface;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        CammodelWorkReportRepositoryInterface $cammodelWorkReportRepositoryInterface,
        CammodelRepositoryInterface $cammodelRepositoryInterface,
        RoomRepositoryInterface $roomRepositoryInterface,
        ShiftRepositoryInterface $shiftRepositoryInterface
    ) {
        $this->toolsInterface              = $toolRepositoryInterface;
        $this->cammodelWorkReportInterface = $cammodelWorkReportRepositoryInterface;
        $this->cammodelInterface           = $cammodelRepositoryInterface;
        $this->roomInterface               = $roomRepositoryInterface;
        $this->shiftInterface              = $shiftRepositoryInterface;
        $this->module                      = 'Registro Turno Modelo';
    }

    public function listCammodelWorkReports(array $data): array
    {
        $searchData = $this->toolsInterface->setSearchParametersRefactor($data);
        $searchData['q']        = $searchData['q']  == '' ? null : $searchData['q'];
        $searchData['comments'] = array_key_exists('comments', $data['search']) && $data['search']['comments'] == "1" ?
            $data['search']['comments'] :
            null;

        if (auth()->guard('employee')->user()->hasRole('operative_leader|superadmin|operative_leader_aux|night_shift_admin')) {
            $list = $this->cammodelWorkReportInterface->searchCammodelWorkReport(
                $searchData['q'],
                $searchData['fromOrigin'],
                $searchData['toOrigin'],
                $searchData['comments']
            );
        } else {
            $list = $this->cammodelWorkReportInterface->searchCammodelWorkReport(
                $searchData['q'],
                $searchData['fromOrigin'],
                $searchData['toOrigin'],
                $searchData['comments'],
                auth()->guard('employee')->user()->subsidiary_id
            );
        }

        return [
            'data' => [
                'cammodelWorkReports'   => $list,
                'cammodels'             => $this->cammodelInterface->getAllCammodelNames(),
                'rooms'                 => $this->roomInterface->getAllRoomNames(),
                'shifts'                => $this->shiftInterface->getAllShiftNames(),
                'optionsRoutes'         => config('generals.optionRoutes'),
                'module'                => $this->module,
                'headers'               => ['id', 'Modelo', 'Room', 'Turno', 'Manager', 'Hora Entrada', 'Hora Conexión', 'Hora Desconexión', 'Fecha', 'Acciones']
            ],
            'search' => $searchData['search']
        ];
    }

    public function createCammodelWorkReport(): array
    {
        $not_available_rooms     = $this->getAllNotAvailableRoomsIds();
        $not_available_cammodels = $this->getAllNotAvailableCammodelsIds();
        $rooms                   = $this->roomInterface->getAllRoomNames()->whereNotIn('id', $not_available_rooms);
        $cammodels               = $this->cammodelInterface->getAllCammodelNames()->whereNotIn('id', $not_available_cammodels);

        if (auth()->guard('employee')->user()->hasRole('studio_admin|subsidiary_supervisor') || auth()->guard('employee')->user()->hasRole('studio_manager')) {
            $rooms = $rooms->where('subsidiary_id', auth()->guard('employee')->user()->subsidiary_id);
            foreach ($cammodels as $key => $cammodel) {
                if ($cammodel->employee->subsidiary_id != auth()->guard('employee')->user()->subsidiary_id) {
                    $cammodels->forget($key);
                }
            }
        }

        return  [
            'cammodels'     => $cammodels,
            'rooms'         => $rooms,
            'shifts'        => $this->shiftInterface->getAllShiftNames(),
            'module'        => $this->module,
            'optionsRoutes' => config('generals.optionRoutes')
        ];
    }

    public function storeCammodelWorkReport(array $requestData): CammodelWorkReport
    {
        $cammodel = $this->cammodelInterface->findCammodelById($requestData['cammodel_id']);
        $requestData['cammodel_shift_id'] = $cammodel->shift_id;
        $requestData['manager_id'] = auth()->guard('employee')->user()->id;
        $requestData['subsidiary_id'] = $cammodel->employee->subsidiary_id;

        return $this->cammodelWorkReportInterface->createCammodelWorkReport($requestData);
    }

    public function updateCammodelWorkReport(array $requestData, int $CammodelWorkReportId)
    {
        $workReport = $this->getCammodelWorkReport($CammodelWorkReportId);
        $update     = new CammodelWorkReportRepository($workReport);
        $update->updateCammodelWorkReport($requestData);
        return $workReport;
    }

    public function destroyCammodelWorkReport(int $CammodelWorkReportId)
    {
        $update = new CammodelWorkReportRepository($this->verifyDestroy($CammodelWorkReportId));
        $update->deleteCammodelWorkReport();
    }

    private function verifyDestroy(int $CammodelWorkReportId)
    {
        $workReport = $this->getCammodelWorkReport($CammodelWorkReportId);
        if ($workReport->connection_time == null) {
            return $workReport;
        } else {
            return false;
        }
    }

    private function getCammodelWorkReport(int $CammodelWorkReportId): CammodelWorkReport
    {
        return $this->cammodelWorkReportInterface->findCammodelWorkReportById($CammodelWorkReportId);
    }

    public function getAllNotAvailableCammodelsIds(): array
    {
        $idsCollection = $this->cammodelWorkReportInterface->getNotAvailableCammodelsIds();
        $ids_array     = [];
        foreach ($idsCollection as $value) {
            array_push($ids_array, $value->cammodel_id);
        }

        return $ids_array;
    }

    public function getAllNotAvailableRoomsIds(): array
    {
        $idsCollection = $this->cammodelWorkReportInterface->getAllNotAvailableRoomsIds();
        $ids_array     = [];
        foreach ($idsCollection as $value) {
            array_push($ids_array, $value->room_id);
        }

        return $ids_array;
    }
}
