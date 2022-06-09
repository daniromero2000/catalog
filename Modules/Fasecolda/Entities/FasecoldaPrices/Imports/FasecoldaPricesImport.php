<?php

namespace Modules\Fasecolda\Entities\FasecoldaPrices\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class FasecoldaPricesImport implements WithMultipleSheets
{
    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }

    public function sheets(): array
    {
        return [
            new FirstSheetImport()
        ];
    }
}
