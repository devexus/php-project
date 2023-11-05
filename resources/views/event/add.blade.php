<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add new event') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <form method="post" action="{{ route('event.store') }}" class="mt-6 space-y-6">
                            @csrf
                            @method('post')
                            <div>
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>
                            <div>
                                <x-input-label for="date_start" :value="__('Date start')" />
                                <x-text-input id="date_start" name="date_start" type="date" class="mt-1 block w-full" />
                                <x-input-error class="mt-2" :messages="$errors->get('date_start')" />
                            </div>
                            <div>
                                <x-input-label for="date_end" :value="__('Date end')" />
                                <x-text-input id="date_end" name="date_end" type="date" class="mt-1 block w-full" />
                                <x-input-error class="mt-2" :messages="$errors->get('date_end')" />
                            </div>
                            <div>
                                <x-input-label for="description" :value="__('Description')" />
                                <x-textarea id="description" name="description" class="mt-1 block w-full" />
                                <x-input-error class="mt-2" :messages="$errors->get('date_end')" />
                            </div>
                            <div>
                                <x-input-label for="image_url" :value="__('Image url')" />
                                <x-text-input id="image_url" name="image_url" type="text" class="mt-1 block w-full" />
                                <x-input-error class="mt-2" :messages="$errors->get('image_url')" />
                            </div>
                            <div>
                                <x-input-label for="category_id" :value="__('Category')" />
                                <x-select id="category_id" name="category_id" class="mt-1 block w-full">
                                    @foreach($categories as $category)
                                    <option value="{{$category->id}}">
                                        {{$category->name}}
                                    </option>
                                    @endforeach
                                </x-select>
                                <x-input-error class="mt-2" :messages="$errors->get('image_url')" />
                            </div>
                            <x-primary-button>{{ __('Add') }}</x-primary-button>
                    </section>
                </div>
            </div>
        </div>
</x-app-layout>