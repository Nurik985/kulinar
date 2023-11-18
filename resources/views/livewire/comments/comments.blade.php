<div>
    <section class="bg-white dark:bg-gray-900">
        <div class="mx-auto max-w-screen-xl">
            <div class="flex justify-between mb-5">
                <div class="flex">
                    <button wire:click="statusBtn('all')" type="button" class="inline-flex items-center border px-4 py-2 mr-2 text-sm font-medium text-center text-gray-500 rounded-[4px] hover:bg-gray-200 hover:text-gray-700  @if(count($sortBtn) == 3) bg-gray-300  @else bg-gray-100 @endif">
                        Все <span class="text-xs ml-1 text-gray-500"> {{$statusAll}}</span>
                    </button>
                    <button wire:click="statusBtn(0)" type="button" class="inline-flex items-center border px-4 py-2 mr-2 text-sm font-medium text-center text-gray-500 bg-gray-100 rounded-[4px] hover:bg-gray-200 hover:text-gray-700 @if(count($sortBtn) == 1 && $sortBtn[0] == 0) bg-gray-300 @else bg-gray-100 @endif">
                        Ожидающие <span class="text-xs ml-1 text-gray-500"> {{$statusWaiting}}</span>
                    </button>
                    <button wire:click="statusBtn(1)" type="button" class="inline-flex items-center border px-4 py-2 mr-2 text-sm font-medium text-center text-gray-500 bg-gray-100 rounded-[4px] hover:bg-gray-200 hover:text-gray-700 @if(count($sortBtn) == 1 && $sortBtn[0] == 1) bg-gray-300 @else bg-gray-100 @endif">
                        Одобренные <span class="text-xs ml-1 text-gray-500"> {{$statusApproved}}</span>
                    </button>
                    <button wire:click="statusBtn(2)" type="button" class="inline-flex items-center border px-4 py-2 mr-2 text-sm font-medium text-center text-gray-500 bg-gray-100 rounded-[4px] hover:bg-gray-200 hover:text-gray-700 @if(count($sortBtn) == 1 && $sortBtn[0] == 2) bg-gray-300 @else bg-gray-100 @endif">
                        Корзина <span class="text-xs ml-1 text-gray-500"> {{$statusBasket}}</span>
                    </button>
                </div>
            </div>

            <div class="relative overflow-hidden rounded-lg border bg-white dark:bg-gray-800">
                <div
                    class="flex flex-col items-center justify-between space-y-3 p-4 md:flex-row md:space-x-4 md:space-y-0">
                    <div
                        class="flex w-full flex-shrink-0 flex-col items-stretch justify-end space-y-2 md:w-auto md:flex-row md:items-center md:space-x-3 md:space-y-0">
                        <div class="flex w-full items-center space-x-3 md:w-auto">
                            <select wire:model.lazy="event" class="flex w-full items-center justify-center rounded-[4px] border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-gray-900 ">
                                <option value="default">Действие</option>
                                <option value="waiting">Ожидает</option>
                                <option value="approved">Одобрить</option>
                                <option value="basket">Удалить</option>
                            </select>
                            <button wire:click="eventClick()" type="button" class="px-3 py-2 h-[35px] text-xs font-medium text-center text-white bg-blue-700 rounded-[4px] hover:bg-blue-800 focus:outline-none">Применить</button>
                        </div>
                    </div>
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
                        @if(count($sortBtn) == 1 && $sortBtn[0] == 2)
                            <div wire:click="clearBasket()"
                                 class="flex items-center justify-center rounded-lg bg-red-500 px-4 py-2 text-sm font-medium text-white hover:bg-red-800 focus:outline-none cursor-pointer">
                                <i class="mr-2 ti ti-trash-x-filled"></i>
                                Очистить корзину
                            </div>
                        @endif
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
                            <th class="w-50 border border-l-0 text-center border-gray-400 px-4 py-3">
                                <input wire:model.lazy="selectAll" type="checkbox" class="cursor-pointer">
                            </th>
                            <th scope="col" class="w-100 border border-gray-400 border-gray-400 px-4 py-3">Автор</th>
                            <th scope="col" class="w-auto border border-gray-400 px-4 py-3 text-xs">Комментарий</th>
                            <th scope="col" class="w-auto border border-gray-400 px-4 py-3 text-xs">Кол-во</th>
                            <th scope="col" class="w-250 border border-gray-400 px-4 py-3 text-xs">Статья</th>
                            <th scope="col" class="w-120 border border-r-0 border-gray-400 px-4 py-3">Отправлено</th>
                            <th scope="col" class="w-70 border border-r-0 border-gray-400 px-4 py-3"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if (count($comments) > 0)
                            @foreach ($comments as $k => $comment)
                                @php
                                    $recipe = DB::table('recipes')->select('id', 'name', 'url')->where("id", '=', $comment->id_recipe)->first();
                                    $countComment = DB::table('comments')->where("id_recipe", '=', $comment->id_recipe)->count();
                                @endphp
                                <tr wire:key="{{ $comment->id }}"
                                    class="border-b font-medium text-gray-900 text-center">
                                    <td class="w-50 border-r px-4 py-3 text-gray-500">
                                        <input wire:model.lazy="selected" type="checkbox" class="cursor-pointer" value="{{$comment->id}}">
                                    </td>
                                    <td class="w-200 px-4 py-3 text-xs text-left">{{$comment->name_user}}</td>
                                    <td class="w-[40%] text-gray-500 border px-4 py-3 text-left">
                                        {{ $comment->text }}<hr class="mt-2 mb-2 bg-gra-700 border-dotted"><span class="text-purple-500 text-[12px] italic d-block">{{$comment->answer}}</span>
                                    </td>
                                    <td class="w-70 border px-4 py-3 text-gray-500 text-left">
                                    <span class="bg-gray-100 border text-gray-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded-[2px] dark:bg-gray-700 dark:text-gray-300">{{$countComment}}</span>
                                    </td>
                                    <td class="w-250 border px-4 py-3 text-gray-500 text-left">
                                        @if(!empty($comment->id_recipe))
                                            @php
                                                if(!empty($recipe->url)){
                                                    echo '<a target="_blank" class="text-blue-500 cursor-pointer" href="/'.$recipe->url.'">'.$recipe->name.'</a> - <a href="'.route('recipe.edit', $comment->id_recipe).'" class="text-[10px] btn text-green-400 btn-sm btn-icon item-edit mr-2">редактировать</a>';
                                                }
                                            @endphp
                                        @endif
                                    </td>
                                    <td class="w-70 border items-center justify-end px-4 py-3">
                                        {{ $comment->created_at->format("m.d.Y") }}
                                    </td>
                                    <td class="w-100 px-4 py-3 text-center">
                                        <div class="flex">
                                            <a href="{{ route('comments.edit', $comment->id) }}"
                                               class="www btn btn-sm btn-icon item-edit mr-2"><i
                                                    class="ti ti-pencil text-green-500"></i></a>
                                            <span wire:click="openDelModal({{ $comment->id }}, '')"
                                                  class="btn btn-sm btn-icon item-edit cursor-pointer"><i
                                                    class="ti ti-trash text-red-800"></i></span>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="p-5 text-center text-sm text-red-400">Поиск не дал никаких
                                    результатов
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
                {{ $comments->links() }}
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
                    <p class="mb-4 text-gray-500 dark:text-gray-300">Вы точно хотите удалить комментарий <br>
                        <span wire:model.live="modText" class="text-lg font-medium">{{ $modText }}</span>?
                    </p>
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
