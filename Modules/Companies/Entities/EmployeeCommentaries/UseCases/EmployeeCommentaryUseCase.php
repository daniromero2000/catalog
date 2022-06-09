<?php

namespace Modules\Companies\Entities\EmployeeCommentaries\UseCases;

use Modules\Companies\Entities\EmployeeCommentaries\Repositories\Interfaces\EmployeeCommentaryRepositoryInterface;
use Modules\Companies\Entities\EmployeeCommentaries\UseCases\Interfaces\EmployeeCommentaryUseCaseInterface;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;

class EmployeeCommentaryUseCase implements EmployeeCommentaryUseCaseInterface
{
    private $employeeCommentaryInterface, $toolsInterface;

    public function __construct(
        ToolRepositoryInterface         $toolRepositoryInterface,
        EmployeeCommentaryRepositoryInterface $employeeCommentaryRepositoryInterface
    ) {
        $this->toolsInterface        = $toolRepositoryInterface;
        $this->employeeCommentaryInterface = $employeeCommentaryRepositoryInterface;
    }

    public function listEmployeeCommentaries(int $employee)
    {
        return $this->employeeCommentaryInterface->listEmployeeCommentaries($employee);
    }

    public function storeEmployeeCommentary($request)
    {
        $user            = $this->toolsInterface->setSignedUser();
        $request['user'] = $user->name . ' ' . $user->last_name;
        $this->employeeCommentaryInterface->createEmployeeCommentary($request->except('_token', '_method'));
        $request->session()->flash('message', 'Comentario Creado Exitosamente');
    }

    public function updateEmployeeCommentary($request, int $id)
    {
    }
}
