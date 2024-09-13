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
                    <a class="bg-blue-500 text-white font-semibold px-4 py-2 rounded shadow-sm" href="/admin/labels/create">+ Create Label</a>
                    

                    <div class="relative overflow-x-auto mt-6">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        #
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Label Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Created At
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $index=1;
                                @endphp
                                @if($labels->isEmpty())
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                            Label Not Found 
                                        </td>
                                    </tr>
                                @else
                                    @foreach ($labels as $label)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                                <?= $index++ . "." ?>
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ $label->label_name }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ Carbon\Carbon::parse($label->created_at)->format('d F Y G:i') }}
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                <div class="flex justify-center space-x-2">
                                                    <a class="bg-yellow-500 font-bold text-black px-4 py-1 rounded shadow-sm" href="{{ "/admin/labels/edit/" . $label->id }}">Edit</a>
                                                    <form action="/admin/labels/delete" method="post">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $label->id }}">
                                                        <button class="bg-red-500 font-bold text-white px-4 py-1 rounded shadow-sm" type="submit">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                               
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-6">
                        {{ $labels->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteForms = document.querySelectorAll('form[action="/admin/labels/delete"]');

        deleteForms.forEach(form => {
            form.addEventListener('submit', function (event) {
                event.preventDefault(); 
                
                Swal.fire({
                    title: 'Apakah anda yakin untuk menghapus?',
                    text: "Setelah data terhapus, maka data tidak bisa dikembalikan",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#4e73df',
                    cancelButtonColor: '#e74a3b',
                    confirmButtonText: 'Ya, hapus data'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); 
                    }
                });
            });
        });
    });
</script>