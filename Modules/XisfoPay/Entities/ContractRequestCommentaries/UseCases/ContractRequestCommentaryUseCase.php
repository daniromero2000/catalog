<?php

namespace Modules\XisfoPay\Entities\ContractRequestCommentaries\UseCases;

use Modules\XisfoPay\Entities\ContractRequestCommentaries\Exceptions\CreateContractRequestCommentaryErrorException;
use Modules\XisfoPay\Entities\ContractRequestCommentaries\Repositories\Interfaces\ContractRequestCommentaryRepositoryInterface;
use Modules\XisfoPay\Entities\ContractRequestCommentaries\UseCases\Interfaces\ContractRequestCommentaryUseCaseInterface;

class ContractRequestCommentaryUseCase implements ContractRequestCommentaryUseCaseInterface
{
    private $contractCommentaryInterface;

    public function __construct(
        ContractRequestCommentaryRepositoryInterface $contractCommentaryRepositoryInterface
    ) {
        $this->contractCommentaryInterface = $contractCommentaryRepositoryInterface;
    }

    public function storeContractRequestCommentary($request)
    {
        $user            = auth()->guard('employee')->user();
        $request['user'] = $user->name . ' ' . $user->last_name;

        try {
            return $this->contractCommentaryInterface->createContractRequestCommentary($request->except('_token', '_method'));
        } catch (CreateContractRequestCommentaryErrorException $e) {
            return redirect()->route('admin.contracts.show', $request->contract_id)
                ->with('error', 'No se pudo crear el comentario');
        }
    }
}
