<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p class="">Ticket Status</p>
                    <div class="flex gap-2 mt-3">
                        <div class="flex-1 ">
                            <div class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">

                                <h5 class="mb-2 text-3xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $ticket_status['open'] }}</h5>
                                <p class="font-normal text-md text-gray-700 dark:text-gray-400">Open Ticket</p>
                            </div>
                        </div>
                        <div class="flex-1 ">
                            <div class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">

                                <h5 class="mb-2 text-3xl font-bold tracking-tight text-gray-900 dark:text-white">
                                    {{ $ticket_status['close'] }}
                                </h5>
                                <p class="font-normal text-md text-gray-700 dark:text-gray-400">Close Ticket</p>
                            </div>
                        </div>
                        <div class="flex-1 ">
                            <div class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">

                                <h5 class="mb-2 text-3xl font-bold tracking-tight text-gray-900 dark:text-white">
                                    {{ $ticket_status['unassigned_agent'] }}
                                </h5>
                                <p class="font-normal text-md text-gray-700 dark:text-gray-400">Ticket With Unassigned Agent</p>
                            </div>
                        </div>
                    </div>
                    <p class="mt-10">Open Ticket Priorities</p>
                    <div class="flex gap-2 mt-3">
                        <div class="flex-1 ">
                            <div class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">

                                <h5 class="mb-2 text-3xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $ticket_priorities['low'] }}</h5>
                                <p class="font-normal text-md text-gray-700 dark:text-gray-400">Low</p>
                            </div>
                        </div>
                        <div class="flex-1 ">
                            <div class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">

                                <h5 class="mb-2 text-3xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $ticket_priorities['normal'] }}</h5>
                                <p class="font-normal text-md text-gray-700 dark:text-gray-400">Normal</p>
                            </div>
                        </div>
                        <div class="flex-1 ">
                            <div class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">

                                <h5 class="mb-2 text-3xl font-bold tracking-tight text-gray-900 dark:text-white">
                                    {{ $ticket_priorities['high'] }}
                                </h5>
                                <p class="font-normal text-md text-gray-700 dark:text-gray-400">High</p>
                            </div>
                        </div>
                        <div class="flex-1 ">
                            <div class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">

                                <h5 class="mb-2 text-3xl font-bold tracking-tight text-gray-900 dark:text-white">
                                    {{ $ticket_priorities['urgent'] }}
                                </h5>
                                <p class="font-normal text-md text-gray-700 dark:text-gray-400">Urgent</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
