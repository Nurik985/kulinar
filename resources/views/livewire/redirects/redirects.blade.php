<div>
    <section class="bg-white dark:bg-gray-900">
        <div class="mx-auto max-w-screen-xl">
            @include('admin.layouts.sections.successAlert')
            <div class="bg-white dark:bg-gray-800 relative border rounded-lg overflow-hidden">
                <form wire:submit="saveRedirect" class="p-4">
                    @csrf
                    <div class="grid gap-2 grid-cols-3 sm:gap-6 m-5">
                        <div class=" w-full">
                            <input wire:model="old" type="text"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-[4px] focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                   required>
                        </div>
                        <div class=" w-full">
                            <input wire:model="new" type="text"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                   required>
                        </div>
                        <div class="w-full">
                            <button
                                    class="flex items-center justify-center text-white bg-green-500 hover:bg-green-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                                <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20"
                                     xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path clip-rule="evenodd" fill-rule="evenodd"
                                          d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"/>
                                </svg>
                                Добавить редирект
                            </button>
                        </div>
                    </div>
                </form>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3 border border-gray-400">Исходный URL</th>
                            <th scope="col" class="px-4 py-3 border border-gray-400">URL куда будет редирект</th>
                            <th scope="col" class="px-4 py-3 border border-gray-400 border-r-0">
                                <span class="sr-only"></span>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($redirects) > 0)
                            @foreach ($redirects as $k => $redirect)
                                <tr wire:key="{{ $redirect->id }}"
                                    class="border-b dark:border-gray-700 text-gray-900 font-medium ">
                                    <td class="px-4 py-3 w-1/2 text-red-400 border">{{ $redirect["old-url"] }}</td>
                                    <td class="px-4 py-3 w-1/2 text-green-500 border">{{ $redirect["new-url"] }}</td>
                                    <td class="px-4 py-3 text-center w-fit">
                                        <span wire:click="openDelModal({{$redirect->id }})"
                                              class="btn btn-sm btn-icon item-edit cursor-pointer"><i
                                                class="text-red-800 ti ti-trash"></i></span>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="p-5 text-center text-sm text-red-400">Данных нет
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div wire:ignore.self id="delMod" tabindex="-1" aria-hidden="true"
             class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                <div class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                    <svg class="text-red-600 dark:text-gray-500 w-11 h-11 mb-3.5 mx-auto" aria-hidden="true"
                         fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                              clip-rule="evenodd"></path>
                    </svg>
                    <p class="mb-4 text-gray-500  dark:text-gray-300">Вы точно хотите удалить этот редирект?
                    </p>
                    <div class="flex justify-center items-center space-x-4">
                        <button wire:click="closeDelModal" type="button"
                                class="w-20 rounded-lg border border-gray-200 bg-gray-700 px-3 py-2 text-sm font-medium text-white hover:bg-gray-500 hover:text-white focus:z-10 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:border-gray-500 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white dark:focus:ring-gray-600">
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
