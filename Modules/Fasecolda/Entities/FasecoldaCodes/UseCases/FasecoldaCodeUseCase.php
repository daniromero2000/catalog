<?php

namespace Modules\Fasecolda\Entities\FasecoldaCodes\UseCases;

use Maatwebsite\Excel\Facades\Excel;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\Fasecolda\Entities\FasecoldaCodes\Imports\FasecoldaCodesImport;
use Modules\Fasecolda\Entities\FasecoldaCodes\Repositories\Interfaces\FasecoldaCodeRepositoryInterface;
use Modules\Fasecolda\Entities\FasecoldaCodes\UseCases\Interfaces\FasecoldaCodeUseCaseInterface;
use Modules\Fasecolda\Entities\FasecoldaPrices\Repositories\Interfaces\FasecoldaPriceRepositoryInterface;

class FasecoldaCodeUseCase implements FasecoldaCodeUseCaseInterface
{
    private $fasecoldaCodeInterface, $fasecoldaPriceInterface;

    public function __construct(
        FasecoldaCodeRepositoryInterface $fasecoldaCodeRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface,
        FasecoldaPriceRepositoryInterface $fasecoldaPriceRepositoryInterface
    ) {
        $this->fasecoldaCodeInterface  = $fasecoldaCodeRepositoryInterface;
        $this->fasecoldaPriceInterface = $fasecoldaPriceRepositoryInterface;
        $this->toolsInterface          = $toolRepositoryInterface;
        $this->module                  = 'Códigos Fasecolda';
    }

    public function listFasecoldaCodes(array $data)
    {
        $searchData      = $this->toolsInterface->setSearchParametersRefactor($data);
        $searchData['q'] = $searchData['q']  == '' ? null : $searchData['q'];

        return [
            'data' => [
                'fasecolda_codes' => $this->fasecoldaCodeInterface->searchFasecoldaCode($searchData['q']),
                'optionsRoutes'   => config('generals.optionRoutes'),
                'module'          => $this->module,
                'headers'         => [
                    'Marca', 'Clase',  'Referencia1',  'Referencia2', 'Referencia3',
                    'Servicio', 'Bcpp', 'Importado', 'Potencia', 'TipoCaja',
                    'Cilindraje', 'Nacionalidad', 'CapacidadPasajeros', 'CapacidadCarga',
                    'Puertas', 'AireAcondicionado', 'Ejes', 'Estado', 'Combustible',
                    'Transmision', 'Um', 'PesoCategoria', 'Fecha'
                ],
            ],
            'search'  =>  $searchData['search']
        ];
    }

    public function createFasecoldaCode(): array
    {
        return  [
            'module'        => $this->module,
            'optionsRoutes' => config('generals.optionRoutes')
        ];
    }

    public function storeFasecoldaCode($file)
    {
        $this->fasecoldaCodeInterface->truncateTable();
        set_time_limit(0);
        return Excel::import(new FasecoldaCodesImport, $file);
    }

    public function getFasecoldaClases()
    {
        return  $this->fasecoldaCodeInterface->listFasecoldaClases()->unique('Clase');
    }

    public function findFasecoldaBrandsWithClase($clase)
    {
        $fasecoldaBrandsLists = $this->fasecoldaCodeInterface->listFasecoldaBrands($clase);
        $fasecoldaBrands = [];
        foreach ($fasecoldaBrandsLists as $value) {
            $fasecoldaBrands[$value['Marca']] = $value['Marca'];
        }
        return $fasecoldaBrands;
    }

    public function findreferences1WithMarca($requestData)
    {
        $fasecoldaReferences1List = $this->fasecoldaCodeInterface->listFasecoldaRefs1($requestData['marca'], $requestData['clase']);
        $fasecoldaReferences1 = [];
        foreach ($fasecoldaReferences1List as $value) {
            $fasecoldaReferences1[$value['Referencia1']] = $value['Referencia1'];
        }
        return $fasecoldaReferences1;
    }

    public function findreferences2WithReference1($requestData)
    {
        $fasecoldaReferences2List = $this->fasecoldaCodeInterface->listFasecoldaRefs2($requestData['marca'], $requestData['clase'], $requestData['ref1']);
        $fasecoldaReferences2 = [];
        foreach ($fasecoldaReferences2List as $value) {
            $fasecoldaReferences2[$value['Referencia2']] = $value['Referencia2'];
        }
        return $fasecoldaReferences2;
    }

    public function findreferences3WithReference2($requestData)
    {
        $fasecoldaReferences3List = $this->fasecoldaCodeInterface->listFasecoldaRefs3($requestData['marca'], $requestData['clase'], $requestData['ref1'], $requestData['ref2']);
        $fasecoldaReferences3 = [];
        foreach ($fasecoldaReferences3List as $key => $value) {
            $fasecoldaReferences3[$value['Referencia3']] = $value['Referencia3'];
        }
        return $fasecoldaReferences3;
    }

    public function findFasecoldaCodeWithReferences($requestData)
    {
        $fasecoldaCode      = $this->fasecoldaCodeInterface->listFasecoldaCodigo($requestData['ref1'], $requestData['ref2'], $requestData['ref3']);
        $fasecoldaYearsList = $this->fasecoldaPriceInterface->listFasecoldaYears($fasecoldaCode);
        $fasecoldaYears     = [];
        foreach ($fasecoldaYearsList as $value) {
            $fasecoldaYears[$value['Modelo']] = $value['Modelo'];
        }
        return $fasecoldaYears;
    }
}
