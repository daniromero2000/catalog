<?php

namespace Modules\CamStudio\Entities\CammodelWorkReportCommentaries\UseCases;

use Modules\CamStudio\Entities\CammodelWorkReportCommentaries\CammodelWorkReportCommentary;
use Modules\CamStudio\Entities\CammodelWorkReportCommentaries\Repositories\Interfaces\CammodelWorkReportCommentaryRepositoryInterface;
use Modules\CamStudio\Entities\CammodelWorkReportCommentaries\UseCases\Interfaces\CammodelWorkReportCommentaryUseCaseInterface;
use Modules\Generals\Entities\Tools\ToolRepository;

class CammodelWorkReportCommentaryUseCase implements CammodelWorkReportCommentaryUseCaseInterface
{
    private $cammodelWorkReportCommentaryInterface;

    public function __construct(
        CammodelWorkReportCommentaryRepositoryInterface $cammodelWorkReportCommentaryRepositoryInterface
    ) {
        $this->cammodelWorkReportCommentaryInterface = $cammodelWorkReportCommentaryRepositoryInterface;
        $this->module                                = 'Comentarios Reportes Studio';
    }

    public function storeCammodelWorkReportCommentary(array $requestData): CammodelWorkReportCommentary
    {
        $user                = ToolRepository::setStaticSignedUser();
        $requestData['user'] = $user->name . ' ' . $user->last_name;
        return $this->cammodelWorkReportCommentaryInterface->createCammodelWorkReportCommentary($requestData);
    }
}
