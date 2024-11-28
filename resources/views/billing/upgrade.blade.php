<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Upgrade Subscription Plan') }}
        </h2>
    </x-slot>

    <!-- Pricing -->
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <!-- Title -->
        <div class="max-w-2xl mx-auto text-center mb-10 lg:mb-14">
            <h2 class="text-2xl font-bold md:text-4xl md:leading-tight text-gray-800">Subscription Plans</h2>
            <p class="mt-1 text-gray-600">Choose the plan that better fits your needs.</p>
        </div>
        <!-- End Title -->

        <!-- Grid -->
        <div class="mt-12 grid sm:grid-cols-1 lg:grid-cols-3 gap-6 lg:items-center">
            <!-- Monthly Plan -->
            <div class="flex flex-col border border-gray-200 text-center rounded-xl p-8">
                <h4 class="font-medium text-lg text-gray-800">Monthly</h4>
                <span class="mt-5 font-bold text-5xl text-gray-800">
                    <span class="font-bold text-2xl -me-2">$</span>
                    4.99
                </span>
                <p class="mt-2 text-sm text-gray-500">No commitments. Cancel anytime.</p>

                @if (auth()->user()->subscription('default') && auth()->user()->subscription('default')->stripe_price == 'price_1QPv0qI3nt5ZF2Ew4N9VAvc7')
                    <p class="mt-4 text-green-600">You are currently subscribed to this plan.</p>
                @else
                    <form method="POST" action="{{ route('checkout', ['price_id' => 'price_1QPv0qI3nt5ZF2Ew4N9VAvc7']) }}">
                        @csrf
                        <button type="submit" 
                                class="mt-5 py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-indigo-100 text-indigo-800 hover:bg-indigo-200 disabled:opacity-50 disabled:pointer-events-none">
                            Upgrade Plan
                        </button>
                    </form>
                @endif
            </div>

            <!-- Yearly Plan -->
            <div class="flex flex-col border-2 border-indigo-600 text-center shadow-xl rounded-xl p-8">
                <p class="mb-3"><span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-lg text-xs uppercase font-semibold bg-indigo-100 text-indigo-800">Most popular</span></p>
                <h4 class="font-medium text-lg text-gray-800">Yearly</h4>
                <span class="mt-5 font-bold text-5xl text-gray-800">
                    <span class="font-bold text-2xl -me-2">$</span>
                    34.99
                </span>
                <p class="mt-2 text-sm text-gray-500">Save 30% with full access for 1 year.</p>

                @if (auth()->user()->subscription('default') && auth()->user()->subscription('default')->stripe_price == 'price_1QPuxhI3nt5ZF2Ew3GBMxqzM')
                    <p class="mt-4 text-green-600">You are currently subscribed to this plan.</p>
                @else
                    <form method="POST" action="{{ route('checkout', ['price_id' => 'price_1QPuxhI3nt5ZF2Ew3GBMxqzM']) }}">
                        @csrf
                        <button type="submit" 
                                class="mt-5 py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-indigo-600 text-white hover:bg-indigo-700 disabled:opacity-50 disabled:pointer-events-none">
                            Upgrade Plan
                        </button>
                    </form>
                @endif
            </div>

            <!-- Lifetime Plan -->
            <div class="flex flex-col border border-gray-200 text-center rounded-xl p-8">
                <h4 class="font-medium text-lg text-gray-800">Lifetime</h4>
                <span class="mt-5 font-bold text-5xl text-gray-800">
                    <span class="font-bold text-2xl -me-2">$</span>
                    174.99
                </span>
                <p class="mt-2 text-sm text-gray-500">Pay once. Lifetime access.</p>

                @if (auth()->user()->subscription('default') && auth()->user()->subscription('default')->stripe_price == 'price_1QPv0qI3nt5ZF2EwRd2JYIfo')
                    <p class="mt-4 text-green-600">You are currently subscribed to this plan.</p>
                @else
                    <form method="POST" action="{{ route('checkout', ['price_id' => 'price_1QPv0qI3nt5ZF2EwRd2JYIfo']) }}">
                        @csrf
                        <button type="submit" 
                                class="mt-5 py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-indigo-100 text-indigo-800 hover:bg-indigo-200 disabled:opacity-50 disabled:pointer-events-none">
                            Upgrade Plan
                        </button>
                    </form>
                @endif
            </div>

        </div>
        <!-- End Grid -->
    </div>
    <!-- End Pricing -->
</x-app-layout>
