<?php

namespace Modules\Companies\Entities\EmployeeWorkingHours\Repositories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Modules\Generals\Entities\Tools\UploadableTrait;
use Modules\Companies\Entities\EmployeeWorkingHours\EmployeeWorkingHour;
use Modules\Companies\Entities\EmployeeWorkingHours\Exceptions\EmployeeWorkingHourNotFoundException;
use Modules\Companies\Entities\EmployeeWorkingHours\Exceptions\CreateEmployeeWorkingHourErrorException;
use Modules\Companies\Entities\EmployeeWorkingHours\Exceptions\DeletingEmployeeWorkingHourErrorException;
use Modules\Companies\Entities\EmployeeWorkingHours\Exceptions\UpdateEmployeeWorkingHourErrorException;
use Modules\Companies\Entities\EmployeeWorkingHours\Repositories\Interfaces\EmployeeWorkingHourRepositoryInterface;

class EmployeeWorkingHourRepository implements EmployeeWorkingHourRepositoryInterface
{
    use UploadableTrait;
    protected $model;
    private $columns = [
        'id',
        'date',
        'start_time',
        'finish_time',
        'employee_id',
        'created_at'
    ];

    public function __construct(EmployeeWorkingHour $paymentRequest)
    {
        $this->model = $paymentRequest;
    }

    public function createEmployeeWorkingHour(array $data): EmployeeWorkingHour
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateEmployeeWorkingHourErrorException($e->getMessage());
        }
    }

    public function updateEmployeeWorkingHour(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdateEmployeeWorkingHourErrorException($e->getMessage());
        }
    }

    public function findEmployeeWorkingHourById(int $id): EmployeeWorkingHour
    {
        try {
            return $this->model
                ->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new EmployeeWorkingHourNotFoundException($e->getMessage());
        }
    }

    public function listEmployeeWorkingHours($totalView): Collection
    {
        return  $this->model->orderBy('created_at', 'desc')
            ->skip($totalView)->take(10)->get($this->columns);
    }

    public function deleteEmployeeWorkingHour(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            throw new DeletingEmployeeWorkingHourErrorException($e->getMessage());
        }
    }

    public function searchEmployeeWorkingHour(string $text = null, int $totalView, $from = null, $to = null): Collection
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return $this->listEmployeeWorkingHours($totalView);
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchEmployeeWorkingHour($text)
                ->skip($totalView)
                ->take(10)
                ->get($this->columns);
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->skip($totalView)
                ->take(10)
                ->get($this->columns);
        }

        return $this->model->searchEmployeeWorkingHour($text)
            ->whereBetween('created_at', [$from, $to])
            ->orderBy('created_at', 'desc')
            ->skip($totalView)
            ->take(10)
            ->get($this->columns);
    }

    public function countEmployeeWorkingHour(string $text = null,  $from = null, $to = null)
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return $this->model->count();
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchEmployeeWorkingHour($text)->count();
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return  $this->model->whereBetween('created_at', [$from, $to])->count();
        }

        return $this->model->searchEmployeeWorkingHour($text)
            ->whereBetween('created_at', [$from, $to])->count();
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setEmployeeIdAttribute($input)
    {
        $this->attributes['employee_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setDateAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['date'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        } else {
            $this->attributes['date'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getDateAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format'));

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('app.date_format'));
        } else {
            return '';
        }
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setStartTimeAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['start_time'] = Carbon::createFromFormat('H:i:s', $input)->format('H:i:s');
        } else {
            $this->attributes['start_time'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getStartTimeAttribute($input)
    {
        if ($input != null && $input != '') {
            return Carbon::createFromFormat('H:i:s', $input)->format('H:i:s');
        } else {
            return '';
        }
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setFinishTimeAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['finish_time'] = Carbon::createFromFormat('H:i:s', $input)->format('H:i:s');
        } else {
            $this->attributes['finish_time'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getFinishTimeAttribute($input)
    {
        if ($input != null && $input != '') {
            return Carbon::createFromFormat('H:i:s', $input)->format('H:i:s');
        } else {
            return '';
        }
    }

    public function getEmployee($employee_id): Collection
    {
        return $this->model->where('employee_id', $employee_id)->get($this->columns);
    }
}
