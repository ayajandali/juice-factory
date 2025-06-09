<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-blue-900">Work Details - {{ $status->user->first_name }} {{ $status->user->last_name }}</h2>
    </x-slot>

    <div class="p-6 bg-white rounded-lg shadow-md space-y-6">
        <div>
            <h3 class="font-semibold text-blue-800">Raw Materials Consumed:</h3>
            @if($status->rawMaterials->isEmpty())
                <p class="text-gray-600">No raw materials recorded.</p>
            @else
                <ul class="list-disc list-inside text-blue-700">
                    @foreach($status->rawMaterials as $item)
                        <li>{{ $item->rawMaterial->name }} - Quantity: {{ $item->quantity_used }}</li>
                    @endforeach
                </ul>
            @endif
        </div>

    <div>
    <h3 class="font-semibold text-blue-800">Products Produced:</h3>
    @if($status->products->isEmpty())
        <p class="text-gray-600">No products recorded.</p>
    @else
        <ul class="list-disc list-inside text-blue-700">
            @foreach($status->products as $item)
                <li>
                    {{ $item->product->product_name }}
                    
                    @php
                        $available = $item->product->availableProducts->first();
                    @endphp

                    @if($available)
                        <div class="text-sm text-gray-600 ml-4">
                            Production Date: {{ \Carbon\Carbon::parse($available->production_date)->format('Y-m-d') }}<br>
                            Expiry Date: {{ \Carbon\Carbon::parse($available->expiry_date)->format('Y-m-d') }}<br>
                            Quantity produced: {{$available->quantity}}
                        </div>
                    @else
                        <div class="text-sm text-gray-600 ml-4">
                            No production/expiry info found.
                        </div>
                    @endif
                </li>
            @endforeach
        </ul>
    @endif
</div>



        <a href="{{ route('manager.dailyworkstatus.index') }}" class="text-sm text-blue-600 hover:underline">← Back to list</a>
    </div>
</x-app-layout>
