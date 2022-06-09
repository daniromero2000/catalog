<?php

namespace Modules\CamStudio\Entities\CammodelStreamingIncomes\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Modules\CamStudio\Entities\CammodelStreamingIncomes\CammodelStreamingIncome;
use Modules\CamStudio\Entities\CammodelStreamingIncomes\Exceptions\CammodelStreamingIncomeNotFoundException;
use Modules\CamStudio\Entities\CammodelStreamingIncomes\Exceptions\CreateCammodelStreamingIncomeErrorException;
use Modules\CamStudio\Entities\CammodelStreamingIncomes\Exceptions\DeletingCammodelStreamingIncomeErrorException;
use Modules\CamStudio\Entities\CammodelStreamingIncomes\Exceptions\UpdateCammodelStreamingIncomeErrorException;
use Modules\CamStudio\Entities\CammodelStreamingIncomes\Repositories\Interfaces\CammodelStreamingIncomeRepositoryInterface;

class CammodelStreamingIncomeRepository implements CammodelStreamingIncomeRepositoryInterface
{
    protected $model;
    private $columns = [
        'id',
        'cammodel_work_report_id',
        'cammodel_stream_account_id',
        'tokens',
        'dollars',
        'accumulated_tokens',
        'accumulated_dollars',
        'user_approves',
        'cammodel_payroll_id',
        'created_at'

    ];

    public function __construct(CammodelStreamingIncome $CammodelStreamingIncome)
    {
        $this->model = $CammodelStreamingIncome;
    }

    public function createCammodelStreamingIncome(array $data): CammodelStreamingIncome
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateCammodelStreamingIncomeErrorException($e->getMessage());
        }
    }

    public function updateCammodelStreamingIncome(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdateCammodelStreamingIncomeErrorException($e->getMessage());
        }
    }

    public function findCammodelStreamingIncomeById(int $CammodelStreamingIncomeId): CammodelStreamingIncome
    {
        try {
            return $this->model->findOrFail($CammodelStreamingIncomeId, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new CammodelStreamingIncomeNotFoundException($e->getMessage());
        }
    }

    public function listCammodelStreamingIncomes($totalView): Collection
    {
        return  $this->model
            ->with(['cammodelStreamAccount'])->orderBy('id', 'desc')
            ->skip($totalView)->take(10)->get($this->columns);
    }

    public function listAllCammodelStreamingIncomes(): Collection
    {
        return  $this->model->with(['cammodelStreamAccount'])
            ->orderBy('created_at', 'desc')->get($this->columns);
    }

    public function listUnapprovedCammodelStreamingIncomes(): Collection
    {
        return  $this->model->with(['cammodelStreamAccount'])
            ->where('user_approves', null)
            ->orderBy('id', 'desc')->get($this->columns);
    }

    public function deleteCammodelStreamingIncome(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            throw new DeletingCammodelStreamingIncomeErrorException($e->getMessage());
        }
    }

    public function searchCammodelStreamingIncome(string $text = null, int $totalView, $from = null, $to = null): Collection
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return $this->listCammodelStreamingIncomes($totalView);
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchCammodelStreamingIncome($text)
                ->with(['cammodelStreamAccount'])
                ->orderBy('id')
                ->skip($totalView)
                ->take(10)
                ->get($this->columns);
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->with(['cammodelStreamAccount'])
                ->orderBy('id')
                ->skip($totalView)
                ->take(10)
                ->get($this->columns);
        }

        return $this->model->searchCammodelStreamingIncome($text)
            ->with(['cammodelStreamAccount'])
            ->whereBetween('created_at', [$from, $to])
            ->orderBy('id')
            ->skip($totalView)
            ->take(10)
            ->get($this->columns);
    }

    public function countCammodelStreamingIncome(string $text = null,  $from = null, $to = null)
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return count($this->model->get(['id']));
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return count($this->model->searchCammodelStreamingIncome($text)->get(['id']));
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return count($this->model->whereBetween('created_at', [$from, $to])->get(['id']));
        }

        return count($this->model->searchCammodelStreamingIncome($text)->whereBetween('created_at', [$from, $to])->get(['id']));
    }

    public function getCammodelStreamingIncomes($streamAccountId, $periodDate, $createdAt)
    {
        return $this->model->where('cammodel_stream_account_id', $streamAccountId)
            ->whereBetween('created_at', $periodDate)->where('created_at', '>=', $createdAt)
            ->orderBy('created_at')->get(['id', 'tokens', 'created_at']);
    }

    public function getAllNotAvailableWorkReportsIds(): array
    {
        $idsCollection = $this->model
            ->distinct('cammodel_work_report_id')
            ->get('cammodel_work_report_id');

        $ids_array = [];

        foreach ($idsCollection as $value) {
            array_push($ids_array, $value->cammodel_work_report_id);
        }

        return $ids_array;
    }

    public function getAprobedCammodelStreamingIncomesPeriod(array $dates): Collection
    {
        return $this->model->with(['cammodelStreamAccount'])
            ->whereBetween('created_at', $dates)->where('user_approves', '!=', null)
            ->where('cammodel_payroll_id', null)->get($this->columns);
    }

    public function getPeriodAprobedCammodelStreamingIncomes(array $dates, $subsidiaryId = null): Collection
    {
        return $this->model
            ->with(['cammodelStreamAccount', 'cammodelWorkReport'])
            ->whereHas('cammodelWorkReport', function ($q) use ($subsidiaryId) {
                if ($subsidiaryId != null) {
                    $q->where('subsidiary_id', $subsidiaryId);
                }
            })
            ->whereBetween('created_at', $dates)->where('user_approves', '!=', null)
            ->get($this->columns);
    }

    public function getAllPeriodCammodelIncomes(array $dates, array $accountIds): Collection
    {
        return $this->model
            ->with(['cammodelStreamAccount'])->whereBetween('created_at', $dates)
            ->where('user_approves', '!=', null)
            ->whereIn('cammodel_stream_account_id', $accountIds)
            ->get($this->columns);
    }

    public function getAprobedSubsidiaryStreamingIncomesPeriod(array $dates, $accountIds): Collection
    {
        return $this->model->with(['cammodelStreamAccount'])
            ->whereBetween('created_at', $dates)
            ->where('user_approves', '!=', null)
            ->whereIn('cammodel_stream_account_id', $accountIds)
            ->where('cammodel_payroll_id', null)
            ->get($this->columns);
    }

    public function getPeriodAprobedSubsidiaryStreamingIncomes(array $dates, $accountIds, $subsidiaryId = null): Collection
    {
        return $this->model
            ->with(['cammodelStreamAccount', 'cammodelWorkReport'])
            ->whereHas('cammodelWorkReport', function ($q) use ($subsidiaryId) {
                if ($subsidiaryId != null) {
                    $q->where('subsidiary_id', $subsidiaryId);
                }
            })
            ->whereBetween('created_at', $dates)
            ->where('user_approves', '!=', null)
            ->where(function ($k) use ($accountIds) {
                if ($accountIds != null) {
                    $k->whereIn('cammodel_stream_account_id', $accountIds);
                }
            })->get($this->columns);
    }

    public function getAprobedCammodelStreamingIncomesPeriodForDelete($accounts, array $dates): Collection
    {
        return $this->model->with(['cammodelStreamAccount'])
            ->whereIn('cammodel_stream_account_id', $accounts)
            ->whereBetween('created_at', $dates)
            ->where('user_approves', '!=', null)
            ->where('cammodel_payroll_id', null)
            ->get($this->columns);
    }

    public function getStreamAccountLastAvailableStreamingIncome($cammodelStreamAccountId, $to = null)
    {
        if ($to != null) {
            return $this->model->where('cammodel_stream_account_id', $cammodelStreamAccountId)
                ->where('created_at', '<', $to)
                ->where('cammodel_payroll_id', null)
                ->orderBy('created_at', 'desc')
                ->first(['accumulated_tokens', 'created_at']);
        }
        return $this->model->where('cammodel_stream_account_id', $cammodelStreamAccountId)
            ->where('cammodel_payroll_id', null)
            ->orderBy('created_at', 'desc')
            ->first(['accumulated_tokens', 'created_at']);
    }

    public function getStreamAccountAvailableStreamingIncomes($cammodelStreamAccountId)
    {
        return $this->model->where('cammodel_stream_account_id', $cammodelStreamAccountId)
            ->where('cammodel_payroll_id', null)->sum('tokens');
    }

    public function getPrevStreamingIncomes($today, $streamings)
    {
        return $this->model->where('created_at', 'LIKE', $today . "%")
            ->whereIn('cammodel_stream_account_id', $streamings)
            ->get($this->columns);
    }

    public function alreadyExists($streamAccount, $workReport)
    {
        return $this->model->where('cammodel_stream_account_id', $streamAccount)
            ->where('cammodel_work_report_id', $workReport)
            ->get('id')->first();
    }

    public function findFromStreamAccount(int $streamAccount, $from)
    {
        return $this->model->where('cammodel_stream_account_id', $streamAccount)
            ->where('created_at', 'LIKE', $from . '%')->first();
    }

    public function getCammodelIncomesByDays($periodDate, array $streamAccounts): Collection
    {
        return $this->model->whereBetween('created_at', $periodDate)
            ->whereIn('cammodel_stream_account_id', $streamAccounts)
            ->get($this->columns);
    }

    public function getManagerIncomesByDays($periodDate, int $managerId): Collection
    {
        return $this->model
            ->with('cammodelWorkReport')
            ->whereBetween('created_at', $periodDate)
            ->whereHas('cammodelWorkReport', function ($q) use ($managerId) {
                $q->whereHas('manager', function ($k) use ($managerId) {
                    $k->where('id', $managerId);
                });
            })->where('user_approves', '!=', null)->get($this->columns);
    }

    public function getAllPeriodStreamingIncomes($periodDate, int $subsidiaryId = null, int $cammodelId = null): Collection
    {
        return $this->model
            ->with(['cammodelWorkReport'])
            ->whereBetween('created_at', $periodDate)
            ->whereHas('cammodelWorkReport', function ($j) use ($subsidiaryId) {
                if ($subsidiaryId != null) {
                    $j->where('subsidiary_id', $subsidiaryId);
                }
            })
            ->whereHas('cammodelStreamAccount', function ($q) use ($cammodelId) {
                $q->whereHas('cammodel', function ($k) use ($cammodelId) {
                    if ($cammodelId != null) {
                        $k->where('id', $cammodelId);
                    }
                });
            })->where('user_approves', '!=', null)->get($this->columns);
    }
}
