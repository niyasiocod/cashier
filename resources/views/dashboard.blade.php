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
                    <!-- Display success message -->
                    @if (session('success'))
                        <div class="bg-green-500 text-white p-4 rounded mb-4">
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif

                    <!-- Display error message -->
                    @if (session('error'))
                        <div class="bg-red-500 text-white p-4 rounded mb-4">
                            <p>{{ session('error') }}</p>
                        </div>
                    @endif

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
                            <br>
                            @if ($subscription->onGracePeriod())
                                <span class="text-red-500 font-semibold ml-2">Your subscription has been cancelled.</span>
                            @else
                                <span class="text-green-500 ml-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                                        <path d="M12.7 4.3a1 1 0 1 0-1.4 1.4L8 9.6 5.7 7.3a1 1 0 0 0-1.4 1.4l3 3a1 1 0 0 0 1.4 0l5-5a1 1 0 0 0 0-1.4z"/>
                                        <path d="M8 0a8 8 0 1 0 8 8A8 8 0 0 0 8 0zM8 14A6 6 0 1 1 8 2a6 6 0 0 1 0 12z"/>
                                    </svg>
                                    Active
                                </span>
                            @endif
                        </p>

                        <!-- Options to Upgrade or Cancel -->
                        <div class="mt-6">
                            @if (!$subscription->onGracePeriod())
                                <a href="{{ route('billing.upgrade') }}" 
                                   style="display: inline-flex; align-items: center; padding: 0.5rem 1rem; background-color: #4c51bf; border: none; border-radius: 0.375rem; font-weight: 600; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; color: #ffffff; cursor: pointer; transition: background-color 0.2s; text-decoration: none;"
                                   onmouseover="this.style.backgroundColor='#434190'" onmouseout="this.style.backgroundColor='#4c51bf'">
                                    Upgrade Plan
                                </a>
                                <form method="POST" action="{{ route('billing.cancel') }}" class="inline">
                                    @csrf
                                    <button type="submit" 
                                            style="display: inline-flex; align-items: center; padding: 0.5rem 1rem; background-color: #e53e3e; border: none; border-radius: 0.375rem; font-weight: 600; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; color: #ffffff; cursor: pointer; transition: background-color 0.2s;"
                                            onmouseover="this.style.backgroundColor='#c53030'" onmouseout="this.style.backgroundColor='#e53e3e'">
                                        Cancel Plan
                                    </button>
                                </form>
                            @else
                                <!-- Resubscribe Button -->
                                <form method="POST" action="{{ route('billing.resubscribe') }}" class="inline mt-4">
                                    @csrf
                                    <button type="submit" 
                                            style="display: inline-flex; align-items: center; padding: 0.5rem 1rem; background-color: #38a169; border: none; border-radius: 0.375rem; font-weight: 600; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; color: #ffffff; cursor: pointer; transition: background-color 0.2s;"
                                            onmouseover="this.style.backgroundColor='#2f855a'" onmouseout="this.style.backgroundColor='#38a169'">
                                        Resubscribe to {{ $plan->name }}
                                    </button>
                                </form>
                            @endif
                        </div>
                    @else
                        <p class="mt-2 text-gray-600">You do not have an active subscription.</p>
                        <a href="{{ route('pricing') }}" 
                           style="display: inline-flex; align-items: center; padding: 0.5rem 1rem; background-color: #48bb78; border: none; border-radius: 0.375rem; font-weight: 600; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; color: #ffffff; cursor: pointer; transition: background-color 0.2s; text-decoration: none;"
                           onmouseover="this.style.backgroundColor='#38a169'" onmouseout="this.style.backgroundColor='#48bb78'">
                            Subscribe Now
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
