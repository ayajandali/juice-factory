<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Accountant Dashboard') }}
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="bg-white shadow-lg sm:rounded-lg p-8">
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-700">Export Invoice</h1>
            </div>

            <!-- Start Form -->
            <form action="{{ route('accountant.export.store') }}" method="POST">
                @csrf
                <div class="space-y-6">

                    <!-- Invoice Number -->
                    <div>
                        <label for="invoice_number" class="block text-sm font-medium text-gray-700">Invoice Number</label>
                        <input type="text" name="invoice_number" id="invoice_number"
                               class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-500 sm:text-sm"
                               required>
                    </div>

                    <!-- Date -->
                    <div>
                        <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                        <input type="date" name="date" id="date"
                               class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-500 sm:text-sm"
                               required>
                    </div>

                    <!-- Products -->
                    <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Products</h3>
                    <div id="product-items">
                        <!-- هنا الصف الأول للمنتج كما في الكود الأصلي -->
                        <div class="product-item flex items-center space-x-4 mb-3">
                            <select name="products[0][product_id]" class="product-select w-1/2 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200" onchange="updateTotalAmount()">
                                @foreach ($products as $item)
                                    @if($item->products)
                                        <option value="{{ $item->products->id }}" data-price="{{ $item->products->price }}">
                                            {{ $item->products->product_name }} - ${{ number_format($item->products->price, 2) }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            <input type="number" name="products[0][quantity]" class="quantity-input w-1/3 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200" placeholder="Quantity" min="1" oninput="updateTotalAmount()">
                        </div>
                    </div>

                    <button type="button" id="add-product-btn" class="mt-3 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                        + Add Product
                    </button>
                </div>


                    <!-- Total Amount -->
                    <div>
                        <label for="total_amount" class="block text-sm font-medium text-gray-700">Total Amount</label>
                        <input type="number" name="total_amount" id="total_amount"
                               class="mt-1 block w-full px-4 py-3 bg-gray-100 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-500 sm:text-sm"
                               readonly>
                    </div>

                   

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" id="description" rows="4"
                                  class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-500 sm:text-sm"></textarea>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-6">
                        <button type="submit"
                                class="w-full py-3 px-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-md shadow-md transition duration-300">
                            Submit Invoice
                        </button>
                    </div>
                </div>
            </form>
            <!-- End Form -->

            @if (session('status'))
                <div class="mt-4 p-4 text-sm text-green-600 bg-green-100 rounded-md">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>

    <!-- JavaScript -->
    <script>
            let productIndex = 1;

            document.getElementById('add-product-btn').addEventListener('click', function () {
                const productItemsDiv = document.getElementById('product-items');

                // انشاء div جديد للمنتج
                const newProductDiv = document.createElement('div');
                newProductDiv.classList.add('product-item', 'flex', 'items-center', 'space-x-4', 'mb-3');

                // خيارات المنتجات HTML (تقدر تجيبها من نفس القائمة في السيرفر أو تبنيها هنا ديناميكياً)
                // هنا أضفتها ثابتة، لكن الأفضل جلبها من السيرفر مباشرة أو تمريرها من Blade
                let optionsHtml = `
                    @foreach ($products as $item)
                        @if($item->products)
                            <option value="{{ $item->products->id }}" data-price="{{ $item->products->price }}">
                                {{ $item->products->product_name }} - ${{ number_format($item->products->price, 2) }}
                            </option>
                        @endif
                    @endforeach
                `;

                newProductDiv.innerHTML = `
                    <select name="products[${productIndex}][product_id]" class="product-select w-1/2 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200" onchange="updateTotalAmount()">
                        ${optionsHtml}
                    </select>
                    <input type="number" name="products[${productIndex}][quantity]" class="quantity-input w-1/3 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200" placeholder="Quantity" min="1" oninput="updateTotalAmount()">
                    <button type="button" class="remove-product-btn px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition">🗑️</button>
                `;

                productItemsDiv.appendChild(newProductDiv);

                productIndex++;

                updateTotalAmount();

                // إضافة حدث حذف للزر الجديد
                newProductDiv.querySelector('.remove-product-btn').addEventListener('click', function () {
                    newProductDiv.remove();
                    updateTotalAmount();
                });
            });

            // تعديل بسيط في updateTotalAmount ليحسب بشكل صحيح بعد حذف أو إضافة المنتجات
            function updateTotalAmount() {
                let total = 0;
                const productItems = document.querySelectorAll('.product-item');

                productItems.forEach(item => {
                    const select = item.querySelector('select');
                    const quantityInput = item.querySelector('.quantity-input');

                    const selectedOption = select.options[select.selectedIndex];
                    const price = parseFloat(selectedOption.getAttribute('data-price')) || 0;
                    const quantity = parseFloat(quantityInput.value) || 0;

                    total += price * quantity;
                });

                document.getElementById('total_amount').value = total.toFixed(2);
            }
        </script>


</x-app-layout>
