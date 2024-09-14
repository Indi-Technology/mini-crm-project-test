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
                    <a class="bg-gray-500 text-white font-semibold px-4 py-2 rounded shadow-sm" href="/admin/logs">< Back To Ticket Logs Data</a>
                    
                    <div class="mt-6">                
                        <ol class="relative border-s border-gray-200 dark:border-gray-700">               
                            @if ($ticket->logs->isEmpty())
                                Logs is not found.
                            @else
                                @foreach ($ticket->logs as $log)
                                    <li class="mb-10 ms-4">
                                        <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -start-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
                                        <time class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">{{ Carbon\Carbon::parse($log->created_at)->format('d F Y G:i') }}</time>
                                        <p class="text-base font-normal text-gray-500 dark:text-gray-400">
                                            @if ($log->action == "created")
                                                A new support ticket has been created with ID #{{$ticket->id}} by {{ $log->user->name }}.
                                            @elseif($log->action == "updated")
                                                Support ticket with ID #{{$ticket->id}} has been updated by {{ $log->user->name }}.
                                            @elseif($log->action == "commented")
                                                {{ $log->user->name }} added a comment to support ticket with ID #{{$ticket->id}}.
                                            @else
                                                Ticket with ID #{{$ticket->id}} is <span class="capitalize">{{ $ticket->action }}</span> by {{ $log->user->name }}
                                            @endif
                                        </p>
                                    </li>
                                @endforeach
                            @endif
                        </ol>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>