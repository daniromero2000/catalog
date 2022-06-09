<?php

namespace Modules\Ecommerce\Entities\ProductAttributes\Repositories;

use Modules\Ecommerce\Entities\ProductAttributes\ProductAttribute;

interface ProductAttributeRepositoryInterface
{
    public function findProductAttributeById(int $id): ProductAttribute;
}
