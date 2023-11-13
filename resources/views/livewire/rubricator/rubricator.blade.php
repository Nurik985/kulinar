<div>
    <section class="bg-white dark:bg-gray-900 mb-40">
        <form wire:submit="saveRubricator">
        <div class="mx-auto max-w-screen-xl border border-gray-400">
            <div class="flex justify-between rounded-[1px] items-center py-2 px-4">
                <div class="bg-white">
                    <div class="flex flex-col text-gray-500 items-center justify-between p-2">
                        Меню в шапке
                    </div>
                </div>
                <div>
                    <button wire:click="addHeaderMenu()" type="button"
                        class="flex items-center justify-center rounded-lg bg-gray-200 px-4 py-2 text-sm font-medium text-gray-800 hover:bg-gray-300 focus:outline-none">
                        <svg class="mr-2 h-3.5 w-3.5" fill="currentColor" viewbox="0 0 20 20"
                             xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                  d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                        </svg>
                        Добавить меню
                    </button>
                </div>
            </div>
            @if(!empty($headerMenu))
                @foreach($headerMenu as $k => $menu)
                    <div wire:key="{{$k}}" class="flex border-t px-4 py-2 items-center">
                        <div class="w-[20%] p-2 flex justify-center items-center">
                            <div class="w-full flex items-center justify-center">
                                @if(!empty($menu['icon']))
                                    <div class="text-[24px] w-fit mr-3"><?php echo $menu['icon']; ?></div>
                                    <div wire:click="removeIcon({{$k}})" class="text-[12px] text-red-600 font-light w-fit cursor-pointer">удалить</div>
                                @else
                                    <div class="w-1/2 text-left text-[16px] font-light mr-4 text-gray-500">Иконка:<br><small class="text-black text-[13px]">(HTML Entity)</small></div>
                                    <input wire:model.lazy="headerMenu.{{$k}}.icon" type="text" class="border-gray-400 h-[35px] w-1/2 mr-3" >
                                @endif
                            </div>
                        </div>
                        <div class="w-[75%] p-2 flex items-center">
                            <div class="flex items-center mr-4 w-full">
                                <div class="w-fit text-[16px] font-light mr-4 text-gray-500">Название:</div>
                                <div class="w-full"><input wire:model.lazy="headerMenu.{{$k}}.name" type="text" class="border-gray-400 h-[35px] w-full"></div>
                            </div>
                            <div class="flex items-center w-full">
                                <div class="w-fit text-[16px] font-light mr-4 text-gray-500">URL:</div>
                                <div class="w-full"><input wire:model.lazy="headerMenu.{{$k}}.url"  type="text" class="border-gray-400 h-[35px] w-full"></div>
                            </div>
                        </div>
                        <div class="w-[5%] p-2 text-center">
                            <i wire:click="removeHeaderMenu({{$k}})" class="ti ti-trash cursor-pointer text-red-600"></i>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="mx-auto max-w-screen-xl mt-5 border border-gray-400">
            <div class="rounded-[1px] py-2 px-4">
                <div class="flex justify-between items-center">
                    <div class="bg-white">
                        <div class="flex text-gray-500 flex-col items-center justify-between p-2">
                            Меню в плашке
                        </div>
                    </div>
                    <div>
                        <button wire:click="addBannerMenu()"
                            class="flex items-center justify-center rounded-lg bg-gray-200 px-4 py-2 text-sm font-medium text-gray-800 hover:bg-gray-300 focus:outline-none">
                            <svg class="mr-2 h-3.5 w-3.5" fill="currentColor" viewbox="0 0 20 20"
                                 xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path clip-rule="evenodd" fill-rule="evenodd"
                                      d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                            </svg>
                            Добавить меню
                        </button>
                    </div>
                </div>
            </div>
            @if(!empty($bannerMenu))
                @foreach($bannerMenu as $k => $menu)
                    <div class="flex border-t px-4 py-2 mb-3 items-center">
                        <div class="flex flex-col w-[20%]">
                            <div class="text-[16px] font-light text-gray-500">Название меню</div>
                            <div><input wire:model.lazy="bannerMenu.{{$k}}.name" type="text" class="h-[30px] mt-2"></div>
                            <div class="mt-2 font-light text-red-500 cursor-pointer">
                                <button wire:click="removeBannerMenu({{$k}})" type="button" class="px-3 h-[30px] py-2 text-xs font-medium text-center text-white bg-red-700 rounded-[1px] hover:bg-red-800 focus:outline-none">удалить меню</button>
                            </div>
                        </div>
                        <div class="flex flex-col w-[80%]">
                            <div class="block mb-2 text-[16px] font-light text-gray-500">Подпункты меню</div>
                            <div class="div_mass">
                                <div class="line-val block w-full rounded-[1px] border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900">
                                    <div class="div-block-item flex flex-wrap gap-2 line-val">
                                        @if(!empty($bannerMenu[$k]['selecteds']))
                                            @foreach($bannerMenu[$k]['selecteds'] as $key => $selecteds)
                                                <div class="block-item w-fit bg-gray-300 mr-2 text-black border border-black p-1.5 select-none rounded-[2px]"><div class="item flex text-[16px]"><span id="{{$key}}">{{$selecteds}}</span><i wire:click="bannerMenuSelectedRemove({{$k}}, {{$key}})" class="ti removeItem ti-square-letter-x ml-2 cursor-pointer text-red-600"></i></div></div>
                                            @endforeach
                                        @endif
                                    </div>
                                    <input wire:input="searchBannerMenu({{$k}})" wire:model.live="bannerMenu.{{$k}}.searchText" type="text" name="url" class="findRub inpt_text block w-full rounded-[4px] border-[#ccc] m-0 h-10 border-1 p-2 mt-2  text-sm text-gray-900">
                                </div>
                                <div class="relative">
                                    @if(!empty($bannerMenu[$k]['searchResult']))
                                        <div class="abs-items absolute search z-10 bg-[lightgray] rounded-[4px] top-1 shadow w-full dark:bg-gray-700">
                                            <ul class="overflow-y-auto text-md text-gray-700 dark:text-gray-200">
                                                {!! $bannerMenu[$k]['searchResult'] !!}
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="mx-auto max-w-screen-xl mt-5 border border-gray-400">
            <div class="rounded-[1px] border-b py-2 px-4">
                <div class="flex justify-between items-center">
                    <div class="bg-white">
                        <div class="flex text-gray-500 flex-col items-center justify-between p-2">
                            Меню в сайдбаре
                        </div>
                    </div>
                    <div>
                        <button wire:click="addSideBarBlock()"
                            class="flex items-center justify-center rounded-lg bg-gray-200 px-4 py-2 text-sm font-medium text-gray-800 hover:bg-gray-300 focus:outline-none">
                            <svg class="mr-2 h-3.5 w-3.5" fill="currentColor" viewbox="0 0 20 20"
                                 xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path clip-rule="evenodd" fill-rule="evenodd"
                                      d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                            </svg>
                            Добавить блок
                        </button>
                    </div>
                </div>
            </div>
            @if(!empty($sideBarBlock))
                @foreach($sideBarBlock as $k => $menu)
                    <div class="flex flex-col px-4 py-2">
                        <div class="flex justify-between items-center w-full pt-2 pb-2">
                            <div class="flex items-center">
                                <div class="mr-2 font-light text-gray-500 text-[16px]">Название блока</div>
                                <div class="mr-2"><input wire:model.lazy="sideBarBlock.{{$k}}.block" type="text" class="h-[30px] font-normal"></div>
                                <div class="mr-2 cursor-pointer text-green-400">
                                    <button wire:click="addSideBarBlockMenu({{$k}})" type="button" class="px-3 h-[30px] py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-[1px] hover:bg-blue-800 focus:outline-none">добавить меню</button>
                                </div>
                                <div class="text-red-600 cursor-pointer">
                                    <button wire:click="removeSideBarBlock({{$k}})" type="button" class="px-3 h-[30px] py-2 text-xs font-medium text-center text-white bg-red-700 rounded-[1px] hover:bg-red-800 focus:outline-none">удалить блок</button>
                                </div>
                            </div>
                        </div>
                        @if(!empty($sideBarBlock[$k]['sideBarBlockMenu']))
                            @foreach($sideBarBlock[$k]['sideBarBlockMenu'] as $sideBarBlockMenuKey => $sideBarBlockMenuValue)
                                <div class="flex w-[100%] pt-4">
                                    <div class="flex flex-col w-[20%]">
                                        <div class="text-[16px] font-light text-gray-500">Название меню</div>
                                        <div><input wire:model.lazy="sideBarBlock.{{$k}}.sideBarBlockMenu.{{$sideBarBlockMenuKey}}.menu" type="text" class="h-[30px] mt-2"></div>
                                        <div class="mt-2 font-light text-red-500">
                                            <div class="text-red-600 cursor-pointer">
                                                <button wire:click="removeSideBarBlockMenu({{$k}}, {{$sideBarBlockMenuKey}})" type="button" class="px-3 h-[30px] py-2 text-xs font-medium text-center text-white bg-red-700 rounded-[1px] hover:bg-red-800 focus:outline-none">удалить меню</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex flex-col w-[80%]">
                                        <div class="block mb-2 text-[16px] font-light text-gray-500">Подпункты меню</div>
                                        <div class="div_mass">
                                            <div class="line-val block w-full rounded-[1px] border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900">
                                                <div class="div-block-item flex flex-wrap gap-2 line-val">
                                                    @if(!empty($sideBarBlock[$k]['sideBarBlockMenu'][$sideBarBlockMenuKey]['selecteds']))
                                                        @foreach($sideBarBlock[$k]['sideBarBlockMenu'][$sideBarBlockMenuKey]['selecteds'] as $key => $sideBarBlockMenuSelected)
                                                            <div class="block-item w-fit bg-gray-300 mr-2 text-black border border-black p-1.5 select-none rounded-[2px]"><div class="item flex text-[16px]"><span id="{{$key}}">{{$sideBarBlockMenuSelected}}</span><i wire:click="sideBarBlockMenuSelectedRemove({{$k}}, {{$sideBarBlockMenuKey}}, {{$key}})" class="ti removeItem ti-square-letter-x ml-2 cursor-pointer text-red-600"></i></div></div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <input wire:keyup="sideBarBlockMenuSearch({{$k}}, {{$sideBarBlockMenuKey}})" wire:model="sideBarBlock.{{$k}}.sideBarBlockMenu.{{$sideBarBlockMenuKey}}.searchText" type="text" name="url" class="findRub inpt_text block w-full rounded-[4px] border-[#ccc] m-0 h-10 border-1 p-2 mt-2  text-sm text-gray-900">
                                            </div>
                                            <div class="relative">
                                                @if(!empty($sideBarBlock[$k]['sideBarBlockMenu'][$sideBarBlockMenuKey]['searchResult']))
                                                    <div class="abs-items absolute search z-10 bg-[lightgray] rounded-[4px] top-1 shadow w-full dark:bg-gray-700">
                                                        <ul class="overflow-y-auto text-md text-gray-700 dark:text-gray-200">
                                                            {!! $sideBarBlock[$k]['sideBarBlockMenu'][$sideBarBlockMenuKey]['searchResult'] !!}
                                                        </ul>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        <hr class="w-full h-[1px] mx-auto my-4 bg-blue-400 border-0 rounded">
                    </div>
                @endforeach
            @endif
        </div>
        <div class="fixed bottom-0 left-1/2 -translate-x-1/2 z-[49] border w-[95rem] p-3 bg-gray-100">
            <div class="flex content-end flex-wrap justify-end items-center">
                <div id="hideAlert" class="flex items-center mr-10 text-green-400 animate-fade-in animate-delay-1000">
                    @if ($message = Session::get('success'))
                        {!!  $message !!}
                    @endif
                </div>
                <button wire:loading.attr="disabled" wire:target="saveRubricator" type="submit"
                         class="border border-green-600 w-fit inline-flex items-center justify-center px-5 py-2 text-sm font-medium text-center text-white cursor-pointer bg-green-600 rounded-[6px] hover:bg-green-800" wire:loading.class="!border !border-gray-700 !text-gray-400 bg-gray-200" wire:loading.class.remove="cursor-pointer bg-green-600 hover:bg-green-800">
                    <svg wire:loading wire:target="saveRubricator" fill='none' class="w-5 h-5 animate-spin mr-2" viewBox="0 0 32 32" xmlns='http://www.w3.org/2000/svg'>
                        <path clip-rule='evenodd'
                              d='M15.165 8.53a.5.5 0 01-.404.58A7 7 0 1023 16a.5.5 0 011 0 8 8 0 11-9.416-7.874.5.5 0 01.58.404z'
                              fill='currentColor' fill-rule='evenodd' />
                    </svg>
                    Сохранить
                </button>
            </div>
        </div>
        </form>
    </section>
</div>
