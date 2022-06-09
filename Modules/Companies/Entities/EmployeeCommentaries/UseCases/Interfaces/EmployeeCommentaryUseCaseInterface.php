<?php

namespace Modules\Companies\Entities\EmployeeCommentaries\UseCases\Interfaces;

interface EmployeeCommentaryUseCaseInterface
{
    public function listEmployeeCommentaries(int $employee);

    public function storeEmployeeCommentary($request);

    public function updateEmployeeCommentary($request, int $id);
}
