<?php

namespace Modules\Ecommerce\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Modules\Ecommerce\Entities\ProductReviews\Repositories\Interfaces\ProductReviewInterface;

class ProductReviewController extends Controller
{
    private $productReviewInterf;

    public function __construct(
        ProductReviewInterface $productReviewInterface
    ) {
        $this->productReviewInterf  = $productReviewInterface;
    }

    public function store(Request $request)
    {
        if (Auth::check()) {
            $data = [
                'name'          =>  '', //$request->input('name'),
                'title'         =>  '', //$request->input('title'),
                'rating'        =>  $request->input('rating'),
                'comment'       =>  $request->input('comment'),
                'status'        =>  '', //$request->input('status'),
                'product_id'    =>  $request->input('product_id'),
                'customer_id'   =>  auth()->user()->id,
            ];
            return $this->productReviewInterf->createProductReview($data);
        }
        return 'login';
    }

    public function edit($id)
    {
        if (Auth::check()) {
            $data = [
                'product_id'          =>  $id,
                'customer_id'         =>  auth()->user()->id,
            ];
            $response = [
                'data' => $this->productReviewInterf->findProductReview($data),
                'res' => 'succes'
            ];
            return $response;
        }
        return 'login';
    }

    public function update(Request $request, $id)
    {
        $data = [
            'name'          =>  '', //$request->input('name'),
            'title'         =>  '', //$request->input('title'),
            'rating'        =>  $request->input('rating'),
            'comment'       =>  $request->input('comment'),
            'status'        =>  '', //$request->input('status'),
            'product_id'    =>  $request->input('product_id'),
            'customer_id'   =>  auth()->user()->id
        ];
        return $this->productReviewInterf->updateProductReview($data, $id);
    }
}
