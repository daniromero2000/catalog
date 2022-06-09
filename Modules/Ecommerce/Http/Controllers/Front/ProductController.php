<?php

namespace Modules\Ecommerce\Http\Controllers\Front;

use Modules\Ecommerce\Entities\Products\Repositories\Interfaces\ProductRepositoryInterface;
use Modules\Ecommerce\Entities\Products\Transformations\ProductTransformable;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\Ecommerce\Entities\Products\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use ProductTransformable;
    private $productRepo;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        ProductRepositoryInterface $productRepository
    ) {
        $this->toolsInterface = $toolRepositoryInterface;
        $this->productRepo    = $productRepository;
    }

    public function search(Request $request)
    {
        if (request()->has('q') && request()->input('q') != '') {
            $list = $this->productRepo->searchProduct(request()->input('q'));
        } else {
            $skip = $this->toolsInterface->getSkip($request->input('skip'));
            $list = $this->productRepo->listProducts($skip * 10);
        }

        $products = $list->where('status', 1)->map(function (Product $item) {
            return $this->transformProduct($item);
        });

        return view('ecommerce::front.products.product-search', [
            'products' => $products->all()
        ]);
    }

    public function show(string $slug)
    {
        if ($slug) {
            $product = $this->productRepo->findProductBySlug(['slug' => $slug]);
            $reviews        =   $product->reviews;
            $total_rating   =   0;
            $cant_reviews   =   count($reviews);
            $ratings        =   [];
            if ($cant_reviews > 0) {
                foreach ($reviews as $item) {
                    $total_rating   +=  $item->rating;
                    $ratings[]  =   $item->rating;
                }
                // para el promedio se toma el total de ratings y se divide entre la cantidad de reviews
                $promedio = round(($total_rating / $cant_reviews), 1);
            } else {
                $promedio = 0;
            }
            // variable para mostrar que cantidad de voto por estrella se ha dado
            $contador = array_count_values($ratings);
            // para obtener el % de voto por estrella hay q almacenar en varias variables la cantidad de voto por cada estrella
            // (cant_1,cant_2,cant_3,cant_4,cant_5),
            // luego para obtener cada porcentaje se debe tomar  cant_? multiplicarlo por 100 y dividirlo por el total de reviews
            // esto nos da el procentaje de votos por estrella
            $cant_1 = 0;
            $cant_2 = 0;
            $cant_3 = 0;
            $cant_4 = 0;
            $cant_5 = 0;
            $x1 = 0;
            $x2 = 0;
            $x3 = 0;
            $x4 = 0;
            $x5 = 0;
            // if 1 exist en raitings
            if (array_key_exists(1, $contador)) {
                $cant_1 = $contador[1];
            }
            // if 2 exist en raitings
            if (array_key_exists(2, $contador)) {
                $cant_2 = $contador[2];
            }
            // if 3 exist en raitings
            if (array_key_exists(3, $contador)) {
                $cant_3 = $contador[3];
            }
            // if 4 exist en raitings
            if (array_key_exists(4, $contador)) {
                $cant_4 = $contador[4];
            }
            // if 5 exist en raitings
            if (array_key_exists(5, $contador)) {
                $cant_5 = $contador[5];
            }
            // porcentajes de votos por estrella en variables
            if ($cant_reviews > 0) {
                $x1 = round((($cant_1 * 100) / $cant_reviews), 1);
                $x2 = round((($cant_2 * 100) / $cant_reviews), 1);
                $x3 = round((($cant_3 * 100) / $cant_reviews), 1);
                $x4 = round((($cant_4 * 100) / $cant_reviews), 1);
                $x5 = round((($cant_5 * 100) / $cant_reviews), 1);
            }
            // agrego el promedio al objeto producto

            return view('layouts.front.products.show_product', [
                'product'               =>  $product,
                'images'                =>  $product->images,
                'bestSellers'           =>  $this->productRepo->listProductGroups('Nuevos'),
                'productAttributes'     =>  $product->attributes,
                'category'              =>  $product->categories()->first(),
                'promedioRating'        =>  $promedio,
                'cant_reviews'          =>  $cant_reviews,
                'contador'              =>  $contador,
                'x1'                    =>  $x1,
                'x2'                    =>  $x2,
                'x3'                    =>  $x3,
                'x4'                    =>  $x4,
                'x5'                    =>  $x5,
                'imagenes'              => $product->images->toArray()
            ]);
        } else {
            return false;
        }
    }

    public function outlet()
    {
        return view('layouts.front.outlet.outlet', [
            'products' => $this->productRepo->listProductGroups('Outlet'),
            'bestSellers' => $this->productRepo->listProductGroups('Nuevos')
        ]);
    }

    public function getImages($id)
    {
        $product        =   $this->productRepo->findProductBySlug(['id' => $id]);
        $imagenes[0] =  'storage/' . $product->cover;
        foreach ($product->images as $key => $value) {
            $imagenes[$key + 1] =  'storage/' . $value->src;
        }
        return $imagenes;
    }

    public function getAtributes($id)
    {
        $product =  $this->productRepo->findProductBySlug(['id' => $id]);
        $result = array();

        foreach ($product->attributes as $key => $atribute) {
            foreach ($atribute->attributesValues as $key => $attributes_value) {
                if ($attributes_value->attribute->name == 'Color') {
                    $atribute->color = $attributes_value->description;
                    $result[$attributes_value->value][] = $atribute;
                }
            }
        }
        return $result;
    }
}
