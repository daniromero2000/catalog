<?php

namespace Modules\Ecommerce\Http\Controllers\Front;

use App\Http\Controllers\Controller;

class ThankUPagePseController extends Controller
{
    public function index()
    {
        return view('layouts.front.thank_you_pages.pse', [
            'order'     => request()->input('order'),
            'total'     => request()->input('total'),
            'customer'  => auth()->user()->name
        ]);
    }
}
