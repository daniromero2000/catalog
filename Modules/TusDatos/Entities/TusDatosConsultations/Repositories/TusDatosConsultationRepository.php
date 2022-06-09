<?php

namespace Modules\TusDatos\Entities\TusDatosConsultations\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\TusDatos\Entities\TusDatosConsultations\TusDatosConsultation;
use Modules\TusDatos\Entities\TusDatosConsultations\Exceptions\TusDatosConsultationNotFoundException;
use Modules\TusDatos\Entities\TusDatosConsultations\Exceptions\CreateTusDatosConsultationErrorException;
use Modules\TusDatos\Entities\TusDatosConsultations\Exceptions\DeletingTusDatosConsultationErrorException;
use Modules\TusDatos\Entities\TusDatosConsultations\Exceptions\UpdateTusDatosConsultationErrorException;
use Modules\TusDatos\Entities\TusDatosConsultations\Repositories\Interfaces\TusDatosConsultationRepositoryInterface;

class TusDatosConsultationRepository implements TusDatosConsultationRepositoryInterface
{
    protected $model;
    private $columns = [
        'id',
        'email',
        'identiy_number',
        'jobid',
        'name',
        'typedoc',
        'validado',
        'created_at'
    ];

    public function __construct(TusDatosConsultation $tusDatosConsultation)
    {
        $this->model = $tusDatosConsultation;
    }

    public function createTusDatosConsultation(array $data): TusDatosConsultation
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateTusDatosConsultationErrorException($e->getMessage());
        }
    }

    public function updateTusDatosConsultation(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdateTusDatosConsultationErrorException($e->getMessage());
        }
    }

    public function findTusDatosConsultationById(int $id): TusDatosConsultation
    {
        try {
            return $this->model->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new TusDatosConsultationNotFoundException($e->getMessage());
        }
    }

    public function deleteTusDatosConsultation(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            throw new DeletingTusDatosConsultationErrorException($e->getMessage());
        }
    }

    public function searchTusDatosConsultation(string $text = null): LengthAwarePaginator
    {
        if (is_null($text)) {
            return $this->listTusDatosConsultations();
        } else {
            return $this->model->searchTusDatosConsultation($text)
                ->select($this->columns)->orderBy('created_at', 'desc')
                ->paginate(10);
        }
    }

    private function listTusDatosConsultations(): LengthAwarePaginator
    {
        return  $this->model->select($this->columns)
            ->orderBy('created_at', 'asc')->paginate(10);
    }
}
