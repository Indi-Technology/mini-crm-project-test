<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4"">
        <div class="py-5">
            <div class="max-w-sm mx-auto sm:px-6 lg:px-4">
                <div class="grid bg-white h-30 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="ps-6 pt-6 text-gray-900">
                        <p>Total Ticket:</p>
                    </div>
                    <div class="px-6 pb-6 text-gray-900 justify-self-center">
                        <p class="mt-3 text-4xl">{{ $tiket_count }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-5">
            <div class="max-w-sm mx-auto sm:px-6 lg:px-4">
                <div class="grid bg-white h-30 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="ps-6 pt-6 text-gray-900">
                        <p>Status Open:</p>
                    </div>
                    <div class="px-6 pb-6 text-gray-900 justify-self-center">
                        <p class="mt-3 text-4xl">{{ $status_open }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-5">
            <div class="max-w-sm mx-auto sm:px-6 lg:px-4">
                <div class="grid bg-white h-30 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="ps-6 pt-6 text-gray-900">
                        <p>Status In progress:</p>
                    </div>
                    <div class="px-6 pb-6 text-gray-900 justify-self-center">
                        <p class="mt-3 text-4xl">{{ $status_progress }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-5">
            <div class="max-w-sm mx-auto sm:px-6 lg:px-4">
                <div class="grid bg-white h-30 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="ps-6 pt-6 text-gray-900">
                        <p>Status Closed:</p>
                    </div>
                    <div class="px-6 pb-6 text-gray-900 justify-self-center">
                        <p class="mt-3 text-4xl">{{ $status_closed }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
