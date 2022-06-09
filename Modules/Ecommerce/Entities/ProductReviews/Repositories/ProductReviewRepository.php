<?php

namespace Modules\Ecommerce\Entities\ProductReviews\Repositories;

use Illuminate\Database\QueryException;
use Modules\Ecommerce\Entities\ProductReviews\ProductReview;
use Modules\Ecommerce\Entities\ProductReviews\Repositories\Interfaces\ProductReviewInterface;
use Modules\Ecommerce\Entities\ProductReviews\Exceptions\CreateProductReviewErrorException;
use Illuminate\Support\Collection;

class ProductReviewRepository implements ProductReviewInterface
{
    protected $model;
    private $columns = [
        'id',
        'name',
        'title',
        'rating',
        'comment',
        'status',
        'product_id',
        'customer_id'
    ];

    public function __construct(ProductReview $ProductReview)
    {
        $this->model = $ProductReview;
    }

    public function createProductReview(array $data): ProductReview
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateProductReviewErrorException($e->getMessage());
        }
    }

    public function listProductReviews(): Collection
    {
        return $this->model->get($this->columns);
    }

    public function findProductReview(array $data)
    {
        return $this->model->where('customer_id',$data['customer_id'])->where('product_id',$data['product_id'])->first();
    }

    public function updateProductReview(array $data, int $id)
    {
        return $this->model->where('id', $id)->where('customer_id',$data['customer_id'])->where('product_id',$data['product_id'])->update($data);

    }

}
