<?php

namespace Modules\Pqrs\Entities\PqrCommentaries\Repositories;

use Modules\Pqrs\Entities\PqrCommentaries\PqrCommentary;
use Modules\Pqrs\Entities\PqrCommentaries\Repositories\Interfaces\PqrCommentaryRepositoryInterface;
use Illuminate\Database\QueryException;

class PqrCommentaryRepository implements PqrCommentaryRepositoryInterface
{
    protected $model;
    private $columns = [];

    public function __construct(PqrCommentary $pqrcommentary)
    {
        $this->model = $pqrcommentary;
    }

    public function createPqrCommentary(array $attributes)
    {
        try {
            return $this->model->create($attributes);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
