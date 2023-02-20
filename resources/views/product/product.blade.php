<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('lang.product') }}
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
                                {{ __('lang.create_product') }}
                            </x-primary-button>
                            @if (session('status') === 'product-updated')
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
                                    {{ __('lang.product_udpated_successfully') }}
                                </div>
                            @endif
                            @if (session('status') === 'product-deleted')
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
                                    {{ __('lang.product_deleted_successfully') }}
                                </div>
                            @endif
                            @if (session('status') === 'product-error')
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
                                    {{ __('lang.product_error') }}
                                </div>
                            @endif
                        </div>
                        {{-- modal form --}}
                        <x-modal name="create-product" :show="$errors->productCreating->isNotEmpty() || session('status') === 'product-created'" focusable>
                            <form enctype="multipart/form-data" method="post" action="{{ route('product.store') }}"
                                class="p-6">
                                @csrf
                                @method('post')
                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    {{ __('lang.add_new_product_text') }}
                                </h2>
                                {{-- media --}}
                                <div class="flex justify-start">
                                    <div class="mb-3 w-96 ">
                                        <x-input-label class="py-2" for="media"
                                            value="{{ __('lang.produc_media') }}" />
                                        <input name="media"
                                            class="form-control
                                      block
                                      w-full
                                      px-3
                                      py-1.5
                                      text-base
                                      font-normal
                                      text-gray-700
                                      bg-white bg-clip-padding
                                      border border-solid border-gray-300
                                      rounded
                                      transition
                                      ease-in-out
                                      m-0
                                      focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                            type="file" id="formFile">
                                    </div>
                                </div>
                                <x-input-error :messages="$errors->productCreating->get('media')" class="mt-2" />
                                {{-- option --}}
                                <x-input-label class="py-2" for="category_id" value="{{ __('lang.category') }}" />
                                <select class="rounded-md bg-gray-100" name="category_id">
                                    <option disabled selected>...</option>
                                    @foreach (App\Models\Category::all() as $index => $data)
                                        <option class="text-gray-500" value="{{ $data->id }}">{{ $data->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->productCreating->get('category_id')" class="mt-2" />
                                {{-- name --}}
                                <div class="my-1">
                                    <x-input-label class="py-2" for="name" value="{{ __('lang.name') }}" />

                                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-3/4"
                                        placeholder="{{ __('lang.product_text') }}" />

                                    <x-input-error :messages="$errors->productCreating->get('name')" class="mt-2" />
                                </div>
                                {{-- description --}}
                                <div class="flex justify-start">
                                    <div class="mb-3 xl:w-96">
                                        <x-input-label class="py-2" for="description"
                                            value="{{ __('lang.product_description') }}" />

                                        <textarea name="description"
                                            class="
          form-control
          block
          w-full
          px-3
          py-1.5
          text-base
          font-normal
          text-gray-700
          bg-white bg-clip-padding
          border border-solid border-gray-300
          rounded
          transition
          ease-in-out
          m-0
          focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none
        "
                                            id="exampleFormControlTextarea1" rows="3" placeholder="{{ __('lang.product_description_place') }}"></textarea>
                                    </div>
                                </div>
                                <x-input-error :messages="$errors->productCreating->get('description')" class="mt-2" />
                                <div class="mt-6 flex justify-end">
                                    @if (session('status') === 'product-created')
                                        <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                            class="bg-green-100 rounded-lg py-1 px-2  mb-3 text-base text-green-700 inline-flex items-center w-fit"
                                            role="alert">

                                            {{ __('lang.product_created_successfuly') }}</p>
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
                    @livewire('show-products')

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
