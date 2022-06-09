<?php

namespace Modules\Ecommerce\Http\Controllers\Front;

use Modules\Ecommerce\Entities\Categories\Repositories\CategoryRepository;
use Modules\Ecommerce\Entities\Categories\Repositories\Interfaces\CategoryRepositoryInterface;
use Modules\Ecommerce\Entities\Attributes\Repositories\Interfaces\AttributeRepositoryInterface;
use Modules\Ecommerce\Entities\Products\Repositories\Interfaces\ProductRepositoryInterface;
use App\Http\Controllers\Controller;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;

class CategoryController extends Controller
{
    private $categoryInterface, $attributeInterface, $productRepo;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        CategoryRepositoryInterface $categoryRepositoryInterface,
        AttributeRepositoryInterface $attributeRepositoryInterface,
        ProductRepositoryInterface $productRepository
    ) {
        $this->toolsInterface     = $toolRepositoryInterface;
        $this->categoryInterface  = $categoryRepositoryInterface;
        $this->attributeInterface = $attributeRepositoryInterface;
        $this->productRepo        = $productRepository;
    }

    public function getCategory(string $slug)
    {
        $category = $this->categoryInterface->findCategoryBySlug(['slug' => $slug]);

        $CategoryRepository = new CategoryRepository($category);
        $take = 21;
        if (request()->input('q') && (request()->input('skip') == 0 || request()->input('skip') > 0)) {
            $data[] = request('q');
            foreach ($data as $key => $value) {
                foreach ($data[$key] as $key2 => $value2) {
                    $select[] = $data[$key][$key2];
                }
            }
            $skip     = $this->toolsInterface->getSkip(request()->input('skip'));
            $products = $CategoryRepository->findProductsFilter($select, $skip * $take, $take);
            $count    = $products[1];
            $products = $products[0]->where('is_active', 1);
            $paginate = ceil($count->count()  / $take);
        } elseif (request()->input('skip')) {
            $count    = $CategoryRepository->countProducts();
            $paginate = ceil($count->count()  / $take);
            $skip     = $this->toolsInterface->getSkip(request()->input('skip'));
            $products = $CategoryRepository->findProductsSkip($skip * $take, $take)->where('is_active', 1)->all();
        } else {
            $skip = 0;
            $count    = $CategoryRepository->countProducts();
            $paginate = ceil($count->count() / $take);
            $products = $CategoryRepository->findProductsSkip($skip * $take, $take)->where('is_active', 1)->all();
        }

        $values = $CategoryRepository->getCategoryProductAttributesFront();

        return view('layouts.front.categories.show_category', [
            'category'    => $category,
            'products'    => $products,
            'attributes'  => $this->attributeInterface->listCategoryAttributes($values),
            'bestSellers' => $this->productRepo->listProductGroups('Nuevos'),
            'paginate'    => $paginate,
            'skip'        => $skip
        ]);
    }
}
