<div>
    <section class="bg-white dark:bg-gray-900">
        <div class="mx-auto max-w-screen-xl">
            <!-- Start coding here -->
            <button wire:ignore id="dropdownCheckboxButton" data-dropdown-toggle="dropdownDefaultCheckbox" class="flex items-center justify-center rounded-lg bg-gray-500 px-4 py-2 text-sm mb-5 font-medium text-white hover:bg-gray-800 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800" type="button"><i class="ti ti-columns mr-2"></i> Выбрать столбцы <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                </svg>
            </button>
            <!-- Dropdown menu -->
            <div wire:ignore id="dropdownDefaultCheckbox" class="z-50 hidden w-48 bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600">

                <ul class="p-3 bg-gray-300 space-y-3 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownCheckboxButton">
                    @foreach($rowSows as $key => $rowSow)
                        <li>
                            <div class="flex items-center">
                                <input wire:click="rowShowRender({{$key}})" id="checkbox-item-{{$key}}" type="checkbox" @if($rowSows[$key]['status']) checked @endif value="" class="cursor-pointer  h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="checkbox-item-{{$key}}" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300 cursor-pointer">{{$rowSows[$key]['name']}}</label>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="relative overflow-hidden rounded-lg border bg-white dark:bg-gray-800">
                <div
                    class="flex flex-col items-center justify-between space-y-3 p-4 md:flex-row md:space-x-4 md:space-y-0">
                    <div class="w-full md:w-1/2">
                        <form class="m-0 flex items-center">
                            <label for="simple-search" class="sr-only">Поиск...</label>
                            <div class="relative w-full">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <svg aria-hidden="true" class="h-5 w-5 text-gray-500 dark:text-gray-400"
                                         fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                              d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                              clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input wire:model.live.debounce.300ms="search" type="text" id="simple-search"
                                       class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2 pl-10 text-sm text-gray-900 focus:border-gray-500 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                                       placeholder="Поиск..." required="">
                            </div>
                        </form>
                    </div>
                    <div
                        class="flex w-full flex-shrink-0 flex-col items-stretch justify-end space-y-2 md:w-auto md:flex-row md:items-center md:space-x-3 md:space-y-0">
                        <a href="{{ route('razdel.create') }}"
                           class="flex items-center justify-center rounded-lg bg-green-500 px-4 py-2 text-sm font-medium text-white hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            <svg class="mr-2 h-3.5 w-3.5" fill="currentColor" viewbox="0 0 20 20"
                                 xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path clip-rule="evenodd" fill-rule="evenodd"
                                      d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                            </svg>
                            Добавить рецепт
                        </a>
                        <div class="flex w-full items-center space-x-3 md:w-auto">
                            <select wire:model.live="perPage"
                                    class="flex w-full items-center justify-center rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white md:w-auto">
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
                            @foreach($rowSows as $key => $rowSow)
                                @if($rowSows[$key]['name'] == 'Заголовок' && $rowSows[$key]['status'] == true)
                                    <th scope="col" class="border border-gray-400 px-4 py-3">
                                        <div class="flex items-center">
                                            {{$rowSows[$key]['name']}}
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
                                @elseif($rowSows[$key]['status'] == true)
                                    <th scope="col" class="border border-gray-400 px-4 py-3"><span class="w-[130px]">{{$rowSows[$key]['name']}}</span></th>
                                @endif
                            @endforeach
                                <th scope="col" class="border border-r-0 border-gray-400 px-4 py-3">
                                    <span class="sr-only"></span>
                                </th>
                        </tr>
                        </thead>
                        <tbody>
                        @if (count($recipes) > 0)
                            @foreach ($recipes as $k => $recipe)
                                <tr wire:key="{{ $recipe->id }}"
                                    class="border-b font-medium text-gray-900 dark:border-gray-700">
                                    @foreach($rowSows as $key => $rowSow)
                                        @if($rowSows[$key]['name'] == 'Заголовок' && $rowSows[$key]['status'] == true)
                                            <td class="w-1/3 px-4 py-3">{{ $recipe->name }}</td>
                                        @elseif($rowSows[$key]['name'] == 'Дата публикации' && $rowSows[$key]['status'] == true)
                                            <td class="w-min-[80px] border px-4 py-3">{{ $recipe->created_at->format('d-m-Y') }}</td>
                                        @elseif($rowSows[$key]['name'] == 'Изменено' && $rowSows[$key]['status'] == true)
                                            <td style="width: 130px !important;"  class=" border px-4 py-3">{{ $recipe->updated_at->format('d-m-Y') }}</td>
                                        @elseif($rowSows[$key]['name'] == 'Рейтинг' && $rowSows[$key]['status'] == true)
                                            <td class="w-min-[80px] border px-4 py-3"><span class="text-green-500">{{ $recipe->positive_rating }}</span> / <span class="text-red-500">{{ $recipe->negative_rating }}</span></td>
                                        @elseif($rowSows[$key]['name'] == 'Количество шагов' && $rowSows[$key]['status'] == true)
                                            <td class="w-fit border px-4 py-3">
                                                @php
                                                    $steps = json_decode(preg_replace("/[\r\n]+/", "<br>",$recipe->steps),true);
                                                    $all_col = count($steps);
                                                    echo $all_col;
                                                @endphp
                                            </td>
                                        @elseif($rowSows[$key]['name'] == 'Кухня' && $rowSows[$key]['status'] == true)
                                            <td class="w-fit border px-4 py-3">
                                                @php
                                                    $methods = json_decode(preg_replace("/[\r\n]+/", "<br>",$recipe->world),true);
                                                    if($methods){
                                                        $methods = implode('<br>', $methods);
                                                    }
                                                    echo $methods;
                                                @endphp
                                            </td>
                                        @elseif($rowSows[$key]['name'] == 'Статус' && $rowSows[$key]['status'] == true)
                                            <td class="w-fit border px-4 py-3">{{ $recipe->status }}</td>
                                        @elseif($rowSows[$key]['name'] == 'Проверил' && $rowSows[$key]['status'] == true)
                                            <td class="w-fit border px-4 py-3">Проверил</td>
                                        @elseif($rowSows[$key]['name'] == 'Одобрил' && $rowSows[$key]['status'] == true)
                                            <td class="w-fit border px-4 py-3">Одобрил</td>
                                        @elseif($rowSows[$key]['name'] == 'Автор' && $rowSows[$key]['status'] == true)
                                            <td class="w-fit border px-4 py-3">{{ $recipe->author_id }}</td>
                                        @elseif($rowSows[$key]['name'] == 'Время готовки' && $rowSows[$key]['status'] == true)
                                            <td class="w-fit border px-4 py-3">Время готовки</td>
                                        @elseif($rowSows[$key]['name'] == 'Время приготовления' && $rowSows[$key]['status'] == true)
                                            <td class="w-fit border px-4 py-3">Время приготовления</td>
                                        @elseif($rowSows[$key]['name'] == 'Порции' && $rowSows[$key]['status'] == true)
                                            <td class="w-fit border px-4 py-3">Порции</td>
                                        @elseif($rowSows[$key]['name'] == 'Что готовим' && $rowSows[$key]['status'] == true)
                                            <td class="w-fit border px-4 py-3">Что готовим</td>
                                        @elseif($rowSows[$key]['name'] == 'Способ приготовления' && $rowSows[$key]['status'] == true)
                                            <td class="w-fit border px-4 py-3">Способ приготовления</td>
                                        @elseif($rowSows[$key]['name'] == 'Рубрика' && $rowSows[$key]['status'] == true)
                                            <td class="w-fit border px-4 py-3">Рубрика</td>
                                        @elseif($rowSows[$key]['name'] == 'Калорий' && $rowSows[$key]['status'] == true)
                                            <td class="w-fit border px-4 py-3">Калорий</td>
                                        @endif
                                    @endforeach
                                        <td class="min-w-[120px] px-4 py-3 text-center">
                                            <a href="{{ route('razdel.edit', $recipe->id) }}"
                                               class="btn btn-sm btn-icon item-edit mr-2"><i
                                                    class="ti ti-pencil text-green-500"></i></a>
                                            <a href="javascript:;" class="btn btn-sm btn-icon item-edit mr-2"><i
                                                    class="ti ti-eye text-purple-500"></i></a>
                                            <span wire:click="openDelModal({{ $recipe->id }}, '{{ $recipe->h1 }}')"
                                                  class="btn btn-sm btn-icon item-edit cursor-pointer"><i
                                                    class="ti ti-trash text-red-800"></i></span>
                                        </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="p-5 text-center text-sm text-red-400">Поиск не дал никаких
                                    результатов
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
                {{ $recipes->links() }}
            </div>
        </div>
        <div wire:ignore.self id="delMod" tabindex="-1" aria-hidden="true"
             class="fixed left-0 right-0 top-0 z-50 hidden h-modal w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0 md:h-full">
            <div class="relative h-full w-full max-w-md p-4 md:h-auto">
                <div class="relative rounded-lg bg-white p-4 text-center shadow dark:bg-gray-800 sm:p-5">
                    <svg class="mx-auto mb-3.5 h-11 w-11 text-red-600 dark:text-gray-500" aria-hidden="true"
                         fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                              clip-rule="evenodd"></path>
                    </svg>
                    <p class="mb-4 text-gray-500 dark:text-gray-300">Вы точно хотите удалить раздел <br>
                        <span wire:model.live="modText" class="text-lg font-medium">{{ $modText }}</span>?
                    </p>
                    <div class="flex items-center justify-center space-x-4">
                        <button wire:click="closeDelModal" type="button"
                                class="w-20 rounded-lg border border-gray-200 bg-gray-500 px-3 py-2 text-sm font-medium text-white hover:bg-gray-400 hover:text-white focus:z-10 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:border-gray-500 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white dark:focus:ring-gray-600">
                            Нет
                        </button>
                        <button wire:click="destroy()" wire:loading.attr="disabled" type="button"
                                class="w-20 rounded-lg bg-red-600 px-3 py-2 text-center text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                            Да
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
