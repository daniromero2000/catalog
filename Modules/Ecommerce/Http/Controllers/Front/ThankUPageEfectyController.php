<?php

namespace Modules\Ecommerce\Http\Controllers\Front;

use App\Http\Controllers\Controller;

class ThankUPageEfectyController extends Controller
{
    public function index()
    {
        return view('layouts.front.thank_you_pages.efecty', [
            'order' =>  request()->input('order'),
            'total' => request()->input('total')
        ]);
    }
}
