<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-3xl font-extrabold text-gray-900">
                {{ __('Accountant Dashboard') }}
            </h2>
            <div class="text-right text-indigo-600 font-semibold text-lg tracking-wide">
                📊 Smart Invoice Pro
            </div>
        </div>
         <!-- Litepicker CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/litepicker/dist/css/litepicker.css"/>

        <!-- Litepicker JS -->
        <script src="https://cdn.jsdelivr.net/npm/litepicker/dist/bundle.js"></script>

    </x-slot>

    <div class="max-w-7xl mx-auto py-12 px-6 lg:px-8">
        <div class="bg-white shadow-2xl rounded-2xl p-10 space-y-10 border-l-8 border-indigo-500">

            <!-- ✅ Summary Section -->
            <div class="grid md:grid-cols-3 gap-6">
                <div class="bg-gray-50 border border-gray-200 rounded-xl p-6 text-center shadow-sm">
                    <h3 class="text-xl font-bold text-indigo-700">📥 {{ $importCount ?? 0 }}</h3>
                    <p class="text-gray-600 text-sm mt-1">Total Import Invoices</p>
                </div>
                <div class="bg-gray-50 border border-gray-200 rounded-xl p-6 text-center shadow-sm">
                    <h3 class="text-xl font-bold text-indigo-700">📤 {{ $exportCount ?? 0 }}</h3>
                    <p class="text-gray-600 text-sm mt-1">Total Export Invoices</p>
                </div>
                <div class="bg-gray-50 border border-gray-200 rounded-xl p-6 text-center shadow-sm">
                    <h3 class="text-sm font-semibold text-gray-800">🕒 Last Invoice</h3>
                    <p class="text-indigo-600 font-medium mt-1">
                        {{ $lastInvoiceNumber ?? 'N/A' }}
                    </p>
                    <p class="text-gray-500 text-xs">{{ $lastInvoiceDate ?? 'Not Available' }}</p>
                </div>
            </div>

            <!-- Header Buttons -->
            <div class="flex items-center justify-between mt-10">
                <div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-1">Manage Invoices</h3>
                    <p class="text-gray-500 text-sm">Import, export or view all invoice records.</p>
                </div>

                <div class="flex gap-3">
                    <form action="{{ route('accountant.export') }}" method="get">
                        <button type="submit"
                            class="inline-flex items-center gap-2 px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-xl shadow transition">
                            📤 Export
                        </button>
                    </form>

                    <form action="{{ route('accountant.import.salary') }}" method="get">
                        <button type="submit"
                            class="inline-flex items-center gap-2 px-5 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-xl shadow transition">
                            📥 Salary Import
                        </button>
                    </form>

                    <form action="{{ route('accountant.import.raw_materials') }}" method="get">
                        <button type="submit"
                            class="inline-flex items-center gap-2 px-5 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-xl shadow transition">
                            📥 Raw Materials Import
                        </button>
                    </form>
                </div>
            </div>

            <!-- Divider -->
            <div class="border-t border-gray-200 my-6"></div>

            <!-- Invoice Links -->
            <div class="grid md:grid-cols-2 gap-6">
                <a href="{{ route('import.all.invoice') }}"
                    class="block bg-indigo-50 hover:bg-indigo-100 border border-indigo-200 p-6 rounded-xl shadow-sm transition text-center">
                    <h4 class="text-lg font-semibold text-indigo-700 mb-1">📑 Show All Import Invoices</h4>
                    <p class="text-gray-600 text-sm">Browse all invoices received.</p>
                </a>

                <a href="{{ route('export.all.invoice') }}"
                    class="block bg-indigo-50 hover:bg-indigo-100 border border-indigo-200 p-6 rounded-xl shadow-sm transition text-center">
                    <h4 class="text-lg font-semibold text-indigo-700 mb-1">📃 Show All Export Invoices</h4>
                    <p class="text-gray-600 text-sm">Browse all invoices sent.</p>
                </a>
            </div>

        </div>
    </div>

    <div class="max-w-7xl mx-auto py-12 px-6 lg:px-8">
        <div class="bg-white shadow-2xl rounded-2xl p-10 space-y-10 border-l-8 border-indigo-500">

        <!-- Leave Request Form -->
        @include('dashboards.partials.leave-request-form')
        </div>
        
    </div>
</x-app-layout>
