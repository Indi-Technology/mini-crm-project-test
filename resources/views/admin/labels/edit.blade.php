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
                    <a class="bg-slate-500 text-white font-semibold px-4 py-2 rounded shadow-sm" href="/admin/labels">< Back To Labels Data</a>
                
                    <div class="mt-6">
                        <form action="/admin/labels/update" method="post">
                            @csrf       
                            <div class="mb-5">
                                <label for="label_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Label Name</label>
                                <input type="text" id="label_name" name="label_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Insert Label Name ..." value="{{ $label->label_name }}" required />
                                @error('label_name')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <input type="hidden" name="id" value="{{ $label->id }}">
                            
                            <button type="submit" class="text-white bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-500 dark:hover:bg-blue-500 dark:focus:ring-blue-800">Update</button>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>