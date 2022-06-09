<?php

namespace Modules\Companies\Entities\Goals\UseCases;

use Carbon\Carbon;
use Modules\Companies\Entities\Goals\Repositories\GoalRepository;
use Modules\Companies\Entities\Goals\Repositories\Interfaces\GoalRepositoryInterface;
use Modules\Companies\Entities\Goals\UseCases\Interfaces\GoalUseCaseInterface;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;

class GoalUseCase implements GoalUseCaseInterface
{
    private $goalInterface, $toolsInterface, $module;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        GoalRepositoryInterface $goalRepositoryInterface
    ) {
        $this->toolsInterface = $toolRepositoryInterface;
        $this->goalInterface  = $goalRepositoryInterface;
        $this->module         = 'Metas';
    }

    public function listGoals(array $data): array
    {
        $searchData = $this->toolsInterface->setSearchParameters($data);

        if ($searchData['q'] != '' && ($searchData['fromOrigin'] == '' || $searchData['toOrigin'] == '')) {
            $list     = $this->goalInterface->searchGoal($searchData['q'], $searchData['skip'] * 10);
            $paginate = $this->goalInterface->countGoal($searchData['q'], '');
            $searchData['search'] = true;
        } elseif (($searchData['q'] != '' || $searchData['fromOrigin'] != '' || $searchData['toOrigin'] != '')) {
            $from     = $searchData['fromOrigin'] != '' ? $searchData['fromOrigin'] : Carbon::now()->subMonths(1);
            $to       = $searchData['toOrigin'] != '' ? $searchData['toOrigin'] : Carbon::now();
            $list     = $this->goalInterface->searchGoal($searchData['q'], $searchData['skip'] * 10, $from, $to);
            $paginate = $this->goalInterface->countGoal($searchData['q'], $from, $to);
            $searchData['search'] = true;
        } else {
            $paginate = $this->goalInterface->countGoal(null);
            $list     = $this->goalInterface->listGoals($searchData['skip'] * 10);
        }

        $getPaginate  = $this->toolsInterface->getPaginate($paginate, $searchData['skip']);

        return [
            'data' => [
                'goals'                 => $list,
                'optionsRoutes'         => config('generals.optionRoutes'),
                'module'                => $this->module,
                'headers'               => ['Id', 'Meta en Dólares', 'Bonificación', 'Acciones'],
                'skip'                  => $searchData['skip'],
                'paginate'              => $getPaginate['paginate'],
                'position'              => $getPaginate['position'],
                'page'                  => $getPaginate['page'],
                'limit'                 => $getPaginate['limit']
            ],
            'search'  =>  $searchData['search']
        ];
    }

    public function createGoal()
    {
        return  [
            'module'        => $this->module,
            'optionsRoutes' => config('generals.optionRoutes')
        ];
    }

    public function storeGoal(array $requestData)
    {
        $this->goalInterface->createGoal($requestData);
    }

    public function updateGoal($request, int $id)
    {
        $update = new GoalRepository($this->getGoal($id));
        $update->updateGoal($request->except('_token', '_method'));
    }

    public function destroyGoal(int $id)
    {
        $update = new GoalRepository($this->getGoal($id));
        $update->deleteGoal();
    }

    private function getGoal(int $id)
    {
        return $this->goalInterface->findGoalById($id);
    }
}
