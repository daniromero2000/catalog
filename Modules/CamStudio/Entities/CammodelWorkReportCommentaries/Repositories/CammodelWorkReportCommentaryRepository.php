<?php

namespace Modules\CamStudio\Entities\CammodelWorkReportCommentaries\Repositories;

use Modules\CamStudio\Entities\CammodelWorkReportCommentaries\CammodelWorkReportCommentary;
use Modules\CamStudio\Entities\CammodelWorkReportCommentaries\Exceptions\CreateCammodelWorkReportCommentaryErrorException;
use Modules\CamStudio\Entities\CammodelWorkReportCommentaries\Repositories\Interfaces\CammodelWorkReportCommentaryRepositoryInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;

class CammodelWorkReportCommentaryRepository implements CammodelWorkReportCommentaryRepositoryInterface
{
    protected $model;
    private $columns = [
        'id',
        'commentary',
        'user',
        'cammodel_work_report_id',
        'created_at'
    ];

    public function __construct(CammodelWorkReportCommentary $CammodelWorkReportCommentary)
    {
        $this->model = $CammodelWorkReportCommentary;
    }

    public function createCammodelWorkReportCommentary(array $data): CammodelWorkReportCommentary
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateCammodelWorkReportCommentaryErrorException($e->getMessage());
        }
    }

    public function findReportPeriodComments(array $periodDates, string $periodType): Collection
    {
        return $this->model->whereBetween('created_at', $periodDates)
            ->where('period_type', $periodType)
            ->orderBy('id', 'desc')
            ->get($this->columns);
    }
}
