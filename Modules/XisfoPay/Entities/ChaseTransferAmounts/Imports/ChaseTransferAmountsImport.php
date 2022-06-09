<?php

namespace Modules\XisfoPay\Entities\ChaseTransferAmounts\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Modules\XisfoPay\Entities\ChaseTransferAmounts\Exceptions\CreateChaseTransferAmountErrorException;

class ChaseTransferAmountsImport implements WithMultipleSheets
{
    private $chaseTransferID;

    public function __construct(
        int $chaseTransferID
    ) {
        $this->chaseTransferID = $chaseTransferID;
    }

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }

    public function sheets(): array
    {
        try {
            return [
                new FirstSheetImport($this->chaseTransferID)
            ];
        } catch (CreateChaseTransferAmountErrorException $e) {
            throw new CreateChaseTransferAmountErrorException($e->getMessage());
        }
    }
}
