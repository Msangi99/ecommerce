<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-3xl font-bold text-slate-900 mb-8">Checkout</h1>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <div class="lg:col-span-8">
                <form id="checkout-form" action="{{ route('checkout.store') }}" method="POST">
                    @csrf

                    <div class="bg-white shadow-sm sm:rounded-lg border border-slate-200 p-6 mb-6">
                        <h2 class="text-lg font-medium text-slate-900 mb-4">1. Shipping Address</h2>

                        @if($addresses->isEmpty())
                            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-4">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-yellow-700">
                                            You need to add a shipping address before you can checkout.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="space-y-4">
                                @foreach($addresses as $address)
                                    <div
                                        class="relative flex items-start p-4 border rounded-lg hover:bg-slate-50 cursor-pointer">
                                        <div class="flex items-center h-5">
                                            <input id="address-{{ $address->id }}" name="address_id" type="radio"
                                                value="{{ $address->id }}" {{ $loop->first ? 'checked' : '' }}
                                                class="focus:ring-[#fa8900] h-4 w-4 text-[#fa8900] border-gray-300">
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label for="address-{{ $address->id }}" class="font-medium text-slate-900 block">
                                                {{ $address->type }}
                                                @if($address->is_default)
                                                    <span
                                                        class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">Default</span>
                                                @endif
                                            </label>
                                            <span class="block text-slate-500">{{ $address->address }}, {{ $address->city }},
                                                {{ $address->state }} {{ $address->zip }}</span>
                                            <span class="block text-slate-500">{{ $address->country }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <div class="mt-6">
                            <a href="{{ route('addresses.create') }}"
                                class="inline-flex items-center text-sm font-medium text-[#fa8900] hover:text-orange-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Add a new address (with map location)
                            </a>
                        </div>
                    </div>

                    <div class="bg-white shadow-sm sm:rounded-lg border border-slate-200 p-6 mb-6">
                        <h2 class="text-lg font-medium text-slate-900 mb-4">2. Payment Method</h2>
                        <div class="flex items-center p-4 border rounded-lg bg-slate-50">
                            <input id="payment-cod" name="payment_method" type="radio" value="cod" checked
                                class="focus:ring-[#fa8900] h-4 w-4 text-[#fa8900] border-gray-300">
                            <label for="payment-cod" class="ml-3 block text-sm font-medium text-slate-900">
                                Cash on Delivery (COD)
                            </label>
                        </div>
                    </div>
                </form>
            </div>

            <div class="lg:col-span-4">
                <div class="bg-white shadow-sm sm:rounded-lg border border-slate-200 p-6 sticky top-4">
                    <h2 class="text-lg font-medium text-slate-900 mb-4">Order Summary</h2>

                    @php
                        $subtotal = $cart->items->sum(function ($item) {
                            return $item->product->price * $item->quantity;
                        });
                        $tax = $subtotal * 0.18;
                        $total = $subtotal + $tax;
                    @endphp

                    <div class="flow-root">
                        <dl class="-my-4 text-sm divide-y divide-slate-200">
                            @foreach($cart->items as $item)
                                <div class="py-4 flex items-center justify-between">
                                    <dt class="text-slate-600 w-2/3 truncate">{{ $item->product->name }}
                                        (x{{ $item->quantity }})</dt>
                                    <dd class="font-medium text-slate-900">TZS
                                        {{ number_format($item->product->price * $item->quantity, 0) }}</dd>
                                </div>
                            @endforeach

                            <div class="py-4 flex items-center justify-between border-t border-slate-200 mt-4">
                                <dt class="text-slate-600">Subtotal</dt>
                                <dd class="font-medium text-slate-900">TZS {{ number_format($subtotal, 0) }}</dd>
                            </div>
                            <div class="py-4 flex items-center justify-between">
                                <dt class="text-slate-600">Tax estimate</dt>
                                <dd class="font-medium text-slate-900">TZS {{ number_format($tax, 0) }}</dd>
                            </div>
                            <div class="py-4 flex items-center justify-between">
                                <dt class="text-base font-medium text-slate-900">Order total</dt>
                                <dd class="text-base font-bold text-[#fa8900]">TZS {{ number_format($total, 0) }}</dd>
                            </div>
                        </dl>
                    </div>

                    <div class="mt-6">
                        <button type="submit" form="checkout-form" @if($addresses->isEmpty()) disabled @endif
                            class="w-full bg-[#fa8900] border border-transparent rounded-full shadow-sm py-3 px-4 text-base font-medium text-white hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fa8900] shadow-md transition-transform active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed">
                            Place Order
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>