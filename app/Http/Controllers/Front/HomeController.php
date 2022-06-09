<?php

namespace App\Http\Controllers\Front;

use Modules\Ecommerce\Entities\Products\Repositories\Interfaces\ProductRepositoryInterface;

class HomeController
{
    private $productRepo;

    public function __construct(
        ProductRepositoryInterface $productRepository
    ) {
        $this->productRepo = $productRepository;
    }

    public function index()
    {
        return view('layouts.front.index', [
            'bestSellers' => $this->productRepo->listProductGroups('Más Popular')
        ]);
    }
}
