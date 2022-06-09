<?php

namespace Modules\XisfoPay\Entities\ContractCommentaries\Repositories\Interfaces;

use Modules\XisfoPay\Entities\ContractCommentaries\ContractCommentary;

interface ContractCommentaryRepositoryInterface
{
    public function createContractCommentary(array $data): ContractCommentary;
}
