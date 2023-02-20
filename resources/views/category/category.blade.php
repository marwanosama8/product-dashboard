<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- modal --}}
                    <div>
                        {{-- modal btn --}}
                        <div class=" flex items-center justify-between">
                            <x-primary-button x-data=""
                                x-on:click.prevent="$dispatch('open-modal', 'create-product')">
                                {{ __('lang.create_category') }}
                            </x-primary-button>
                            @if (session('status') === 'category-updated')
                                <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                    class="bg-green-100 rounded-lg py-5 px-6 mb-3 text-base text-green-700 inline-flex items-center w-fit"
                                    role="alert">
                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check-circle"
                                        class="w-4 h-4 mr-2 fill-current" role="img"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path fill="currentColor"
                                            d="M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zM227.314 387.314l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.249-16.379-6.249-22.628 0L216 308.118l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.249 16.379 6.249 22.628.001z">
                                        </path>
                                    </svg>
                                    {{ __('lang.category_udpated_successfully') }}
                                </div>
                            @endif
                            @if (session('status') === 'category-deleted')
                                <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                    class="bg-red-100 rounded-lg py-5 px-6 mb-3 text-base text-red-700 inline-flex items-center w-fit"
                                    role="alert">
                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="times-circle"
                                        class="w-4 h-4 mr-2 fill-current" role="img"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path fill="currentColor"
                                            d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm121.6 313.1c4.7 4.7 4.7 12.3 0 17L338 377.6c-4.7 4.7-12.3 4.7-17 0L256 312l-65.1 65.6c-4.7 4.7-12.3 4.7-17 0L134.4 338c-4.7-4.7-4.7-12.3 0-17l65.6-65-65.6-65.1c-4.7-4.7-4.7-12.3 0-17l39.6-39.6c4.7-4.7 12.3-4.7 17 0l65 65.7 65.1-65.6c4.7-4.7 12.3-4.7 17 0l39.6 39.6c4.7 4.7 4.7 12.3 0 17L312 256l65.6 65.1z">
                                        </path>
                                    </svg>
                                    {{ __('lang.category_deleted_successfully') }}
                                </div>
                            @endif
                        </div>
                        {{-- modal form --}}
                        <x-modal name="create-product" :show="$errors->categoryCreating->isNotEmpty() || session('status') === 'category-created'" focusable>
                            <form method="post" action="{{ route('category.store') }}" class="p-6">
                                @csrf
                                @method('post')

                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    {{ __('lang.add_new_product_text') }}
                                </h2>
                                <div class="mt-6">
                                    <x-input-label class="py-4" for="name" value="{{ __('lang.name') }}" />

                                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-3/4"
                                        placeholder="{{ __('lang.category_text') }}" />

                                    <x-input-error :messages="$errors->categoryCreating->get('name')" class="mt-2" />
                                </div>

                                <div class="mt-6 flex justify-end">
                                    @if (session('status') === 'category-created')
                                        <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                            class="bg-green-100 rounded-lg py-1 px-2  mb-3 text-base text-green-700 inline-flex items-center w-fit"
                                            role="alert">

                                            {{ __('lang.category_created_successfuly') }}</p>
                                        </div>
                                    @endif
                                    <x-secondary-button x-on:click="$dispatch('close')">
                                        {{ __('lang.Cancel') }}
                                    </x-secondary-button>

                                    <x-primary-button class="ml-3">
                                        {{ __('lang.create') }}
                                    </x-primary-button>
                                </div>
                            </form>
                        </x-modal>
                    </div>

                    {{-- table --}}
                    <div class="flex justify-center items-center w-full">
                        <div class="flex flex-col">
                            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                                    <div class="overflow-hidden">
                                        <table class="min-w-full">
                                            <thead class="bg-white border-b">
                                                <tr>
                                                    <th scope="col"
                                                        class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                        #
                                                    </th>
                                                    <th scope="col"
                                                        class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                        {{ __('lang.name') }}
                                                    </th>
                                                    <th scope="col"
                                                        class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                        {{ __('lang.Actions') }}
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (App\Models\Category::all()->count())

                                                    @foreach (App\Models\Category::all() as $index => $data)
                                                        <tr class="bg-gray-100 border-b">
                                                            <td
                                                                class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                                {{ $index + 1 }}</td>
                                                            <td
                                                                class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                                {{ $data->name }}
                                                            </td>
                                                            <td
                                                                class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                                <a href="#" class="text-red-500 underline"
                                                                    x-data=""
                                                                    x-on:click.prevent="$dispatch('open-modal', 'category-delete-{{ $data->id }}')"><span
                                                                        title="{{ __('lang.delete') }}"
                                                                        class="material-symbols-outlined">
                                                                        delete
                                                                    </span></a>
                                                                <a href="{{ route('category.edit', $data->id) }}"
                                                                    class="text-blue-500 underline"><span
                                                                        title="{{ __('lang.edit') }}"
                                                                        class="material-symbols-outlined">
                                                                        settings
                                                                    </span></a>
                                                            </td>
                                                        </tr>
                                                        {{-- delete modal --}}
                                                        <x-modal name="category-delete-{{ $data->id }}">
                                                            <form method="post"
                                                                action="{{ route('category.destroy', $data->id) }}"
                                                                class="p-6">
                                                                @csrf
                                                                @method('delete')

                                                                <h2
                                                                    class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                                                    {{ __('lang.Are you sure you want to delete your account?') }}
                                                                    {{ $data->name }}
                                                                </h2>

                                                                <p
                                                                    class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                                                    {{ __('lang.Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                                                                </p>



                                                                <div class="mt-6 flex justify-end">
                                                                    <x-secondary-button x-on:click="$dispatch('close')">
                                                                        {{ __('lang.Cancel') }}
                                                                    </x-secondary-button>

                                                                    <x-danger-button class="ml-3">
                                                                        {{ __('lang.Delete Account') }}
                                                                    </x-danger-button>
                                                                </div>
                                                            </form>
                                                        </x-modal>
                                                    @endforeach
                                                @else
                                                <div class="text-center font-bold ">{{__('lang.Theres no cat')}}</div>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
