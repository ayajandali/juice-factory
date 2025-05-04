<!-- Leave Request Form -->

<div class="bg-white shadow-md rounded-lg p-8 max-w-3xl mx-auto my-10">
    <h3 class="text-2xl font-bold text-[#011491] mb-6">Request a Leave</h3>

    <form method="POST" action="{{ route('employee.leave-request') }}">
        @csrf

        <!-- Leave Type -->
        <div class="mb-5">
            <label for="leave_type" class="block text-sm font-medium text-gray-700 mb-1">Leave Type</label>
            <select name="leave_type" id="leave_type" class="w-full border-gray-300 focus:border-[#011491] focus:ring-[#011491] rounded-md shadow-sm" required>
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
            <label for="date_range" class="block text-sm font-medium text-gray-700 mb-1" class="w-full border-gray-300 focus:border-[#011491] focus:ring-[#011491] rounded-md shadow-sm"
            >Select Date Range</label>
            <input type="text" id="date_range" name="date_range" class="w-full border-gray-300 focus:border-[#011491] focus:ring-[#011491] rounded-md shadow-sm " required>
            @error('date_range')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Payment -->
        <div class="mb-5">
            <label for="is_paid" class="block text-sm font-medium text-gray-700 mb-1">Payment</label>
            <select name="is_paid" id="is_paid" class="w-full border-gray-300 focus:border-[#011491] focus:ring-[#011491] rounded-md shadow-sm" required>
                <option value="">-- Select if you want a paid leave --</option>
                <option value="paid">Paid</option>
                <option value="not_paid">Not Paid</option>
            </select>
        </div>

        <!-- Submit Button -->
        <div class="mt-6">
            <x-primary-button class="bg-[#011491] hover:bg-[#011491] focus:ring-[#011491]">Submit Request</x-primary-button>
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

<!-- Link to all requests -->
<div class="flex justify-end mt-6">
    <a href="{{ route('requests') }}" 
       class="inline-flex items-center px-4 py-2 bg-[#011491] text-white text-sm font-medium rounded-md shadow hover:bg-[#011491] transition duration-200">
       <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" stroke-width="2"
       viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
      <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
  </svg>
  
        Show All Requests
    </a>
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
