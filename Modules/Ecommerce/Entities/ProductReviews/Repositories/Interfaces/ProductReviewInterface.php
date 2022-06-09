<?php

namespace Modules\Ecommerce\Entities\ProductReviews\Repositories\Interfaces;

use Illuminate\Support\Collection;

use Modules\Ecommerce\Entities\ProductReviews\ProductReview;

interface ProductReviewInterface
{
    public function createProductReview(array $data): ProductReview;
    public function listProductReviews(): Collection;
    public function findProductReview(array $data);
    public function updateProductReview(array $data, int $id);
}
