<?php

namespace Modules\XisfoPay\Entities\ContractCommentaries\UseCases;

use Modules\Generals\Entities\Tools\ToolRepository;
use Modules\XisfoPay\Entities\ContractCommentaries\Repositories\Interfaces\ContractCommentaryRepositoryInterface;
use Modules\XisfoPay\Entities\ContractCommentaries\UseCases\Interfaces\ContractCommentaryUseCaseInterface;

class ContractCommentaryUseCase implements ContractCommentaryUseCaseInterface
{
    private $contractCommentaryInterface;

    public function __construct(
        ContractCommentaryRepositoryInterface $contractCommentaryRepositoryInterface
    ) {
        $this->contractCommentaryInterface = $contractCommentaryRepositoryInterface;
    }

    public function storeContractCommentary($request)
    {
        $user            = ToolRepository::setStaticSignedUser();
        $request['user'] = $user->name . ' ' . $user->last_name;
        return $this->contractCommentaryInterface->createContractCommentary($request->except('_token', '_method'));
    }
}
