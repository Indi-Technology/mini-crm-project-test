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
                    <a class="bg-gray-500 text-white font-semibold px-4 py-2 rounded shadow-sm" href="/tickets">< Back To Tickets Data</a>
                    
                    <div class="relative overflow-x-auto mt-6">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <tbody>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th class="px-6 py-4">Ticket ID</th>    
                                    <td class="px-6 py-4 w-10">:</td>    
                                    <td class="px-6 py-4 w-auto">{{ "#" . $ticket->id }}</td>    
                                </tr>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th class="px-6 py-4">Ticket Title</th>    
                                    <td class="px-6 py-4 w-10">:</td>    
                                    <td class="px-6 py-4 w-auto">{{ $ticket->title }}</td>    
                                </tr>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th class="px-6 py-4">Ticket Description</th>    
                                    <td class="px-6 py-4 w-10">:</td>    
                                    <td class="px-6 py-4 w-auto">{{ $ticket->description }}</td>    
                                </tr>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th class="px-6 py-4">Category</th>    
                                    <td class="px-6 py-4 w-10">:</td>    
                                    <td class="px-6 py-4 w-auto">
                                        @foreach ($ticket->categories as $category)
                                            <span class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-900 dark:text-gray-300 capitalize">{{ $category->category_name }}</span>
                                        @endforeach    
                                    </td>    
                                </tr>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th class="px-6 py-4 w-[20%]">Label</th>    
                                    <td class="px-6 py-4 w-10">:</td>    
                                    <td class="px-6 py-4 w-auto">
                                        @foreach ($ticket->labels as $label)
                                            <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300 capitalize">{{ "#". $label->label_name }}</span>
                                        @endforeach    
                                    </td>    
                                </tr>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th class="px-6 py-4">Assigned Agent</th>    
                                    <td class="px-6 py-4 w-10">:</td>    
                                    <td class="px-6 py-4 w-auto">
                                        @if ($ticket->assigned_agent_id == null)
                                            {{"-"}}
                                        @else
                                            {{ $ticket->assigned_agent->name }}
                                        @endif
                                    </td>    
                                </tr>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th class="px-6 py-4">Priority</th>    
                                    <td class="px-6 py-4 w-10">:</td>    
                                    <td class="px-6 py-4 w-auto capitalize">
                                        @if ($ticket->priority == "urgent")
                                            <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300 capitalize">{{ $ticket->priority }}</span>
                                        @elseif ($ticket->priority == "high")
                                            <span class="bg-orange-100 text-orange-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-orange-900 dark:text-orange-300 capitalize">{{ $ticket->priority }}</span>
                                        @elseif ($ticket->priority == "normal")
                                            <span class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300 capitalize">{{ $ticket->priority }}</span>
                                        @else
                                            <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300 capitalize">{{ $ticket->priority }}</span>
                                        @endif
                                    </td>    
                                </tr>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th class="px-6 py-4">Status</th>    
                                    <td class="px-6 py-4 w-10">:</td>    
                                    <td class="px-6 py-4 w-auto capitalize">
                                        @if ($ticket->status == "open")
                                            <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300 capitalize">{{ $ticket->status }}</span>
                                        @else
                                            <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300 capitalize">{{ $ticket->status }}</span>
                                        @endif
                                    </td>    
                                </tr>
                                <tr class="bg-white  dark:bg-gray-800 dark:border-gray-700">
                                    <th class="px-6 py-4">Last Update At</th>    
                                    <td class="px-6 py-4 w-10">:</td>    
                                    <td class="px-6 py-4 w-auto capitalize">
                                        {{$ticket->updated_at}}
                                    </td>    
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-6">
                        {{-- Comment Form Here --}}
                    </div>
                    <div class="mt-6">
                        {{-- Comments Here --}}
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>