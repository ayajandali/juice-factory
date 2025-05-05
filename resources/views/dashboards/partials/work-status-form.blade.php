<!-- Daily Work Status Form -->
<div class="bg-white shadow-md rounded-lg p-8 max-w-3xl mx-auto my-10">
    <h2 class="text-xl font-semibold text-[#011491] mb-4">Daily Work Status</h2>

    <form method="POST" action="{{ route('super-employee.store') }}">
        @csrf

        <!-- Work Status -->
        <div class="mb-4">
            <label for="work_status" class="block text-sm font-medium text-gray-700 mb-1">Work Status</label>
            <select id="work_status" name="work_status" class="w-full border border-gray-300 rounded-xl shadow-sm px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300" required>
                <option value="">-- Select Work Status --</option>
                <option value="Completed">Completed</option>
                <option value="Pending">Pending</option>
                <option value="Delayed">Delayed</option>
            </select>
        </div>

        <!-- Notes -->
        <div class="mb-4">
            <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
            <textarea id="notes" name="notes" rows="3" class="w-full border border-gray-300 rounded-xl shadow-sm px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300"></textarea>
        </div>

        <!-- Date -->
        <div class="mb-4">
            <label for="date" class="block text-sm font-medium text-gray-700 mb-1">Date</label>
            <input type="text" id="daily_date" name="date" class="w-full border border-gray-300 rounded-xl shadow-sm px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300" required>
        </div>

        <!-- Submit Button -->
        <div class="mt-4">
            <x-primary-button class="bg-[#2a3a9f] hover:bg-[#4856a3] focus:ring-blue-300">
                Submit Status
            </x-primary-button>
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="mt-4 p-3 text-green-700 bg-green-100 border border-green-300 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        <!-- Date Duplicate Error -->
        @error('date_duplicate')
            <div class="text-red-600 text-sm mt-2">{{ $message }}</div>
        @enderror
    </form>
</div>


<script>
    const picker2 = new Litepicker({
        element: document.getElementById('daily_date'),
        singleMode: true, // يحدد أنه اختيار يوم واحد فقط
        format: 'YYYY-MM-DD',
        maxDate: new Date(), // يمنع اختيار تاريخ بالمستقبل (اختياري)
    });
</script>

