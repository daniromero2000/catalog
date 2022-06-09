<?php

namespace Modules\Fasecolda\Entities\FasecoldaCodes\Repositories\Interfaces;


use Modules\Fasecolda\Entities\FasecoldaCodes\FasecoldaCode;

interface FasecoldaCodeRepositoryInterface
{
    public function listFasecoldaBrands($clase);

    public function listFasecoldaRefs1($marca, $clase);

    public function listFasecoldaRefs2($marca, $clase, $ref1);

    public function listFasecoldaRefs3($marca, $clase, $ref1, $ref2);

    public function listFasecoldaCodigo($ref1, $ref2, $ref3);

    public function listFasecoldaClases();

    public function truncateTable();

    public function searchFasecoldaCode(string $text = null);
}
