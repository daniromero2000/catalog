<?php

namespace Modules\Fasecolda\Entities\FasecoldaPrices\UseCases;

use Maatwebsite\Excel\Facades\Excel;
use Modules\Fasecolda\Entities\FasecoldaCodes\Repositories\Interfaces\FasecoldaCodeRepositoryInterface;
use Modules\Fasecolda\Entities\FasecoldaPrices\Imports\FasecoldaPricesImport;
use Modules\Fasecolda\Entities\FasecoldaPrices\Repositories\Interfaces\FasecoldaPriceRepositoryInterface;
use Modules\Fasecolda\Entities\FasecoldaPrices\UseCases\Interfaces\FasecoldaPriceUseCaseInterface;

class FasecoldaPriceUseCase implements FasecoldaPriceUseCaseInterface
{
    private $fasecoldaPriceInterface, $fasecoldaCodeInterface;

    public function __construct(
        FasecoldaPriceRepositoryInterface $fasecoldaPriceRepositoryInterface,
        FasecoldaCodeRepositoryInterface $fasecoldaCodeRepositoryInterface
    ) {
        $this->fasecoldaPriceInterface = $fasecoldaPriceRepositoryInterface;
        $this->fasecoldaCodeInterface  = $fasecoldaCodeRepositoryInterface;
        $this->module                  = 'Valores Fasecolda';
    }

    public function createFasecoldaPrice(): array
    {
        return  [
            'module'        => $this->module,
            'optionsRoutes' => config('generals.optionRoutes')
        ];
    }

    public function storeFasecoldaPrice($file)
    {
        $this->fasecoldaPriceInterface->truncateTable();
        set_time_limit(0);

        return Excel::import(new FasecoldaPricesImport, $file);
    }

    public function findFasecoldaPrice($requestData)
    {
        $fasecoldaCode  = $this->fasecoldaCodeInterface->listFasecoldaCodigo($requestData['ref1'], $requestData['ref2'], $requestData['ref3']);
        return $this->fasecoldaPriceInterface->listFasecoldaPrice($requestData['model'], $fasecoldaCode);
    }
}
