<?php

namespace Modules\Customers\Http\Controllers\Front\Leads;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Customers\Entities\Leads\Requests\CreateLeadFrontRequest;
use Modules\Customers\Entities\Leads\UseCases\Interfaces\LeadUseCaseInterface;


class LeadsFrontController extends Controller
{
    private $leadUseCaseInterface;

    public function __construct(
        LeadUseCaseInterface $leadUseCaseInterface
    ) {
        $this->leadUseCaseInterface = $leadUseCaseInterface;
    }

    public function index()
    {
        //
    }

    public function create()
    {
        return  view('customers::front.leads.create', $this->leadUseCaseInterface->createLeadFront());
    }


    public function store(CreateLeadFrontRequest $request)
    {
        $this->leadUseCaseInterface->storeLeadFront($request);

        return view('layouts.front.thankyoupage');
    }

    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        //
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
