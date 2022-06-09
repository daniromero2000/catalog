<?php

namespace Modules\Companies\Entities\CompanyReviews\Repositories;

use Modules\Companies\Entities\CompanyReviews\CompanyReview;
use Modules\Companies\Entities\CompanyReviews\Repositories\Interfaces\CompanyReviewRepositoryInterface;
use Illuminate\Database\QueryException;
use Modules\Companies\Entities\CompanyReviews\Exceptions\CreateCompanyReviewErrorException;

class CompanyReviewRepository implements CompanyReviewRepositoryInterface
{
    protected $model;

    public function __construct(CompanyReview $companyReview)
    {
        $this->model = $companyReview;
    }

    public function createCompanyReview(array $data): CompanyReview
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateCompanyReviewErrorException($e->getMessage());
        }
    }
}
