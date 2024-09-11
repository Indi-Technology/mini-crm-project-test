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
                    <a class="bg-slate-500 text-white font-semibold px-4 py-2 rounded shadow-sm" href="/tickets">< Back To Tickets Data</a>
                
                    <div class="mt-6">
                        <form action="/tickets/save" method="post" enctype="multipart/form-data">
                            @csrf       
                            <div class="mb-5">
                                <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                                <input type="text" id="title" name="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Insert Title ..." value="{{ old('title') }}" required />
                                @error('title')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-5">
                                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                                <textarea id="description" name="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Insert Description ...">{{ old('description') }}</textarea>
                                 @error('description')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-5">
                                <label for="labels" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Labels</label>
                                
                                 @foreach ($labels as $label)
                                    <input id="labels" {{ in_array($label->id, old('labels', [])) ? 'checked' : '' }} name="labels[]" type="checkbox" value="{{ $label->id }}" class="w-4 h-4  text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="labels" class="ms-1 text-sm font-medium capitalize text-gray-900 dark:text-gray-300 mr-3">{{ $label->label_name  }}</label>
                                @endforeach

                                 @error('labels')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror

                            </div>

                            <div class="mb-5">
                                <label for="categories" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Categories</label>

                                @foreach ($categories as $category)
                                    <input id="categories" {{ in_array($category->id, old('categories', [])) ? 'checked' : '' }} name="categories[]" type="checkbox" value="{{ $category->id }}" class="w-4 h-4  text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="categories" class="ms-1 text-sm font-medium capitalize text-gray-900 dark:text-gray-300 mr-3">{{ $category->category_name }}</label>
                                @endforeach
                                
                                 @error('categories')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror

                            </div>

                            <div class="mb-5">
                                <label for="priority" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Priority</label>
                                <select id="priority" name="priority" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected>Choose a priority</option>
                                    <option {{ (old('priority') == "low") ? "selected" : false }} value="low">Low</option>
                                    <option {{ (old('priority') == "normal") ? "selected" : false }} value="normal">Normal</option>
                                    <option {{ (old('priority') == "high") ? "selected" : false }} value="high">High</option>
                                    <option {{ (old('priority') == "urgent") ? "selected" : false }} value="urgent">Urgent</option>
                                </select>
                                 @error('priority')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-5">
                              
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="attachments">Attachments (Optional)</label>
                                <input type="file" class=" file:bg-gray-200 file:text-black file:border-0 file:py-1 file:px-3 file:rounded-full  file:shadow-blue-500/30 text-gray-600" name="attachments[]" id="attachments" multiple>
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG, JPG or GIF (Max. 2MB).</p>


                                @error('attachments.*')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                           
                            
                            <button type="submit" class="text-white bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-500 dark:hover:bg-blue-500 dark:focus:ring-blue-800">Save</button>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>