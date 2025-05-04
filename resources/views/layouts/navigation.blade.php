@php
    use App\Models\Notification;
    $notifications = Notification::where('user_id', auth()->id())->where('is_read', false)->get();
@endphp

<nav x-data="{ open: false, showNotifications: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden sm:flex sm:ml-10 space-x-8">
                    @php
                        $role = auth()->user()->role;
                        switch ($role) {
                            case 'Manager':
                                $dashboardRoute = route('manager.dashboard');
                                break;
                            case 'HR':
                                $dashboardRoute = route('hr.dashboard');
                                break;
                            case 'Employee':
                                $dashboardRoute = route('employee.dashboard');
                                break;
                            case 'super-employee':
                                $dashboardRoute = route('super-employee.dashboard');
                                break;
                            case 'Accountant':
                            default:
                                $dashboardRoute = route('accountant.dashboard');
                                break;
                        }
                    @endphp

                    <x-nav-link :href="$dashboardRoute" :active="request()->is('*dashboard*')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Right Side Items -->
            <div class="flex items-center space-x-4">
                <!-- Notification Dropdown -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="relative flex items-center text-gray-600 hover:text-gray-800 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 
                                0118 14.158V11a6.002 6.002 0 
                                00-4-5.659V5a2 2 0 
                                10-4 0v.341C7.67 
                                6.165 6 8.388 6 
                                11v3.159c0 
                                .538-.214 
                                1.055-.595 
                                1.436L4 
                                17h5m6 
                                0v1a3 3 0 
                                11-6 0v-1m6 0H9" />
                        </svg>
                        @if($notifications->count())
                            <span class="absolute top-0 right-0 inline-flex items-center justify-center px-1 py-0.5 text-xs font-bold text-white bg-red-600 rounded-full">
                                {{ $notifications->count() }}
                            </span>
                        @endif
                        <svg class="ml-1 h-3 w-3 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 
                            011.414 0L10 10.586l3.293-3.293a1 1 0 
                            111.414 1.414l-4 4a1 1 0 
                            01-1.414 0l-4-4a1 1 0 
                            010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>

                    <!-- Notifications Dropdown Content -->
                    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-64 bg-white shadow-lg rounded-md z-50">
                        <div class="py-2 px-4 text-sm text-gray-700">
                            @forelse ($notifications as $notification)
                                <div class="border-b border-gray-100 py-2">
                                    {{ $notification->message }}
                                </div>
                            @empty
                                <div class="text-center text-gray-500 py-2">
                                    No new notifications
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- User Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none">
                            <div>{{ Auth::user()->first_name }}</div>
                            <div class="ml-1">
                                <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 
                                    011.414 0L10 10.586l3.293-3.293a1 1 0 
                                    111.414 1.414l-4 4a1 1 0 
                                    01-1.414 0l-4-4a1 1 0 
                                    010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>
