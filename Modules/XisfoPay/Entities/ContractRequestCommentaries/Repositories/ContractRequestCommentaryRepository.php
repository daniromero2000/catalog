<?php

namespace Modules\XisfoPay\Entities\ContractRequestCommentaries\Repositories;

use Illuminate\Database\QueryException;
use Modules\XisfoPay\Entities\ContractRequestCommentaries\ContractRequestCommentary;
use Modules\XisfoPay\Entities\ContractRequestCommentaries\Exceptions\CreateContractRequestCommentaryErrorException;
use Modules\XisfoPay\Entities\ContractRequestCommentaries\Repositories\Interfaces\ContractRequestCommentaryRepositoryInterface;

class ContractRequestCommentaryRepository implements ContractRequestCommentaryRepositoryInterface
{
    protected $model;

    public function __construct(
        ContractRequestCommentary $contractCommentary
    ) {
        $this->model = $contractCommentary;
    }

    public function createContractRequestCommentary(array $data): ContractRequestCommentary
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateContractRequestCommentaryErrorException($e->getMessage());
        }
    }
}
