<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Salary Display -->
            <div class="bg-white p-6 shadow sm:rounded-lg mb-4">
                <div class="flex justify-between items-center">
                    <label class="block font-medium text-sm text-gray-700">Salary</label>
                    <input type="text" class="form-input rounded-md shadow-sm mt-1 w-1/3 bg-gray-100" 
                           value="{{ $user->salary }}" readonly>
                </div>
            </div>

            <!-- Machine Name Display -->
            <div class="bg-white p-6 shadow sm:rounded-lg mb-4">
                <div class="flex justify-between items-center">
                    <label class="block font-medium text-sm text-gray-700">Machine Name</label>
                    <input type="text" class="form-input rounded-md shadow-sm mt-1 w-1/3 bg-gray-100" 
                           value="{{ $user->machine ? $user->machine->name : 'No Machine Assigned' }}" readonly>
                </div>
            </div>

            <!-- Update Profile Information -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg mb-4">
                <div class="max-w-xl mx-auto">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Update Password -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg mb-4">
                <div class="max-w-xl mx-auto">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Delete Account -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg mb-4">
                <div class="max-w-xl mx-auto">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
