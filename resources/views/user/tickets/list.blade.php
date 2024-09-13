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
                                            Ticket Not Found 
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