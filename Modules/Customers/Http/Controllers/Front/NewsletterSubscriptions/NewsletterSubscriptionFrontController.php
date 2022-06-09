<?php

namespace Modules\Customers\Http\Controllers\Front\NewsletterSubscriptions;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Customers\Entities\NewsletterSubscriptions\Repositories\Interfaces\NewsletterSubscriptionRepositoryInterface;

class NewsletterSubscriptionFrontController extends Controller
{
    private $newsletterSubscriptionInterface;

    public function __construct(
        NewsletterSubscriptionRepositoryInterface $newsletterSubscriptionRepositoryInterface
    ) {
        $this->newsletterSubscriptionInterface = $newsletterSubscriptionRepositoryInterface;
    }

    public function index()
    {
        return view('customers::index');
    }


    public function create()
    {
        return view('customers::create');
    }


    public function store(Request $request)
    {
        $this->newsletterSubscriptionInterface->createNewsletterSubscription($request->except('_token', '_method'));
        return back()->with('message', 'Gracias por subscribirte');
    }


    public function show($id)
    {
        return view('customers::show');
    }


    public function edit($id)
    {
        return view('customers::edit');
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
