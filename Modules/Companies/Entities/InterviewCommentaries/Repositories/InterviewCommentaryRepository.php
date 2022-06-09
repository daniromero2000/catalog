<?php

namespace Modules\Companies\Entities\InterviewCommentaries\Repositories;

use Modules\Companies\Entities\InterviewCommentaries\InterviewCommentary;
use Modules\Companies\Entities\InterviewCommentaries\Repositories\Interfaces\InterviewCommentaryRepositoryInterface;
use Illuminate\Database\QueryException;

class InterviewCommentaryRepository implements InterviewCommentaryRepositoryInterface
{
    protected $model;
    private $columns = [];

    public function __construct(InterviewCommentary $InterviewCommentary)
    {
        $this->model = $InterviewCommentary;
    }

    public function createInterviewCommentary(array $data): InterviewCommentary
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
