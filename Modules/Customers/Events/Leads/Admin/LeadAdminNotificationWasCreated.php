<?php

namespace Modules\Customers\Events\Leads\Admin;

use Illuminate\Queue\SerializesModels;
use Modules\Customers\Entities\Leads\Lead;

class LeadAdminNotificationWasCreated
{
    use SerializesModels;

    public $lead;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Lead $lead)
    {
        $this->lead = $lead;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}