<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="text-xl font-semibold mb-4">Subscription Details</p>

                    @php
                        $subscription = auth()->user()->subscription('default');
                        $plan = $subscription 
                            ? \App\Models\Plan::where('stripe_price_id', $subscription->stripe_price)->first()
                            : null;
                    @endphp

                    @if ($subscription && $plan)
                        <p class="mt-2 text-gray-600">
                            You are subscribed to the <strong>{{ $plan->name }}</strong>.
                            <br>
                            Renewal Date: {{ \Carbon\Carbon::createFromTimestamp($subscription->asStripeSubscription()->current_period_end)->format('M d, Y') }}
                        </p>

                        <!-- Options to Upgrade or Cancel -->
                        <div class="mt-6">
                            <a href="{{ route('billing.upgrade') }}" 
                               class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Upgrade Plan
                            </a>
                            <a href="{{ route('billing.cancel') }}" 
                               class="ml-4 inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Cancel Plan
                            </a>
                        </div>
                    @else
                        <p class="mt-2 text-gray-600">You do not have an active subscription.</p>
                        <a href="{{ route('billing.subscribe') }}" 
                           class="mt-4 inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Subscribe Now
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
