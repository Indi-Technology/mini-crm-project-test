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
                    <a class="bg-slate-500 text-white font-semibold px-4 py-2 rounded shadow-sm" href="/admin/tickets">< Back To Tickets Data</a>
                
                    <div class="mt-6">
                        <form action="/admin/tickets/update" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-5">
                                <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                                <input type="text" id="title" name="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Insert Title ..." value="{{ $ticket->title }}" required />
                                @error('title')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-5">
                                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                                <textarea id="description" name="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Insert Description ...">{{ $ticket->description }}</textarea>
                                 @error('description')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-5">
                                <label for="labels" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Labels</label>
                                
                                 @foreach ($labels as $label)
                                    <input id="labels" {{ in_array($label->id, $ticket->labels->pluck('id')->toArray()) ? 'checked' : '' }} name="labels[]" type="checkbox" value="{{ $label->id }}" class="w-4 h-4  text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="labels" class="ms-1 text-sm font-medium capitalize text-gray-900 dark:text-gray-300 mr-3">{{ $label->label_name  }}</label>
                                @endforeach

                                 @error('labels')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror

                            </div>

                            <div class="mb-5">
                                <label for="categories" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Categories</label>

                                @foreach ($categories as $category)
                                    <input id="categories" {{ in_array($category->id, $ticket->categories->pluck('id')->toArray()) ? 'checked' : '' }} name="categories[]" type="checkbox" value="{{ $category->id }}" class="w-4 h-4  text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
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
                                    <option {{ ($ticket->priority == "low") ? "selected" : false }} value="low">Low</option>
                                    <option {{ ($ticket->priority == "normal") ? "selected" : false }} value="normal">Normal</option>
                                    <option {{ ($ticket->priority == "high") ? "selected" : false }} value="high">High</option>
                                    <option {{ ($ticket->priority == "urgent") ? "selected" : false }} value="urgent">Urgent</option>
                                </select>
                                 @error('priority')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-5">
                                <label for="assigned_agent" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Assigned Agent</label>
                                <select id="assigned_agent" name="assigned_agent" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected>Assign an agent</option>
                                    @foreach ($agents as $agent)
                                        <option {{ ($ticket->assigned_agent && $ticket->assigned_agent->id == $agent->id) ? "selected" : false }} value="{{$agent->id}}">({{ $agent->id }}) - {{ $agent->name }}</option>                                        
                                    @endforeach
                                </select>
                                 @error('assigned_agent')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-5">
                                <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                                <select id="status" name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected>Choose a status</option>
                                    <option {{ ($ticket->status == "open") ? "selected" : false }} value="open">Open</option>
                                    <option {{ ($ticket->status == "close") ? "selected" : false }} value="close">Close</option>
                                </select>
                                 @error('status')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <input type="hidden" name="ticket_id" value="{{$ticket->id}}">

                            <button type="submit" class="text-white bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-500 dark:hover:bg-blue-500 dark:focus:ring-blue-800">Update</button>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    @if(session('success'))
        Swal.fire({
            title: 'Success!',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    @endif

    @if(session('error'))
        Swal.fire({
            title: 'Error!',
            text: '{{ session('error') }}',
            icon: 'error',
            confirmButtonText: 'OK'
        });
    @endif
</script>