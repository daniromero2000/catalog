<?php

namespace Modules\Customers\Http\Controllers\Admin\LeadCommentaries;

use Illuminate\Routing\Controller;
use Modules\Customers\Entities\LeadCommentaries\Requests\CreateLeadCommentaryRequest;
use Modules\Customers\Entities\LeadCommentaries\UseCases\Interfaces\LeadCommentaryUseCaseInterface;

class LeadCommentariesController extends Controller
{
    private $leadCommentaryServiceInterface;

    public function __construct(
        LeadCommentaryUseCaseInterface $leadCommentaryUseCaseInterface
    ) {
        $this->middleware(['permission:leads, guard:employee']);
        $this->leadCommentaryServiceInterface = $leadCommentaryUseCaseInterface;
    }

    public function store(CreateLeadCommentaryRequest $request)
    {
        $this->leadCommentaryServiceInterface->storeLeadCommentary($request);

        return redirect()->route('admin.leads.show', $request->lead_id)
            ->with('message', config('messaging.create'));
    }

    public function show(int $id)
    {
        return redirect()->route('admin.dashboard')
            ->with('error', config('messaging.not_found'));
    }
}
