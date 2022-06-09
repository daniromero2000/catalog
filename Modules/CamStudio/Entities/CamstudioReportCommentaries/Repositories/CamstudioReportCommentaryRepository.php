<?php

namespace Modules\CamStudio\Entities\CamstudioReportCommentaries\Repositories;

use Modules\CamStudio\Entities\CamstudioReportCommentaries\CamstudioReportCommentary;
use Modules\CamStudio\Entities\CamstudioReportCommentaries\Exceptions\CreateCamstudioReportCommentaryErrorException;
use Modules\CamStudio\Entities\CamstudioReportCommentaries\Repositories\Interfaces\CamstudioReportCommentaryRepositoryInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;

class CamstudioReportCommentaryRepository implements CamstudioReportCommentaryRepositoryInterface
{
    protected $model;
    private $columns = [
        'id',
        'commentary',
        'user',
        'created_at'
    ];

    public function __construct(CamstudioReportCommentary $CamstudioReportCommentary)
    {
        $this->model = $CamstudioReportCommentary;
    }

    public function createCamstudioReportCommentary(array $data): CamstudioReportCommentary
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateCamstudioReportCommentaryErrorException($e->getMessage());
        }
    }

    public function findReportPeriodComments(array $periodDates, string $periodType, int $subsidiaryId = null): Collection
    {
        return $this->model->whereBetween('created_at', $periodDates)
            ->where(function ($q) use ($subsidiaryId) {
                if ($subsidiaryId != null) {
                    $q->where('subsidiary_id', $subsidiaryId)->orWhereNull('subsidiary_id');
                }
            })
            ->where('period_type', $periodType)->orderBy('id', 'desc')
            ->get($this->columns);
    }
}
