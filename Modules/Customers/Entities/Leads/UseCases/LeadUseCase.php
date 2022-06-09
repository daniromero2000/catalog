<?php

namespace Modules\Customers\Entities\Leads\UseCases;

use Modules\Customers\Entities\CustomerChannels\Repositories\Interfaces\CustomerChannelRepositoryInterface;
use Modules\Customers\Entities\Leads\Repositories\Interfaces\LeadRepositoryInterface;
use Modules\Customers\Entities\Leads\Repositories\LeadRepository;
use Modules\Customers\Entities\Leads\UseCases\Interfaces\LeadUseCaseInterface;
use Modules\Customers\Entities\LeadStatuses\Repositories\Interfaces\LeadStatusRepositoryInterface;
use Modules\Customers\Entities\LeadStatusesLogs\Repositories\Interfaces\LeadStatusesLogRepositoryInterface;
use Modules\Customers\Entities\Services\Repositories\Interfaces\ServiceRepositoryInterface;
use Modules\Generals\Entities\Cities\Repositories\Interfaces\CityRepositoryInterface;
use Modules\Generals\Entities\Countries\Repositories\Interfaces\CountryRepositoryInterface;
use Modules\Generals\Entities\Provinces\Repositories\Interfaces\ProvinceRepositoryInterface;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\Customers\Events\Leads\Admin\LeadAdminNotificationWasCreated;
use Modules\Customers\Events\Leads\Front\LeadFrontWasCreated;
use Illuminate\Support\Facades\Log;
use Modules\Customers\Entities\LeadReasons\Repositories\Interfaces\LeadReasonRepositoryInterface;
use Modules\Customers\Entities\Leads\Lead;

class LeadUseCase implements LeadUseCaseInterface
{
    private $leadRepositoryInterface, $cityInterface, $customerChannelInterface;
    private $leadStatusInterface, $toolsInterface, $serviceInterface;
    private $leadStatusesLogInterface, $countryInterface, $provinceInterface;

    public function __construct(
        LeadRepositoryInterface $leadRepositoryInterface,
        CityRepositoryInterface $cityRepositoryInterface,
        CountryRepositoryInterface $countryRepositoryInterface,
        ProvinceRepositoryInterface $provinceRepositoryInterface,
        CustomerChannelRepositoryInterface $customerChannelRepositoryInterface,
        LeadStatusRepositoryInterface $leadStatusRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface,
        ServiceRepositoryInterface $serviceRepositoryInterface,
        LeadStatusesLogRepositoryInterface $leadStatusesLogRepositoryInterface,
        LeadReasonRepositoryInterface $leadReasonRepositoryInterface
    ) {
        $this->leadRepositoryInterface  = $leadRepositoryInterface;
        $this->cityInterface            = $cityRepositoryInterface;
        $this->customerChannelInterface = $customerChannelRepositoryInterface;
        $this->leadStatusInterface      = $leadStatusRepositoryInterface;
        $this->toolsInterface           = $toolRepositoryInterface;
        $this->serviceInterface         = $serviceRepositoryInterface;
        $this->leadStatusesLogInterface = $leadStatusesLogRepositoryInterface;
        $this->countryInterface         = $countryRepositoryInterface;
        $this->provinceInterface        = $provinceRepositoryInterface;
        $this->leadReasonInterface      = $leadReasonRepositoryInterface;
        $this->module                   = 'Leads';
    }


    public function listLeads(array $data): array
    {
        $searchData      = $this->toolsInterface->setSearchParametersRefactor($data);
        $searchData['q'] = $searchData['q']  == '' ? null : $searchData['q'];

        if (auth()->guard('employee')->user()->hasRole('subsidiary_supervisor')) {
            $subsidiaryId = auth()->guard('employee')->user()->subsidiary_id;
            $list     = $this->leadRepositoryInterface->searchSubsidiaryLead($searchData['q'], $subsidiaryId, $searchData['fromOrigin'], $searchData['toOrigin']);
        } else {
            $list     = $this->leadRepositoryInterface->searchLead($searchData['q'], $searchData['fromOrigin'], $searchData['toOrigin']);
        }

        return [
            'data' => [
                'leads'             => $list,
                'optionsRoutes'     => config('generals.optionRoutes'),
                'module'            => $this->module,
                'headers'           => ['FECHA DE CREACIÓN', 'NOMBRE(S) / APELLIDO(S)', 'CIUDAD', 'CANAL', 'MOTIVO DE REGISTRO', 'ESTADO', 'OPCIONES'],
                'cities'            => $this->cityInterface->getAllCityNames(),
                'countries'         => $this->countryInterface->getCountriesNames(),
                'provinces'         => $this->provinceInterface->getAllProvincesPrefixes(),
                'customer_channels' => $this->customerChannelInterface->getAllCustomerChannelNames(),
                'lead_statuses'     => $this->leadStatusInterface->getAllLeadStatusesNames(),
                'services'          => $this->serviceInterface->getAllServicesNames(),
            ],
            'search'  =>  $searchData['search']
        ];
    }

    public function createLead()
    {
        return [
            'optionsRoutes'     => config('generals.optionRoutes'),
            'module'            => $this->module,
            'countries'         => $this->countryInterface->getCountriesNames(),
            'cities'            => $this->cityInterface->getAllCityNames(),
            'countries'         => $this->countryInterface->getCountriesNames(),
            'provinces'         => $this->provinceInterface->getAllProvincesPrefixes(),
            'customer_channels' => $this->customerChannelInterface->getAllCustomerChannelNames(),
            'lead_statuses'     => $this->leadStatusInterface->getAllLeadStatusesNames(),
            'services'          => $this->serviceInterface->getAllServicesNames(),
            'reasons'           => $this->leadReasonInterface->getAllLeadReasonsNames()
        ];
    }

    public function createLeadFront()
    {
        return [
            'cities'  => $this->cityInterface->getAllCityNames(),
            'reasons' => $this->leadReasonInterface->getAllLeadReasonsNames()
        ];
    }

    public function storeLead(array $requestData)
    {
        $lead     = $this->leadRepositoryInterface->createlead($requestData);
        $employee = $this->toolsInterface->setSignedUser();
        $user     = $employee->name . ' ' . $employee->last_name;

        $this->createLeadStatusLog($lead, 'Lead creado por panel administrativo', $user);
    }

    public function storeLeadFront($request)
    {
        $requestData = $request->except('_method', '_token');
        $requestData = $this->setLeadSubsidiary($requestData);
        $requestData['customer_chanel_id'] = 12;
        $requestData['leads_status_id']    = 3;
        $lead = $this->leadRepositoryInterface->createlead($requestData);
        $this->confirmLogDataPolitics($request);
        $user = $lead->name . ' ' . $lead->last_name;
        $this->createLeadStatusLog($lead, 'Lead creado por cliente en página web', $user);

        event(new LeadAdminNotificationWasCreated($lead));
        event(new LeadFrontWasCreated($lead));
    }

    public function showLead(int $id): array
    {
        return  [
            'lead'              => $this->getLead($id),
            'cities'            => $this->cityInterface->getAllCityNames(),
            'countries'         => $this->countryInterface->getCountriesNames(),
            'provinces'         => $this->provinceInterface->getAllProvincesPrefixes(),
            'customer_channels' => $this->customerChannelInterface->getAllCustomerChannelNames(),
            'lead_statuses'     => $this->leadStatusInterface->getAllLeadStatusesNames(),
            'services'          => $this->serviceInterface->getAllServicesNames()
        ];
    }


    public function updateLead(array $requestData, $id)
    {
        $lead   = $this->getLead($id);
        $update = new LeadRepository($lead);
        $update->updateLead($requestData);
        $this->getLogStatus($lead, $requestData['lead_status_id']);
    }

    private function getLogStatus($lead, $status)
    {
        if ($lead->leadStatus->id == $status) {
            $this->createLeadStatusLog($lead, 'Datos de lead actualizados');
        } else {
            $lead = $lead->fresh();
            $this->createLeadStatusLog($lead, 'Estado de lead actualizado a ' . $lead->leadStatus->name);
        }
    }

    public function destroyLead(int $id)
    {
        $update = new LeadRepository($this->getLead($id));
        $update->deleteLead();
    }

    private function getLead(int $id): Lead
    {
        return $this->leadRepositoryInterface->findLeadById($id);
    }

    public function setLeadSubsidiary(array $requestData)
    {
        switch ($requestData['city_id']) {
            case $requestData['city_id'] == 830:
                $requestData['subsidiary_id'] = 1;
                break;
            case $requestData['city_id'] == 834:
                $requestData['subsidiary_id'] = 3;
                break;
            case $requestData['city_id'] == 319:
                $requestData['subsidiary_id'] = 4;
                break;
            default:
                break;
        }
        return $requestData;
    }

    public function createLeadStatusLog($lead, string $status)
    {
        $user = auth()->guard('employee')->user() ? auth()->guard('employee')->user() : $lead;

        $data = array(
            'lead_id' => $lead->id,
            'status'  => $status,
            'user'    => $user->name . ' ' . $user->last_name
        );

        $this->leadStatusesLogInterface->createLeadStatusesLog($data);
    }

    public function confirmLogDataPolitics($request)
    {
        $logchannel = config('logging.channels.leads.name');

        if ($logchannel == null) {
            return false;
        }

        $message = 'Info: Customer:' . $request->getClientIp() . ' User ' . ($request->name) . ' ' . ($request->last_name) .
            ' confirm data politics. Is woman and adult. With the following information:' . ' phone: ' .
            ($request->phone) . ' email: ' . ($request->email) . ' city: ' . ($request->city_id) . '.';
        Log::channel($logchannel)->info($message);
    }
}
