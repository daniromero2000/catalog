<?php

namespace Modules\Ecommerce\Http\Controllers\Front;

use Modules\Ecommerce\Entities\Carts\Requests\AddToCartRequest;
use Modules\Ecommerce\Entities\Carts\Requests\UpdateCartRequest;
use Modules\Ecommerce\Entities\Carts\Repositories\Interfaces\CartRepositoryInterface;
use Modules\Ecommerce\Entities\Couriers\Repositories\Interfaces\CourierRepositoryInterface;
use Modules\Ecommerce\Entities\ProductAttributes\Repositories\ProductAttributeRepositoryInterface;
use Modules\Ecommerce\Entities\Products\Repositories\Interfaces\ProductRepositoryInterface;
use Modules\Ecommerce\Entities\Products\Transformations\ProductTransformable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Ecommerce\Entities\ProductAttributes\Exceptions\ProductAttributeNotFoundException;
use Modules\Ecommerce\Entities\Products\Exceptions\ProductNotFoundException;

class CartController extends Controller
{
    use ProductTransformable;
    private $cartRepo, $productRepo, $courierRepo, $productAttributeRepo;

    public function __construct(
        CartRepositoryInterface $cartRepository,
        ProductRepositoryInterface $productRepository,
        CourierRepositoryInterface $courierRepository,
        ProductAttributeRepositoryInterface $productAttributeRepository
    ) {
        $this->cartRepo             = $cartRepository;
        $this->productRepo          = $productRepository;
        $this->courierRepo          = $courierRepository;
        $this->productAttributeRepo = $productAttributeRepository;
    }

    public function index()
    {
        $courier = $this->courierRepo->getCourier();
        $shippingFee = $this->cartRepo->getShippingFee($courier);

        return view('layouts.front.carts.cart', [
            'cartItems'     => $this->cartRepo->getCartItemsTransformed(),
            'subtotal'      => $this->cartRepo->getSubTotal(),
            'tax'           => $this->cartRepo->getTax(),
            'shippingFee'   => $shippingFee,
            'total'         => $this->cartRepo->getTotal(2, $shippingFee)
        ]);
    }

    public function store(AddToCartRequest $request)
    {
        try {
            $product = $this->productRepo->findProductById($request->input('product'));
        } catch (ProductNotFoundException $e) {
            return back()->with('error', 'El Producto que estás buscando no se encuentra');
        }

        if (isset($product->sale_price) && $product->sale_price != '0') {
            $product->price = $product->sale_price;
        }

        $options = [];
        if ($request->has('productAttribute')) {
            $attr = $this->productAttributeRepo->findProductAttributeById($request->input('productAttribute'));
            if (isset($attr->sale_price) && $attr->sale_price != '0') {
                $product->price = $attr->sale_price;
            } else {
                $product->price = $attr->price;
            }
            $options['product_attribute_id'] = $request->input('productAttribute');
            $options['combination'] = $attr->attributesValues->toArray();
        } elseif ($product->attributes()->count() > 0) {
            $productAttr = $product->attributes()->where('default', 1)->first();
            if (isset($productAttr->sale_price)) {
                $product->price = $productAttr->price;

                if (!is_null($productAttr->sale_price)) {
                    $product->price = $productAttr->sale_price;
                }
            }
        }

        return  $this->cartRepo->addToCart($product, $request->input('quantity'), $options);
    }

    public function update(UpdateCartRequest $request, $id)
    {
        $this->cartRepo->updateQuantityInCart($id, $request->input('quantity'));
        request()->session()->flash('message', config('messaging.update'));
        return 'true';
    }

    public function destroy($id)
    {
        $this->cartRepo->removeToCart($id);
        return redirect()->route('cart.index')->with('message', config('messaging.delete'));
    }

    public function getCart(Request $request)
    {
        $cartItems   = $this->cartRepo->getCartItemsTransformed();
        $data        = [];

        foreach ($cartItems as $key => $value) {
            $data[] = $cartItems[$key];
        }

        $courier = $this->courierRepo->getCourier();
        $shippingFee = $this->cartRepo->getShippingFee($courier);

        if ($request->has('mode')) {
            return  [
                'cartItems'     => $data,
                'subtotal'      => $this->cartRepo->getSubTotal(),
                'tax'           => $this->cartRepo->getTax(),
                'shippingFee'   => $shippingFee,
                'total'         => $this->cartRepo->getTotal()
            ];
        }

        return  [
            'cartItems'     => $data,
            'subtotal'      => $this->cartRepo->getSubTotal(),
            'tax'           => $this->cartRepo->getTax(),
            'shippingFee'   => $shippingFee,
            'total'         => $this->cartRepo->getTotal(2, $shippingFee)
        ];
    }
}
