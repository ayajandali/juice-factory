<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-blue-900">Work Details - {{ $status->user->first_name }} {{ $status->user->last_name }}</h2>
    </x-slot>

    <div class="p-6 bg-white rounded-xl shadow-lg space-y-8 mt-4">
        {{-- Raw Materials Section --}}
        <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
            <h3 class="text-lg font-semibold text-blue-800 mb-2">Raw Materials Consumed:</h3>
            @if($status->rawMaterials->isEmpty())
                <p class="text-gray-600 italic">No raw materials recorded.</p>
            @else
                <ul class="list-disc list-inside text-blue-700 space-y-1">
                    @foreach($status->rawMaterials as $item)
                        <li>
                            <span class="font-medium">{{ $item->rawMaterial->name }}</span> - 
                            Quantity: <span class="text-black">{{ $item->quantity_used }}</span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        {{-- Products Section --}}
        <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
            <h3 class="text-lg font-semibold text-blue-800 mb-2">Products Produced:</h3>
            @if($status->products->isEmpty())
                <p class="text-gray-600 italic">No products recorded.</p>
            @else
                <ul class="list-disc list-inside text-blue-700 space-y-2">
                    @foreach($status->products as $item)
                        <li>
                            <span class="font-medium">{{ $item->product->product_name }}</span>
                            @php
                                $available = $item->product->availableProducts->first();
                            @endphp

                            @if($available)
                                <div class="text-sm text-gray-700 ml-5 mt-1 leading-relaxed">
                                    <div>Production Date: <span class="text-black">{{ \Carbon\Carbon::parse($available->production_date)->format('Y-m-d') }}</span></div>
                                    <div>Expiry Date: <span class="text-black">{{ \Carbon\Carbon::parse($available->expiry_date)->format('Y-m-d') }}</span></div>
                                    <div>Quantity produced: <span class="text-black">{{ $available->quantity }}</span></div>
                                </div>
                            @else
                                <div class="text-sm text-gray-600 ml-5 mt-1 italic">
                                    No production/expiry info found.
                                </div>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        {{-- Back Link --}}
        <div>
            <a href="{{ route('manager.dailyworkstatus.index') }}" class="inline-block text-sm text-blue-700 hover:text-blue-900 hover:underline transition">
                ← Back to list
            </a>
        </div>
    </div>
</x-app-layout>
