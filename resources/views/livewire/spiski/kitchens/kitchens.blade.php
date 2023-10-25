<div>
    <section class="bg-white dark:bg-gray-900">
        <div class="mx-auto max-w-screen-xl">
            <div class="relative overflow-hidden rounded-[4px] border bg-white dark:bg-gray-800">
                <div
                    class="flex flex-col items-center justify-between space-y-3 p-4 md:flex-row md:space-x-4 md:space-y-0">
                    <div class="w-full md:w-1/2">
                        <div class="m-0 flex items-center">
                            <label for="search" class="sr-only">Поиск...</label>
                            <div class="relative w-full">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <svg aria-hidden="true" class="h-5 w-5 text-gray-500 dark:text-gray-400"
                                         fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                              d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                              clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input wire:model.live.debounce.300ms="search" type="text" id="search"
                                       class="block w-full rounded-[4px] border border-gray-300 bg-gray-50 p-2 pl-10 text-sm text-gray-900 focus:border-gray-500 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                                       placeholder="Поиск...">
                            </div>
                        </div>
                    </div>
                    <div
                        class="flex w-full flex-shrink-0 flex-col items-stretch justify-end space-y-2 md:w-auto md:flex-row md:items-center md:space-x-3 md:space-y-0">
                        <a href="{{ route('spisok.kitchen.create') }}"
                           class="flex items-center justify-center text-white bg-green-500 hover:bg-green-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                            <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20"
                                 xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path clip-rule="evenodd" fill-rule="evenodd"
                                      d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                            </svg>
                            Добавить кухню
                        </a>
                        <div class="flex w-full items-center space-x-3 md:w-auto">
                            <select wire:model.live="perPage"
                                    class="flex w-full items-center justify-center rounded-[4px] border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white md:w-auto">
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="30">30</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                        <thead class="bg-gray-200 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3 border border-gray-400 border-l-0">
                                <div class="flex items-center">
                                    Название
                                    <a wire:click="setSortBy('name')" class="cursor-pointer">
                                        <svg class="ml-1.5 h-3 w-3" aria-hidden="true"
                                             xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                             viewBox="0 0 24 24">
                                            <path
                                                d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                        </svg>
                                    </a>
                                </div>
                            </th>
                            <th scope="col" class="px-4 py-3 text-xs border border-gray-400">Количество рецептов</th>
                            <th scope="col" class="px-4 py-3 border border-gray-400 border-r-0">
                                <span class="sr-only"></span>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($kitchens) > 0)
                            @foreach ($kitchens as $k => $kitchen)
                                <tr wire:key="{{ $kitchen->id }}"
                                    class="border-b dark:border-gray-700 text-gray-900 font-medium">
                                    <td class="px-4 py-3 w-1/2">{{ $kitchen->name }}</td>
                                    <td class="px-4 py-3 w-1/2 border text-gray-500 text-center"></td>
                                    <td class="px-4 py-3 flex items-center justify-end w-fit">
                                        <a href="{{ route('spisok.kitchen.edit', $kitchen->id) }}" class=" www btn btn-sm btn-icon item-edit mr-2"><i
                                                class="text-green-500 ti ti-pencil"></i></a>
                                        <a href="#" class="btn btn-sm btn-icon item-edit mr-2"><i
                                                class="text-purple-500 ti ti-eye"></i></a>
                                        <span wire:click="openDelModal({{$kitchen->id }}, '{{$kitchen->name}}')"
                                              class="btn btn-sm btn-icon item-edit cursor-pointer"><i
                                                class="text-red-800 ti ti-trash"></i></span>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="9" class="p-5 text-center text-sm text-red-400">Поиск не дал никаких
                                    результатов</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
                {{ $kitchens->links() }}
            </div>
        </div>

        <div wire:ignore.self id="delMod" tabindex="-1" aria-hidden="true"
             class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
            <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                <div class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                    <svg class="text-red-600 dark:text-gray-500 w-11 h-11 mb-3.5 mx-auto" aria-hidden="true"
                         fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                              clip-rule="evenodd"></path>
                    </svg>
                    <p class="mb-4 text-gray-500  dark:text-gray-300">Вы точно хотите удалить кухню <br>
                        <span wire:model="modText" class="text-lg font-medium">{{ $modText }}</span>?
                    </p>
                    <div class="flex justify-center items-center space-x-4">
                        <button wire:click="closeDelModal" type="button"
                                class="w-20 py-2 px-3 text-sm font-medium text-white bg-gray-500 rounded-lg border border-gray-200 hover:bg-gray-400 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-white focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                            Нет
                        </button>
                        <button wire:click="destroy()" wire:loading.attr="disabled" type="button"
                                class="w-20 py-2 px-3 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                            Да
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
