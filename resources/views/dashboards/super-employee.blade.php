<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Supervisor Employee Dashboard') }}
        </h2>
    </x-slot>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Daily Work Status Form -->
           @include('dashboards.partials.work-status-form')
        </div> 

        <div>
            <!-- Leave Request Form -->
            @include('dashboards.partials.leave-request-form')
            
        </div>
</x-app-layout>
