<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BillingController extends Controller
{
    public function showUpgradeForm()
    {
        // Fetch available plans and show upgrade UI
        $plans = [
            'price_1QPuxhI3nt5ZF2Ew3GBMxqzM' => 'Yearly - $34.99',
            'price_1QPv0qI3nt5ZF2Ew4N9VAvc7' => 'Monthly - $4.99',
            'price_1QPv0qI3nt5ZF2EwRd2JYIfo' => 'Lifetime - $174.99',
        ];

        return view('billing.upgrade', compact('plans'));
    }

    public function cancel(Request $request)
    {
        $user = $request->user();

        if ($user->subscribed('default')) {
            $user->subscription('default')->cancel();
        }

        return redirect()->route('dashboard')->with('status', 'Your subscription has been canceled.');
    }

    /**
     * Handle resubscribe request.
     */
    public function resubscribe(Request $request)
    {
        // Ensure the user is authenticated
        $user = $request->user();

        // Get the user's current subscription
        $subscription = $user->subscription('default');

        if ($subscription->onGracePeriod()) {
            // Resume the subscription if it's canceled and in the grace period
            try {
                $subscription->resume();

                return redirect()->route('dashboard')->with('success', 'Your subscription has been resumed!');
            } catch (\Exception $e) {
                return redirect()->route('dashboard')->with('error', 'Failed to resume the subscription. Please try again.');
            }
        }

        return redirect()->route('dashboard')->with('error', 'No canceled subscription found to resume.');
    }
}
