<?php

namespace Modules\TusDatos\Entities\TusDatosConsultations\UseCases;

use Modules\TusDatos\Entities\TusDatosConsultations\Repositories\TusDatosConsultationRepository;
use Modules\TusDatos\Entities\TusDatosConsultations\Repositories\Interfaces\TusDatosConsultationRepositoryInterface;
use Modules\TusDatos\Entities\TusDatosConsultations\UseCases\Interfaces\TusDatosConsultationUseCaseInterface;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\TusDatos\Entities\TusDatosConsultations\TusDatosConsultation;

class TusDatosConsultationUseCase implements TusDatosConsultationUseCaseInterface
{
    private $tusDatosConsultationRepositoryInterface, $user, $toolsInterface, $module;
    private $password;

    public function __construct(
        TusDatosConsultationRepositoryInterface $tusDatosConsultationRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface
    ) {
        $this->tusDatosConsultationRepositoryInterface = $tusDatosConsultationRepositoryInterface;
        $this->toolsInterface                          = $toolRepositoryInterface;
        $this->user                                    = env('TUS_DATOS_USER', false);
        $this->password                                = env('TUS_DATOS_PASSWORD', false);
        $this->module                                  = 'Consultas TusDatos';
    }

    public function listTusDatosConsultations(array $data): array
    {
        $searchData = $this->toolsInterface->setSearchParametersRefactor($data);
        $searchData['q'] = $searchData['q'] == '' ? null : $searchData['q'];

        return [
            'data' => [
                'tusDatosConsultations' => $this->tusDatosConsultationRepositoryInterface->searchTusDatosConsultation($searchData['q']),
                'optionsRoutes'         => config('generals.optionRoutes'),
                'module'                => $this->module,
                'headers'               => [],
            ],
            'search'  =>  $searchData['search']
        ];
    }

    public function createTusDatosConsultation(): array
    {
        return [
            'optionsRoutes' => config('generals.optionRoutes'),
            'module'        => $this->module
        ];
    }

    public function storeTusDatosConsultation(array $requestData): TusDatosConsultation
    {
        return $this->tusDatosConsultationRepositoryInterface->createTusDatosConsultation($requestData);
    }

    public function updateTusDatosConsultation(array $requestData, $id): bool
    {
        $update = new TusDatosConsultationRepository($this->getTusDatosConsultation($id));
        return $update->updateTusDatosConsultation($requestData);
    }

    public function destroyTusDatosConsultation(int $id): bool
    {
        $update = new TusDatosConsultationRepository($this->getTusDatosConsultation($id));
        return $update->deleteTusDatosConsultation();
    }

    private function getTusDatosConsultation(int $id): TusDatosConsultation
    {
        return $this->tusDatosConsultationRepositoryInterface->findTusDatosConsultationById($id);
    }

    public function launchCustomerConsultation(array $customerIdData): array
    {
        //Example customerIdData
        //$customerIdData =  ["doc" => 1088353252, "typedoc" => "CC", "fechaE" => "06/02/2017"];
        $myJSON = json_encode($customerIdData);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POSTFIELDS, $myJSON);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_USERPWD, "$this->user:$this->password");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_URL, env('TUS_DATOS_PRODUCTION_URL', false) . '/api/launch/');
        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result, true);
    }
}
