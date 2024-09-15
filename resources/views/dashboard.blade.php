<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                    <h1 class="text-2xl mt-2 font-bold">Hi, {{ auth()->user()->name }}! We're here to fully support you
                        every step of the way!
                    </h1>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mt-6">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Total Tickets</h3>
                    <p class="text-4xl text-white ">{{ $data['tickets'] }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Open Tickets</h3>
                    <p class="text-4xl text-white font-bold">{{ $data['open'] }}</p>
                </div>
                @if (auth()->user()->role === 'admin')
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Closed Tickets</h3>
                        <p class="text-4xl text-white font-bold">{{ $data['closed'] }}</p>
                    </div>
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Total Labels</h3>
                        <p class="text-4xl text-white font-bold">{{ $data['labels'] }}</p>
                    </div>
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Total Categories</h3>
                        <p class="text-4xl text-white font-bold">{{ $data['categories'] }}</p>
                    </div>
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Total Users</h3>
                        <p class="text-4xl text-white font-bold">{{ $data['users'] }}</p>
                    </div>
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Unassigned Tickets</h3>
                        <p class="text-4xl text-white font-bold">{{ $data['unassigned'] }}</p>
                    </div>
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Assigned Tickets</h3>
                        <p class="text-4xl text-white font-bold">{{ $data['assigned'] }}</p>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
