<?php

namespace Modules\Customers\Entities\LeadCommentaries\UseCases;

use Modules\Customers\Entities\LeadCommentaries\Repositories\Interfaces\LeadCommentaryRepositoryInterface;
use Modules\Customers\Entities\LeadCommentaries\UseCases\Interfaces\LeadCommentaryUseCaseInterface;
use Modules\Generals\Entities\Tools\ToolRepository;

class LeadCommentaryUseCase implements LeadCommentaryUseCaseInterface
{
    private $leadCommentaryInterface;

    public function __construct(
        LeadCommentaryRepositoryInterface $leadCommentaryRepositoryInterface
    ) {
        $this->leadCommentaryInterface = $leadCommentaryRepositoryInterface;
    }

    public function storeLeadCommentary($request)
    {
        $request = $this->userLeadCommentary($request);

        return $this->leadCommentaryInterface->createLeadCommentary($request->except('_token', '_method'));
    }

    public function userLeadCommentary($request)
    {
        $user = ToolRepository::setStaticSignedUser();
        $request['user'] = $user->name . ' ' . $user->last_name;
        return $request;
    }
}
