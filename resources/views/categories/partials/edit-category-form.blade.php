<section>
    <form method="post" action="{{ route('category.update', $category->id) }}" class="mt-6 space-y-6">
        @csrf
        @method('PUT')
        <div>
            <x-input-label for="name" :value="__('Nama Kategori')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $category->category_name)" required
                autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</section>
