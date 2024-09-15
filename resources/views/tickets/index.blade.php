<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Ticket') }}
        </h2>
        <x-breadcrumb :items="[['url' => route('dashboard'), 'label' => 'Dashboard'], ['url' => '#', 'label' => 'Tickets']]" />
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between align-middle mb-4">
                <div>
                    @if (auth()->user()->role == 'admin')
                        <span
                            class="inline-flex items-center px-3 py-1 mr-2 text-sm font-medium leading-5 text-gray-700 bg-gray-100 rounded-full dark:bg-gray-700 dark:text-gray-300">
                            {{ $count_data['open'] }} Open Tickets
                        </span>
                        <span
                            class="inline-flex items-center px-3 py-1 text-sm font-medium leading-5 text-red-700 bg-red-100 rounded-full dark:bg-red-700 dark:text-red-300">
                            {{ $count_data['unassigned'] }} Unassigned Agents
                        </span>
                    @endif
                </div>

                @if (auth()->user()->role === 'admin' || auth()->user()->role === 'user')
                    <div class="self-center">
                        <a href="{{ route('tickets.create') }}"
                            class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-500">
                            Create Ticket
                        </a>
                    </div>
                @endif
            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <div class="mb-4">
                    <form method="GET" action="{{ route('tickets.index') }}">
                        <div class="flex space-x-4">
                            <!-- Status Filter -->
                            <div>
                                <x-input-label for="status" :value="__('Status')" />
                                <select id="status" name="status"
                                    class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                                    <option value="">{{ __('All') }}</option>
                                    <option value="open" {{ request('status') == 'open' ? 'selected' : '' }}>
                                        {{ __('Open') }}</option>
                                    <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>
                                        {{ __('Closed') }}</option>
                                </select>
                            </div>

                            <!-- Priority Filter -->
                            <div>
                                <x-input-label for="priority" :value="__('Priority')" />
                                <select id="priority" name="priority"
                                    class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                                    <option value="">{{ __('All') }}</option>
                                    <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>
                                        {{ __('Low') }}</option>
                                    <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>
                                        {{ __('Medium') }}</option>
                                    <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>
                                        {{ __('High') }}</option>
                                </select>
                            </div>

                            <!-- Category Filter -->
                            <div>
                                <x-input-label for="category" :value="__('Category')" />
                                <select id="category" name="category"
                                    class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                                    <option value="">{{ __('All') }}</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ request('category') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="flex items-end">
                                <x-primary-button class="ml-4">
                                    {{ __('Filter') }}
                                </x-primary-button>
                                @if (request()->has('status') || request()->has('priority') || request()->has('category'))
                                    <a href="{{ route('tickets.index') }}"
                                        class="ml-4 inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 focus:outline-none focus:border-gray-300 dark:focus:border-gray-600 focus:ring focus:ring-gray-200 dark:focus:ring-gray-600 active:bg-gray-300 dark:active:bg-gray-600 disabled:opacity-25 transition">
                                        {{ __('Clear') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Title
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Priority
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Category
                            </th>
                            @if (auth()->user()->role == 'admin')
                                <th scope="col" class="px-6 py-3">
                                    Agent
                                </th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                    <tbody>
                        @foreach ($tickets as $ticket)
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 cursor-pointer">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $ticket->title }}
                                </th>

                                <td class="px-6 py-4">
                                    @php
                                        $priorityClasses = [
                                            'low' => 'bg-green-100 text-green-800',
                                            'medium' => 'bg-yellow-100 text-yellow-800',
                                            'high' => 'bg-red-100 text-red-800',
                                        ];
                                    @endphp
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $priorityClasses[$ticket->priority] ?? '' }}">
                                        {{ ucfirst($ticket->priority) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $statusClasses = [
                                            'open' => 'bg-blue-100 text-blue-800',
                                            'closed' => 'bg-red-100 text-red-800',
                                        ];
                                    @endphp
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClasses[$ticket->status] ?? '' }}">
                                        {{ ucfirst($ticket->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @foreach ($ticket->categories as $category)
                                        {{ $category->name }}{{ $loop->last ? '' : ', ' }}
                                    @endforeach
                                </td>
                                @if (auth()->user()->role == 'admin')
                                    @if ($ticket->agent)
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-500 text-white">
                                                {{ $ticket->agent->name }}
                                            </span>
                                        </th>
                                    @else
                                        <td class="px-6 py-4">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Unassigned!
                                            </span>
                                        </td>
                                    @endif
                                @endif
                                <input type="hidden" value="{{ $ticket->id }}">
                            </tr>
                            <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST"
                                id="delete-ticket-{{ $ticket->id }}">
                                @csrf
                                @method('DELETE')
                            </form>
                        @endforeach
                    </tbody>
                    </tbody>
                </table>
                @if ($tickets->isEmpty())
                    <div class="flex justify-center items-center h-24">
                        <p class="text-gray-500">No tickets found.</p>
                    </div>
                @endif
            </div>
            <div class="mt-4">
                {{ $tickets->links() }}
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('tr').forEach(function(tr) {
                    tr.addEventListener('click', function() {
                        var id = tr.querySelector('input').value;
                        window.location.href = '{{ route('tickets.show', ':id') }}'.replace(':id', id);
                    });
                });
            });
        </script>
    @endpush
</x-app-layout>
