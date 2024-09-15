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
            <div class="mx-2 content-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-chevron-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708" />
                </svg>
            </div>
            <div class="content-center">
                <h2 class=" text-xl text-gray-800">
                    {{ __('Detail') }}
                </h2>
            </div>
        </div>
    </x-slot>

    @php
        setlocale(LC_ALL, 'IND');
        \Carbon\Carbon::setLocale('id');
    @endphp

    <div class="py-5">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <div class="flex pe-4 pt-3 justify-end">
                        <form action="{{ route('ticket.edit', $tiket->id) }}">
                            @csrf
                            <x-primary-button>{{ __('Edit Ticket') }}</x-primary-button>
                        </form>
                    </div>
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
                        <tbody>
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td scope="row"
                                    class="w-1/4 px-6 py-4 font-medium text-gray-900
                                    whitespace-nowrap">
                                    Title
                                </td>
                                <td scope="row"
                                    class="w-[2%] py-4 font-medium text-gray-900
                                    whitespace-nowrap">
                                    :
                                </td>
                                <td scope="row" class="pe-6 py-4 font-medium text-gray-700 whitespace-nowrap">
                                    {{ $tiket->title }}
                                </td>
                            </tr>
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td scope="row"
                                    class="w-1/4 px-6 py-4 font-medium text-gray-900
                                    whitespace-nowrap">
                                    Priority
                                </td>
                                <td scope="row"
                                    class="w-[2%] py-4 font-medium text-gray-900
                                    whitespace-nowrap">
                                    :
                                </td>
                                <td scope="row" class="pe-6 py-4 font-medium text-gray-700 whitespace-nowrap">
                                    {{ $tiket->priority }}
                                </td>
                            </tr>
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td scope="row"
                                    class="w-1/4 px-6 py-4 font-medium text-gray-900
                                    whitespace-nowrap">
                                    Status
                                </td>
                                <td scope="row"
                                    class="w-[2%] py-4 font-medium text-gray-900
                                    whitespace-nowrap">
                                    :
                                </td>
                                <td scope="row" class="pe-6 py-4 font-medium text-gray-700 whitespace-nowrap">
                                    {{ $tiket->status }}
                                </td>
                            </tr>
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td scope="row"
                                    class="w-1/4 px-6 py-4 font-medium text-gray-900
                                    whitespace-nowrap">
                                    Category
                                </td>
                                <td scope="row"
                                    class="w-[2%] py-4 font-medium text-gray-900
                                    whitespace-nowrap">
                                    :
                                </td>
                                <td scope="row" class="pe-6 py-4 font-medium text-gray-700 whitespace-nowrap">
                                    @foreach ($tiket->tiket_category as $category)
                                        {{ $category->category_name }}{{ !$loop->last ? ', ' : '' }}
                                    @endforeach
                                </td>
                            </tr>
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td scope="row"
                                    class="w-1/4 px-6 py-4 font-medium text-gray-900
                                    whitespace-nowrap">
                                    Label
                                </td>
                                <td scope="row"
                                    class="w-[2%] py-4 font-medium text-gray-900
                                    whitespace-nowrap">
                                    :
                                </td>
                                <td scope="row" class="pe-6 py-4 font-medium text-gray-700 whitespace-nowrap">
                                    @foreach ($tiket->tiket_label as $label)
                                        {{ $label->label_name }}{{ !$loop->last ? ', ' : '' }}
                                    @endforeach
                                </td>
                            </tr>
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td scope="row"
                                    class="w-1/4 px-6 py-4 font-medium text-gray-900
                                    whitespace-nowrap">
                                    Description
                                </td>
                                <td scope="row"
                                    class="w-[2%] py-4 font-medium text-gray-900
                                    whitespace-nowrap">
                                    :
                                </td>
                                <td scope="row" class="pe-6 py-4 font-medium text-gray-700 whitespace-nowrap">
                                    {{ $tiket->description }}
                                </td>
                            </tr>
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td scope="row"
                                    class="w-1/4 px-6 py-4 font-medium text-gray-900
                                    whitespace-nowrap">
                                    Created At
                                </td>
                                <td scope="row"
                                    class="w-[2%] py-4 font-medium text-gray-900
                                    whitespace-nowrap">
                                    :
                                </td>
                                <td scope="row" class="pe-6 py-4 font-medium text-gray-700 whitespace-nowrap">
                                    {{ $tiket->created_at->isoFormat('D MMMM Y') }}
                                </td>
                            </tr>
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td scope="row"
                                    class="w-1/4 px-6 py-4 font-medium text-gray-900
                                    whitespace-nowrap">
                                    Attachment file
                                </td>
                                <td scope="row"
                                    class="w-[2%] py-4 font-medium text-gray-900
                                    whitespace-nowrap">
                                    :
                                </td>
                                <td scope="row" class="pe-6 py-4 font-medium text-gray-700 whitespace-nowrap">
                                    <a class="underline underline-offset-2 text-sky-400"
                                        href="{{ Storage::url($tiket->attachment_file) }}" download>
                                        Download File
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @livewire('comments', ['ticket_id' => $tiket->id])

</x-app-layout>
