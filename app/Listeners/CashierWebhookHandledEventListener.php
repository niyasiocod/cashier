<?php

namespace App\Listeners;

use Laravel\Cashier\Events\WebhookHandled;

class CashierWebhookHandledEventListener
{
    /**
     * Handle received Stripe webhooks.
     */
    public function handle(WebhookHandled $event): void
    {
        info($event->payload);

        if ($event->payload['type'] === 'customer.subscription.updated') {
            // Handle the incoming event...

            info('WebhookHandled');
        }
    }
}
