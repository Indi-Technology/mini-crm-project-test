<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-start content-center">
            <div class="content-center">
                <a href="{{ route('label.index') }}">
                    <h2 class="font-semibold text-xl text-gray-800">
                        {{ __('Labels') }}
                    </h2>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-5">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-3 relative overflow-x-auto shadow-md sm:rounded-lg">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="flex items-center mb-3">
                                <a href="{{ route('label.create') }}"
                                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    {{ __('Create label') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Nama Label
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($label as $item)
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        {{ $item->label_name }}
                                    </th>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('label.edit', $item->id) }}"
                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                        <a href="#"
                                            onclick="event.preventDefault(); document.getElementById('{{ 'delete-label'.$item->id }}').submit();"
                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Delete</a>
                                        <form id={{ "delete-label".$item->id }} action="{{ route('label.destroy', $item->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
