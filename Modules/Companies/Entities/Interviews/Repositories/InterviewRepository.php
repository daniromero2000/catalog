<?php

namespace Modules\Companies\Entities\Interviews\Repositories;

use Modules\Companies\Entities\Interviews\Exceptions\InterviewInvalidArgumentException;
use Modules\Companies\Entities\Interviews\Exceptions\InterviewNotFoundException;
use Modules\Companies\Entities\Interviews\Interview;
use Modules\Companies\Entities\Interviews\Repositories\Interfaces\InterviewRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;


class InterviewRepository implements InterviewRepositoryInterface
{
    protected $model;
    private $columns = [
        'id',
        'name',
        'last_name',
        'identification_number',
        'birthday',
        'phone',
        'email',
        'address',
        'calification',
        'employee_position_id',
        'english_knowledge',
        'interview_status_id',
        'picture',
        'created_at'
    ];

    public function __construct(Interview $Interview)
    {
        $this->model = $Interview;
    }

    public function createInterview(array $data): Interview
    {
        try {
            return   $this->model->create($data);
        } catch (QueryException $e) {
            throw new InterviewInvalidArgumentException($e->getMessage(), 500, $e);
        }
    }

    public function updateInterview(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new InterviewInvalidArgumentException($e->getMessage());
        }
    }

    public function findInterviewById(int $id): Interview
    {
        try {
            return $this->model->with(['interviewStatus', 'employeePosition', 'interviewCommentaries'])
                ->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new InterviewNotFoundException($e->getMessage());
        }
    }

    public function listInterviews(int $totalView): Collection
    {
        return $this->model->with(['interviewStatus', 'employeePosition'])
            ->orderBy('id', 'desc')
            ->skip($totalView)->take(10)
            ->get($this->columns);
    }

    public function removeInterview(): bool
    {
        try {
            return $this->model->where('id', $this->model->id)->delete();
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function searchInterview(string $text = null, int $totalView, $from = null, $to = null): Collection
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return $this->listInterviews($totalView);
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchInterview($text)
                ->skip($totalView)->take(10)->get($this->columns);
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->skip($totalView)->take(10)->get($this->columns);
        }

        return $this->model->searchInterview($text)
            ->whereBetween('created_at', [$from, $to])
            ->orderBy('nickname', 'desc')->skip($totalView)
            ->take(10)->get($this->columns);
    }


    public function countInterview(string $text = null,  $from = null, $to = null)
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return count($this->model->get(['id']));
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return count($this->model->searchInterview($text)
                ->get(['id']));
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return count($this->model->whereBetween('created_at', [$from, $to])
                ->get(['id']));
        }

        return count($this->model->searchInterview($text)
            ->whereBetween('created_at', [$from, $to])->get(['id']));
    }
}
