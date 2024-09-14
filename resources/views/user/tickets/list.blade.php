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
                    <a class="bg-blue-500 text-white font-semibold px-4 py-2 rounded shadow-sm" href="/tickets/create">+ Make Support Tickets</a>
                    
                    <form method="get">
                        <div class="flex gap-2 mt-6">
                                <div class="flex-1">
                                    <select id="priority" name="priority" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="" selected>Select Priority</option>
                                        <option {{ ($selected_priority && $selected_priority == "low") ? "selected" : false }} value="low">Low</option>
                                        <option {{ ($selected_priority && $selected_priority == "normal") ? "selected" : false }} value="normal">Normal</option>
                                        <option {{ ($selected_priority && $selected_priority == "high") ? "selected" : false }} value="high">High</option>
                                        <option {{ ($selected_priority && $selected_priority == "urgent") ? "selected" : false }} value="urgent">Urgent</option>
                                    </select>
                                </div>
                                <div class="flex-1">
                                    <select id="category" name="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="" selected>Select Category</option>
                                        @foreach ($categories as $category)
                                            <option {{ ($selected_category && $selected_category == $category->id) ? "selected" : false }} value="{{ $category->id }}">{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="flex-1">
                                    <select id="status" name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="" selected>Select Status</option>
                                        <option {{($selected_status && $selected_status == 'open') ? "selected" : false}} value="open">Open</option>
                                        <option {{($selected_status && $selected_status == 'close') ? "selected" : false}}  value="close">Close</option>
                                    </select>
                                </div>
                                <div class="flex-[0.3] ">
                                    <button class="bg-blue-500 h-full w-full text-sm text-white font-semibold px-4 py-2 rounded-lg shadow-sm">Filter</button>
                                </div>
                        </div>
                    </form>
                    <div class="relative overflow-x-auto mt-6">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        #
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Ticket ID
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Ticket Title
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Category
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Priority
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Last Update
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $index=1;
                                @endphp
                                @if($tickets->isEmpty())
                                    <tr>
                                        <td colspan="8" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                            Tickets Not Found 
                                        </td>
                                    </tr>
                                @else
                                    @foreach ($tickets as $ticket)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                                <?= $index++ . "." ?>
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ "#" . $ticket->id }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $ticket->title }}
                                            </td>
                                            <td class="px-6 py-4">
                                                @foreach ($ticket->categories as $categories)
                                                     <span class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-900 dark:text-gray-300 capitalize">{{ $categories->category_name }}</span>
                                                @endforeach
                                            </td>
                                            <td class="px-6 py-4">
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
                                            <td class="px-6 py-4">
                                                @if ($ticket->status == "open")
                                                    <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300 capitalize">{{ $ticket->status }}</span>
                                                @else
                                                    <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300 capitalize">{{ $ticket->status }}</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ Carbon\Carbon::parse($ticket->updated_at)->format('d F Y G:i') }}
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                <div class="flex justify-center space-x-2">
                                                    <a class="bg-green-500 font-bold text-white px-4 py-1 rounded shadow-sm" href="{{ "/tickets/detail/" . $ticket->id }}">View</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        {{ $tickets->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteForms = document.querySelectorAll('form[action="/admin/categories/delete"]');

        deleteForms.forEach(form => {
            form.addEventListener('submit', function (event) {
                event.preventDefault(); 
                
                Swal.fire({
                    title: 'Are you sure you want to delete?',
                    text: "Once data is deleted, it cannot be recovered.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#4e73df',
                    cancelButtonColor: '#e74a3b',
                    confirmButtonText: 'Yes, Delete Data'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); 
                    }
                });
            });
        });
    });
</script>