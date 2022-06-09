<?php

namespace Modules\Companies\Entities\Companies\Repositories\Interfaces;

use Modules\Companies\Entities\Companies\Company;
use Illuminate\Support\Collection;

interface CompanyRepositoryInterface
{
    public function listCompanies(int $totalView): Collection;

    public function createCompany(array $data): Company;

    public function findCompanyById(int $id): Company;

    public function deleteCompany(): bool;

    public function searchCompany(string $text): Collection;
}
