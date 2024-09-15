<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Buat Tiket') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Lengkapi data berikut ini untuk membuat tiket baru!') }}
        </p>
    </header>
    <form method="post" action="{{ route('ticket.store') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        <div>
            <x-input-label for="title" :value="__('Title')" />
            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title')" required
                autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('title')" />
        </div>

        <div>
            <x-input-label for="description" :value="__('Description')" />
            <x-textarea-input id="description" name="description" type="text" class="mt-1 block w-full"
                :value="old('description')" required autocomplete="description"></x-textarea-input>
            <x-input-error class="mt-2" :messages="$errors->get('description')" />
        </div>

        <div>
            <x-input-label for="labels" :value="__('Labels')" />
            <div class="flex items-start mt-2 mb-5">
                @foreach ($label as $item)
                    <div class="flex mb-2 sm:mt-0">
                        <div class="flex items-center h-5">
                            <input id="category" type="checkbox" name="labels[]" value="{{ $item->id }}"
                                class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300" />
                        </div>
                        <label for="category" class="ms-2 text-sm font-medium text-gray-900 me-5">{{ $item->label_name }}</label>
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
                                class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300" />
                        </div>
                        <label for="remember" class="ms-2 text-sm font-medium text-gray-900 me-5">{{ $item->category_name }}</label>
                    </div>
                @endforeach
                <x-input-error class="mt-2" :messages="$errors->get('categories')" />
            </div>
        </div>

        <div>
            <x-input-label for="priority" :value="__('Priority')" />
            <select name="priority" required
                class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mt-2">
                <option active>-- pilih --</option>
                <option value="High">High</option>
                <option value="Medium">Medium</option>
                <option value="Low">Low</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('priority')" />
        </div>
        <div>
            <x-input-label for="attachment" :value="__('Attachment')" />
            <input name="attachment" required
                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer focus:outline-none p-1"
                aria-describedby="user_avatar_help" id="user_avatar" type="file">
            <div class="mt-1 text-sm text-gray-500" id="user_avatar_help">Max size 2 MB</div>
            <x-input-error class="mt-2" :messages="$errors->get('attachment')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
