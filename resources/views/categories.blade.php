<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="flex font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Categories') }}
            </h2>
            <x-button-link :href="route('category')">{{ __('Add new category') }}</x-button-link>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                @if (\Session::has('error'))
                <div class="p-2 text-red-600">
                    <ul>
                        <li>{!! \Session::get('error') !!}</li>
                    </ul>
                </div>
                @endif
                <div class="p-6 text-gray-900">
                    <div class="flex flex-col gap-5">
                        @if ($categories->isEmpty())
                        <div> {{ __('No results') }}</div>
                        @else
                        <div class="table  border-separate w-full border border-slate-400 bg-white bg-slate-100 text-sm shadow-sm ">
                            <div class="table-header-group bg-slate-50 dark:bg-slate-700">
                                <div class="table-row">
                                    <div class="table-cell border border-slate-300 dark:border-slate-600 font-semibold p-4 text-slate-900 dark:text-slate-200 text-left">Color</div>
                                    <div class="table-cell border border-slate-300 dark:border-slate-600 font-semibold p-4 text-slate-900 dark:text-slate-200 text-left">Name</div>
                                    <div class="table-cell border border-slate-300 dark:border-slate-600 font-semibold p-4 text-slate-900 dark:text-slate-200 text-left">Actions</div>
                                </div>
                            </div>
                            <div class="table-row-group">
                                @foreach($categories as $category)
                                <div class="table-row my-3">
                                    <div class="table-cell border border-slate-300 dark:border-slate-700 p-4 text-slate-500 text-black">
                                        <div style="height: 20px; width: 20px;background-color: {{$category->color}}; border-radius: 50%;" class="border border-slate-500 border-slate-500"></div>
                                    </div>
                                    <div class="table-cell border border-slate-300 dark:border-slate-700 p-4 text-slate-500 text-black">{{$category->name}}</div>
                                    <div class="table-cell border border-slate-300 dark:border-slate-700 p-4 text-slate-500 text-black">
                                        <div class="flex gap-1">
                                            <x-button-link :href="route('category.edit', $category->id)">{{ __('Edit') }}</x-button-link>
                                            <form method="POST" action="{{ route('categories.destroy', $category->id) }}">
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