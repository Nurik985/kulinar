<div>
    <section class="bg-white dark:bg-gray-900">
        <div class="mx-auto max-w-screen-xl">
            <!-- Start coding here -->
            <div class="bg-white dark:bg-gray-800 relative border rounded-lg overflow-hidden">
                <div
                    class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                    <div class="w-1/3 md:w-1/3">
                        <form class="flex items-center m-0">
                            <label for="simple-search" class="sr-only">Поиск...</label>
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                        fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input wire:model.live.debounce.300ms="search" type="text" id="simple-search"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-100 focus:border-gray-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Поиск..." required="">
                            </div>
                        </form>
                    </div>
                    <div
                        class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                        <a href="{{ route('rubrica.param-create') }}"
                            class="flex items-center justify-center text-white bg-green-500 hover:bg-green-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                            <i class="ti ti-list-details mr-2"></i>
                            Добавить по параметрам
                        </a>
                        <a href="{{ route('rubrica.manual-create') }}"
                            class="flex items-center justify-center text-white bg-green-500 hover:bg-green-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                            <i class="ti ti-hand-click mr-2"></i>
                            Добавить рубрику вручную
                        </a>
                        <div class="flex items-center space-x-3 w-full md:w-auto">
                            <select wire:model.live="perPage"
                                class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900  bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
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
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-4 py-3">Заголовок</th>
                                <th scope="col" class="px-4 py-3">Раздел</th>
                                <th scope="col" class="px-4 py-3">Кол. рецептов в рубрике</th>
                                <th scope="col" class="px-4 py-3">Тип</th>
                                <th scope="col" class="px-4 py-3">Дата</th>
                                <th scope="col" class="px-4 py-3">
                                    <span class="sr-only"></span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($headings) > 0)
                            @foreach ($headings as $k => $heading)
                            <tr wire:key="{{ $heading->id }}"
                                class="border-b dark:border-gray-700 text-gray-900 font-medium">
                                <td class="px-4 py-3">{{ $heading->name }}</td>
                                <td class="px-4 py-3">{{ $heading->parent_sect }}</td>
                                <td class="px-4 py-3">{{ $heading->col_recipe }}</td>
                                <td class="px-4 py-3">{{ $heading->type }}</td>
                                <td class="px-4 py-3">{{ $heading->updated_at->format("d.m.Y") }}</td>
                                <td class="px-4 py-3 flex items-center justify-end">
                                    <a href="{{ route('rubrica.edit',$heading->id) }}"
                                        class=" btn btn-sm btn-icon item-edit mr-2"><i
                                            class="text-green-500 ti ti-pencil"></i></a>
                                    <a href="javascript:;" class="btn btn-sm btn-icon item-edit mr-2"><i
                                            class="text-purple-500 ti ti-eye"></i></a>
                                    <span class="btn btn-sm btn-icon item-edit cursor-pointer"><i
                                            class="text-red-800 ti ti-trash"></i></span>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="4" class="p-5 text-center text-sm text-red-400">Поиск не дал никаких
                                    результатов</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                {{ $headings->links() }}
            </div>
        </div>

        <div id="delMod" wire:ignore tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
            <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                <!-- Modal content -->
                <div class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                    <svg class="text-red-600 dark:text-gray-500 w-11 h-11 mb-3.5 mx-auto" aria-hidden="true"
                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <p class="mb-4 text-gray-500 dark:text-gray-300">Вы точно хотите удалить раздел <br> <span
                            id="mTitle"></span>? </p>
                    <div class="flex justify-center items-center space-x-4">
                        <button wire:click="closeDeleteModal" type="button"
                            class="w-20 py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
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