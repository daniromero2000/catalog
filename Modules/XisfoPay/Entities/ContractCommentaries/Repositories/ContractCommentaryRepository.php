<?php

namespace Modules\XisfoPay\Entities\ContractCommentaries\Repositories;

use Illuminate\Database\QueryException;
use Modules\XisfoPay\Entities\ContractCommentaries\ContractCommentary;
use Modules\XisfoPay\Entities\ContractCommentaries\Exceptions\CreateContractCommentaryErrorException;
use Modules\XisfoPay\Entities\ContractCommentaries\Repositories\Interfaces\ContractCommentaryRepositoryInterface;

class ContractCommentaryRepository implements ContractCommentaryRepositoryInterface
{
    protected $model;

    public function __construct(ContractCommentary $contractCommentary)
    {
        $this->model = $contractCommentary;
    }

    public function createContractCommentary(array $data): ContractCommentary
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateContractCommentaryErrorException($e->getMessage());
        }
    }
}
