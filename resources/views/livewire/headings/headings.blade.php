<?php
use App\Models\Section;
?>
<div>
    <section class="bg-white dark:bg-gray-900">
        <div class="mx-auto max-w-screen-xl">
            <!-- Start coding here -->
            <div class="relative overflow-hidden rounded-lg border bg-white dark:bg-gray-800">
                <div
                    class="flex flex-col items-center justify-between space-y-3 p-4 md:flex-row md:space-x-4 md:space-y-0">
                    <div class="w-1/3 md:w-1/3">
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
                        <a href="{{ route('rubrica.param-create') }}"
                            class="flex items-center justify-center rounded-lg bg-green-500 px-4 py-2 text-sm font-medium text-white hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            <i class="ti ti-list-details mr-2"></i>
                            Добавить по параметрам
                        </a>
                        <a href="{{ route('rubrica.manual-create') }}"
                            class="flex items-center justify-center rounded-lg bg-green-500 px-4 py-2 text-sm font-medium text-white hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            <i class="ti ti-hand-click mr-2"></i>
                            Добавить рубрику вручную
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
                                <th scope="col" class="border border-l-0 border-gray-400 px-4 py-3">Заголовок</th>
                                <th scope="col" class="border border-gray-400 px-4 py-3 text-center">Раздел</th>
                                <th scope="col" class="border border-gray-400 px-4 py-3 text-center">Кол. рецептов
                                </th>
                                <th scope="col" class="border border-gray-400 px-4 py-3 text-center">Тип</th>
                                <th scope="col" class="border border-gray-400 px-4 py-3 text-center">Дата</th>
                                <th scope="col" class="w-fit border border-r-0 border-gray-400 px-4 py-3"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($headings) > 0)
                                @foreach ($headings as $k => $heading)
                                    <tr wire:key="{{ $heading->id }}"
                                        class="border-b font-medium text-gray-900 dark:border-gray-700">
                                        <td class="w-1/2 px-4 py-3">{{ $heading->name }}</td>
                                        <td class="w-1/5 border px-4 py-3 text-left">
                                            @php

                                                foreach ($heading->sections as $key => $value) {
                                                    echo $value->h1.'<br>';
                                                }
//                                                $sections = json_decode($heading->parent_sect);
//
//                                                if ($sections) {
//                                                    foreach ($sections as $key => $value) {
//                                                        $section = Section::find($value);
//                                                        echo '<p class="text-[12px]">' . $section->h1 . '</p>';
//                                                    }
//                                                }
                                            @endphp
                                        </td>
                                        <td class="border px-4 py-3 text-center">{{ $heading->col_recipe }}</td>
                                        <td class="w-1/6 border px-4 py-3 text-center">
                                            {{ $heading->type == 1 ? 'по параметрам' : 'ручная' }}</td>
                                        <td class="border px-4 py-3 text-center">
                                            {{ $heading->updated_at->format('d.m.Y') }}</td>
                                        <td class="m-w-[80px] h-full px-4 py-3">
                                            <div class="flex">
                                                <a href="{{ route('rubrica.edit', $heading->id) }}"
                                                    class="btn btn-sm btn-icon item-edit mr-2"><i
                                                        class="ti ti-pencil text-green-500"></i></a>
                                                <a href="javascript:;" class="btn btn-sm btn-icon item-edit mr-2"><i
                                                        class="ti ti-eye text-purple-500"></i></a>
                                                <span
                                                    wire:click="openDelModal({{ $heading->id }}, '{{ $heading->name }}')"
                                                    class="btn btn-sm btn-icon item-edit cursor-pointer"><i
                                                        class="ti ti-trash text-red-800"></i></span>
                                            </div>
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

        <div wire:ignore.self id="delMod" tabindex="-1" aria-hidden="true"
            class="fixed left-0 right-0 top-0 z-50 hidden h-modal w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0 md:h-full">
            <div class="relative h-full w-full max-w-md p-4 md:h-auto">
                <!-- Modal content -->
                <div class="relative rounded-lg bg-white p-4 text-center shadow dark:bg-gray-800 sm:p-5">
                    <svg class="mx-auto mb-3.5 h-11 w-11 text-red-600 dark:text-gray-500" aria-hidden="true"
                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <p class="mb-4 text-gray-500 dark:text-gray-300">Вы точно хотите удалить раздел <br> <span
                            wire:model="modText" class="text-lg font-medium">{{ $modText }}</span>? </p>
                    <div class="flex items-center justify-center space-x-4">
                        <button wire:click="closeDelModal" type="button"
                            class="w-20 rounded-lg border border-gray-200 bg-gray-700 px-3 py-2 text-sm font-medium text-white hover:bg-gray-500 hover:text-white focus:z-10 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:border-gray-500 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white dark:focus:ring-gray-600">
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
