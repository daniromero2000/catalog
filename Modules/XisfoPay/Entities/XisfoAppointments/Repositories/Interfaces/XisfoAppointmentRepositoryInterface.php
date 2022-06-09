<?php

namespace Modules\XisfoPay\Entities\XisfoAppointments\Repositories\Interfaces;

use Illuminate\Support\Collection;
use Modules\XisfoPay\Entities\XisfoAppointments\XisfoAppointment;

interface XisfoAppointmentRepositoryInterface
{
    public function createXisfoAppointment(array $data): XisfoAppointment;

    public function updateXisfoAppointment(array $data): bool;

    public function findXisfoAppointmentById(int $id): XisfoAppointment;

    public function listXisfoAppointments($totalView): Collection;

    public function deleteXisfoAppointment(): bool;

    public function searchXisfoAppointment(string $text = null, int $totalView, $from = null, $to = null): Collection;

    public function countXisfoAppointment(string $text = null,  $from = null, $to = null);
}
