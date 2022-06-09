<?php

namespace Modules\Fasecolda\Entities\FasecoldaCodes\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class FasecoldaCodesImport implements WithMultipleSheets
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
