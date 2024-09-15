<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-start content-center">
            <div class="content-center">
                <a href="{{ route('ticket.index') }}">
                    <h2 class="font-semibold text-xl text-gray-800">
                        {{ __('Tickets') }}
                    </h2>
                </a>
            </div>
            @if (request()->routeIs('ticket.filter'))
                <div class="mx-2 content-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-chevron-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708" />
                    </svg>
                </div>
                <div class="content-center">
                    <h2 class=" text-xl text-gray-800">
                        {{ __('Filter') }}
                    </h2>
                </div>
            @endif
        </div>
    </x-slot>

    <div class="py-5">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <div class="flex items-center justify-between">
                        <form action="{{ route('ticket.filter') }}" method="GET" class="flex item-center p-4">
                            @csrf
                            <div>
                                <div class="block w-full me-2">
                                    <label for="status"
                                        class="block mb-2 text-sm font-medium text-gray-600 w-full">Status</label>
                                    <select id="status" name='status'
                                        class="h-auto border border-gray-300 text-gray-600 text-base rounded-lg block w-40 py-1.5 px-2 focus:outline-none">
                                        <option selected>Choose</option>
                                        <option value="Open">Open</option>
                                        <option value="In Progress">In Progress</option>
                                        <option value="Closed">Closed</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <div class="block w-full me-2">
                                    <label for="priority"
                                        class="block mb-2 text-sm font-medium text-gray-600 w-full">Priority</label>
                                    <select id="priority" name='priority'
                                        class="h-auto border border-gray-300 text-gray-600 text-base rounded-lg block w-40 py-1.5 px-2 focus:outline-none">
                                        <option selected>Choose</option>
                                        <option value="High">High</option>
                                        <option value="Medium">Medium</option>
                                        <option value="Low">Low</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <div class="block w-full me-2">
                                    <label for="category"
                                        class="block mb-2 text-sm font-medium text-gray-600 w-full">Category</label>
                                    <select id="category" name='category'
                                        class="h-auto border border-gray-300 text-gray-600 text-base rounded-lg block w-40 py-1.5 px-2 focus:outline-none">
                                        <option selected>Choose</option>
                                        @foreach ($categories as $item)
                                            <option value="{{ $item->id }}">{{ $item->category_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="self-end">
                                <x-primary-button>{{ __('filter') }}</x-primary-button>
                            </div>
                        </form>
                        <div class="flex items-center">
                            <div class="flex items-center me-3">
                                <a href="{{ route('ticket.create') }}"
                                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    {{ __('Create Ticket') }}
                                </a>

                            </div>
                        </div>
                    </div>
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Title
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Description
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Priority
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Categories
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tiket as $item)
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td onclick="event.preventDefault(); document.getElementById('{{ 'detail-ticket' . $item->id }}').submit();"
                                        scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap cursor-pointer underline underline-offset-4">
                                        {{ $item->title }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $item->description }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $item->priority }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $item->status }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @foreach ($item->tiket_category as $category)
                                            {{ $category->category_name }}{{ !$loop->last ? ', ' : '' }}
                                        @endforeach
                                    </td>
                                    <td class="px-6 py-4 ">
                                        <a href="#"
                                            onclick="event.preventDefault(); document.getElementById('{{ 'detail-ticket' . $item->id }}').submit();"
                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline z-50">Detail</a>
                                        @can('admin_agent')
                                            <a href="{{ route('ticket.edit', $item->id) }}"
                                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline z-50">Edit</a>
                                            @can('admin')
                                                <a href="#"
                                                    onclick="event.preventDefault(); document.getElementById('{{ 'delete-ticket' . $item->id }}').submit();"
                                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Delete</a>
                                                <form id={{ 'delete-ticket' . $item->id }}
                                                    action="{{ route('ticket.destroy', $item->id) }}" method="post">@csrf
                                                    @method('DELETE')</form>
                                            @endcan
                                        @endcan
                                    </td>
                                </tr>
                                <form id={{ 'detail-ticket' . $item->id }}
                                    action="{{ route('ticket.detail', $item->id) }}" method="get">@csrf</form>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="p-3">
                        @if (request()->routeIs('ticket.index'))
                            {{ $tiket->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
