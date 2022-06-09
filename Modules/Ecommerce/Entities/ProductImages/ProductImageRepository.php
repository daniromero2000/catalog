<?php

namespace Modules\Ecommerce\Entities\ProductImages;

use Modules\Ecommerce\Entities\Products\Product;

class ProductImageRepository
{
    protected $model;
    private $columns = [];

    public function __construct(ProductImage $productImage)
    {
        $this->model = $productImage;
    }

    public function findProduct(): Product
    {
        return $this->model->product;
    }
}
