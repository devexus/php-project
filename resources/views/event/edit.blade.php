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
                        <form method="post" action="{{ route('event.update', $event->id) }}" class="mt-6 space-y-6">
                            @csrf
                            @method('patch')
                            <div>
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $event->name)" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>
                            <div>
                                <x-input-label for="date_start" :value="__('Date start')" />
                                <x-text-input id="date_start" format="d-m-Y" name="date_start" type="date" class="mt-1 block w-full" :value="old('date_start', $event->date_start)" />
                                <x-input-error class="mt-2" :messages="$errors->get('date_start')" />
                            </div>
                            <div>
                                <x-input-label for="date_end" :value="__('Date end')" />
                                <x-text-input id="date_end" name="date_end" type="date" class="mt-1 block w-full" :value="old('date_end', $event->date_end)" />
                                <x-input-error class="mt-2" :messages="$errors->get('date_end')" />
                            </div>
                            <div>
                                <x-input-label for="description" :value="__('Description')" />
                                <x-textarea id="description" name="description" class="mt-1 block w-full">
                                    {{old('description', $event->description)}}
                                </x-textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('date_end')" />
                            </div>
                            <div>
                                <x-input-label for="image_url" :value="__('Image url')" />
                                <x-text-input id="image_url" name="image_url" type="text" class="mt-1 block w-full" :value="old('image_url', $event->image_url)" />
                                <x-input-error class="mt-2" :messages="$errors->get('image_url')" />
                            </div>
                            <div>
                                <x-input-label for="category_id" :value="__('Category')" />
                                <x-select id="category_id" name="category_id" class="mt-1 block w-full" :value="old('category_id', $event->category->id)">
                                    @foreach($categories as $category)
                                    <option value="{{$category->id}}" @if($category->id ==$event->category->id) selected @endif>
                                        {{$category->name}}
                                    </option>
                                    @endforeach
                                </x-select>
                                <x-input-error class="mt-2" :messages="$errors->get('image_url')" />
                            </div>
                            <x-primary-button>{{ __('Update') }}</x-primary-button>
                    </section>
                </div>
            </div>
        </div>
</x-app-layout>