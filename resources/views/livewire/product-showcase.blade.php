<div class="grid grid-cols-2 lg:grid-cols-4 xl:grid-cols-5 gap-4">
    @foreach($products as $product)
        @php
            // Extract first image from JSON array or use placeholder
            $images = is_string($product->images) ? json_decode($product->images, true) : $product->images;
            $mainImage = !empty($images) && count($images) > 0 ? Storage::url($images[0]) : 'https://via.placeholder.com/300x300?text=No+Image';
        @endphp

        <a href="{{ route('product.show', $product->id) }}"
            class="group flex flex-col h-full bg-white hover:shadow-lg rounded-lg border border-transparent hover:border-slate-200 transition-all duration-200 overflow-hidden relative p-2">

            <!-- Image Container -->
            <div class="aspect-square bg-gray-100 rounded-lg overflow-hidden relative mb-2">
                <img src="{{ $mainImage }}" alt="{{ $product->name }}"
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300 mix-blend-multiply">

                <!-- Badge (Optional) -->
                @if($product->stock_quantity > 0)
                    <div
                        class="absolute top-2 left-2 bg-[#fa8900] text-white text-[10px] font-bold px-2 py-0.5 rounded-sm shadow-sm">
                        Choice
                    </div>
                @endif
            </div>

            <!-- Content -->
            <div class="flex flex-col flex-grow px-1">
                <!-- Title -->
                <h3
                    class="text-sm font-medium text-slate-800 line-clamp-2 leading-snug mb-1 group-hover:text-[#fa8900] transition-colors">
                    <span class="bg-yellow-300 text-[10px] font-bold px-1 rounded-sm mr-1 align-middle">Choice</span>
                    {{ $product->name }}
                </h3>

                <!-- Price -->
                <div class="mt-1">
                    <div class="flex items-baseline gap-0.5">
                        <span class="text-xs font-semibold">TZS</span>
                        <span class="text-xl font-extrabold text-slate-900">{{ number_format($product->price, 0) }}</span>
                        <span class="text-[10px] font-medium text-slate-500 line-through ml-1.5">
                            TZS{{ number_format($product->price * 1.3, 0) }}
                        </span>
                    </div>
                </div>

                <!-- Rating -->
                <div class="flex items-center gap-1 mt-1">
                    <div class="flex text-yellow-400 text-xs">
                        @for($i = 0; $i < 5; $i++)
                            @if($i < floor($product->rating))
                                ★
                            @else
                                ☆
                            @endif
                        @endfor
                    </div>
                    <span class="text-[10px] text-slate-500">{{ number_format($product->rating, 1) }} | 500+ sold</span>
                </div>

                <!-- Footer / Bundle -->
                <div class="mt-2 text-[10px] font-medium text-blue-600 flex items-center gap-1 hover:underline">
                    Bundle deals <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </div>
            </div>
        </a>
    @endforeach
</div>