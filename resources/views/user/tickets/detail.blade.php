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
                    <a class="bg-gray-500 text-white font-semibold px-4 py-2 rounded shadow-sm" href="/tickets">< Back To Tickets Data</a>
                    
                    <div class="relative overflow-x-auto mt-6">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <tbody>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th class="px-6 py-4">Ticket ID</th>    
                                    <td class="px-6 py-4 w-10">:</td>    
                                    <td class="px-6 py-4 w-auto">{{ "#" . $ticket->id }}</td>    
                                </tr>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th class="px-6 py-4">Ticket Title</th>    
                                    <td class="px-6 py-4 w-10">:</td>    
                                    <td class="px-6 py-4 w-auto">{{ $ticket->title }}</td>    
                                </tr>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th class="px-6 py-4">Ticket Description</th>    
                                    <td class="px-6 py-4 w-10">:</td>    
                                    <td class="px-6 py-4 w-auto">{{ $ticket->description }}</td>    
                                </tr>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th class="px-6 py-4">Category</th>    
                                    <td class="px-6 py-4 w-10">:</td>    
                                    <td class="px-6 py-4 w-auto">
                                        @foreach ($ticket->categories as $category)
                                            <span class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-900 dark:text-gray-300 capitalize">{{ $category->category_name }}</span>
                                        @endforeach    
                                    </td>    
                                </tr>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th class="px-6 py-4 w-[20%]">Label</th>    
                                    <td class="px-6 py-4 w-10">:</td>    
                                    <td class="px-6 py-4 w-auto">
                                        @foreach ($ticket->labels as $label)
                                            <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300 capitalize">{{ "#". $label->label_name }}</span>
                                        @endforeach    
                                    </td>    
                                </tr>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th class="px-6 py-4">Assigned Agent</th>    
                                    <td class="px-6 py-4 w-10">:</td>    
                                    <td class="px-6 py-4 w-auto">
                                        @if ($ticket->assigned_agent_id == null)
                                            {{"-"}}
                                        @else
                                            {{ $ticket->assigned_agent->name }}
                                        @endif
                                    </td>    
                                </tr>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th class="px-6 py-4">Priority</th>    
                                    <td class="px-6 py-4 w-10">:</td>    
                                    <td class="px-6 py-4 w-auto capitalize">
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
                                </tr>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th class="px-6 py-4">Status</th>    
                                    <td class="px-6 py-4 w-10">:</td>    
                                    <td class="px-6 py-4 w-auto capitalize">
                                        @if ($ticket->status == "open")
                                            <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300 capitalize">{{ $ticket->status }}</span>
                                        @else
                                            <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300 capitalize">{{ $ticket->status }}</span>
                                        @endif
                                    </td>    
                                </tr>
                                <tr class="bg-white border-b  dark:bg-gray-800 dark:border-gray-700">
                                    <th class="px-6 py-4">Last Update At</th>    
                                    <td class="px-6 py-4 w-10">:</td>    
                                    <td class="px-6 py-4 w-auto capitalize">
                                        {{$ticket->updated_at}}
                                    </td>    
                                </tr>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th class="px-6 py-4">Attachments</th>    
                                    <td class="px-6 py-4 w-10">:</td>    
                                    <td class="px-6 py-4 w-auto capitalize">
                                        <ul class="grid grid-cols-1 sm:grid-cols-3 md:grid-cols-5 gap-4" id="images">
                                            @if ($ticket->attachments->isEmpty())
                                                {{"-"}}
                                            @else
                                                @foreach ($ticket->attachments as $attachment)
                                                    <li class="aspect-square">
                                                        <img class="w-full h-full object-cover cursor-pointer" src="{{ asset('storage/' . $attachment->file_path) }}" alt="{{ $attachment->file_name }}">
                                                    </li>
                                                @endforeach
                                            @endif
                                            
                                        </ul>
                                    </td>    
                                </tr>
                                
                            </tbody>


                        </table>
                    </div>
                    <div class="mt-6">
                        @foreach ($ticket->comments as $comment)
                            @if ($comment->user->id == auth()->user()->id)
                                <div class="flex items-start gap-2.5 justify-end mb-5">
                                    <div class="flex flex-col w-full max-w-[50%] leading-1.5 p-4 border-gray-200 bg-blue-100 rounded-tl-xl rounded-bl-xl rounded-br-xl dark:bg-blue-700">
                                        <div class="flex items-center space-x-2 rtl:space-x-reverse">
                                            <span class="text-sm font-semibold text-gray-900 dark:text-white">You ({{$comment->user->name}})</span>
                                            <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                                            {{ Carbon\Carbon::parse($comment->created_at)->format('d F Y g:i') }}
                                            </span>
                                        </div>
                                        <p class="text-sm font-normal pt-2.5 text-gray-900 dark:text-white">{{ $comment->comment_text }}</p>
                                        @if (!$comment->attachments->isEmpty())
                                            <p class="text-sm font-semibold pt-2.5">Attachment :</p>
                                        @endif
                                        <ul class="grid grid-cols-1 sm:grid-cols-3 md:grid-cols-5 gap-4 mt-1" id="comment_attachment_{{ $comment->id }}">
                                            @foreach ($comment->attachments as $attachment)
                                                <li class="aspect-square">
                                                    <img class="w-full h-full object-cover cursor-pointer" src="{{ asset('storage/' . $attachment->file_path) }}" alt="{{ $attachment->file_name }}">
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <img class="w-8 h-8 rounded-full" src="/user-placeholder.jpg" alt="User">
                                </div>
                            @else
                                <div class="flex items-start gap-2.5 mb-5">
                                    <img class="w-8 h-8 rounded-full" src="/user-placeholder.jpg" alt="User">
                                    <div class="flex flex-col w-full max-w-[50%] leading-1.5 p-4 border-gray-200 bg-gray-100 rounded-e-xl rounded-es-xl dark:bg-gray-700">
                                        <div class="flex items-center space-x-2 rtl:space-x-reverse">
                                            <span class="text-sm font-semibold text-gray-900 dark:text-white">{{$comment->user->name}}</span>
                                            <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                                            {{ Carbon\Carbon::parse($comment->created_at)->format('d F Y g:i') }}
                                            
                                            </span>
                                        </div>
                                        <p class="text-sm font-normal py-2.5 text-gray-900 dark:text-white">{{$comment->comment_text}}</p>
                                        <span class="text-sm font-normal text-gray-500 capitalize dark:text-gray-400">{{$comment->user->role}}</span>
                                        @if (!$comment->attachments->isEmpty())
                                            <p class="text-sm font-semibold pt-2.5">Attachment :</p>
                                        @endif
                                        <ul class="grid grid-cols-1 sm:grid-cols-3 md:grid-cols-5 gap-4 mt-1" id="comment_attachment_{{ $comment->id }}">
                                            @foreach ($comment->attachments as $attachment)
                                                <li class="aspect-square">
                                                    <img class="w-full h-full object-cover cursor-pointer" src="{{ asset('storage/' . $attachment->file_path) }}" alt="{{ $attachment->file_name }}">
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif
                            <script>
                                document.querySelectorAll('[id^="comment_attachment_"]').forEach(element => {
                                    new Viewer(element);
                                });
                            </script>
                        @endforeach
                    </div>
                    @if ($ticket->status == "open")
                        <div class="mt-6" id="comment">
                            <form action="/comments/save" method="POST" class="flex items-center mx-auto" enctype="multipart/form-data"> 
                                @csrf  
                                <label for="simple-search" class="sr-only">Search</label>
                                <div class="relative w-full">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">

                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns" fill="#000000" stroke="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>comment-3</title> <desc>Created with Sketch Beta.</desc> <defs> </defs> <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage"> <g id="Icon-Set" sketch:type="MSLayerGroup" transform="translate(-204.000000, -255.000000)" fill="#666666"> <path d="M228,267 C226.896,267 226,267.896 226,269 C226,270.104 226.896,271 228,271 C229.104,271 230,270.104 230,269 C230,267.896 229.104,267 228,267 L228,267 Z M220,281 C218.832,281 217.704,280.864 216.62,280.633 L211.912,283.463 L211.975,278.824 C208.366,276.654 206,273.066 206,269 C206,262.373 212.268,257 220,257 C227.732,257 234,262.373 234,269 C234,275.628 227.732,281 220,281 L220,281 Z M220,255 C211.164,255 204,261.269 204,269 C204,273.419 206.345,277.354 210,279.919 L210,287 L217.009,282.747 C217.979,282.907 218.977,283 220,283 C228.836,283 236,276.732 236,269 C236,261.269 228.836,255 220,255 L220,255 Z M212,267 C210.896,267 210,267.896 210,269 C210,270.104 210.896,271 212,271 C213.104,271 214,270.104 214,269 C214,267.896 213.104,267 212,267 L212,267 Z M220,267 C218.896,267 218,267.896 218,269 C218,270.104 218.896,271 220,271 C221.104,271 222,270.104 222,269 C222,267.896 221.104,267 220,267 L220,267 Z" id="comment-3" sketch:type="MSShapeGroup"> </path> </g> </g> </g></svg>
                                    </div>
                                    <textarea name="comment" placeholder="Write a comment here" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="" cols="30" rows="1" required></textarea>
                                </div>
                                
                                
                                <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                                <input style="display: none" type="file" name="attachments[]" id="attachments" multiple>

                            
                                <button type="button" onClick="document.getElementById('attachments').click()" class="py-1 ms-2 ">
                                    <svg fill="#686D76" class="w-10" viewBox="-1.5 0 19 19" xmlns="http://www.w3.org/2000/svg" class="cf-icon-svg"><path d="M11.26 16.151h-.043a4.012 4.012 0 0 1-2.809-1.182L1.667 8.227a2.799 2.799 0 0 1 0-3.954l.065-.065a2.799 2.799 0 0 1 3.954 0l6.855 6.856a1.752 1.752 0 1 1-2.478 2.478L5.424 8.903a.554.554 0 0 1 .784-.784l4.639 4.64a.644.644 0 1 0 .91-.912L4.903 4.991a1.694 1.694 0 0 0-2.386 0l-.066.066a1.694 1.694 0 0 0 0 2.386l6.742 6.742a2.908 2.908 0 0 0 2.037.858h.031a2.76 2.76 0 0 0 2.782-2.814 2.91 2.91 0 0 0-.858-2.037l-7.03-7.03a.554.554 0 1 1 .784-.783l7.03 7.03a4.01 4.01 0 0 1 1.183 2.809 3.868 3.868 0 0 1-3.89 3.933z"/></svg>
                                </button>
                                <button type="submit" class="p-2.5 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    Send
                                </button>
                            </form>
                            @error('comment')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                            @error('attachments.*')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    @else
                        <div class="mt-6">
                            <p class="text-center text-sm">Support ticket status is closed.</p>
                        </div>
                    @endif
                    
                </div>

            </div>
        </div>
    </div>
</x-app-layout>


<script >
    const gallery = new Viewer(document.getElementById('images'));
</script>