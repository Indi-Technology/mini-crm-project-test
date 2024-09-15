<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            {{ __('Ticket Log') }}
        </h2>
    </x-slot>

    @php
        setlocale(LC_ALL, 'IND');
        \Carbon\Carbon::setLocale('id');
    @endphp

    <div class="py-5">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <div class="flex item-center">
                        <div class="p-4 bg-white ">
                            <label for="table-search" class="sr-only">Search</label>
                            <div class="relative mt-1">
                                <div
                                    class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 " aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                    </svg>
                                </div>
                                <input type="text" id="table-search"
                                    class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 "
                                    placeholder="Search for items">
                            </div>
                        </div>
                    </div>
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
                        <thead class="text-xs text-gray-700 bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Ticket Title
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Priority
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Update By
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Updater Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Date
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($log as $item)
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        {{ $item->ticket_title }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $item->ticket_priority }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $item->ticket_status }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $item->action }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $item->updated_by }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $item->updater_name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $item->created_at->isoFormat('HH:mm, D MMMM Y') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="p-3">
                        {{ $log->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
