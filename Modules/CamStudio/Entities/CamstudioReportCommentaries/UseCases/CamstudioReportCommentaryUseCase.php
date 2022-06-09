<?php

namespace Modules\CamStudio\Entities\CamstudioReportCommentaries\UseCases;

use Modules\CamStudio\Entities\CamstudioReportCommentaries\CamstudioReportCommentary;
use Modules\CamStudio\Entities\CamstudioReportCommentaries\Repositories\Interfaces\CamstudioReportCommentaryRepositoryInterface;
use Modules\CamStudio\Entities\CamstudioReportCommentaries\UseCases\Interfaces\CamstudioReportCommentaryUseCaseInterface;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;

class CamstudioReportCommentaryUseCase implements CamstudioReportCommentaryUseCaseInterface
{
    private $camstudioReportCommentaryInterface, $toolsInterface;

    public function __construct(
        CamstudioReportCommentaryRepositoryInterface $camstudioReportCommentaryRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface
    ) {
        $this->camstudioReportCommentaryInterface = $camstudioReportCommentaryRepositoryInterface;
        $this->toolsInterface                     = $toolRepositoryInterface;
        $this->module                             = 'Comentarios Reportes Studio';
    }

    public function storeCamstudioReportCommentary(array $requestData): CamstudioReportCommentary
    {
        if (isset($requestData['month'])) {
            $requestData['created_at'] = $requestData['month'] . '-29 00:00:01';
        } else {
            $requestData['created_at'] = now();
        }

        if ($requestData['subsidiary_id'] == 'global') {
            unset($requestData['subsidiary_id']);
        }

        $user                = auth()->guard('employee')->user();
        $requestData['user'] = $user->name . ' ' . $user->last_name;

        return $this->camstudioReportCommentaryInterface->createCamstudioReportCommentary($requestData);
    }

    public function listCamstudioReportCommentaries(array $periodDates, string $periodType)
    {
        $user = $this->toolsInterface->setSignedUser();

        if ($user->hasRole('studio_admin|subsidiary_supervisor')) {
            return $this->camstudioReportCommentaryInterface->findReportPeriodComments($periodDates, $periodType, $user->subsidiary_id);
        } else {
            return $this->camstudioReportCommentaryInterface->findReportPeriodComments($periodDates, $periodType);
        }
    }
}
