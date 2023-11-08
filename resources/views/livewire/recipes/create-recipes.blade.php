<div>
    <form wire:submit="saveRecipe" class="space-y-6">
        <div class="w-full rounded-[4px] mr-3 mb-10 border bg-white dark:bg-gray-700">
            <div class="px-6 py-6 lg:px-8">
                <div class="grid gap-2 sm:grid-cols-2 sm:gap-4">
                    <div class="sm:col-span-2">
                        <label for="name"
                               class="@error('name')text-red-700 @enderror mb-2 block font-light text-sm text-gray-500">Название:</label>
                        <input wire:model.live="name" wire:keyup="generateSlug" type="text" name="name" id="name"
                               class="@error('name') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-[4px] dark:bg-gray-700 block w-full p-2.5 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500 @enderror block w-full rounded-[4px] border border-gray-300 bg-gray-50 p-2.5 text-sm focus:outline-none ">
                        @error('name')
                        <p class="mt-1 text-xs text-red-600 dark:text-red-500 error-message"><span
                                class="font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label for="title"
                               class="@error('title')text-red-700 @enderror mb-2 block font-light text-sm text-gray-500">Title
                            (SEO): </label>
                        <input wire:model.live="title" type="title" name="title" id="title"
                               class="@error('title') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-[4px] dark:bg-gray-700 block w-full p-2.5 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500 @enderror block w-full rounded-[4px] border border-gray-300 bg-gray-50 p-2.5 text-sm focus:outline-none ">
                        @error('title')
                        <p class="mt-1 text-xs text-red-600 dark:text-red-500 error-message"><span
                                class="font-medium validation-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label for="url"
                               class="@error('url')text-red-700 @enderror mb-2 font-light block text-sm text-gray-500">URL:</label>
                        <input wire:model.live="url" type="text" name="url" id="url"
                               class="@error('url') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-[4px] dark:bg-gray-700 block w-full p-2.5 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500 @enderror block w-full rounded-[4px] border border-gray-300 bg-gray-50 p-2.5 text-sm focus:outline-none">
                        @error('url')
                        <p class="mt-1 text-xs text-red-600 dark:text-red-500 error-message"><span
                                class="font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label for="linkSource" class="mb-2 block text-sm text-gray-500 font-light dark:text-white">Ссылка
                            на источник:</label>
                        <input wire:model="linkSource" type="text" name="linkSource" id="linkSource"
                               class="block w-full rounded-[4px] border border-gray-300 bg-gray-50 p-2.5 text-sm focus:outline-none">
                    </div>
                    <div wire:ignore class="sm:col-span-2">
                        <label for="beforeText" class="block mb-2 text-sm font-light text-gray-500 dark:text-white">Текст-вступление
                            до шагов приготовления:</label>
                        <textarea wire:model="beforeText" id="beforeText" name="beforeText" rows="8"
                                  class="block p-2.5 w-full text-xs bg-gray-50 rounded-[4px] border border-gray-300"></textarea>
                    </div>
                    <div class="sm:col-span-2">
                        <div class="flex justify-between items-center">
                            {!! $addAutoIngRowRes !!}
                        </div>
                        <div>
                            <textarea wire:input="addAutoIngBtn" wire:model="addAutoIngData" rows="6"
                                      class="@if($autoIngDataFilled) user-select-none @endif block p-2.5 w-full text-sm bg-gray-50 rounded-[4px] border border-gray-300 focus:outline-none"></textarea>
                        </div>
                        <div class="text-sm font-light text-gray-500 mt-3">
                            <button wire:click="addAutoIngBtn" type="button"
                                    class=" px-3 py-2 text-xs font-medium text-center text-white bg-gray-700 rounded-[2px] hover:bg-gray-800 focus:outline-none">
                                заполнить
                            </button>
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <div class="mb-2 block text-sm font-light text-gray-500 dark:text-white">
                            Ингредиенты:
                        </div>
                        <div class="ing-div">
                            @if($ingLists)
                                <div class="border mb-4">
                                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                        <thead
                                            class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-4 py-3"></th>
                                            <th scope="col" class="px-4 py-3 font-light">Название ингредиента</th>
                                            <th scope="col" class="px-4 py-3 font-light">Кол-во (от)</th>
                                            <th scope="col" class="px-4 py-3 font-light">Кол-во (до)</th>
                                            <th scope="col" class="px-4 py-3 font-light">Ед. измерения</th>
                                            <th scope="col" class="px-4 py-3"></th>
                                        </tr>
                                        </thead>
                                        <tbody wire:sortable="updateSort" wire:sortable.options="{ animation: 100}">
                                        @for($i = 0; $i < count($ingLists); $i++)
                                            <tr wire:sortable.item="{{$i}}" wire:key="ing{{$i}}"
                                                class="bg-white border-b">
                                                <th wire:sortable.handle
                                                    class="drag px-4 py-4 text-center font-medium text-gray-900 whitespace-nowrap dark:text-white w-fit">
                                                    <i class="ti ti-arrows-down-up cursor-pointer"></i>
                                                </th>
                                                <th scope="row"
                                                    class="px-4 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white w-1/2">
                                                    <div class="div_mass mb-2">
                                                        <div x-data
                                                             class="line-val block w-full rounded-[2px] border border-gray-300 bg-gray-50 p-1 text-sm">
                                                            <div class="div-block-item flex flex-wrap gap-2 line-val">
                                                                @if(!empty($ingLists[$i]['selected']))
                                                                    @foreach($ingLists[$i]['selected'] as $id => $selected)
                                                                        <div
                                                                            class="block-item w-fit @if($selected['bd']) bg-gray-300 @else bg-red-300 @endif text-black border border-black p-1 select-none rounded-[6px]">
                                                                            <div
                                                                                class="item flex text-[12px] font-light items-center">
                                                                                <span>{{$selected['name']}}</span><i
                                                                                    wire:click="ingRemove({{$i}}, {{$id}}, '{{$selected['name']}}')"
                                                                                    class="ti ti-trash ml-1 !text-[12px] cursor-pointer text-red-600"></i>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                @endif

                                                            </div>

                                                            <input wire:input.lazy="ingSearch({{$i}})"
                                                                   wire:model.live="ingLists.{{$i}}.ingSearchText"
                                                                   type="text"
                                                                   class="findRub font-light inpt_text block w-full rounded-[4px] bg-gray-50 border-none m-0 h-7 border-1 p-1 mt-2 text-sm">
                                                        </div>
                                                        <div class="relative">
                                                            <div>
                                                                @if(!empty($ingLists[$i]['ingSearchResults']))
                                                                    <div @click.away="$wire.ingSearchClose({{$i}})"
                                                                         class="abs-items absolute search z-50 bg-[lightgray] rounded-[4px] top-1 shadow w-full dark:bg-gray-700">
                                                                        <ul class="overflow-y-auto h-[200px] text-md text-gray-700 dark:text-gray-200">
                                                                            @foreach($ingLists[$i]['ingSearchResults'] as $k => $result)
                                                                                <li wire:key="{{$k}}"
                                                                                    wire:click="ingSelect({{$i}}, {{$k}}, {{$result['id']}}, '{{$result['name']}}')"
                                                                                    class="py-1 px-2 {{$result['class']}}"
                                                                                    id="{{$result['id']}}">{{$result['name']}}</li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input wire:model.lazy="ingLists.{{$i}}.inglists.4"
                                                           class="h-5 border border-gray-300 rounded-[2px] font-light p-2 w-full text-[14px] focus:outline-none bg-gray-50 placeholder:text-gray-400"
                                                           placeholder="* особенности ингредиента">
                                                </th>
                                                <td class="px-4 py-4 w-[120px] align-top">
                                                    <input wire:model.lazy="ingLists.{{$i}}.inglists.1"
                                                           class="h-7 border border-gray-300 rounded-[2px] font-light p-2 w-full text-[14px] focus:outline-none bg-gray-50">
                                                </td>
                                                <td class="px-4 py-4 w-[120px] align-top">
                                                    <input wire:model.lazy="ingLists.{{$i}}.inglists.2"
                                                           class="h-7 border border-gray-300 rounded-[2px] font-light p-2 w-full text-[14px] focus:outline-none bg-gray-50">
                                                </td>
                                                <td class="px-4 py-4 w-[200px] align-top">
                                                    <div class="relative">
                                                        <input wire:model="ingLists.{{$i}}.inglists.3.name" type="text"
                                                               disabled
                                                               class="block h-7 py-[0.5px] px-[10px] w-full text-[12px] text-gray-900 border border-gray-300 @if(!empty($ingLists[$i]['inglists'][3]['bd']) && $ingLists[$i]['inglists'][3]['bd'] == 'yes')bg-gray-50 @else bg-red-200 @endif rounded-[2px] ">
                                                        @if(!empty($units) && !empty($ingLists[$i]['unitsShow']))
                                                            <i wire:click="getUnits({{$i}}, 'close')"
                                                               class="ti ti-arrow-bar-to-up ti ti-arrow-bar-to-down absolute top-1 right-2 cursor-pointer"></i>
                                                        @else
                                                            <i wire:click="getUnits({{$i}}, 'open')"
                                                               class="ti ti-arrow-bar-to-down absolute top-1 right-2 cursor-pointer"></i>
                                                        @endif
                                                        <div>
                                                            @if(!empty($units) && !empty($ingLists[$i]['unitsShow']))
                                                                <div @click.away="$wire.getUnits({{$i}}, 'close')"
                                                                     class="abs-items absolute search z-50 bg-[lightgray] rounded-[4px] top-8 shadow w-full dark:bg-gray-700">
                                                                    <ul class="overflow-y-auto text-md h-[400px] text-gray-700 dark:text-gray-200">
                                                                        @foreach($units as $unit)
                                                                            <li wire:key="{{$unit->id}}"
                                                                                wire:click="ingListsAddEd({{$i}}, '{{$unit->name}}')"
                                                                                class="py-1 px-2">{{$unit->name}}</li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-4 py-4 w-[80px] text-center text-red-600"><i
                                                        wire:click="removeIngList({{$i}})"
                                                        class="ti ti-trash font-thin text-red-600 cursor-pointer !text-[25px]"></i>
                                                </td>
                                            </tr>
                                        @endfor
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                        <div class="flex">
                            <input wire:model="addIngRowInput" min="1" type="number" id="addIngRowInput"
                                   class="block w-[100px] p-2 text-gray-900 border border-gray-300 rounded-[2px] bg-gray-50 sm:text-xs focus:outline-none">
                            <button wire:click="addIngRowInputBtn" type="button"
                                    class="ml-2 px-3 py-2 text-xs font-medium text-center text-white bg-gray-700 rounded-[2px] hover:bg-gray-800 focus:outline-none">
                                добавить ингредиент(ов)
                            </button>
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <div for="linkSource" class="mb-5 block text-sm font-light text-gray-500 dark:text-white">
                            Дополнительная информация:
                        </div>
                        <div class="flex flex-col">
                            <div class="w-fit text-light flex mb-3">
                                <span class="w-[220px] text-gray-500 text-sm">Время готовки:</span>
                                <div class="w-1/3">
                                    <input wire:model="vremyGotovki" min="1" type="number"
                                           class="h-7 block w-[100px] p-2 text-gray-900 border border-gray-300 rounded-[2px] bg-gray-50 sm:text-xs focus:outline-none">
                                </div>
                                <select wire:model="vremyGotovkiTime"
                                        class="block h-7 py-[0.5px] px-[10px] w-w-1/3 text-[12px] text-gray-900 border border-gray-300 rounded-[2px] bg-gray-50 ">
                                    <option value="мин">мин</option>
                                    <option value="час">час</option>
                                    <option value="день">день</option>
                                </select>
                            </div>
                            <div class="w-fit text-light flex mb-3">
                                <span class="w-[220px] text-gray-500 text-sm">Время приготовления:</span>
                                <div class="w-1/3">
                                    <input wire:model="vremyPrigotovleniya" min="1" type="number" id="addIngInput"
                                           class="h-7 block w-[100px] p-2 text-gray-900 border border-gray-300 rounded-[2px] bg-gray-50 sm:text-xs focus:outline-none">
                                </div>
                                {{$vremyGotovki}}
                                <select wire:model="vremyPrigotovleniyaTime"
                                        class="block h-7 py-[0.5px] px-[10px] w-w-1/3 text-[12px] text-gray-900 border border-gray-300 rounded-[2px] bg-gray-50 ">
                                    <option value="мин">мин</option>
                                    <option value="час">час</option>
                                    <option value="день">день</option>
                                </select>
                            </div>
                            <div class="w-fit text-light flex mb-3">
                                <span class="w-[220px] text-gray-500 text-sm">Порции:</span>
                                <div class="w-1/3">
                                    <input wire:model="portion" type="number" class="h-7 block w-[100px] p-2 text-gray-900 border border-gray-300 rounded-[2px] bg-gray-50 sm:text-xs focus:outline-none">
                                </div>
                                <select wire:model="portionType"
                                    class="block h-7 py-[0.5px] px-[10px] w-w-1/3 text-[12px] text-gray-900 border border-gray-300 rounded-[2px] bg-gray-50 ">
                                    @if(!empty($portionTypeData))
                                        @foreach($portionTypeData as $value)
                                            <option value="{{$value->name}}">{{$value->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <div class="flex justify-between items-center">
                            <div class="block mb-2 text-sm font-light text-gray-500 dark:text-white">
                                Автозаполнение шагов:
                            </div>
                        </div>
                        <div>
                            <textarea wire:model="addAutoStepData" rows="6"
                                      class="block p-2.5 w-full text-sm bg-gray-50 rounded-[2px] border border-gray-300 focus:outline-none"></textarea>
                        </div>
                        <div class="text-sm font-light text-gray-500 mt-3">
                            <button wire:click="addAutoStepBtn" type="button"
                                    class=" px-3 py-2 text-xs font-medium text-center text-white bg-gray-700 rounded-[2px] hover:bg-gray-800 focus:outline-none">
                                заполнить
                            </button>
                        </div>

                    </div>
                    <div class="sm:col-span-2">
                        <div for="linkSource" class="mb-2 block text-sm font-light text-gray-500 dark:text-white">
                            Шаги приготовления:
                        </div>
                        <div class="step-div">
                            @if($stepLists)
                                <div wire:sortable="updateStep" wire:sortable.options="{ animation: 100}">
                                    @for($i = 0; $i < count($stepLists); $i++)

                                    <div wire:sortable.item="{{$i}}" wire:key="step{{$i}}" class="grid grid-cols-custom border-b py-3 mb-4">
                                        <div class="step-numeric font-light flex justify-center items-center text-[30px]">{{$i + 1}}
                                        </div>
                                        <div  class="step-dragIcon flex justify-center items-center "><i
                                                wire:sortable.handle class="ti ti-arrows-down-up bg-gray-300 p-2 rounded-[6px] cursor-pointer text-gray-500 !text-[30px]"></i>
                                        </div>
                                        <div class="step-images flex justify-center items-center">
                                            @if (!empty($stepLists[$i]['img']))
                                                <div class="flex flex-col justify-center items-center">
                                                    @foreach($stepLists[$i]['img'] as $imgKey => $img)
                                                        <div class="relative">
                                                            <img class="w-[140px] h-[140px] object-cover bg-gray-50 mb-2 border-2 border-black rounded-[4px]"  src="{{ $img->temporaryUrl() }}">
                                                            <div class="absolute top-1 right-2 cursor-pointer text-white bg-black rounded-5 border-1 p-1">
                                                                <i wire:click="removeStepListImg({{$i}}, {{$imgKey}})" class="ti ti-x"></i>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    <div class="border w-[60px] text-center relative cursor-pointer border-gray-300 p-4 bg-gray-50 rounded-[2px]">
                                                        <i class="ti ti-camera-plus text-gray-500 !text-[25px]"></i>
                                                        <input type="file" wire:model="stepLists.{{$i}}.img" class="absolute top-0 left-0 w-full h-full opacity-0 cursor-pointer">
                                                    </div>
                                                </div>
                                            @else
                                                <div class="border relative cursor-pointer border-gray-300 p-4 bg-gray-50 rounded-[2px]">
                                                    <i class="ti ti-camera-plus text-gray-500 !text-[25px]"></i>
                                                    <input type="file" wire:model="stepLists.{{$i}}.img.0" class="absolute top-0 left-0 w-full h-full opacity-0 cursor-pointer">
                                                </div>
                                            @endif

                                        </div>
                                        <div class="step-desc flex justify-center items-center">
                                            <textarea wire:model.lazy="stepLists.{{$i}}.desc" class="block p-2.5 ml-3 mr-3 w-full text-sm bg-gray-50 rounded-[2px] border border-gray-300 focus:outline-none" rows="4"></textarea>
                                        </div>
                                        <div class="step-removeIcon flex justify-center items-center">
                                            <i wire:click="removeStepList({{$i}})" class="ti ti-trash font-thin text-red-600 cursor-pointer !text-[25px]"></i>
                                        </div>
                                    </div>

                                @endfor
                                </div>
                            @endif
                        </div>
                        <div class="flex">
                            <input wire:model="addStepRowInput" min="1" type="number" id="addStepRowInput"
                                   class="block w-[100px] p-2 text-gray-900 border border-gray-300 rounded-[2px] bg-gray-50 sm:text-xs focus:outline-none">
                            <button wire:click="addStepRowInputBtn" type="button"
                                    class="ml-2 px-3 py-2 text-xs font-medium text-center text-white bg-gray-700 rounded-[2px] hover:bg-gray-800 focus:outline-none">
                                добавить шаг(и)
                            </button>
                        </div>
                    </div>
                    <div wire:ignore class="sm:col-span-2">
                        <div for="afterText" class="block mb-2 text-sm font-light text-gray-500 dark:text-white">Текст
                            после шагов приготовления:</div>

                        <textarea wire:model.lazy="afterText" id="afterText" name="afterText" rows="8"
                                  class="block p-2.5 w-full text-xs bg-gray-50 rounded-[4px] border border-gray-300 focus:outline-none"></textarea>
                    </div>
                    <div class="w-full">
                        <div class="mb-2 block text-sm text-gray-500 font-light">Изображение
                            записи: @if ($recipeImg)
                                <sdpan wire:click="delRecipeImg" class="text-red-500 cursor-pointer ">удалить?</sdpan>
                            @endif</div>
                        @if ($recipeImg)
                            <img class="w-[200px] h-[200px] object-cover relative block bg-gray-50 border border-gray-300 rounded-[4px]"
                                 src="{{ $recipeImg->temporaryUrl() }}">
                        @else
                            <div
                                class="w-1/3 h-[200px] relative block bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-[4px]"
                                style="background-image:url('{{ Vite::asset('resources/images/plus.svg') }}'); background-position: center; background-size: 20%; background-repeat: no-repeat; background-color: #f9fafb; border-style: dashed; border-width: medium; border-color: #ccc">
                                <input type="file" wire:model="recipeImg"
                                       class="absolute top-0 left-0 w-full h-full opacity-0 cursor-pointer">
                            </div>
                        @endif
                    </div>
                    <div class="sm:col-span-2">
                        <label for="name"
                               class="@error('name')text-red-700 @enderror mb-2 block font-light text-sm text-gray-500">Название:</label>
                        <input wire:model.live="name" wire:keyup="generateSlug" type="text" name="name" id="name"
                               class="@error('name') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-[4px] dark:bg-gray-700 block w-full p-2.5 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500 @enderror block w-full rounded-[4px] border border-gray-300 bg-gray-50 p-2.5 text-sm focus:outline-none ">
                        @error('name')
                        <p class="mt-1 text-xs text-red-600 dark:text-red-500 error-message"><span
                                class="font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="sm:col-span-2">
                        <div class="block mb-2 text-sm font-light text-gray-500 dark:text-white">Что готовим:</div>
                        <div class="div_mass">
                            <div
                                class="line-val block w-full rounded-[4px] border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900">
                                <div class="div-block-item flex flex-wrap gap-2 line-val">
                                    @if($cookSelecteds)
                                        @foreach($cookSelecteds as $k => $cookSelected)
                                            {!! $cookSelected !!}
                                        @endforeach
                                    @endif
                                </div>
                                <input wire:keydown.enter="cookAdd" wire:click="cookShowCheck"
                                       wire:keyup="cookSearchFunc" wire:model="cookSearchText" type="text"
                                       class="findRub inpt_text block w-full rounded-[4px] border-[#ccc] m-0 h-10 border-1 p-2 mt-2  text-sm text-gray-900">
                            </div>
                            <div class="relative">
                                <div
                                    class="abs-items absolute search z-10 bg-[lightgray] rounded-[4px] top-1 shadow w-full dark:bg-gray-700">
                                        @if($cookSearchResults)
                                            <ul class="overflow-y-auto max-h-[200px] text-md text-gray-700 dark:text-gray-200">
                                                {!! $cookSearchResults !!}
                                            </ul>
                                        @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <div class="block mb-2 text-sm font-light text-gray-500 dark:text-white">Способ
                            приготовления:
                        </div>
                        <div class="div_mass">
                            <div
                                class="line-val block w-full rounded-[4px] border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900">
                                <div class="div-block-item flex flex-wrap gap-2 line-val">
                                    @if($methodSelecteds)
                                        @foreach($methodSelecteds as $k => $methodSelected)
                                            {!! $methodSelected !!}
                                        @endforeach
                                    @endif
                                </div>
                                <input wire:keydown.enter="methodAdd" wire:click="methodShowCheck"
                                       wire:keyup="methodSearchFunc" wire:model="methodSearchText" type="text"
                                       name="url"
                                       class="findRub inpt_text block w-full rounded-[4px] border-[#ccc] m-0 h-10 border-1 p-2 mt-2  text-sm text-gray-900">
                            </div>
                            <div class="relative">
                                <div
                                    class="abs-items absolute search z-10 bg-[lightgray] rounded-[4px] top-1 shadow w-full dark:bg-gray-700">
                                        @if($methodSearchResults)
                                            <ul class="overflow-y-auto max-h-[200px] text-md text-gray-700 dark:text-gray-200">
                                                {!! $methodSearchResults !!}
                                            </ul>
                                        @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sm:col-span-2 mb-40">
                        <div class="block mb-2 text-sm font-light text-gray-500 dark:text-white">Кухня:</div>
                        <div class="div_mass">
                            <div
                                class="line-val block w-full rounded-[4px] border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900">
                                <div class="div-block-item flex flex-wrap gap-2 line-val">
                                    @if($kitchenSelecteds)
                                        @foreach($kitchenSelecteds as $k => $kitchenSelected)
                                            {!! $kitchenSelected !!}
                                        @endforeach
                                    @endif
                                </div>
                                <input wire:keydown.enter="kitchenAdd" wire:click="kitchenShowCheck"
                                       wire:keyup="kitchenSearchFunc" wire:model="kitchenSearchText" type="text"
                                       name="url"
                                       class="findRub inpt_text block w-full rounded-[4px] border-[#ccc] m-0 h-10 border-1 p-2 mt-2  text-sm text-gray-900">
                            </div>
                            <div class="relative">
                                <div
                                    class="abs-items relative search z-10 bg-[lightgray] rounded-[4px] top-1 shadow w-full dark:bg-gray-700">
                                        @if($kitchenSearchResults)
                                            <ul class="overflow-y-auto max-h-[200px] text-md text-gray-700 dark:text-gray-200">
                                                {!! $kitchenSearchResults !!}
                                            </ul>
                                        @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="fixed bottom-0 left-1/2 -translate-x-1/2 z-[49] border w-[95rem] p-3 backdrop-blur-2xl ">
            <div class="flex content-end flex-wrap justify-end items-end">
                <ul class="grid w-[60rem] gap-4 grid-cols-5">
                    <li>
                        <label class="cursor-pointer w-full text-sm font-lighr text-black dark:text-gray-300">
                            <div
                                class="flex items-center pl-4 py-2 border border-gray-700 rounded-[6px] bg-white hover:bg-gray-50 cursor-pointer">
                                <input wire:click="statusChange(2)" id="status1" type="radio" value="1" name="status"
                                       class="w-4 h-4 text-green-700 bg-gray-100 border-gray-300 mr-2" checked>
                                Черновик
                            </div>
                        </label>
                    </li>
                    <li>
                        <label class="cursor-pointer w-full text-sm font-lighr text-black dark:text-gray-300">
                            <div
                                class="flex items-center pl-4 py-2 border border-gray-700 rounded-[6px] bg-white hover:bg-gray-50 cursor-pointer">
                                <input wire:click="statusChange(1)" id="status2" type="radio" value="2" name="status"
                                       class="w-4 h-4 text-green-700 bg-gray-100 border-gray-300 mr-2">
                                Опубликовать
                            </div>
                        </label>
                    </li>
                    <li>
                        <label class="cursor-pointer w-full text-sm font-lighr text-black dark:text-gray-300">
                            <div
                                class="flex items-center pl-4 py-2 border border-gray-700 rounded-[6px] bg-white hover:bg-gray-50 cursor-pointer">
                                <input wire:click="statusChange(6)" id="status3" type="radio" value="3" name="status"
                                       class="w-4 h-4 text-green-700 bg-gray-100 border-gray-300 mr-2">
                                На утверждении
                            </div>
                        </label>
                    </li>
                    <li>
                        <label class="cursor-pointer w-full text-sm font-lighr text-black dark:text-gray-300">
                            <div
                                class="flex items-center pl-4 py-2 border border-gray-700 rounded-[6px] bg-white hover:bg-gray-50 cursor-pointer">
                                <input wire:click="statusChange(4)" id="status4" type="radio" value="3" name="status"
                                       class="w-4 h-4 text-green-700 bg-gray-100 border-gray-300 mr-2">
                                Корзина
                            </div>
                        </label>
                    </li>
                    <li>
                        <button  wire:loading.attr="disabled" wire:target="saveRecipe" type="submit"
                                class="border border-green-600 w-full inline-flex items-center justify-center px-5 py-2 text-sm font-medium text-center text-white cursor-pointer bg-green-600 rounded-[6px] hover:bg-green-800" wire:loading.class="!border !border-gray-700 !text-gray-400 bg-gray-200" wire:loading.class.remove="cursor-pointer bg-green-600 hover:bg-green-800">
                            <svg wire:loading wire:target="saveRecipe" fill='none' class="w-5 h-5 animate-spin mr-2" viewBox="0 0 32 32" xmlns='http://www.w3.org/2000/svg'>
                                <path clip-rule='evenodd'
                                      d='M15.165 8.53a.5.5 0 01-.404.58A7 7 0 1023 16a.5.5 0 011 0 8 8 0 11-9.416-7.874.5.5 0 01.58.404z'
                                      fill='currentColor' fill-rule='evenodd' />
                            </svg>
                            Сохранить

                        </button>
                    </li>
                </ul>
            </div>

        </div>
    </form>
</div>

@push('scripts')
    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
    <script>
        Livewire.hook('commit', ({ succeed }) => {
            succeed(() => {
                setTimeout(() => {
                    const firstErrorMessage = document.querySelector('.error-message')

                    if (firstErrorMessage !== null) {
                        firstErrorMessage.scrollIntoView({ block: 'center', inline: 'center' })
                    }
                }, 0)
            })
        })
        ClassicEditor
            .create(document.querySelector('#beforeText'),{
                config:{
                    height: 500,
                },
                language: 'ru',
                removePlugins: [
                    'MediaEmbedToolbar',
                    'Title'
                ],
                placeholder: '',
                ckfinder: {
                    uploadUrl: '{{route('ckeditor.upload').'?_token='.csrf_token()}}',
                }
            })
            .then(editor => {
                editor.model.document.on('change:data', () => {
                    @this.
                    set('beforeText', editor.getData());
                })
            })
            .catch(error => {
            });
        ClassicEditor
            .create(document.querySelector('#afterText'),{
                config:{
                    height: 500,
                },
                language: 'ru',
                removePlugins: [
                    'MediaEmbedToolbar',
                    'Title'
                ],
                placeholder: '',
                ckfinder: {
                    uploadUrl: '{{route('ckeditor.upload').'?_token='.csrf_token()}}',
                }
            })
            .then(editor => {
                editor.model.document.on('change:data', () => {
                    @this.
                    set('afterText', editor.getData());
                })
            })
            .catch(error => {
            });

    </script>
@endpush
