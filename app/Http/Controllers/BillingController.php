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
}
