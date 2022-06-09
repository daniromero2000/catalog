<?php

namespace Modules\Customers\Listeners\Leads\Admin;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Modules\Customers\Entities\Leads\Lead;
use Modules\Customers\Entities\Leads\Repositories\LeadRepository;
use Modules\Customers\Events\Leads\Admin\LeadAdminNotificationWasCreated;

class notifyAdminCreatedLead implements ShouldQueue
{
    use InteractsWithQueue;

    public $lead;
        /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Lead $lead)
    {
        $this->lead = $lead;
    }

        /**
     * Handle the event.
     *
     * @param  LeadFrontWasCreated  $event
     * @return void
     */
    public function handle(LeadAdminNotificationWasCreated $event)
    {
        // send email to customer
        $leadRepository = new LeadRepository($event->lead);
        $leadRepository->sendNewLeadRegisterToAdmin();
    }
}