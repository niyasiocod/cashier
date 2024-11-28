<?php
 
namespace App\Listeners;
 
use Laravel\Cashier\Events\WebhookReceived;
 
class CashierWebhookReceivedEventListener
{
    /**
     * Handle received Stripe webhooks.
     */
    public function handle( WebhookReceived $event): void
    {
        info($event->payload);
        if ($event->payload['type'] === 'invoice.payment_succeeded') {
            // Handle the incoming event...
        }

        if ($event->payload['type'] === 'customer.subscription.updated') {
            info('WebhookReceived');
        }
    }
}