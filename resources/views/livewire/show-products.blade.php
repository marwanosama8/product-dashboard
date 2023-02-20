<div>
    <div class="flex justify-around gap-0 my-4">
        <div class="flex flex-col gap-2">
            <label for="category" class="text-gray-700">{{ __('lang.category_filter') }}:</label>
            <select wire:model='selected.category' class="rounded-md bg-gray-100" name="category_id">
                <option selected>...</option>
                @foreach (App\Models\Category::all() as $index => $data)
                    <option class="text-gray-500" value="{{ $data->id }}">{{ $data->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="flex flex-col gap-2">
            <label for="category" class="text-gray-700">{{ __('lang.name_filter') }}:</label>
            <input wire:model='selected.name' type="text" class="rounded-md">
        </div>
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
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        #
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        {{ __('lang.produc_media') }}
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        {{ __('lang.category_text') }}
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        {{ __('lang.name') }}
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        {{ __('lang.product_description') }}
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        {{ __('lang.Actions') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($products))
                                    @foreach ($products as $index => $data)
                                        <tr class="bg-gray-100 border-b">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $index + 1 }}</td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                <img src="{{ $data->getFirstMediaUrl() }}" width="100px"
                                                    alt="">
                                            </td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                {{ $data->category->name }}
                                            </td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                {{ $data->name }}
                                            </td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                {{ $data->description }}
                                            </td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                <a href="#" class="text-red-500 underline" x-data=""
                                                    x-on:click.prevent="$dispatch('open-modal', 'product-delete-{{ $data->id }}')"><span
                                                        title="{{ __('lang.delete') }}"
                                                        class="material-symbols-outlined">
                                                        delete
                                                    </span></a>
                                                <a href="{{ route('product.edit', $data->id) }}"
                                                    class="text-blue-500 underline"><span title="{{ __('lang.edit') }}"
                                                        class="material-symbols-outlined">
                                                        settings
                                                    </span></a>
                                            </td>
                                        </tr>
                                        {{-- delete modal --}}
                                        <x-modal name="product-delete-{{ $data->id }}">
                                            <form method="post" action="{{ route('product.destroy', $data->id) }}"
                                                class="p-6">
                                                @csrf
                                                @method('delete')

                                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                                    {{ __('lang.Are you sure you want to delete your account?') }}
                                                    {{ $data->name }}
                                                </h2>

                                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
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
                                    <tr>
                                        <div class="text-center font-bold ">There's no product right
                                            now</div>
                                    </tr>
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
