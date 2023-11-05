<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <form method="post" action="{{ route('category.update', $category->id) }}" class="mt-6 space-y-6">
                            @csrf
                            @method('patch')
                            <div>
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" name="name" type="text" :value="old('name', $category->name)" class="mt-1 block w-full" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>
                            <div>
                                <x-input-label for="color" :value="__('Color')" />
                                <x-text-input id="color" name="color" type="text" :value="old('color', $category->color)" class="mt-1 block w-full" />
                                <x-input-error class="mt-2" :messages="$errors->get('color')" />
                            </div>
                            <x-primary-button>{{ __('Update') }}</x-primary-button>
                    </section>
                </div>
            </div>
        </div>
</x-app-layout>