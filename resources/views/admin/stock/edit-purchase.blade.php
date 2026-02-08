<x-admin-layout>
    <div class="py-12 px-8">
        <div class="max-w-4xl mx-auto">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-slate-900">Edit Purchase</h1>
                    <p class="mt-2 text-slate-600">Update purchase details.</p>
                </div>
                <a href="{{ route('admin.stock.purchases') }}" class="text-slate-600 hover:text-slate-900">Back to List</a>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-6">
                <form action="{{ route('admin.stock.update-purchase', $purchase->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Date -->
                        <div class="col-span-1">
                            <label for="date" class="block text-sm font-medium text-slate-700 mb-1">Date of Purchase</label>
                            <input type="date" name="date" id="date" value="{{ old('date', $purchase->date) }}" disabled class="w-full rounded-md border-slate-300 bg-slate-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 cursor-not-allowed">
                        </div>

                        <!-- Distributor -->
                        <div class="col-span-1">
                            <label for="distributor_name" class="block text-sm font-medium text-slate-700 mb-1">Distributor Name</label>
                            <input list="distributors" name="distributor_name" id="distributor_name" value="{{ old('distributor_name', $purchase->distributor_name) }}" disabled class="w-full rounded-md border-slate-300 bg-slate-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 cursor-not-allowed">
                        </div>

                        <!-- Category -->
                        <div class="col-span-1">
                            <label for="category_id" class="block text-sm font-medium text-slate-700 mb-1">Category</label>
                            <select name="category_id" id="category_id" disabled class="w-full rounded-md border-slate-300 bg-slate-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 cursor-not-allowed">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $purchase->product->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Model -->
                        <div class="col-span-1">
                            <label for="model" class="block text-sm font-medium text-slate-700 mb-1">Model (Product Name)</label>
                            <input type="text" name="model" id="model" value="{{ old('model', $purchase->product->name ?? '') }}" disabled class="w-full rounded-md border-slate-300 bg-slate-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 cursor-not-allowed">
                        </div>

                        <!-- Quantity -->
                        <div class="col-span-1">
                            <label for="quantity" class="block text-sm font-medium text-slate-700 mb-1">Quantity</label>
                            <input type="number" name="quantity" id="quantity" value="{{ old('quantity', $purchase->quantity) }}" disabled class="w-full rounded-md border-slate-300 bg-slate-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 cursor-not-allowed">
                        </div>

                        <!-- Unit Price -->
                        <div class="col-span-1">
                            <label for="unit_price" class="block text-sm font-medium text-slate-700 mb-1">Unit Price</label>
                            <input type="number" step="0.01" name="unit_price" id="unit_price" value="{{ old('unit_price', $purchase->unit_price) }}" disabled class="w-full rounded-md border-slate-300 bg-slate-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 cursor-not-allowed">
                        </div>

                        <!-- Total Value (Read Only) -->
                        <div class="col-span-2">
                            <label for="total_amount" class="block text-sm font-medium text-slate-700 mb-1">Total Purchase Value</label>
                            <input type="text" id="total_amount" readonly class="w-full rounded-md border-slate-300 bg-slate-100 shadow-sm cursor-not-allowed font-bold text-gray-700" value="{{ number_format($purchase->quantity * $purchase->unit_price, 2) }}">
                        </div>

                        <div class="col-span-2 border-t border-slate-100 pt-4 mt-2">
                            <h3 class="text-lg font-medium text-slate-900 mb-4">Payment Details</h3>
                        </div>

                        <!-- Paid Date -->
                        <div class="col-span-1">
                            <label for="paid_date" class="block text-sm font-medium text-slate-700 mb-1">Paid Date</label>
                            <input type="date" name="paid_date" id="paid_date" value="{{ old('paid_date', $purchase->paid_date) }}" class="w-full rounded-md border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <!-- Paid Amount -->
                        <div class="col-span-1">
                            <label for="paid_amount" class="block text-sm font-medium text-slate-700 mb-1">Paid Amount</label>
                            <input type="number" step="0.01" name="paid_amount" id="paid_amount" value="{{ old('paid_amount', $purchase->paid_amount) }}" min="0" class="w-full rounded-md border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('paid_amount') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Payment Status -->
                        <div class="col-span-2">
                            <label for="payment_status" class="block text-sm font-medium text-slate-700 mb-1">Status</label>
                            <select name="payment_status" id="payment_status" required class="w-full rounded-md border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="pending" {{ old('payment_status', $purchase->payment_status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="partial" {{ old('payment_status', $purchase->payment_status) == 'partial' ? 'selected' : '' }}>Partial</option>
                                <option value="paid" {{ old('payment_status', $purchase->payment_status) == 'paid' ? 'selected' : '' }}>Paid</option>
                            </select>
                            @error('payment_status') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end gap-3">
                        <a href="{{ route('admin.stock.purchases') }}" class="bg-gray-100 text-gray-800 px-6 py-2 rounded-lg hover:bg-gray-200 transition-colors">
                            Cancel
                        </a>
                        <button type="submit" class="bg-[#fa8900] text-white px-6 py-2 rounded-lg hover:bg-[#fa8900]/90 transition-colors font-medium">
                            Update Purchase
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function calculateTotal() {
            const qty = parseFloat(document.getElementById('quantity').value) || 0;
            const price = parseFloat(document.getElementById('unit_price').value) || 0;
            const total = qty * price;
            document.getElementById('total_amount').value = total.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2});
        }
    </script>
</x-admin-layout>
