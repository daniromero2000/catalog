<?php

namespace Modules\XisfoPay\Entities\XisfoAppointments\Repositories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Modules\Generals\Entities\Tools\UploadableTrait;
use Modules\XisfoPay\Entities\XisfoAppointments\XisfoAppointment;
use Modules\XisfoPay\Entities\XisfoAppointments\Exceptions\XisfoAppointmentNotFoundException;
use Modules\XisfoPay\Entities\XisfoAppointments\Exceptions\CreateXisfoAppointmentErrorException;
use Modules\XisfoPay\Entities\XisfoAppointments\Exceptions\DeletingXisfoAppointmentErrorException;
use Modules\XisfoPay\Entities\XisfoAppointments\Exceptions\UpdateXisfoAppointmentErrorException;
use Modules\XisfoPay\Entities\XisfoAppointments\Repositories\Interfaces\XisfoAppointmentRepositoryInterface;

class XisfoAppointmentRepository implements XisfoAppointmentRepositoryInterface
{
    use UploadableTrait;
    protected $model;
    private $columns = [
        'id',
        'name',
        'is_active',
        'created_at'
    ];

    public function __construct(XisfoAppointment $paymentRequest)
    {
        $this->model = $paymentRequest;
    }

    public function createXisfoAppointment(array $data): XisfoAppointment
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateXisfoAppointmentErrorException($e->getMessage());
        }
    }

    public function updateXisfoAppointment(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdateXisfoAppointmentErrorException($e->getMessage());
        }
    }

    public function findXisfoAppointmentById(int $id): XisfoAppointment
    {
        try {
            return $this->model
                ->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new XisfoAppointmentNotFoundException($e->getMessage());
        }
    }

    public function listXisfoAppointments($totalView): Collection
    {
        return  $this->model->orderBy('created_at', 'desc')
            ->skip($totalView)->take(10)->get($this->columns);
    }

    public function deleteXisfoAppointment(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            throw new DeletingXisfoAppointmentErrorException($e->getMessage());
        }
    }

    public function searchXisfoAppointment(string $text = null, int $totalView, $from = null, $to = null): Collection
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return $this->listXisfoAppointments($totalView);
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchXisfoAppointment($text)
                ->skip($totalView)->take(10)->get($this->columns);
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->skip($totalView)->take(10)->get($this->columns);
        }

        return $this->model->searchXisfoAppointment($text)
            ->whereBetween('created_at', [$from, $to])->orderBy('created_at', 'desc')
            ->skip($totalView)->take(10)->get($this->columns);
    }

    public function countXisfoAppointment(string $text = null,  $from = null, $to = null)
    {
        if (is_null($text) && is_null($from) && is_null($to)) {
            return $this->model->count();
        }

        if (!is_null($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchXisfoAppointment($text)->count();
        }

        if (is_null($text) && (!is_null($from) || !is_null($to))) {
            return  $this->model->whereBetween('created_at', [$from, $to])->count();
        }

        return $this->model->searchXisfoAppointment($text)
            ->whereBetween('created_at', [$from, $to])->count();
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getFinishTimeAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format') . ' H:i:s');

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d H:i:s', $input)->format(config('app.date_format') . ' H:i:s');
        } else {
            return '';
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
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format') . ' H:i:s');

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d H:i:s', $input)->format(config('app.date_format') . ' H:i:s');
        } else {
            return '';
        }
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setClientIdAttribute($input)
    {
        $this->attributes['client_id'] = $input ? $input : null;
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
    public function setStartTimeAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['start_time'] = Carbon::createFromFormat(config('app.date_format') . ' H:i:s', $input)->format('Y-m-d H:i:s');
        } else {
            $this->attributes['start_time'] = null;
        }
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setFinishTimeAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['finish_time'] = Carbon::createFromFormat(config('app.date_format') . ' H:i:s', $input)->format('Y-m-d H:i:s');
        } else {
            $this->attributes['finish_time'] = null;
        }
    }
}
