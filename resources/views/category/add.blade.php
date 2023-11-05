<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add new category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <form method="post" action="{{ route('category.store') }}" class="mt-6 space-y-6">
                            @csrf
                            @method('post')
                            <div>
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>
                            <div>
                                <x-input-label for="color" :value="__('Color')" />
                                <x-text-input id="color" name="color" type="text" class="mt-1 block w-full" />
                                <x-input-error class="mt-2" :messages="$errors->get('color')" />
                            </div>
                            <x-primary-button>{{ __('Add') }}</x-primary-button>
                    </section>
                </div>
            </div>
        </div>
</x-app-layout>