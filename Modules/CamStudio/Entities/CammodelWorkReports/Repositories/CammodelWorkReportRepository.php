<?php

namespace Modules\CamStudio\Entities\CammodelWorkReports\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Modules\CamStudio\Entities\CammodelWorkReports\CammodelWorkReport;
use Modules\CamStudio\Entities\CammodelWorkReports\Exceptions\CammodelWorkReportNotFoundException;
use Modules\CamStudio\Entities\CammodelWorkReports\Exceptions\CreateCammodelWorkReportErrorException;
use Modules\CamStudio\Entities\CammodelWorkReports\Exceptions\DeletingCammodelWorkReportErrorException;
use Modules\CamStudio\Entities\CammodelWorkReports\Exceptions\UpdateCammodelWorkReportErrorException;
use Modules\CamStudio\Entities\CammodelWorkReports\Repositories\Interfaces\CammodelWorkReportRepositoryInterface;

class CammodelWorkReportRepository implements CammodelWorkReportRepositoryInterface
{
    protected $model;
    private $columns = [
        'id',
        'cammodel_id',
        'room_id',
        'subsidiary_id',
        'cammodel_shift_id',
        'shift_id',
        'manager_id',
        'entry_time',
        'connection_time',
        'disconnection_time',
        'observations',
        'created_at'
    ];

    public function __construct(CammodelWorkReport $CammodelWorkReport)
    {
        $this->model = $CammodelWorkReport;
    }

    public function createCammodelWorkReport(array $data): CammodelWorkReport
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateCammodelWorkReportErrorException($e->getMessage());
        }
    }

    public function updateCammodelWorkReport(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdateCammodelWorkReportErrorException($e->getMessage());
        }
    }

    public function findCammodelWorkReportById(int $CammodelWorkReportId): CammodelWorkReport
    {
        try {
            return $this->model->findOrFail($CammodelWorkReportId, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new CammodelWorkReportNotFoundException($e->getMessage());
        }
    }

    public function findCammodelLastWorkReportById(int $cammodelId): CammodelWorkReport
    {
        return $this->model->orderBy('created_at', 'desc')
            ->where('cammodel_id', $cammodelId)
            ->first('manager_id');
    }

    public function deleteCammodelWorkReport(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            throw new DeletingCammodelWorkReportErrorException($e->getMessage());
        }
    }

    public function searchCammodelWorkReportsWithIncomes(string $text = null, $from = null, $to = null,  array $where): LengthAwarePaginator
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return $this->listCammodelWorkReportsWithIncomes($where);
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchCammodelWorkReport($text)
                ->with([
                    'cammodel', 'room', 'shift', 'inCharge', 'subsidiary',
                    'cammodelStreamingIncomes'
                ])
                ->orderBy('created_at', 'desc')
                ->whereHas('cammodelStreamingIncomes', function ($k) use ($where) {
                    if ($where[0] != 1) {
                        $k->where('user_approves', $where[0], $where[1]);
                    }
                })
                ->select($this->columns)
                ->paginate(10);
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->with([
                    'cammodel', 'room', 'shift', 'inCharge', 'subsidiary',
                    'cammodelStreamingIncomes'
                ])
                ->orderBy('created_at', 'desc')
                ->whereHas('cammodelStreamingIncomes', function ($k) use ($where) {
                    if ($where[0] != 1) {
                        $k->where('user_approves', $where[0], $where[1]);
                    }
                })
                ->select($this->columns)
                ->paginate(10);
        }
        return $this->model->searchCammodelWorkReport($text)
            ->whereBetween('created_at', [$from, $to])
            ->with([
                'cammodel', 'room', 'shift', 'inCharge', 'subsidiary',
                'cammodelStreamingIncomes'
            ])
            ->orderBy('created_at', 'desc')
            ->whereHas('cammodelStreamingIncomes', function ($k) use ($where) {
                if ($where[0] != 1) {
                    $k->where('user_approves', $where[0], $where[1]);
                }
            })
            ->select($this->columns)
            ->paginate(10);
    }

    private function listCammodelWorkReportsWithIncomes(array $where)
    {
        return $this->model->select($this->columns)
            ->with([
                'cammodel', 'room', 'shift', 'inCharge', 'subsidiary',
                'cammodelStreamingIncomes'
            ])
            ->orderBy('created_at', 'desc')
            ->whereHas('cammodelStreamingIncomes', function ($k) use ($where) {
                if ($where[0] != 1) {
                    $k->where('user_approves', $where[0], $where[1]);
                }
            })
            ->paginate(10);
    }

    public function searchSubsidiaryCammodelWorkReportsWithIncomes(string $text = null, int $subsidiary_id, $from = null,  $to = null, array $where): LengthAwarePaginator
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return $this->listSubsidiaryCammodelWorkReportsWithIncomes($subsidiary_id, $where);
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchCammodelWorkReport($text)
                ->with([
                    'cammodel', 'room', 'shift', 'inCharge', 'subsidiary',
                    'cammodelStreamingIncomes'
                ])
                ->orderBy('created_at', 'desc')
                ->whereHas('cammodelStreamingIncomes', function ($k) use ($where) {
                    if ($where[0] != 1) {
                        $k->where('user_approves', $where[0], $where[1]);
                    }
                })
                ->select($this->columns)
                ->whereHas('cammodel', function ($q) use ($subsidiary_id) {
                    $q->whereHas('employee', function ($k) use ($subsidiary_id) {
                        $k->where('subsidiary_id', $subsidiary_id);
                    });
                })->paginate(10);
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->with([
                    'cammodel', 'room', 'shift', 'inCharge', 'subsidiary',
                    'cammodelStreamingIncomes'
                ])
                ->orderBy('created_at', 'desc')
                ->whereHas('cammodelStreamingIncomes', function ($k) use ($where) {
                    if ($where[0] != 1) {
                        $k->where('user_approves', $where[0], $where[1]);
                    }
                })
                ->select($this->columns)
                ->whereHas('cammodel', function ($q) use ($subsidiary_id) {
                    $q->whereHas('employee', function ($k) use ($subsidiary_id) {
                        $k->where('subsidiary_id', $subsidiary_id);
                    });
                })->paginate(10);
        }
        return $this->model->searchCammodelWorkReport($text)
            ->whereBetween('created_at', [$from, $to])
            ->with([
                'cammodel', 'room', 'shift', 'inCharge', 'subsidiary',
                'cammodelStreamingIncomes'
            ])
            ->orderBy('created_at', 'desc')
            ->whereHas('cammodelStreamingIncomes', function ($k) use ($where) {
                if ($where[0] != 1) {
                    $k->where('user_approves', $where[0], $where[1]);
                }
            })
            ->select($this->columns)
            ->whereHas('cammodel', function ($q) use ($subsidiary_id) {
                $q->whereHas('employee', function ($k) use ($subsidiary_id) {
                    $k->where('subsidiary_id', $subsidiary_id);
                });
            })->paginate(10);
    }

    private function listSubsidiaryCammodelWorkReportsWithIncomes(
        int $subsidiary_id,
        array $where
    ) {
        return $this->model->select($this->columns)
            ->with([
                'cammodel', 'room', 'shift', 'inCharge', 'subsidiary',
                'cammodelStreamingIncomes'
            ])
            ->orderBy('created_at', 'desc')
            ->whereHas('cammodelStreamingIncomes', function ($k) use ($where) {
                if ($where[0] != 1) {
                    $k->where('user_approves', $where[0], $where[1]);
                }
            })
            ->whereHas('cammodel', function ($q) use ($subsidiary_id) {
                $q->whereHas('employee', function ($k) use ($subsidiary_id) {
                    $k->where('subsidiary_id', $subsidiary_id);
                });
            })->paginate(10);
    }

    public function searchCammodelWorkReport(string $text = null,   $from = null,  $to = null,   $comments = null, int $subsidiary_id = null): LengthAwarePaginator
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return $this->listCammodelWorkReports($comments, $subsidiary_id);
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchCammodelWorkReport($text)
                ->with([
                    'cammodel', 'room', 'shift', 'inCharge', 'subsidiary',
                    'cammodelStreamingIncomes', 'cammodelWorkReportCommentaries'
                ])
                ->orderBy('created_at', 'desc')
                ->whereHas('cammodel', function ($q) use ($subsidiary_id) {
                    $q->whereHas('employee', function ($k) use ($subsidiary_id) {
                        if ($subsidiary_id != null) {
                            $k->where('subsidiary_id', $subsidiary_id);
                        }
                    });
                })
                ->where(function ($com) use ($comments) {
                    if ($comments != null) {
                        $com->whereHas('cammodelWorkReportCommentaries');
                    }
                })
                ->select($this->columns)->paginate(10);
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->with([
                    'cammodel', 'room', 'shift', 'inCharge', 'subsidiary',
                    'cammodelStreamingIncomes', 'cammodelWorkReportCommentaries'
                ])
                ->orderBy('created_at', 'desc')
                ->whereHas('cammodel', function ($q) use ($subsidiary_id) {
                    $q->whereHas('employee', function ($k) use ($subsidiary_id) {
                        if ($subsidiary_id != null) {
                            $k->where('subsidiary_id', $subsidiary_id);
                        }
                    });
                })
                ->where(function ($com) use ($comments) {
                    if ($comments != null) {
                        $com->whereHas('cammodelWorkReportCommentaries');
                    }
                })
                ->select($this->columns)->paginate(10);
        }
        return $this->model->searchCammodelWorkReport($text)
            ->whereBetween('created_at', [$from, $to])
            ->with([
                'cammodel', 'room', 'shift', 'inCharge', 'subsidiary',
                'cammodelStreamingIncomes', 'cammodelWorkReportCommentaries'
            ])
            ->orderBy('created_at', 'desc')
            ->whereHas('cammodel', function ($q) use ($subsidiary_id) {
                $q->whereHas('employee', function ($k) use ($subsidiary_id) {
                    if ($subsidiary_id != null) {
                        $k->where('subsidiary_id', $subsidiary_id);
                    }
                });
            })
            ->where(function ($com) use ($comments) {
                if ($comments != null) {
                    $com->whereHas('cammodelWorkReportCommentaries');
                }
            })
            ->select($this->columns)->paginate(10);
    }

    private function listCammodelWorkReports($comments, $subsidiary_id): LengthAwarePaginator
    {
        return $this->model->select($this->columns)
            ->with([
                'cammodel', 'room', 'shift', 'inCharge', 'subsidiary',
                'cammodelStreamingIncomes', 'cammodelWorkReportCommentaries'
            ])
            ->whereHas('cammodel', function ($q) use ($subsidiary_id) {
                $q->whereHas('employee', function ($k) use ($subsidiary_id) {
                    if ($subsidiary_id != null) {
                        $k->where('subsidiary_id', $subsidiary_id);
                    }
                });
            })
            ->where(function ($com) use ($comments) {
                if ($comments != null) {
                    $com->whereHas('cammodelWorkReportCommentaries');
                }
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }

    public function getAllCammodelWorkReports(): Collection
    {
        return $this->model->with(['cammodel', 'room', 'cammodelWorkReportCommentaries'])
            ->get(['id', 'connection_time', 'disconnection_time', 'cammodel_payroll_id', 'cammodel_id', 'room_id']);
    }

    public function getAllNotAvailableRoomsIds(): Collection
    {
        return $this->model
            ->where('disconnection_time', null)
            ->get('room_id');
    }


    public function getNotAvailableCammodelsIds(): Collection
    {
        return $this->model->where('disconnection_time', null)
            ->get('cammodel_id');
    }
}
