<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('lang.product_edit') }}
            {{ $product->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- form --}}
                    <div class="flex justify-start items-start w-full">
                        <form enctype="multipart/form-data" method="post" action="{{ route('product.update',$product->id) }}"
                            class="p-6">
                            @csrf
                            @method('post')
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('lang.add_new_product_text') }}
                            </h2>
                            {{-- media --}}
                            @if (!empty($product->getFirstMediaUrl()))
                            <div class="p-3 rounded-md border border-gray-500">
                                <img src="{{$product->getFirstMediaUrl()}}" width="350px" alt="">
                            </div>
                            @endif
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
                            <x-input-label class="py-2" for="category_id" value="{{ __('lang.product_name') }}" />
                            <select class="rounded-md bg-gray-100" name="category_id">
                                <option value='{{$product->category->id}}' selected>{{$product->category->name}}</option>
                                @foreach (App\Models\Category::all() as $index => $data)
                                    <option class="text-gray-500" value="{{ $data->id }}">{{ $data->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->productCreating->get('category_id')" class="mt-2" />
                            {{-- name --}}
                            <div class="my-1">
                                <x-input-label class="py-2" for="name" value="{{ __('lang.name') }}" />

                                <x-text-input value='{{$product->name}}' id="name" name="name" type="text" class="mt-1 block w-3/4" 
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
                                        id="exampleFormControlTextarea1" rows="3" placeholder="{{ __('lang.product_description_place') }}" value="{{$product->description}}"></textarea>
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
                                <a href="{{ route('product') }}"
                                    class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-800 uppercase tracking-widest hover:bg-gray-400 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 ">
                                {{__('lang.back')}}
                                </a>

                                <x-primary-button class="ml-3">
                                    {{ __('lang.create') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
