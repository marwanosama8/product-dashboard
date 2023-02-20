<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('lang.category_edit') }}
            {{ $category->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- form --}}
                    <div class="flex justify-start items-start w-full">
                        <form method="post" action="{{ route('category.update', $category->id) }}" class="p-6">
                            @csrf
                            @method('post')

                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('lang.add_new_product_text') }}
                            </h2>
                            <div class="mt-6">
                                <x-input-label class="py-4" for="name" value="{{ __('lang.name') }}" />

                                <x-text-input id="name" value='{{ $category->name }}' name="name" type="text"
                                    class="mt-1 block w-3/4" placeholder="{{ __('lang.category_text') }}" />

                                <x-input-error :messages="$errors->categoryUpdating->get('name')" class="mt-2" />
                            </div>

                            <div class="mt-6 flex justify-end">
                                <a href="{{ route('category') }}"
                                    class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-800 uppercase tracking-widest hover:bg-gray-400 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 ">
                                {{__('lang.back')}}
                                </a>

                                <x-primary-button class="ml-3">
                                    {{ __('lang.create') }}
                                </x-primary-button>
                                @if (session('status') === 'category-created')
                                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600 dark:text-gray-400">
                                        {{ __('lang.category_created_successfuly') }}</p>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
