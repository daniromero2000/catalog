<?php

namespace Modules\Companies\Entities\CompanyReviews\Repositories\Interfaces;

use Modules\Companies\Entities\CompanyReviews\CompanyReview;

interface CompanyReviewRepositoryInterface
{
    public function createCompanyReview(array $data): CompanyReview;
}
