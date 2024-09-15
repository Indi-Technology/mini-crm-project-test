@extends('admin.layouts.app')

@section('content')
<div class="container px-6 mx-auto grid">
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Users
    </h2>
    <!-- General elements -->
    <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
        Elements
    </h4>
    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Name</span>
                <input
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    placeholder="Jane Doe" 
                    name="name"/>
            </label>

            <div class="mt-4">
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Email</span>
                    <input
                        type="email"
                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                        placeholder="youremail@example.com" 
                        name="email"/>
                </label>
            </div>
            
            <div class="mt-4">
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Password</span>
                    <input
                        type="password"
                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                        placeholder="********" 
                        name="password"/>
                </label>
            </div>
            

            <div class="mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                    Account Type
                </span>
                <div class="mt-2">
                    <label class="inline-flex items-center text-gray-600 dark:text-gray-400">
                        <input type="radio"
                            class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                            name="role" value="agent" />
                        <span class="ml-2">Agent User</span>
                    </label>
                    <label class="inline-flex items-center ml-6 text-gray-600 dark:text-gray-400">
                        <input type="radio"
                            class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                            name="role" value="regular" />
                        <span class="ml-2">Regular User</span>
                    </label>
                </div>
            </div>

            <div class="flex justify-between mt-4">
                <div>
                    <button class="bg-blue-500 hover:bg-blue-400 text-white text-sm font-semibold px-4 py-2 rounded">
                    Cancel
                    </button>
                </div>
                <div>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white text-sm font-semibold px-4 py-2 rounded">
                    Add User
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection