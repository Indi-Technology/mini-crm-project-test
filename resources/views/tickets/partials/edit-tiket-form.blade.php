<section>
    <form method="post" action="{{ route('ticket.update', $ticket->id) }}" class="mt-6 space-y-6"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div>
            <x-input-label for="title" :value="__('Title')" />
            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $ticket->title)" required
                autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('title')" />
        </div>

        <div>
            <x-input-label for="description" :value="__('Description')" />
            <textarea id="description" name="description" type="text"
                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                required autocomplete="description">{{ old('description', $ticket->description) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('description')" />
        </div>

        <div>
            <x-input-label for="labels" :value="__('Labels')" />
            <div class="flex items-start mt-2 mb-5">
                @foreach ($labels as $item)
                    <div class="flex mb-2 sm:mt-0">
                        <div class="flex items-center h-5">
                            <input id="category" type="checkbox" name="labels[]" value="{{ $item->id }}"
                                class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300"
                                @if ($ticket->tiket_label->contains($item->id)) checked @endif />
                        </div>
                        <label for="category"
                            class="ms-2 text-sm font-medium text-gray-900 me-5">{{ $item->label_name }}</label>
                    </div>
                @endforeach
                <x-input-error class="mt-2" :messages="$errors->get('labels')" />
            </div>
        </div>
        <div>
            <x-input-label for="categories" :value="__('Categories')" />
            <div class="flex flex-col sm:flex-row items-start mt-2 mb-5">
                @foreach ($categories as $item)
                    <div class="flex mb-2 sm:mt-0">
                        <div class="flex items-center h-5">
                            <input id="remember" type="checkbox" name="categories[]" value="{{ $item->id }}"
                                class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300"
                                @if ($ticket->tiket_category->contains($item->id)) checked @endif />
                        </div>
                        <label for="remember"
                            class="ms-2 text-sm font-medium text-gray-900 me-5">{{ $item->category_name }}</label>
                    </div>
                @endforeach
                <x-input-error class="mt-2" :messages="$errors->get('categories')" />
            </div>
        </div>

        <div>
            <x-input-label for="priority" :value="__('Priority')" />
            <select name="priority" required
                class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mt-2">
                <option disabled>-- pilih --</option>
                <option value="High" {{ $ticket->priority === 'High' ? 'selected' : '' }}>High</option>
                <option value="Medium" {{ $ticket->priority === 'Medium' ? 'selected' : '' }}>Medium</option>
                <option value="Low" {{ $ticket->priority === 'Low' ? 'selected' : '' }}>Low</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('priority')" />
        </div>

        <div>
            <x-input-label for="status" :value="__('Status')" />
            <select name="status" required
                class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mt-2">
                <option disabled>-- pilih --</option>
                <option value="Open" {{ $ticket->status === 'Open' ? 'selected' : '' }}>Open</option>
                <option value="In Progress" {{ $ticket->status === 'In Progress' ? 'selected' : '' }}>In Progress
                </option>
                <option value="Closed" {{ $ticket->status === 'Closed' ? 'selected' : '' }}>Closed</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('status')" />
        </div>

        @can('admin')
            <div>
                <x-input-label for="assigned_to" :value="__('Assigned To')" />
                <select name="assigned_to" required
                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mt-2">
                    <option>-- pilih --</option>
                    @foreach ($agent as $a)
                        <option value="{{ $a->id }}" {{ $ticket->assigned_to == $a->id ? 'selected' : '' }}>
                            {{ $a->name }}
                        </option>
                    @endforeach
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('assigned_to')" />
            </div>
        @endcan

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
