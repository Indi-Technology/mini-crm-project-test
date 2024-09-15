<div class="max-w-8xl mx-auto sm:px-6 lg:px-4">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg pb-2">
            <div class="px-6 pt-4">
                <h2 class="font-semibold text-xl text-gray-800">Comment</h2>
            </div>
            <div class="flex flex-col p-4 bg-gray-50 mt-4 mx-6 rounded-t-md">
                @foreach ($comments_data as $item)
                    <div class="bg-orange-200 flex items-end w-fit p-2 my-1 rounded-lg">
                        <div class="flex flex-col">
                            <div class="mb-2">
                                <p class="font-bold text-md text-gray-800">{{ $item->user->name }}</p>
                                <p class="font-thin text-xs text-gray-800">
                                    {{ $item->created_at->isoFormat('D MMM Y, HH.mm') }}</p>
                            </div>
                            <div class="">
                                <p>{{ $item->comment }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="px-6">
                <div class="mb-1 inline-flex w-full flex-row">
                    <input type="text" id="base-input" placeholder="Type . . ." wire:model="comment"
                        class="bg-white border border-gray-300 text-gray-900 text-sm rounded-bl-md block w-full p-2.5 ">
                    <button wire:click="store()"
                        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-br-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Send</button>
                </div>
                @if ($errors->any())
                    <div class="text-sm text-red-600 space-y-1 mb-2">
                        <ul>
                            @foreach ($errors->all() as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
