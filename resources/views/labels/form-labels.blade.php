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
            <div class="mx-2 content-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-chevron-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708" />
                </svg>
            </div>
            <div class="content-center">
                <h2 class=" text-xl text-gray-800">
                    @if (isset($label))
                        {{ __('Edit label') }}
                    @else
                        {{ __('Create label') }}
                    @endif
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-5">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="">
                    @if (isset($label))
                        @include('labels.partials.edit-labels-input')
                    @else
                        @include('labels.partials.create-labels-input')
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
