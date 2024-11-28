<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Support\Facades\Log;

class HandleSubscriptionUpdatedAction
{
    /**
     * Handle the action when a subscription is updated.
     *
     * @param  array  $subscriptionData
     * @return void
     */
    public function execute(array $subscriptionData)
    {
        // $data = $subscriptionData['data']['object'];
        // Example: Log the updated subscription info
        Log::info('Subscription updated', $subscriptionData);

        
    }
}
