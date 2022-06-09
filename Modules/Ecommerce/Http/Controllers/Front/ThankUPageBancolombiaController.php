<?php

namespace Modules\Ecommerce\Http\Controllers\Front;

use App\Http\Controllers\Controller;

class ThankUPageBancolombiaController extends Controller
{
    public function index()
    {
        return view('layouts.front.thank_you_pages.bank', [
            'order' =>  request()->input('order'),
            'total' => request()->input('total'),
            'customer' => auth()->user()->name
        ]);
    }
}
