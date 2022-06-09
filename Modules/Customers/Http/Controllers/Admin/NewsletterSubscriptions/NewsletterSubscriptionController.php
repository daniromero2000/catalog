<?php

namespace Modules\Customers\Http\Controllers\Admin\NewsletterSubscriptions;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Customers\Entities\NewsletterSubscriptions\Repositories\Interfaces\NewsletterSubscriptionRepositoryInterface;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;

class NewsletterSubscriptionController extends Controller
{
    private $newsletterSubscriptionInterface, $toolsInterface;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        NewsletterSubscriptionRepositoryInterface $newsletterSubscriptionRepositoryInterface
    ) {
        $this->middleware(['permission:newsletter_subscriptions, guard:employee']);
        $this->toolsInterface                  = $toolRepositoryInterface;
        $this->newsletterSubscriptionInterface = $newsletterSubscriptionRepositoryInterface;
        $this->module                          = 'Suscripciones';
    }

    public function index(Request $request)
    {
        if (request()->has('q')) {
            $skip = 0;
            $list = $this->newsletterSubscriptionInterface->searchSubscription(request()->input('q'));
            $request->session()->flash('message', config('messaging.searching'));
        } else {
            $skip = $this->toolsInterface->getSkip($request->input('skip'));
            $list = $this->newsletterSubscriptionInterface->listNewsletterSubscriptions($skip * 10);
        }

        return view('customers::admin.newsletter-subscriptions.list', [
            'newsletter_subscriptions' => $list,
            'optionsRoutes'            =>  config('generals.optionRoutes'),
            'module'                   => $this->module,
            'skip'                     => $skip,
            'headers'                  => ['Fecha', 'Email',  'Estado', 'Opciones']
        ]);
    }


    public function create()
    {
        return view('customers::create');
    }


    public function store(Request $request)
    {
        //
    }


    public function show(int $id)
    {
        return redirect()->route('admin.newsletter-subscriptions.index')
            ->with('error', config('messaging.not_found'));
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
