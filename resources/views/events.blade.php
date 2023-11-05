<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="flex font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Events') }}
            </h2>
            <x-button-link :href="route('event')">{{ __('Add new events') }}</x-button-link>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if ($events->isEmpty())
                    <div> {{ __('No results') }}</div>
                    @else
                    <div class="table  border-separate w-full border border-slate-400 bg-white bg-slate-100 text-sm shadow-sm ">
                        <div class="table-header-group bg-slate-50 dark:bg-slate-700">
                            <div class="table-row">
                                <div class="table-cell border border-slate-300 dark:border-slate-600 font-semibold p-4 text-slate-900 dark:text-slate-200 text-left">Name</div>
                                <div class="table-cell border border-slate-300 dark:border-slate-600 font-semibold p-4 text-slate-900 dark:text-slate-200 text-left">Description</div>
                                <div class="table-cell border border-slate-300 dark:border-slate-600 font-semibold p-4 text-slate-900 dark:text-slate-200 text-left">Date start</div>
                                <div class="table-cell border border-slate-300 dark:border-slate-600 font-semibold p-4 text-slate-900 dark:text-slate-200 text-left">Date end</div>
                                <div class="table-cell border border-slate-300 dark:border-slate-600 font-semibold p-4 text-slate-900 dark:text-slate-200 text-left">Image url</div>
                                <div class="table-cell border border-slate-300 dark:border-slate-600 font-semibold p-4 text-slate-900 dark:text-slate-200 text-left">Category name</div>
                                <div class="table-cell border border-slate-300 dark:border-slate-600 font-semibold p-4 text-slate-900 dark:text-slate-200 text-left">Category color</div>
                                <div class="table-cell border border-slate-300 dark:border-slate-600 font-semibold p-4 text-slate-900 dark:text-slate-200 text-left">Actions</div>
                            </div>
                        </div>
                        <div class="table-row-group">
                            @foreach($events as $event)
                            <div class="table-row my-3">
                                <div class="table-cell border border-slate-300 dark:border-slate-700 p-4 text-slate-500 text-black">{{$event->name}}</div>
                                <div class="table-cell border border-slate-300 dark:border-slate-700 p-4 text-slate-500 text-black">{{$event->description}}</div>
                                <div class="table-cell border border-slate-300 dark:border-slate-700 p-4 text-slate-500 text-black">{{$event->date_start}}</div>
                                <div class="table-cell border border-slate-300 dark:border-slate-700 p-4 text-slate-500 text-black">{{$event->date_end}}</div>
                                <div class="table-cell border border-slate-300 dark:border-slate-700 p-4 text-slate-500 text-black"><a href="{{$event->image_url}}">Link</a></div>
                                <div class="table-cell border border-slate-300 dark:border-slate-700 p-4 text-slate-500 text-black">{{$event->category->name}}</div>
                                <div class="table-cell border border-slate-300 dark:border-slate-700 p-4 text-slate-500 text-black">
                                    <div style="height: 20px; width: 20px;background-color: {{$event->category->color}}; border-radius: 50%;" class="border border-slate-500 border-slate-500"></div>
                                </div>
                                <div class="table-cell border border-slate-300 dark:border-slate-700 p-4 text-slate-500 text-black">
                                    <div class="flex gap-1">
                                        <x-button-link :href="route('event.edit', $event->id)">{{ __('Edit') }}</x-button-link>
                                        <form method="POST" action="{{ route('event.destroy', $event->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <x-danger-button>{{ __('Delete') }}</x-danger-button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>