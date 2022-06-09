<?php

namespace Modules\CamStudio\Entities\Fouls\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Modules\CamStudio\Entities\Fouls\Foul;
use Modules\CamStudio\Entities\Fouls\Exceptions\FoulNotFoundException;
use Modules\CamStudio\Entities\Fouls\Exceptions\CreateFoulErrorException;
use Modules\CamStudio\Entities\Fouls\Exceptions\DeletingFoulErrorException;
use Modules\CamStudio\Entities\Fouls\Exceptions\UpdateFoulErrorException;
use Modules\CamStudio\Entities\Fouls\Repositories\Interfaces\FoulRepositoryInterface;

class FoulRepository implements FoulRepositoryInterface
{
    protected $model;
    private $columns = [
        'id',
        'name',
        'description',
        'charge',
        'created_at'
    ];

    public function __construct(Foul $Foul)
    {
        $this->model = $Foul;
    }

    public function createFoul(array $data): Foul
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateFoulErrorException($e->getMessage());
        }
    }

    public function updateFoul(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdateFoulErrorException($e->getMessage());
        }
    }

    public function findFoulById(int $foulId): Foul
    {
        try {
            return $this->model->findOrFail($foulId, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new FoulNotFoundException($e->getMessage());
        }
    }

    public function listFouls($totalView): Collection
    {
        return  $this->model->skip($totalView)->take(10)->get($this->columns);
    }

    public function deleteFoul(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            throw new DeletingFoulErrorException($e->getMessage());
        }
    }

    public function searchFoul(string $text = null, int $totalView, $from = null, $to = null): Collection
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return $this->listFouls($totalView);
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchFoul($text)->skip($totalView)
                ->take(10)->get($this->columns);
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->skip($totalView)->take(10)->get($this->columns);
        }

        return $this->model->searchFoul($text)->whereBetween('created_at', [$from, $to])
            ->skip($totalView)->take(10)->get($this->columns);
    }

    public function countFoul(string $text = null,  $from = null, $to = null)
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return count($this->model->get(['id']));
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return count($this->model->searchFoul($text)->get(['id']));
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return count($this->model->whereBetween('created_at', [$from, $to])->get(['id']));
        }

        return count($this->model->searchFoul($text)->whereBetween('created_at', [$from, $to])->get(['id']));
    }

    public function getAllFoulNames()
    {
        return $this->model->orderBy('name', 'asc')->get(['id', 'name']);
    }
}
