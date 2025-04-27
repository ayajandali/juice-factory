 <!-- Daily Work Status Form -->
 <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-4">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Daily Work Status</h3>
                <form method="POST" action="{{ route('super-employee.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Work Status</label>
                        <select name="work_status" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                            <option value="">-- Select Work Status --</option>
                            <option value="Completed">Completed</option>
                            <option value="Pending">Pending</option>
                            <option value="Delayed">Delayed</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Notes</label>
                        <textarea name="notes" rows="3" class="form-input rounded-md shadow-sm mt-1 block w-full"></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Date</label>
                        <input type="date" name="date" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                    </div>

                    <x-primary-button>Submit Status</x-primary-button>

                    @if (session('success'))
                    <div class="p-4 mb-4 text-green-500 bg-green-100 rounded-md">
                        {{ session('success') }}
                    </div>
                    @endif

                    <!-- Display errors specific to Daily Work Status form -->
                    @error('date_duplicate')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
                </form>
            </div>