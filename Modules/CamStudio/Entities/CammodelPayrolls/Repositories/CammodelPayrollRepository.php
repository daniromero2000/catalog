<?php

namespace Modules\CamStudio\Entities\CammodelPayrolls\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use Modules\CamStudio\Entities\CammodelPayrolls\CammodelPayroll;
use Modules\CamStudio\Entities\CammodelPayrolls\Exceptions\CammodelPayrollNotFoundException;
use Modules\CamStudio\Entities\CammodelPayrolls\Exceptions\CreateCammodelPayrollErrorException;
use Modules\CamStudio\Entities\CammodelPayrolls\Exceptions\DeletingCammodelPayrollErrorException;
use Modules\CamStudio\Entities\CammodelPayrolls\Exceptions\UpdateCammodelPayrollErrorException;
use Modules\CamStudio\Entities\CammodelPayrolls\Repositories\Interfaces\CammodelPayrollRepositoryInterface;
use Modules\CamStudio\Mail\CammodelPayrolls\SendNewCammodelPayrollEmailNotificationToAdmin;

class CammodelPayrollRepository implements CammodelPayrollRepositoryInterface
{
    protected $model;
    private $columns = [
        'id',
        'cammodel_id',
        'usd_cammodel',
        'bonus',
        'total_usd_cammodel',
        'usd_studio',
        'total_cop_cammodel',
        'trm',
        'user_approves',
        'from',
        'to',
        'created_at'
    ];

    public function __construct(CammodelPayroll $cammodelPayroll)
    {
        $this->model = $cammodelPayroll;
    }

    public function createCammodelPayroll(array $data): CammodelPayroll
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateCammodelPayrollErrorException($e->getMessage());
        }
    }

    public function updateCammodelPayroll(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdateCammodelPayrollErrorException($e->getMessage());
        }
    }

    public function findCammodelPayrollById(int $id): CammodelPayroll
    {
        try {
            return $this->model->with(['cammodelStreamingIncomes', 'cammodel', 'cammodelFines'])
                ->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new CammodelPayrollNotFoundException($e->getMessage());
        }
    }

    public function listCammodelPayrolls($totalView): Collection
    {
        return  $this->model->orderBy('created_at', 'desc')
            ->skip($totalView)->take(10)->get($this->columns);
    }

    public function deleteCammodelPayroll(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            throw new DeletingCammodelPayrollErrorException($e->getMessage());
        }
    }

    public function searchCammodelPayroll(string $text = null, int $totalView, $from = null, $to = null): Collection
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return $this->listCammodelPayrolls($totalView);
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchCammodelPayroll($text)
                ->orderBy('created_at', 'desc')
                ->skip($totalView)->take(10)->get($this->columns);
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->orderBy('created_at', 'desc')
                ->skip($totalView)->take(10)->get($this->columns);
        }

        return $this->model->searchCammodelPayroll($text)
            ->whereBetween('created_at', [$from, $to])
            ->orderBy('created_at', 'desc')
            ->skip($totalView)
            ->take(10)->get($this->columns);
    }

    public function countCammodelPayroll(string $text = null,  $from = null, $to = null)
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return count($this->model->get(['id']));
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return count($this->model->searchCammodelPayroll($text)
                ->get(['id']));
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return count($this->model->whereBetween('created_at', [$from, $to])
                ->get(['id']));
        }

        return count($this->model->searchCammodelPayroll($text)
            ->whereBetween('created_at', [$from, $to])->get(['id']));
    }

    public function sendNewCammodelPayrollEmailNotificationToAdmin()
    {
        Mail::to(['email' => 'carlosq.syc@gmail.com'])->cc([
            'contabilidad@sycgroup.co',
            'aux.contable@sycgroup.co'
        ])->queue(new SendNewCammodelPayrollEmailNotificationToAdmin($this->findCammodelPayrollById($this->model->id)));
    }
}
