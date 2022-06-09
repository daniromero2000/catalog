<?php

namespace Modules\XisfoPay\Entities\ContractRequestCommentaries\Repositories\Interfaces;

use Modules\XisfoPay\Entities\ContractRequestCommentaries\ContractRequestCommentary;

interface ContractRequestCommentaryRepositoryInterface
{
    public function createContractRequestCommentary(array $data): ContractRequestCommentary;
}
