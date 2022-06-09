<?php

namespace Modules\Ecommerce\Entities\OrderCommentaries\Repositories;

use Modules\Ecommerce\Entities\OrderCommentaries\OrderCommentary;
use Modules\Ecommerce\Entities\OrderCommentaries\Repositories\Interfaces\OrderCommentaryRepositoryInterface;
use Illuminate\Database\QueryException;

class OrderCommentaryRepository implements OrderCommentaryRepositoryInterface
{
    protected $model;
    private $columns = [];

    public function __construct(OrderCommentary $OrderCommentary)
    {
        $this->model = $OrderCommentary;
    }

    public function createOrderCommentary(array $data): OrderCommentary
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
