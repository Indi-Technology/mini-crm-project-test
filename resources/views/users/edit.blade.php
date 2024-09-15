<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit ' . $user->name) }}
        </h2>
        <x-breadcrumb :items="[
            ['url' => route('dashboard'), 'label' => 'Dashboard'],
            ['url' => route('users.index'), 'label' => 'Users'],
            ['url' => '#', 'label' => 'Editing ' . $user->name],
        ]" />
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('users.update', $user->id) }}">
                @csrf
                @method('PUT')

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                        required autofocus autocomplete="name" value="{{ $user->name }}" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                        :value="old('email')" required autocomplete="username" value="{{ $user->email }}" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('New Password')" />

                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                        autocomplete="new-password" />

                    <small class="text-gray-600">Leave blank if you don't want to change the password</small>

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Select Role -->

                <div class="mt-4">
                    <x-input-label for="role" :value="__('Role')" />
                    <select id="role" name="role"
                        class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                        <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="agent" {{ $user->role == 'agent' ? 'selected' : '' }}>Agent</option>
                    </select>
                    <x-input-error :messages="$errors->get('role')" class="mt-2" />
                </div>


                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="ms-4">
                        {{ __('Update ' . $user->name) }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
