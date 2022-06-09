<?php

namespace Modules\XisfoPay\Entities\ContractRequests\UseCases;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use Modules\Customers\Entities\CustomerAddresses\Repositories\Interfaces\CustomerAddressRepositoryInterface;
use Modules\Customers\Entities\CustomerCompanies\Repositories\Interfaces\CustomerCompanyRepositoryInterface;
use Modules\Customers\Entities\CustomerEmails\Repositories\Interfaces\CustomerEmailRepositoryInterface;
use Modules\Customers\Entities\CustomerGroups\Repositories\Interfaces\CustomerGroupRepositoryInterface;
use Modules\Customers\Entities\CustomerIdentities\Repositories\Interfaces\CustomerIdentityRepositoryInterface;
use Modules\Customers\Entities\CustomerPhones\Repositories\Interfaces\CustomerPhoneRepositoryInterface;
use Modules\Customers\Entities\Customers\Repositories\Interfaces\CustomerRepositoryInterface;
use Modules\Customers\Entities\CustomerStatusesLogs\UseCases\Interfaces\CustomerStatusesLogUseCaseInterface;
use Modules\Banking\Entities\Banks\Repositories\Interfaces\BankRepositoryInterface;
use Modules\Customers\Entities\Customers\Exceptions\CreateCustomerErrorException;
use Modules\Generals\Entities\Cities\Repositories\Interfaces\CityRepositoryInterface;
use Modules\Generals\Entities\CivilStatuses\Repositories\Interfaces\CivilStatusRepositoryInterface;
use Modules\Generals\Entities\Countries\Repositories\Interfaces\CountryRepositoryInterface;
use Modules\Generals\Entities\Genres\Repositories\Interfaces\GenreRepositoryInterface;
use Modules\Generals\Entities\IdentityTypes\Repositories\Interfaces\IdentityTypeRepositoryInterface;
use Modules\Generals\Entities\PasswordResets\Repositories\Interfaces\PasswordResetRepositoryInterface;
use Modules\Generals\Entities\Provinces\Repositories\Interfaces\ProvinceRepositoryInterface;
use Modules\Generals\Entities\Relationships\Repositories\Interfaces\RelationshipRepositoryInterface;
use Modules\Streamings\Entities\Streamings\Repositories\Interfaces\StreamingRepositoryInterface;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\XisfoPay\Entities\ContractRequests\Exceptions\ContractRequestNotFoundException;
use Modules\XisfoPay\Entities\ContractRequests\Exceptions\CreateContractRequestErrorException;
use Modules\XisfoPay\Entities\ContractRequests\Repositories\ContractRequestRepository;
use Modules\XisfoPay\Entities\ContractRequests\Repositories\Interfaces\ContractRequestRepositoryInterface;
use Modules\XisfoPay\Entities\ContractRequests\UseCases\Interfaces\ContractRequestUseCaseInterface;
use Modules\XisfoPay\Entities\ContractRequestStatuses\Repositories\Interfaces\ContractRequestStatusRepositoryInterface;
use Modules\XisfoPay\Entities\ContractRequestStatusesLogs\UseCases\Interfaces\ContractRequestStatusesLogUseCaseInterface;
use Modules\XisfoPay\Entities\ContractRequestStreamAccountCommissions\Repositories\Interfaces\ContractRequestStreamAccountCommissionRepositoryInterface;
use Modules\XisfoPay\Events\ContractRequests\ContractRequestWasCreated;
use Modules\XisfoPay\Events\ContractRequests\Front\ContractRequestFrontWasCreated;
use Modules\XisfoPay\Mail\ContractRequests\SendUnapprobedRequestsEmailNotificationToAdmin;

class ContractRequestUseCase implements ContractRequestUseCaseInterface
{
    private $toolsInterface, $contractRequestInterface, $contractRequestStatusInterface;
    private $contractRequestStatusesLogServiceInterface, $genreInterface, $cityInterface;
    private $identityTypeInterface, $customerInterface, $customerStatusesLogServiceInterface;
    private $customerCompanyInterface, $customerIdentityInterface, $customerEmailInterface;
    private $customerPhoneInterface, $civilStatusInterface, $customerAddressInterface;
    private $customerGroupInterface, $bankInterface, $relationshipInterface;
    private $streamingInterface, $provinceInterface, $countryInterface, $passwordResetInterface;
    private $contractRequestStreamAccountCommissionInterface;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        ContractRequestRepositoryInterface $contractRequestRepositoryInterface,
        ContractRequestStreamAccountCommissionRepositoryInterface $contractRequestStreamAccountCommissionRepositoryInterface,
        ContractRequestStatusRepositoryInterface $contractRequestStatusRepositoryInterface,
        ContractRequestStatusesLogUseCaseInterface $contractRequestStatusesLogUseCaseInterface,
        GenreRepositoryInterface $genreRepositoryInterface,
        CityRepositoryInterface $cityRepositoryInterface,
        IdentityTypeRepositoryInterface $identityTypeRepositoryInterface,
        CustomerRepositoryInterface $customerRepositoryInterface,
        CustomerStatusesLogUseCaseInterface $customerStatusesLogUseCaseInterface,
        CustomerCompanyRepositoryInterface $customerCompanyRepositoryInterface,
        CustomerIdentityRepositoryInterface $customerIdentityRepositoryInterface,
        CustomerEmailRepositoryInterface $customerEmailRepositoryInterface,
        CustomerPhoneRepositoryInterface $customerPhoneRepositoryInterface,
        CivilStatusRepositoryInterface $civilStatusRepositoryInterface,
        CustomerAddressRepositoryInterface $customerAddressRepositoryInterface,
        CustomerGroupRepositoryInterface $customerGroupRepositoryInterface,
        BankRepositoryInterface $bankRepositoryInterface,
        RelationshipRepositoryInterface $relationshipRepositoryInterface,
        StreamingRepositoryInterface $streamingRepositoryInterface,
        ProvinceRepositoryInterface $provinceRepositoryInterface,
        CountryRepositoryInterface $countryRepositoryInterface,
        PasswordResetRepositoryInterface $passwordResetRepositoryInterface
    ) {
        $this->toolsInterface                                  = $toolRepositoryInterface;
        $this->contractRequestInterface                        = $contractRequestRepositoryInterface;
        $this->contractRequestStatusInterface                  = $contractRequestStatusRepositoryInterface;
        $this->contractRequestStatusesLogServiceInterface      = $contractRequestStatusesLogUseCaseInterface;
        $this->contractRequestStreamAccountCommissionInterface = $contractRequestStreamAccountCommissionRepositoryInterface;
        $this->genreInterface                                  = $genreRepositoryInterface;
        $this->cityInterface                                   = $cityRepositoryInterface;
        $this->identityTypeInterface                           = $identityTypeRepositoryInterface;
        $this->customerInterface                               = $customerRepositoryInterface;
        $this->customerStatusesLogServiceInterface             = $customerStatusesLogUseCaseInterface;
        $this->customerCompanyInterface                        = $customerCompanyRepositoryInterface;
        $this->customerIdentityInterface                       = $customerIdentityRepositoryInterface;
        $this->customerEmailInterface                          = $customerEmailRepositoryInterface;
        $this->customerPhoneInterface                          = $customerPhoneRepositoryInterface;
        $this->civilStatusInterface                            = $civilStatusRepositoryInterface;
        $this->customerAddressInterface                        = $customerAddressRepositoryInterface;
        $this->customerGroupInterface                          = $customerGroupRepositoryInterface;
        $this->bankInterface                                   = $bankRepositoryInterface;
        $this->relationshipInterface                           = $relationshipRepositoryInterface;
        $this->streamingInterface                              = $streamingRepositoryInterface;
        $this->provinceInterface                               = $provinceRepositoryInterface;
        $this->countryInterface                                = $countryRepositoryInterface;
        $this->passwordResetInterface                          = $passwordResetRepositoryInterface;
        $this->module                                          = 'Solicitudes de Contrato';
    }

    public function listContractRequests(array $data): array
    {
        $searchData      = $this->toolsInterface->setSearchParametersRefactor($data);
        $searchData['q'] = $searchData['q']  == '' ? null : $searchData['q'];

        return [
            'data' => [
                'contract_requests'         => $this->contractRequestInterface->searchContractRequest($searchData['q'], $searchData['fromOrigin'], $searchData['toOrigin']),
                'contract_request_statuses' => $this->contractRequestStatusInterface->getAllContractRequestStatusesNames(),
                'optionsRoutes'             => config('generals.optionRoutes'),
                'module'                    => $this->module,
                'contract_requests_total'   => 10,
                'headers'                   => ['Fecha', 'Nombre Legal / Comercial', 'Tipo Cliente', 'Identificador', 'Estado', 'Firmado / Aprobado', 'Opciones'],
            ],
            'search'  =>  $searchData['search']
        ];
    }

    public function listCustomerContractRequests(): array
    {
        $contract_requests =  $this->contractRequestInterface->listContractRequestsFront(auth()->guard('web')->user()->id);
        $enable_create = 1;
        foreach ($contract_requests as $contract_request) {
            if ($contract_request->is_aprobed == 0) {
                $enable_create = 0;
            }
        }

        return [
            'data' => [
                'headers'           => ['Nombre Legal / Comercial', 'Id. Cliente', 'Estado', 'Firmado / Aprobado', 'Opciones'],
                'contract_requests' => $contract_requests,
                'enable_create'     => $enable_create
            ]
        ];
    }

    public function createContractRequest()
    {
        return [
            'optionsRoutes'   => config('generals.optionRoutes'),
            'module'          => $this->module,
            'genres'          => $this->genreInterface->getAllGenresNames(),
            'cities'          => $this->cityInterface->getAllCityNames(),
            'countries'       => $this->countryInterface->getCountriesNames(),
            'identity_types'  => $this->identityTypeInterface->getAllIdentityTypesNames()
                ->whereIn('initials', array('CC', 'Pasaporte', 'CE')),
            'civil_statuses'  => $this->civilStatusInterface->getAllCivilStatusesNames(),
            'customer_groups' => $this->customerGroupInterface->getAllCustomerGroupNames()
                ->whereIn('code', array('estudio', 'modelo', 'satelite_estudio', 'token_sales'))
        ];
    }

    public function createFrontContractRequest()
    {
        return [
            'countries'       => $this->countryInterface->getCountriesNames(),
            'identity_types'  => $this->identityTypeInterface->getAllIdentityTypesNames()
                ->whereIn('initials', array('CC', 'Pasaporte', 'CE'))
        ];
    }

    public function createNewContractRequest(int $id)
    {
        return [
            'id'             => 1,
            'customer_id'    => $id,
            'optionsRoutes'  => config('generals.optionRoutes'),
            'module'         => $this->module,
            'countries'      => $this->countryInterface->getCountriesNames(),
            'identity_types' => $this->identityTypeInterface->getAllIdentityTypesNames()
                ->whereIn('initials', array('rut'))
        ];
    }

    public function createNewFrontContractRequest()
    {
        return [
            'id'             => 1,
            'countries'      => $this->countryInterface->getCountriesNames(),
            'identity_types' => $this->identityTypeInterface->getAllIdentityTypesNames()
                ->whereIn('initials', array('rut'))
        ];
    }

    public function storeContractRequest($request)
    {
        $customer = $this->customerInterface->createCustomer($request->except('_token', '_method'));
        $this->customerStatusesLogServiceInterface->storeCustomerStatusesLog($customer->id, 'Cliente Creado');
        $request['customer_id']     = $customer->id;
        $request['company_address'] = $request['customer_address'];
        $request['company_phone']   = $request['phone'];
        $request['employee_id']     = auth()->guard('employee')->user()->id;
        $this->customerIdentityInterface->createCustomerIdentity($request->except('_token', '_method'));
        $this->customerEmailInterface->createCustomerEmail($request->except('_token', '_method'));
        $this->customerPhoneInterface->createCustomerPhone($request->except('_token', '_method'));
        $this->customerAddressInterface->createCustomerAddress($request->except('_token', '_method'));
        $request['customer_company_id']   = $this->customerCompanyInterface->createCustomerCompany($request->except('_token', '_method'))->id;
        $request['client_identifier']     = $this->getClientIdentifier($request->input(), $this->cityInterface->findCityById($request['city_id'])->city);
        $request['contract_request_type'] = $this->defineContractRequestType($request->input());
        $contractRequest =  $this->contractRequestInterface->createContractRequest($request->except('_token', '_method'));
        $this->contractRequestStatusesLogServiceInterface->storeContractRequestStatusesLog($contractRequest->id, 'Solicitud Creada');
        event(new ContractRequestWasCreated($contractRequest));

        return $contractRequest;
    }


    public function storeFrontContractRequest($request)
    {
        $request['token'] = $request->_token;
        $customer = $this->customerInterface->createCustomer($request->except('_token', '_method'));
        $this->passwordResetInterface->createPasswordReset($request->except('_method'));
        $link =  $this->passwordResetInterface->getResetLink($request, $customer);
        $this->customerStatusesLogServiceInterface->storeFrontCustomerStatusesLog($customer->id, 'Cliente Creado');
        $request['customer_id']     = $customer->id;
        $request['company_address'] = $request['customer_address'];
        $request['company_phone']   = $request['phone'];
        $request['city_id']         = $request['company_city_id'];
        $this->customerIdentityInterface->createCustomerIdentity($request->except('_token', '_method'));
        $this->customerEmailInterface->createCustomerEmail($request->except('_token', '_method'));
        $this->customerPhoneInterface->createCustomerPhone($request->except('_token', '_method'));
        $this->customerAddressInterface->createCustomerAddress($request->except('_token', '_method'));
        $customer_company  = $this->customerCompanyInterface->createCustomerCompany($request->except('_token', '_method'));
        $request['customer_company_id']   = $customer_company->id;
        $request['is_tokens']              = '0';
        $request['client_identifier']     = $this->getClientIdentifier($request->input(), $this->cityInterface->findCityById($request['city_id'])->city);
        $request['contract_request_type'] = $this->defineContractRequestType($request->input());
        $contractRequest =  $this->contractRequestInterface->createContractRequest($request->except('_token', '_method'));
        $this->contractRequestStatusesLogServiceInterface->storeCustomerContractRequestStatusesLog($contractRequest->id, 'Solicitud Creada', $customer);
        event(new ContractRequestFrontWasCreated($contractRequest, $link));

        return [
            'customer_email'     => $customer->email,
            'company_legal_name' => $customer_company->company_legal_name
        ];
    }

    public function storeNewContractRequest($request, int $id)
    {
        $customer = $this->customerInterface->findCustomerById($id);
        $request['identity_type_id']      = '6';
        $request['customer_id']           = $customer->id;
        $request['company_address']       = 'No data';
        $request['company_phone']         = 'No data';
        $request['employee_id']           = auth()->guard('employee')->user()->id;
        $request['city_id']               = $request['company_city_id'];
        $request['contract_request_type'] = $request['constitution_type'];

        if ($request['contract_request_type'] == 'Tokens') {
            $request['constitution_type'] = 'Natural';
            $request['is_tokens'] = '1';
        }

        if ($this->contractRequestInterface->findCustomerContractRequests($customer->id, $request['contract_request_type'])) {
            throw new CreateContractRequestErrorException('No se encuentra');
        } else {
            $customer_company_id = $this->customerCompanyInterface->enableCreateCompany($request, $customer->customerCompanies);

            if ($customer_company_id == 0) {
                $request['company_id_number']   = $request['identity_number'];
                $request['customer_company_id'] = $this->customerCompanyInterface->createCustomerCompany($request->except('_token', '_method'))->id;
            } else {
                $request['customer_company_id'] = $customer_company_id;
            }

            $this->customerIdentityInterface->createCustomerIdentity($request->except('_token', '_method'));
            $request['identity_number']       = $customer->customerIdentities->where('identity_type_id', 1)->first()->identity_number;
            $request['client_identifier']     = $this->getClientIdentifier($request, $this->cityInterface->findCityById($request['city_id'])->city);
            $request['contract_request_type'] = $this->contractType($request['contract_request_type']);
            $contractRequest =  $this->contractRequestInterface->createContractRequest($request->except('_token', '_method'));
            $this->contractRequestStatusesLogServiceInterface->storeContractRequestStatusesLog($contractRequest->id, 'Solicitud Creada');
            return $contractRequest;
        }
    }

    public function storeNewFrontContractRequest($request)
    {
        $customer = $this->customerInterface->findCustomerById(auth()->user()->id);
        $request['identity_type_id']   = '6';
        $request['customer_id']        = $customer->id;
        $request['company_address']    = $customer->customerAddresses[0]->customer_address;
        $request['company_phone']      = $customer->customerPhones[0]->phone;
        $request['city_id']            = $request['company_city_id'];
        $request['given_constitution'] = $request['constitution_type'];
        $request['is_tokens']          = '0';

        if ($request['given_constitution'] == 'Tokens') {
            $request['constitution_type'] = 'Natural';
            $request['is_tokens']         = '1';
        }

        $this->customerIdentityInterface->createCustomerIdentity($request->except('_token', '_method'));

        if ($request['constitution_type'] == 'Natural' && $customer->customerCompanies->where('constitution_type', 'Natural')) {
            $customer_company_id = $customer->customerCompanies->where('constitution_type', 'Natural')->first()->id;
        } else {
            $request['company_id_number'] = $request['identity_number'];
            $customer_company_id = $this->customerCompanyInterface->createCustomerCompany($request->except('_token', '_method'))->id;
        }
        $request['constitution_type']     = $request['given_constitution'];
        $request['customer_company_id']   = $customer_company_id;
        $request['client_identifier']     = $this->getClientIdentifier($request, $this->cityInterface->findCityById($request['city_id'])->city);
        $request['contract_request_type'] = $this->defineContractRequestType($request->input());
        $contractRequest =  $this->contractRequestInterface->createContractRequest($request->except('_token', '_method'));
        $this->contractRequestStatusesLogServiceInterface->storeCustomerContractRequestStatusesLog($contractRequest->id, 'Solicitud Creada', $customer);

        return $contractRequest;
    }

    public function showContractRequest(int $id)
    {
        $contract_request = $this->getContractRequest($id);
        $contract_requests =  $this->contractRequestInterface->listContractRequestsFront($contract_request->customer->id);
        $enable_create = 1;
        foreach ($contract_requests as $item) {
            if ($item->is_aprobed == 0) {
                $enable_create = 0;
            }
        }

        return  [
            'contract_request'          => $contract_request,
            'optionsRoutes'             => config('generals.optionRoutes'),
            'module'                    => $this->module,
            'contract_request_statuses' => $this->contractRequestStatusInterface->getAllContractRequestStatusesNames(),
            'cities'                    => $this->cityInterface->getAllCityNames(),
            'countries'                 => $this->countryInterface->getCountriesNames(),
            'identity_types'            => $this->identityTypeInterface->getAllIdentityTypesNames(),
            'banks'                     => $this->bankInterface->getAllBankNames(),
            'relationships'             => $this->relationshipInterface->getLegalRelationshipsNames(),
            'streamings'                => $this->streamingInterface->getAllStreamingNames()->whereIn(
                'streaming',
                [
                    'Chaturbate', 'BongaCams', 'Stripchat',
                    'Cam4', 'EpayService', 'Streamate',
                    'StreamRay', 'Flirt4Free', 'Venta Tokens',
                    'Factoring', 'ManyVids'
                ]
            ),
            'provinces'                 => $this->provinceInterface->getAllProvincesPrefixes(),
            'enable_create'             => $enable_create,
            'streamAccountCommissions'  => $this->contractRequestStreamAccountCommissionInterface->getAllStreamAccountCommissions()
        ];
    }

    public function updateContractRequest($request, int $id)
    {
        $contractRequest = $this->getContractRequest($id);
        $requestData = $request->except(
            '_token',
            '_method',
        );

        $requestData =  $this->setContractRequestIsAprobed($contractRequest, $requestData);
        $update = new ContractRequestRepository($contractRequest);

        if ($request->hasFile('file')) {
            if ($contractRequest->file) {
                $this->toolsInterface->deleteThumbFromServer($contractRequest->file);
            }
            $requestData['file'] = $this->saveContractRequestFile($request->file('file'), $contractRequest->client_identifier);
        }

        $update->updateContractRequest($requestData);
        $this->contractRequestStatusesLogServiceInterface->storeContractRequestStatusesLog($contractRequest->id, $this->setUpdateLogStatus($contractRequest, $request));

        return $contractRequest;
    }

    public function destroyContractRequest(int $id)
    {
        $update = new ContractRequestRepository($this->getContractRequest($id));
        $update->deleteContractRequest();
    }

    private function getContractRequest(int $id)
    {
        return $this->contractRequestInterface->findContractRequestById($id);
    }

    public function getClientIdentifier($requestData, $city)
    {
        $clientIdentifier = '';

        if ($requestData['constitution_type'] == 'Natural') {
            if ($requestData['is_tokens'] == '1') {
                $clientIdentifier = '02' . substr($city, 0, 3) . $requestData['identity_number'] . '-T';
            } else {
                $clientIdentifier = '02' . substr($city, 0, 3) . $requestData['identity_number'];
            }
        } else {
            $clientIdentifier = '01' . substr($city, 0, 3) . $requestData['identity_number'];
        }

        return $clientIdentifier;
    }

    public function defineContractRequestType($requestData)
    {
        if ($requestData['constitution_type'] == "Natural") {
            if ($requestData['is_tokens'] == '1') {
                return  3;
            } else {
                return 2;
            }
        } else {
            return 1;
        }
    }

    public function contractType($contract_type)
    {
        switch ($contract_type) {
            case 'Natural':
                return 2;
            case 'Jurídica':
                return 1;
            case 'Tokens':
                return 3;
        }
    }

    public function setContractRequestIsAprobed($contractRequest, $requestData)
    {
        if ($contractRequest->is_aprobed == 1 && $requestData['contract_request_status_id'] == 5) {
            $requestData['is_aprobed'] = 1;
            $requestData['is_signed'] = 1;
        }
        return $requestData;
    }

    public function saveContractRequestFile(UploadedFile $file, $client): string
    {
        return $file->store('contract-requests/' . $client, ['disk' => 'public']);
    }

    public function checkIfUnapprobedRequests()
    {
        $unApprobedRequests = $this->contractRequestInterface->findUnapprobedContractRequests();

        if (!$unApprobedRequests->isEmpty()) {
            $this->sendUnapprobedRequestsEmailNotificationToAdmin($unApprobedRequests);
        }
    }

    public function sendUnapprobedRequestsEmailNotificationToAdmin($unApprobedRequests)
    {
        Mail::to(['email' => 'aux.mercadeo.xisfo@gmail.com'])->cc([
            'carlosq.syc@gmail.com',
            'financiero0.syc@gmail.com',
            'juan@xisfo.com'
        ])->queue(new SendUnapprobedRequestsEmailNotificationToAdmin($unApprobedRequests));
    }

    public function setUpdateLogStatus($contractRequest, $request)
    {
        if ($contractRequest->contractRequestStatus->id == $request['contract_request_status_id']) {
            $status = 'Solicitud actualizada';
        } else {
            $contractRequest->setRelations(['contractRequestStatus']);
            $status = $contractRequest->contractRequestStatus->name;
        }

        return $status;
    }
}
