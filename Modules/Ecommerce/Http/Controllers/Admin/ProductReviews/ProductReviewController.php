<?php

namespace Modules\Ecommerce\Http\Controllers\Admin\ProductReviews;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Ecommerce\Entities\ProductReviews\ProductReview;
use Modules\Ecommerce\Entities\ProductReviews\Repositories\ProductReviewRepository;
use Modules\Ecommerce\Entities\ProductReviews\Repositories\Interfaces\ProductReviewInterface;
use Modules\Ecommerce\Entities\ProductReviews\Requests\CreateProductReviewRequest;


class ProductReviewController extends Controller
{
    private $ProductReviewRepo;

    public function __construct(
        ProductReviewInterface $ProductReviewInterface
    ) {
        $this->ProductReviewRepo  = $ProductReviewInterface;
    }

    public function index()
    {
        /* //return('Hola');
        return view('ecommerce::admin.product-reviews.list', [
            'productReviews' => $this->ProductReviewRepo->listProductReviews ()
        ]);
        // if(!is_null(auth()->user())){
        //     return $this->ProductReviewRepo->listProductReview(auth()->user()->id);
        // }

        // return redirect('admin.login'); */
    }

    public function create()
    {
        /* if (!is_null(auth()->user())) {
            $data = [
                'product_id' => $request->input('id'),
                'rating' => $request->input('rating'),
                'customer_id' => auth()->user()->id,
            ];

            return $this->ProductReviewRepo->createProductReview($data);
        } */
    }

    public function store(Request $request)
    {
        /* if (!is_null(auth()->user())) {
            $data = [
                'product_id' => $request->input('id'),
                'customer_id' => auth()->user()->id
            ];

            return $this->ProductReviewRepo->createProductReview($data);
        } */
        // $this->ProductReviewRepo->createProductReview($request->all());

        // return redirect()->route('admin.brands.ProductReview')
        //     ->with('message', config('messaging.create'));
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update($request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
