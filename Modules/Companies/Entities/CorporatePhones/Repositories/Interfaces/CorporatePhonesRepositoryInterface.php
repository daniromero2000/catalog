<?php

namespace Modules\Companies\Entities\CorporatePhones\Repositories\Interfaces;

use Illuminate\Support\Collection;
use Modules\Companies\Entities\CorporatePhones\CorporatePhone;


interface CorporatePhonesRepositoryInterface
{
    public function createCorporatePhone(array $data): CorporatePhone;

    public function updateCorporatePhone(array $data): bool;

    public function findCorporatePhoneById(int $id): CorporatePhone;

    public function listCorporatePhones(int $totalView): Collection;

    public function deleteCorporatePhone(): bool;

    public function searchCorporatePhones(string $text = null): Collection;

    public function countCorporatePhones(string $text = null,  $from = null, $to = null);

    public function getAllCorporatePhones(): Collection;
}
