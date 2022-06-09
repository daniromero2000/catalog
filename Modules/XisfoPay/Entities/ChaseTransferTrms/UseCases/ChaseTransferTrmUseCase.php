<?php

namespace Modules\XisfoPay\Entities\ChaseTransferTrms\UseCases;

use Modules\Banking\Entities\Banks\Repositories\Interfaces\BankRepositoryInterface;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\XisfoPay\Entities\PaymentBankTransfers\Repositories\Interfaces\PaymentBankTransferRepositoryInterface;
use Modules\XisfoPay\Entities\ChaseTransferTrms\Repositories\ChaseTransferTrmRepository;
use Modules\XisfoPay\Entities\ChaseTransferTrms\Repositories\Interfaces\ChaseTransferTrmRepositoryInterface;
use Modules\XisfoPay\Entities\ChaseTransferTrms\UseCases\Interfaces\ChaseTransferTrmUseCaseInterface;
use Modules\XisfoPay\Entities\PaymentRequests\Repositories\Interfaces\PaymentRequestRepositoryInterface;
use Modules\XisfoPay\Entities\PaymentRequests\UseCases\Interfaces\PaymentRequestUseCaseInterface;

class ChaseTransferTrmUseCase implements ChaseTransferTrmUseCaseInterface
{
    private $toolsInterface, $chaseTransferTrmInterface;
    private $bankInterface;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        BankRepositoryInterface $bankRepositoryInterface,
        ChaseTransferTrmRepositoryInterface $chaseTransferTrmRepositoryInterface,
        PaymentRequestRepositoryInterface $paymentRequestRepositoryInterface,
        PaymentBankTransferRepositoryInterface $paymentBankTransferRepositoryInterface,
        PaymentRequestUseCaseInterface $paymentRequestUseCaseInterface
    ) {
        $this->toolsInterface                 = $toolRepositoryInterface;
        $this->bankInterface                  = $bankRepositoryInterface;
        $this->chaseTransferTrmInterface         = $chaseTransferTrmRepositoryInterface;
        $this->paymentRequestInterface        = $paymentRequestRepositoryInterface;
        $this->paymentBankTransferInterface   = $paymentBankTransferRepositoryInterface;
        $this->paymentRequestServiceInterface = $paymentRequestUseCaseInterface;
        $this->module                         = 'TRMS';
    }

    public function listChaseTransferTrms(array $data): array
    {
        $searchData      = $this->toolsInterface->setSearchParametersRefactor($data);
        $searchData['q'] = $searchData['q']  == '' ? null : $searchData['q'];
        $searchData['where'] = array_key_exists('status', $data['search']) ?
            ($data['search']['status'] == "1" ? 1 : 0) : null;

        $list     = $this->chaseTransferTrmInterface->searchChaseTransferTrms($searchData['q'], $searchData['fromOrigin'], $searchData['toOrigin'], $searchData['where']);

        return [
            'data' => [
                'chaseTransferTrms' => $list,
                'optionsRoutes'  => config('generals.optionRoutes'),
                'module'         => $this->module,
                'headers'        => ['TRM', 'BANCO', 'USUARIO',  'ESTADO', 'FECHA DE CREACIÓN', 'ACCIONES'],
            ],
            'search'  =>  $searchData['search']
        ];
    }

    public function createChaseTransferTrm()
    {
        return [
            'banks'         => $this->bankInterface->getAllBankNames()->whereIn('name', array('Davivienda', 'Bancolombia', 'Banco de Occidente', 'BBVA Colombia')),
            'optionsRoutes' => config('generals.optionRoutes'),
            'module'        => $this->module
        ];
    }

    public function storeChaseTransferTrm(array $requestData)
    {
        $user                = $this->toolsInterface->setSignedUser();
        $requestData['user'] = $user->name . ' ' . $user->last_name;
        $this->chaseTransferTrmInterface->deactivateTRMs($requestData['bank_id']);
        $this->chaseTransferTrmInterface->createChaseTransferTrm($requestData);
    }

    public function updateChaseTransferTrm(array $requestData, int $id)
    {
        $user                         = $this->toolsInterface->setSignedUser();
        $requestData['user_approves'] = $user->name . ' ' . $user->last_name;
        $update                       = new ChaseTransferTrmRepository($this->getChaseTransferTrm($id));
        $update->updateChaseTransferTrm($requestData);
    }

    public function getChaseTransferTrm(int $id)
    {
        return $this->chaseTransferTrmInterface->findChaseTransferTrmById($id);
    }

    public function destroyChaseTransferTrm(int $id)
    {
        $update = new ChaseTransferTrmRepository($this->getChaseTransferTrm($id));
        $update->deleteChaseTransferTrm();
    }
}
