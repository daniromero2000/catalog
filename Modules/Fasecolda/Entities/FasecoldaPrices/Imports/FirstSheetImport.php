<?php

namespace Modules\Fasecolda\Entities\FasecoldaPrices\Imports;

use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Modules\Fasecolda\Entities\FasecoldaPrices\Exceptions\CreateFasecoldaPriceErrorException;
use Modules\Fasecolda\Entities\FasecoldaPrices\FasecoldaPrice;

class FirstSheetImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            try {
                if ($row[2] > 0) {
                    FasecoldaPrice::create([
                        'Codigo' => $row[0],
                        'Modelo' => $row[1],
                        'Valor'  => $row[2],
                    ]);
                }
            } catch (QueryException $e) {
                throw new CreateFasecoldaPriceErrorException($e->getMessage());
            }
        }
    }
}
