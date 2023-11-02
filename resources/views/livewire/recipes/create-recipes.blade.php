<div>
    <div class="relative flex w-full justify-center">
        <div class="w-full rounded-[4px] mr-3 border bg-white dark:bg-gray-700">
            <div class="px-6 py-6 lg:px-8">
                <form wire:submit="saveHeading" class="space-y-6">
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
                            <label for="linkSource" class="mb-2 block text-sm text-gray-500 font-light dark:text-white">Ссылка на источник:</label>
                            <input wire:model.live="linkSource" type="text" name="linkSource" id="linkSource"
                                   class="block w-full rounded-[4px] border border-gray-300 bg-gray-50 p-2.5 text-sm focus:outline-none">
                        </div>
                        <div wire:ignore class="sm:col-span-2">
                            <label for="beforeText" class="block mb-2 text-sm font-light text-gray-500 dark:text-white">Текст-вступление до шагов приготовления:</label>
                            <textarea wire:model="beforeText" id="beforeText" name="beforeText" rows="8" class="block p-2.5 w-full text-xs bg-gray-50 rounded-[4px] border border-gray-300 focus:outline-none"></textarea>
                        </div>
                        <div wire:ignore class="sm:col-span-2">
                            <div class="flex justify-between items-center">
                                <div for="autoIngr" class="block mb-2 text-sm font-light text-gray-500 dark:text-white">Автозаполнение ингредиетов - <span class=" text-black cursor-pointer">заполнить</span>: </div>
                            </div>
                            <textarea wire:model="autoIngr" id="autoIngr" name="autoIngr" rows="6" class="block p-2.5 w-full text-sm bg-gray-50 rounded-[4px] border border-gray-300 focus:outline-none"></textarea>
                        </div>
                        <div wire:ignore class="sm:col-span-2">
                            <div for="linkSource" class="mb-2 block text-sm font-light text-gray-500 dark:text-white">Ингредиенты:</div>
                            <div class="ing-div">
                                <div class="overflow-x-auto border mb-4">
                                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-4 py-3"></th>
                                            <th scope="col" class="px-4 py-3 font-light">Название ингредиента</th>
                                            <th scope="col" class="px-4 py-3 font-light">Кол-во (от)</th>
                                            <th scope="col" class="px-4 py-3 font-light">Кол-во (до)</th>
                                            <th scope="col" class="px-4 py-3 font-light">Ед. измерения</th>
                                            <th scope="col" class="px-4 py-3"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr class="bg-white border-b">
                                            <th scope="row" class="px-4 py-4 text-center font-medium text-gray-900 whitespace-nowrap dark:text-white w-fit">
                                                <i class="ti ti-arrows-down-up"></i>
                                            </th>
                                            <th scope="row" class="px-4 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white w-1/3">
                                                <div class="div_mass mb-2">
                                                    <div class="line-val block w-full rounded-[2px] border border-gray-300 bg-gray-50 p-1 text-sm">
                                                        <div class="div-block-item flex flex-wrap gap-2 line-val"></div>
                                                        <input type="text" name="url" class="findRub font-light inpt_text block w-full rounded-[4px] bg-gray-50 border-none m-0 h-7 border-1 p-1 mt-2 text-sm">
                                                    </div>
                                                    <div class="relative">

                                                    </div>
                                                </div>
                                                <input class="h-5 border border-gray-300 rounded-[2px] font-light p-2 w-full text-[14px] focus:outline-none bg-gray-50 placeholder:text-gray-400" placeholder="* особенности ингредиента">
                                            </th>
                                            <td class="px-4 py-4 w-[120px] align-top">
                                                <input class="h-7 border border-gray-300 rounded-[2px] font-light p-2 w-full text-[14px] focus:outline-none bg-gray-50">
                                            </td>
                                            <td class="px-4 py-4 w-[120px] align-top">
                                                <input class="h-7 border border-gray-300 rounded-[2px] font-light p-2 w-full text-[14px] focus:outline-none bg-gray-50">
                                            </td>
                                            <td class="px-4 py-4 w-fit align-top">
                                                <select class="block h-7 py-[0.5px] px-[10px] w-full text-[12px] text-gray-900 border border-gray-300 rounded-[2px] bg-gray-50 ">
                                                    <option selected>выбрать</option>
                                                    <option value="US">United States</option>
                                                    <option value="CA">Canada</option>
                                                    <option value="FR">France</option>
                                                    <option value="DE">Germany</option>
                                                </select>
                                            </td>
                                            <td class="px-4 py-4 w-[80px] text-center text-red-600">
                                                <i class="ti ti-trash font-thin text-red-600 cursor-pointer !text-[25px]"></i>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="flex">
                                <input type="number" id="addIngInput" class="block w-[100px] p-2 text-gray-900 border border-gray-300 rounded-[2px] bg-gray-50 sm:text-xs focus:outline-none"><button type="button" class="ml-2 px-3 py-2 text-xs font-medium text-center text-white bg-gray-700 rounded-[2px] hover:bg-gray-800 focus:outline-none">добавить ингредиент(ов)</button>
                            </div>
                        </div>
                        <div wire:ignore class="sm:col-span-2">
                            <div for="linkSource" class="mb-5 block text-sm font-light text-gray-500 dark:text-white">Дополнительная информация:</div>
                            <div class="flex flex-col">
                                <div class="w-fit text-light flex mb-3">
                                    <span class="w-[220px] text-gray-500 text-sm">Время готовки:</span>
                                    <div class="w-1/3">
                                        <input type="number" id="addIngInput" class="h-7 block w-[100px] p-2 text-gray-900 border border-gray-300 rounded-[2px] bg-gray-50 sm:text-xs focus:outline-none">
                                    </div>
                                    <select class="block h-7 py-[0.5px] px-[10px] w-w-1/3 text-[12px] text-gray-900 border border-gray-300 rounded-[2px] bg-gray-50 ">
                                        <option selected></option>
                                        <option value="мин">мин</option>
                                        <option value="час">час</option>
                                        <option value="день">день</option>
                                    </select>
                                </div>
                                <div class="w-fit text-light flex mb-3">
                                    <span class="w-[220px] text-gray-500 text-sm">Время приготовления:</span>
                                    <div class="w-1/3">
                                        <input type="number" id="addIngInput" class="h-7 block w-[100px] p-2 text-gray-900 border border-gray-300 rounded-[2px] bg-gray-50 sm:text-xs focus:outline-none">
                                    </div>
                                    <select class="block h-7 py-[0.5px] px-[10px] w-w-1/3 text-[12px] text-gray-900 border border-gray-300 rounded-[2px] bg-gray-50 ">
                                        <option selected></option>
                                        <option value="мин">мин</option>
                                        <option value="час">час</option>
                                        <option value="день">день</option>
                                    </select>
                                </div>
                                <div class="w-fit text-light flex mb-3">
                                    <span class="w-[220px] text-gray-500 text-sm">Порции:</span>
                                    <div class="w-1/3">
                                        <input type="number" id="addIngInput" class="h-7 block w-[100px] p-2 text-gray-900 border border-gray-300 rounded-[2px] bg-gray-50 sm:text-xs focus:outline-none">
                                    </div>
                                    <select class="block h-7 py-[0.5px] px-[10px] w-w-1/3 text-[12px] text-gray-900 border border-gray-300 rounded-[2px] bg-gray-50 ">
                                        <option selected></option>
                                        <option value="мин">мин</option>
                                        <option value="час">час</option>
                                        <option value="день">день</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <div class="flex justify-between items-center">
                                <div for="autoIngr" class="block mb-2 text-sm font-light text-gray-500 dark:text-white">Автозаполнение шагов - <span class=" text-black cursor-pointer">заполнить</span>: </div>
                            </div>
                            <textarea wire:model="autoIngr" id="autoIngr" name="autoIngr" rows="6" class="block p-2.5 w-full text-sm bg-gray-50 rounded-[2px] border border-gray-300 focus:outline-none"></textarea>
                        </div>
                        <div class="sm:col-span-2">
                            <div for="linkSource" class="mb-5 block text-sm font-light text-gray-500 dark:text-white">Шаги приготовления:</div>
                            <div class="grid grid-cols-custom border-b py-3">
                                <div class="step-numeric font-light flex justify-center items-center text-[30px]">1</div>
                                <div class="step-dragIcon flex justify-center items-center"><i class="ti ti-arrows-down-up text-gray-500 !text-[25px]"></i></div>
                                <div class="step-images flex justify-center items-center">
                                    <div class="border border-gray-300 p-4 bg-gray-50 rounded-[2px]">
                                        <i class="ti ti-cloud-upload text-gray-500 !text-[25px]"></i>
                                    </div>
                                </div>
                                <div class="step-desc flex justify-center items-center">
                                    <textarea class="block p-2.5 ml-3 mr-3 w-full text-sm bg-gray-50 rounded-[2px] border border-gray-300 focus:outline-none" name="desc_step" id="" rows="4"></textarea>
                                </div>
                                <div class="step-removeIcon flex justify-center items-center">
                                    <i class="ti ti-trash font-thin text-red-600 cursor-pointer !text-[25px]"></i>
                                </div>
                            </div>
                        </div>
                        <div class="flex">
                            <input type="number" id="addIngInput" class="block w-[100px] p-2 text-gray-900 border border-gray-300 rounded-[2px] bg-gray-50 sm:text-xs focus:outline-none"><button type="button" class="ml-2 px-3 py-2 text-xs font-medium text-center text-white bg-gray-700 rounded-[2px] hover:bg-gray-800 focus:outline-none">добавить шаг(и)</button>
                        </div>

                    </div>
                    <div class="flex justify-between items-center">
                        <div class="flex  mr-4">
                            <a href="{{ route('rubrica.index') }}" class="inline-flex items-center  justify-center px-5 py-2.5 text-sm font-medium text-center text-white bg-green-600 rounded-[4px]">
                                <i class="ti ti-arrow-badge-left"></i>
                                Вернуться назад
                            </a>
                        </div>
                        <div class="flex">
                            <button type="submit" class="inline-flex items-center  justify-center px-5 py-2.5 text-sm font-medium text-center text-white bg-green-600 rounded-[4px]">
                                <i class="ti ti-device-floppy mr-1"></i>
                                Добавить рубрику
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="fixed bottom-0 left-1/2 -translate-x-1/2 z-[49] w-[95rem] mx-auto text-center border border-grey p-4 bg-gray-400">
            <ul class="grid w-full gap-6 grid-cols-3">
                <li>
                    <input type="radio" id="hosting-small" name="hosting" value="hosting-small" class="hidden peer" required>
                    <label for="hosting-small" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                        <div class="block">
                            <div class="w-full text-lg font-semibold">Черновик</div>
                        </div>
                        <svg class="w-5 h-5 ml-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                        </svg>
                    </label>
                </li>
                <li>
                    <input type="radio" id="hosting-big" name="hosting" value="hosting-big" class="hidden peer">
                    <label for="hosting-big" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                        <div class="block">
                            <div class="w-full text-lg font-semibold">На утверждении</div>
                        </div>
                        <svg class="w-5 h-5 ml-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                        </svg>
                    </label>
                </li>
                <li>
                    <input type="radio" id="hosting-big" name="hosting" value="hosting-big" class="hidden peer">
                    <label for="hosting-big" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                        <div class="block">
                            <div class="w-full text-lg font-semibold">Опубликовать</div>
                        </div>
                        <svg class="w-5 h-5 ml-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                        </svg>
                    </label>
                </li>
            </ul>
        </div>
{{--        <div class="w-1/5 h-[calc(100vh-1rem)] rounded-[4px] border fixed top-5 overflow-y-scroll overscroll-contain">--}}
{{--            <div class="px-2 py-3">--}}
{{--                <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="w-full flex justify-between text-white bg-gray-500 hover:bg-gray-800 font-medium rounded-[4px] text-sm px-2 py-1 text-center inline-flex items-center " type="button"><span>Статус</span> <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">--}}
{{--                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>--}}
{{--                    </svg>--}}
{{--                </button>--}}

{{--                <!-- Dropdown menu -->--}}
{{--                <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">--}}
{{--                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">--}}
{{--                        <li>--}}
{{--                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dashboard</a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Settings</a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Earnings</a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Sign out</a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
</div>
@push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#beforeText' ) )
            .then( editor => {
                editor.model.document.on('change:data', () => {
                    @this.set('beforeText', editor.getData());
                })
            } )
            .catch( error => {
            } );
    </script>
@endpush
