<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Ticket ' . $ticket->id) }}
        </h2>
        <x-breadcrumb :items="[
            ['url' => route('dashboard'), 'label' => 'Dashboard'],
            ['url' => route('tickets.index'), 'label' => 'Tickets'],
            ['url' => '#', 'label' => 'Ticket ' . ' by ' . $ticket->user->name],
        ]" />
    </x-slot>

    <div class="py-4 mb-11">

        {{-- admin panel --}}
        @if (auth()->user()->role == 'admin')
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 sm:rounded-lg mb-5">
                <div class="flex justify-between border border-gray-400 rounded-md px-6 py-4">

                    {{-- Agent Select --}}
                    <form action="{{ route('tickets.assign', $ticket->id) }}" method="POST" class="">
                        @csrf
                        @method('PUT')
                        <div>
                            <select id="agent" name="agent_id"
                                class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option value="medium" selected disabled>-- Select Agent --</option>
                                @foreach ($agents as $agent)
                                    <option value="{{ $agent->id }}"
                                        {{ $ticket->agent && $ticket->agent->id == $agent->id ? 'selected' : '' }}>
                                        {{ $agent->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('agent_id')" class="mt-2" />
                        </div>
                        <div>
                            <x-primary-button class="mt-4">
                                {{ __('Assign Agent') }}
                            </x-primary-button>
                        </div>
                    </form>

                    {{-- Action --}}
                    <div>
                        {{-- edit ticket --}}
                        <a href="{{ route('tickets.edit', $ticket->id) }}"
                            class="text-sm text-blue-500 hover:text-blue-700">Edit</a>
                        {{-- delete ticket --}}
                        <form id="delete-ticket-form" action="{{ route('tickets.destroy', $ticket->id) }}"
                            method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="text-sm text-red-500 hover:text-red-700"
                                id="delete-ticket-button">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @endif

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 sm:rounded-lg flex flex-col lg:flex-row gap-5">

            {{-- Ticket Info --}}
            <div class="w-full lg:w-1/4">
                <div class="flex-col item-center border border-gray-400 rounded-md ">
                    <div class="px-6 py-4 border-b border-gray-800">
                        <h3 class="text-lg leading-6 font-medium text-white">Ticket Information</h3>
                        <p class="mt-1 text-sm text-gray-500">Ticket details with latest information.</p>
                        <div class="flex justify-between mt-2">
                            <div>
                                <span
                                    class="px-4 inline-flex text-xs leading-5 font-semibold rounded-full
                                @if ($ticket->status == 'open') bg-green-100 text-green-800
                                @else bg-red-100 text-red-800 @endif">
                                    {{ ucfirst($ticket->status) }}
                                </span>
                            </div>
                            @if ($ticket->status == 'open')
                                <div>
                                    {{-- close button --}}
                                    <form action="{{ route('tickets.close', $ticket->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit"
                                            class="px-4 py-1 text-sm text-red-500 hover:text-red-700">Close
                                            Ticket</button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="px-6 py-4 border-b border-gray-800">
                        <h3 class="text-sm text-white">Created Ticket</h3>
                        <p class="mt-1 text-md text-gray-500">{{ $ticket->created_at->format('d-m-Y (H:i)') }}</p>
                    </div>
                    <div class="px-6 py-4 border-b border-gray-800">
                        <h3 class="text-sm text-white">Last Update</h3>
                        <p class="mt-1 text-md text-gray-500">{{ $ticket->updated_at->diffForHumans() }}</p>
                    </div>
                    <div class="px-6 py-4 border-b border-gray-800">
                        <h3 class="text-sm text-white">Priority</h3>
                        <span
                            class="px-2 mt-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                @if ($ticket->priority == 'low') bg-green-100 text-green-800
                                @elseif($ticket->priority == 'medium') bg-yellow-100 text-yellow-800
                                @elseif($ticket->priority == 'high') bg-red-100 text-red-800 @endif">
                            {{ ucfirst($ticket->priority) }}
                        </span>
                    </div>
                    <div class="px-6 py-4 border-b border-gray-800">
                        <h3 class="text-sm text-white">Categories</h3>
                        <p class="mt-1 text-md text-gray-500">
                            @foreach ($ticket->categories as $category)
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-200 text-gray-800">
                                    {{ $category->name }}
                                </span>
                            @endforeach
                        </p>
                    </div>
                    <div class="px-6 py-4 border-b border-gray-800">
                        <h3 class="text-sm text-white">Labels</h3>
                        <p class="mt-1 text-md text-gray-500">
                            @foreach ($ticket->labels as $label)
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-200 text-gray-800">
                                    {{ $label->name }}
                                </span>
                            @endforeach
                        </p>
                    </div>
                    <div class="px-6 py-4">
                        <h3 class="text-sm text-white">Agent</h3>

                        <p class="mt-1 text-md text-gray-500">
                            @if ($ticket->agent)
                                {{ $ticket->agent->name }}
                            @else
                                Finding agent...
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            {{-- Ticket Description --}}
            <div class="w-full lg:w-3/4">
                <div class="flex-col item-center border border-gray-400 rounded-md ">
                    <div class="flex justify-between px-6 py-4 border-b border-gray-800">
                        <h3 class="text-lg leading-6 font-medium text-white">{{ $ticket->user->name }}</h3>
                        <p class="mt-1 text-sm text-gray-500">{{ $ticket->created_at->format('d M Y (H:i)') }}</p>
                    </div>
                    <div class="px-6 py-4 ">
                        <h2 class="text-xl text-white font-bold">{{ $ticket->title }}</h2>
                        <div class="text-md text-gray-500">{!! $ticket->description !!}</div>
                        @if ($ticket->attachments->count() > 0)
                            @foreach ($ticket->attachments as $file)
                                <x-attachment route="{{ route('attachments.download', $file->id) }}"
                                    name="{{ $file->original_name }}" size="{{ $file->formatted_size }}"
                                    extension="{{ $file->extension }}" />
                            @endforeach
                        @endif
                    </div>
                </div>

                {{-- Ticket Comment --}}
                <div class="py-4 flex-col item-center">
                    @if ($ticket->status == 'open')
                        <div>
                            <form action="{{ route('comments.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                                <div class="mt-4">
                                    <x-text-area id="comment" class="block mt-1 w-full" name="body"
                                        :value="old('body')" />
                                    <x-input-error :messages="$errors->get('body')" class="mt-2" />
                                </div>
                                <div class="mt-4 px-6 pb-4 border-b border-gray-800">
                                    <x-input-label for="attachments" :value="__('Attachments')" />
                                    <input id="attachments" type="file" name="attachments[]" multiple
                                        class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">

                                    <small class="text-gray-600">Maximum file size 2mb, you can upload multiple files
                                        at
                                        once</small>
                                    @foreach ($errors->get('attachments.*') as $error)
                                        <x-input-error :messages="$error" class="mt-2" />
                                    @endforeach
                                </div>
                                <div class="flex items-center justify-end mt-4">
                                    <x-primary-button class="ms-4">
                                        {{ __('Add Comment') }}
                                    </x-primary-button>
                                </div>
                            </form>
                        </div>
                    @endif
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-white">Comments</h3>
                        <div class="mt-4">
                            @if ($ticket->comments->count() > 0)
                                @foreach ($ticket->comments as $comment)
                                    <div class="flex-col item-center border border-gray-400 rounded-md mb-2">
                                        <div class="flex justify-between px-6 py-4 border-b border-gray-800">
                                            <div class="flex gap-2">
                                                <h3 class="text-md text-white">{{ $comment->user->name }}</h3>
                                                <div class="mt-1 flex items-center">
                                                    <span
                                                        class="px-4 inline-flex text-xs leading-5 font-semibold rounded-full
                                            @if ($comment->user->role == 'user') bg-blue-100 text-blue-800
                                            @else bg-purple-100 text-purple-800 @endif">
                                                        {{ ucfirst($comment->user->role) }}
                                                    </span>
                                                </div>
                                            </div>
                                            <p class="mt-1 text-sm text-gray-500">
                                                {{ $comment->updated_at->diffForHumans() }} |
                                                {{ $comment->created_at->format('d M Y (H:i)') }}</p>
                                        </div>
                                        <div class="px-6 py-4 ">
                                            <div class="text-md text-gray-100">{!! $comment->body !!}</div>
                                            @if ($comment->attachments->count() > 0)
                                                @foreach ($comment->attachments as $file)
                                                    <x-attachment
                                                        route="{{ route('attachments.download', $file->id) }}"
                                                        name="{{ $file->original_name }}"
                                                        size="{{ $file->formatted_size }}"
                                                        extension="{{ $file->extension }}" />
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="flex justify-center items-center h-24">
                                    <p class="text-gray-500">No comments found.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('styles')
        <link rel="stylesheet" type="text/css"
            href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/3.2.6/css/froala_editor.pkgd.min.css">
    @endpush
    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/3.2.6/js/froala_editor.pkgd.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                new FroalaEditor('#comment', {
                    toolbarButtons: [
                        'bold', 'italic', 'underline', 'fontSize', '|', 'formatUL',
                        '-', 'insertLink', '|', 'specialCharacters', 'insertHR',
                        'selectAll', '|', 'html', '|', 'undo', 'redo'
                    ],
                    imageUpload: false,
                    fileUpload: false,
                    videoUpload: false,
                    quickInsertEnabled: false,
                    events: {
                        'initialized': function() {
                            this.html.set(@json(old('body')));
                        }
                    }
                });
            });

            document.getElementById('delete-ticket-button').addEventListener('click', function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-ticket-form').submit();
                    }
                });
            });
        </script>
    @endpush
</x-app-layout>
