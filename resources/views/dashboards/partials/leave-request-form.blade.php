<!-- Leave Request Form -->
<div class="bg-white shadow-lg rounded-2xl p-8 max-w-3xl mx-auto my-10 border border-gray-200">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-2xl font-bold text-black">Request a Leave</h3>
        <a href="{{ route('requests') }}" 
           class="inline-flex items-center px-4 py-2 bg-black text-white text-sm font-medium rounded-md hover:bg-gray-800 transition duration-200">
            <span>Show All Requests</span>
            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
            </svg>
        </a>
    </div>

    <form method="POST" action="{{ route('employee.leave-request') }}">
        @csrf

        <!-- Leave Type -->
        <div class="mb-5">
            <label for="leave_type" class="block text-sm font-semibold text-gray-800 mb-1">Leave Type</label>
            <select name="leave_type" id="leave_type" class="w-full border border-gray-300 focus:border-black focus:ring-black rounded-md shadow-sm" required>
                <option value="">-- Select Leave Type --</option>
                <option value="Sick leave">Sick Leave</option>
                <option value="Maternity leave">Maternity Leave</option>
                <option value="Paternity leave">Paternity Leave</option>
                <option value="Emergency leave">Emergency Leave</option>
                <option value="Marriage leave">Marriage Leave</option>
            </select>
        </div>

        <!-- Date Range -->
        <div class="mb-5">
            <label for="date_range" class="block text-sm font-semibold text-gray-800 mb-1">Select Date Range</label>
            <input type="text" id="date_range" name="date_range" class="w-full border border-gray-300 focus:border-black focus:ring-black rounded-md shadow-sm" required>
            @error('date_range')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Payment -->
        <div class="mb-5">
            <label for="is_paid" class="block text-sm font-semibold text-gray-800 mb-1">Payment</label>
            <select name="is_paid" id="is_paid" class="w-full border border-gray-300 focus:border-black focus:ring-black rounded-md shadow-sm" required>
                <option value="">-- Select if you want a paid leave --</option>
                <option value="paid">Paid</option>
                <option value="not_paid">Not Paid</option>
            </select>
        </div>

        <!-- Submit Button -->
        <div class="mt-6">
            <button type="submit" class="w-full bg-black text-white py-2 px-4 rounded-md hover:bg-gray-800 transition duration-200">
                Submit Request
            </button>
        </div>

        <!-- Success Message -->
        @if (session('leave_success'))
            <div class="mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ session('leave_success') }}
            </div>
        @endif

        <!-- Error Messages -->
        @error('start_date')
            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
        @enderror

        @error('end_date')
            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
        @enderror
    </form>
</div>

<!-- Litepicker Initialization -->
<script>
    const picker = new Litepicker({
        element: document.getElementById('date_range'),
        singleMode: false,
        format: 'YYYY-MM-DD',
        autoApply: true,
        minDate: new Date().toISOString().split('T')[0],
        delimiter: ' to ',
    });
</script>
