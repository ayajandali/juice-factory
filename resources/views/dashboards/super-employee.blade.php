<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Supervisor Employee Dashboard') }}
        </h2>
        <!-- Litepicker CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/litepicker/dist/css/litepicker.css"/>

        <!-- Litepicker JS -->
        <script src="https://cdn.jsdelivr.net/npm/litepicker/dist/bundle.js"></script>

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
