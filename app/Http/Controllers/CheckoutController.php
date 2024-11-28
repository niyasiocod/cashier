<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class CheckoutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, string $price_id)
    {
        // Ensure the user is authenticated
        $user = $request->user();

        // Define your price IDs for clarity
        $recurringPrices = [
            'monthly' => 'price_1QPv0qI3nt5ZF2Ew4N9VAvc7',
            'yearly' => 'price_1QPuxhI3nt5ZF2Ew3GBMxqzM',
        ];

        $lifetimePrice = 'price_1QPv0qI3nt5ZF2EwRd2JYIfo';

        // Check if the price is recurring or one-time
        if (in_array($price_id, $recurringPrices)) {
            // Handle subscription plans
            return $user->newSubscription('default', $price_id)->checkout([
                'success_url' => route('success'), // Ensure 'success' route is defined in web.php
                'cancel_url' => route('dashboard'), // Ensure 'dashboard' route is defined in web.php
            ]);
        } elseif ($price_id === $lifetimePrice) {
            // Handle one-time payment for Lifetime plan
            Stripe::setApiKey(config('cashier.secret')); // Use the Stripe secret key from your .env file

            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [
                    [
                        'price' => $price_id,
                        'quantity' => 1,
                    ]
                ],
                'mode' => 'payment', // Use 'payment' for one-time payments
                'success_url' => route('success'),
                'cancel_url' => route('dashboard'),
            ]);

            // Redirect to Stripe Checkout page
            return redirect($session->url);
        }

        // If the price_id is invalid
        abort(404, 'Invalid price ID');
    }
}
