<?php

namespace Modules\Customers\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Modules\Customers\Events\Leads\Admin\LeadAdminNotificationWasCreated;
use Modules\Customers\Events\Leads\Front\LeadFrontWasCreated;
use Modules\Customers\Listeners\Leads\Admin\notifyAdminCreatedLead;
use Modules\Customers\Listeners\Leads\Front\notifyCustomerCreatedLead;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        LeadFrontWasCreated::class => [
            notifyCustomerCreatedLead::class,
        ],

        LeadAdminNotificationWasCreated::class => [
            notifyAdminCreatedLead::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
