<?php

namespace Modules\Companies\Entities\Shifts\UseCases;

use Modules\Companies\Entities\Goals\Repositories\Interfaces\GoalRepositoryInterface;
use Modules\Companies\Entities\Shifts\Repositories\ShiftRepository;
use Modules\Companies\Entities\Shifts\Repositories\Interfaces\ShiftRepositoryInterface;
use Modules\Companies\Entities\Shifts\Shift;
use Modules\Companies\Entities\Shifts\UseCases\Interfaces\ShiftUseCaseInterface;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;

class ShiftUseCase implements ShiftUseCaseInterface
{
    private $shiftInterface, $toolsInterface, $module, $goalInterface;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        ShiftRepositoryInterface $shiftRepositoryInterface,
        GoalRepositoryInterface $goalRepositoryInterface
    ) {
        $this->toolsInterface = $toolRepositoryInterface;
        $this->shiftInterface = $shiftRepositoryInterface;
        $this->goalInterface  = $goalRepositoryInterface;
        $this->module         = 'Turnos';
    }

    public function listShifts(array $data): array
    {
        $searchData = $this->toolsInterface->setSearchParametersRefactor($data);
        $searchData['q'] = $searchData['q'] == '' ? null : $searchData['q'];

        return [
            'data' => [
                'shifts'        => $this->shiftInterface->searchShift($searchData['q']),
                'goals'         => $this->goalInterface->getAllGoalNames(),
                'optionsRoutes' => config('generals.optionRoutes'),
                'module'        => $this->module,
                'headers'       => ['Id', 'Nombre', 'Inicio', 'Fin', 'Meta en Dolares', 'Acciones'],
            ],
            'search'  =>  $searchData['search']
        ];
    }

    public function createShift(): array
    {
        return  [
            'module'        => $this->module,
            'optionsRoutes' => config('generals.optionRoutes')
        ];
    }

    public function storeShift(array $requestData): void
    {
        $this->shiftInterface->createShift($requestData);
    }

    public function updateShift($request, int $shiftId): void
    {
        $this->getShiftRepository($shiftId)->updateShift($request->except('_token', '_method'));
    }

    public function destroyShift(int $shiftId): void
    {
        $this->getShiftRepository($shiftId)->deleteShift();
    }

    private function getShiftRepository(int $shiftId): ShiftRepository
    {
        return new ShiftRepository($this->getShift($shiftId));
    }

    private function getShift(int $shiftId): Shift
    {
        return $this->shiftInterface->findShiftById($shiftId);
    }
}
