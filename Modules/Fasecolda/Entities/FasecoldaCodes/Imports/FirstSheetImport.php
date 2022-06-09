<?php

namespace Modules\Fasecolda\Entities\FasecoldaCodes\Imports;

use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Modules\Fasecolda\Entities\FasecoldaCodes\Exceptions\CreateFasecoldaCodeErrorException;
use Modules\Fasecolda\Entities\FasecoldaCodes\FasecoldaCode;

class FirstSheetImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            try {
                FasecoldaCode::create([
                    'Novedad'            => $row[0],
                    'Marca'              => $row[1],
                    'Clase'              => $row[2],
                    'Codigo'             => $row[3],
                    'Homologocodigo'     => $row[4],
                    'Referencia1'        => $row[5],
                    'Referencia2'        => $row[6],
                    'Referencia3'        => $row[7],
                    'Peso'               => $row[8],
                    'IdServicio'         => $row[9],
                    'Servicio'           => $row[10],
                    'Bcpp'               => $row[11],
                    'Importado'          => $row[12],
                    'Potencia'           => $row[13],
                    'TipoCaja'           => $row[14],
                    'Cilindraje'         => $row[15],
                    'Nacionalidad'       => $row[16],
                    'CapacidadPasajeros' => $row[17],
                    'CapacidadCarga'     => $row[18],
                    'Puertas'            => $row[19],
                    'AireAcondicionado'  => $row[20],
                    'Ejes'               => $row[21],
                    'Estado'             => $row[22],
                    'Combustible'        => $row[23],
                    'Transmision'        => $row[24],
                    'Um'                 => $row[25],
                    'PesoCategoria'      => $row[26],
                ]);
            } catch (QueryException $e) {
                throw new CreateFasecoldaCodeErrorException($e->getMessage());
            }
        }
    }
}
