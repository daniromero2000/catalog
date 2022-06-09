<?php

namespace Modules\Fasecolda\Entities\FasecoldaCodes\UseCases\Interfaces;

interface FasecoldaCodeUseCaseInterface
{
    public function getFasecoldaClases();

    public function listFasecoldaCodes(array $data);

    public function createFasecoldaCode(): array;

    public function storeFasecoldaCode($file);

    public function findFasecoldaBrandsWithClase($clase);

    public function findreferences1WithMarca($requestData);

    public function findreferences2WithReference1($requestData);

    public function findreferences3WithReference2($requestData);

    public function findFasecoldaCodeWithReferences($requestData);
}
