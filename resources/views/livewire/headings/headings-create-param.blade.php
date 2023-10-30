<div>
    <div class="flex  w-full justify-center">
        <div class="w-full rounded-[4px] border bg-white dark:bg-gray-700">
            <div class="px-6 py-6 lg:px-8">
                <form wire:submit="saveHeading" class="space-y-6" onkeydown="return event.key != 'Enter';">
                    <div class="grid gap-2 sm:grid-cols-2 sm:gap-4">
                        <div class="sm:col-span-2">
                            <label for="name"
                                   class="@error('name')text-red-700 dark:text-red-500 @enderror mb-2 block text-sm font-medium text-gray-900 dark:text-white">Название</label>
                            <input wire:model.live="name" wire:keyup="generateSlug" type="text" name="name" id="name"
                                   class="@error('name') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-[4px] dark:bg-gray-700 block w-full p-2.5 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500 @enderror block w-full rounded-[4px] border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-600 focus:ring-primary-600 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500">
                            @error('name')
                            <p class="mt-1 text-xs text-red-600 dark:text-red-500 error-message"><span
                                    class="font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="sm:col-span-2">
                            <label for="title"
                                   class="@error('title')text-red-700 dark:text-red-500 @enderror mb-2 block text-sm font-medium text-gray-900 dark:text-white">Title
                                (SEO) </label>
                            <input wire:model.live="title" type="title" name="title" id="title"
                                   class="@error('title') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-[4px] dark:bg-gray-700 block w-full p-2.5 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500 @enderror block w-full rounded-[4px] border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-600 focus:ring-primary-600 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500">
                            @error('title')
                            <p class="mt-1 text-xs text-red-600 dark:text-red-500 error-message"><span
                                    class="font-medium validation-error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="sm:col-span-2">
                            <label for="url"
                                   class="@error('url')text-red-700 dark:text-red-500 @enderror mb-2 block text-sm font-medium text-gray-900 dark:text-white">URL</label>
                            <input wire:model.live="url" type="text" name="url" id="url"
                                   class="@error('url') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-[4px] dark:bg-gray-700 block w-full p-2.5 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500 @enderror block w-full rounded-[4px] border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-600 focus:ring-primary-600 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500">
                            @error('url')
                            <p class="mt-1 text-xs text-red-600 dark:text-red-500 error-message"><span
                                    class="font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-2">
                            <div class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Родительская рубрика</div>
                            <div class="div_mass">
                                <div class="line-val block w-full rounded-[4px] border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900">
                                    <div class="div-block-item flex flex-wrap gap-2 line-val">
                                        @if($rubricSelecteds)
                                            @foreach($rubricSelecteds as $k => $rubricSelected)
                                                <div class="block-item w-fit bg-gray-300 mr-2 text-black border border-black p-1.5 select-none rounded-[2px]"><div class="item flex text-[16px]"><span id="{{$k}}">{{$rubricSelected}}</span><i wire:click="rubricRemoveItemId({{$k}})" class="ti removeItem ti-square-letter-x ml-2 cursor-pointer text-red-600"></i></div></div>
                                            @endforeach
                                        @endif
                                    </div>
                                    <input wire:keyup="rubricSearchFunc" wire:model="rubricSearchText" type="text" name="url" class="findRub inpt_text block w-full rounded-[4px] border-[#ccc] m-0 h-10 border-1 p-2 mt-2  text-sm text-gray-900">
                                </div>
                                <div class="relative">
                                    @if($rubricSearchResults)
                                    <div class="abs-items absolute search z-10 bg-[lightgray] rounded-[4px] top-1 shadow w-full dark:bg-gray-700">
                                        <ul class="overflow-y-auto text-md text-gray-700 dark:text-gray-200">
                                            {!! $rubricSearchResults !!}
                                        </ul>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <div class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Родительский раздел</div>
                            <div class="div_mass">
                                <div class="line-val block w-full rounded-[4px] border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900">
                                    <div class="div-block-item flex flex-wrap gap-2 line-val">
                                        @if($sectionSelecteds)
                                            @foreach($sectionSelecteds as $k => $sectionSelected)
                                                <div class="block-item w-fit bg-gray-300 mr-2 text-black border border-black p-1.5 select-none rounded-[2px]"><div class="item flex text-[16px]"><span id="{{$k}}">{{$sectionSelected}}</span><i wire:click="sectionRemoveItemId({{$k}})" class="ti removeItem ti-square-letter-x ml-2 cursor-pointer text-red-600"></i></div></div>
                                            @endforeach
                                        @endif
                                    </div>
                                    <input wire:keyup="sectionSearchFunc" wire:model="sectionSearchText" type="text" name="url" class="findRub inpt_text block w-full rounded-[4px] border-[#ccc] m-0 h-10 border-1 p-2 mt-2  text-sm text-gray-900">
                                </div>
                                <div class="relative">
                                    @if($sectionSearchResults)
                                        <div class="abs-items absolute search z-10 bg-[lightgray] rounded-[4px] top-1 shadow w-full dark:bg-gray-700">
                                            <ul class="overflow-y-auto text-md text-gray-700 dark:text-gray-200">
                                                {!! $sectionSearchResults !!}
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <div class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Хлебные крошки</div>
                            <div class="div_mass">
                                <div class="line-val block w-full rounded-[4px] border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900">
                                    <div class="div-block-item flex flex-wrap gap-2 line-val">
                                        @if($breadcrumbSelecteds)
                                            @foreach($breadcrumbSelecteds as $k => $breadcrumbSelected)
                                                <div class="block-item w-fit bg-gray-300 mr-2 text-black border border-black p-1.5 select-none rounded-[2px]"><div class="item flex text-[16px]"><span id="{{$k}}">{{$breadcrumbSelected}}</span><i wire:click="breadcrumbRemoveItemId({{$k}})" class="ti removeItem ti-square-letter-x ml-2 cursor-pointer text-red-600"></i></div></div>
                                            @endforeach
                                        @endif
                                    </div>
                                    <input wire:keyup="breadcrumbSearchFunc" wire:model="breadcrumbSearchText" type="text" name="url" class="findRub inpt_text block w-full rounded-[4px] border-[#ccc] m-0 h-10 border-1 p-2 mt-2  text-sm text-gray-900">
                                </div>
                                <div class="relative">
                                    @if($breadcrumbSearchResults)
                                        <div class="abs-items absolute search z-10 bg-[lightgray] rounded-[4px] top-1 shadow w-full dark:bg-gray-700">
                                            <ul class="overflow-y-auto text-md text-gray-700 dark:text-gray-200">
                                                {!! $breadcrumbSearchResults !!}
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div wire:ignore class="sm:col-span-2">
                            <label  for="editorFirst" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Текст в начале рубрики</label>
                            <textarea wire:model="firstText" id="editorFirst" name="editorFirst" rows="8" name="text" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-[4px] border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="">{{ old('text', '') }}</textarea>
                        </div>
                        <div wire:ignore class="sm:col-span-2">
                            <label  for="editorLast" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Текст в конце рубрики</label>
                            <textarea wire:model="lastText" id="editorLast" name="editorLast" rows="8" name="text" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-[4px] border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="">{{ old('text', '') }}</textarea>
                        </div>
                        <div class="sm:col-span-2">
                            <div class="mb-2 block text-sm font-medium">Изображение записи @if ($rubImg) <sdpan wire:click="delRubImg" class="text-red-500 cursor-pointer ">удалить?</sdpan>@endif</div>
                            @if ($rubImg)
                                <img class="w-1/4 h-auto relative block bg-gray-50 border border-gray-300 rounded-[4px]"  src="{{ $rubImg->temporaryUrl() }}">
                            @else
                                <div class="w-full h-[200px] relative block bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-[4px]" style="background-image:url('{{ Vite::asset('resources/images/plus.svg') }}'); background-position: center; background-size: 3%; background-repeat: no-repeat; background-color: #f9fafb; border-style: dashed; border-width: medium; border-color: #ccc">
                                    <input type="file" wire:model="rubImg" class="absolute top-0 left-0 w-full h-full opacity-0 cursor-pointer">
                                </div>
                            @endif
                        </div>

                        <div class="sm:col-span-2">
                            <div class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Что готовим</div>
                            <div class="div_mass">
                                <div  class="line-val block w-full rounded-[4px] border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900">
                                    <div class="div-block-item flex flex-wrap gap-2 line-val">
                                        @if($cookSelecteds)
                                            @foreach($cookSelecteds as $k => $cookSelected)
                                                {!! $cookSelected !!}
                                            @endforeach
                                        @endif
                                    </div>
                                    <input wire:keydown.enter="cookAdd" wire:click="cookShowCheck" wire:keyup="cookSearchFunc" wire:model="cookSearchText"  type="text" name="url" class="findRub inpt_text block w-full rounded-[4px] border-[#ccc] m-0 h-10 border-1 p-2 mt-2  text-sm text-gray-900">
                                </div>
                                <div class="relative">
                                    <div class="abs-items absolute search z-10 bg-[lightgray] rounded-[4px] top-1 shadow w-full dark:bg-gray-700">
                                        @if($cookShow)
                                        <div class="check-lab">
                                            <input id="cookChekLabel" wire:model="cookCheck" name="cookCheck" type="checkbox" class="check-logic cursor-pointer">
                                            <label for="cookChekLabel" class="cursor-pointer"><div>или</div></label>
                                        </div>
                                        @endif
                                        @if($cookSearchResults)
                                        <ul class="overflow-y-auto text-md text-gray-700 dark:text-gray-200">
                                            {!! $cookSearchResults !!}
                                        </ul>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <div class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Включая ингредиенты</div>
                            <div class="div_mass">
                                <div  class="line-val block w-full rounded-[4px] border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900">
                                    <div class="div-block-item flex flex-wrap gap-2 line-val">
                                        @if($incIngrSelecteds)
                                            @foreach($incIngrSelecteds as $k => $incIngrSelected)
                                                {!! $incIngrSelected !!}
                                            @endforeach
                                        @endif
                                    </div>
                                    <input wire:keydown.enter="incIngrAdd" wire:click="incIngrShowCheck" wire:keyup="incIngrSearchFunc" wire:model="incIngrSearchText"  type="text" name="url" class="findRub inpt_text block w-full rounded-[4px] border-[#ccc] m-0 h-10 border-1 p-2 mt-2  text-sm text-gray-900">
                                </div>
                                <div class="relative">
                                    <div class="abs-items absolute search z-10 bg-[lightgray] rounded-[4px] top-1 shadow w-full dark:bg-gray-700">
                                        @if($incIngrShow)
                                            <div class="check-lab">
                                                <input id="incIngrChekLabel" wire:model="incIngrCheck" name="incIngrCheck" type="checkbox" class="check-logic cursor-pointer">
                                                <label for="incIngrChekLabel" class="cursor-pointer"><div>или</div></label>
                                            </div>
                                        @endif
                                        @if($incIngrSearchResults)
                                            <ul class="overflow-y-auto text-md text-gray-700 dark:text-gray-200">
                                                {!! $incIngrSearchResults !!}
                                            </ul>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <div class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Исключая игридиенты</div>
                            <div class="div_mass">
                                <div  class="line-val block w-full rounded-[4px] border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900">
                                    <div class="div-block-item flex flex-wrap gap-2 line-val">
                                        @if($excIngrSelecteds)
                                            @foreach($excIngrSelecteds as $k => $excIngrSelected)
                                                {!! $excIngrSelected !!}
                                            @endforeach
                                        @endif
                                    </div>
                                    <input wire:keydown.enter="excIngrAdd" wire:click="excIngrShowCheck" wire:keyup="excIngrSearchFunc" wire:model="excIngrSearchText"  type="text" name="url" class="findRub inpt_text block w-full rounded-[4px] border-[#ccc] m-0 h-10 border-1 p-2 mt-2  text-sm text-gray-900">
                                </div>
                                <div class="relative">
                                    <div class="abs-items absolute search z-10 bg-[lightgray] rounded-[4px] top-1 shadow w-full dark:bg-gray-700">
                                        @if($excIngrShow)
                                            <div class="check-lab">
                                                <input id="excIngrCheckLabel" wire:model="excIngrCheck" name="excIngrCheck" type="checkbox" class="check-logic cursor-pointer">
                                                <label for="excIngrCheckLabel" class="cursor-pointer"><div>или</div></label>
                                            </div>
                                        @endif
                                        @if($excIngrSearchResults)
                                            <ul class="overflow-y-auto text-md text-gray-700 dark:text-gray-200">
                                                {!! $excIngrSearchResults !!}
                                            </ul>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <div class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Способ приготовления</div>
                            <div class="div_mass">
                                <div  class="line-val block w-full rounded-[4px] border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900">
                                    <div class="div-block-item flex flex-wrap gap-2 line-val">
                                        @if($methodSelecteds)
                                            @foreach($methodSelecteds as $k => $methodSelected)
                                                {!! $methodSelected !!}
                                            @endforeach
                                        @endif
                                    </div>
                                    <input wire:keydown.enter="methodAdd" wire:click="methodShowCheck" wire:keyup="methodSearchFunc" wire:model="methodSearchText"  type="text" name="url" class="findRub inpt_text block w-full rounded-[4px] border-[#ccc] m-0 h-10 border-1 p-2 mt-2  text-sm text-gray-900">
                                </div>
                                <div class="relative">
                                    <div class="abs-items absolute search z-10 bg-[lightgray] rounded-[4px] top-1 shadow w-full dark:bg-gray-700">
                                        @if($methodShow)
                                            <div class="check-lab">
                                                <input id="methodCheckLabel" wire:model="methodCheck" name="methodCheck" type="checkbox" class="check-logic cursor-pointer">
                                                <label for="methodCheckLabel" class="cursor-pointer"><div>или</div></label>
                                            </div>
                                        @endif
                                        @if($methodSearchResults)
                                            <ul class="overflow-y-auto text-md text-gray-700 dark:text-gray-200">
                                                {!! $methodSearchResults !!}
                                            </ul>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="flex items-center align-middle justify-between">
                        <div class="flex items-center">
                            <input wire:model="fadeMenu" id="fadeMenu" name="fadeMenu" type="checkbox" class="w-6 h-6 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="fadeMenu" class="ml-2 cursor-pointer text-sm font-medium text-gray-900 dark:text-gray-300">Вывести в верхнее меню</label>
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="flex  mr-4">
                                <a href="{{ route('rubrica.index') }}" class="inline-flex items-center  justify-center px-5 py-2.5 text-sm font-medium text-center text-white bg-green-600 rounded-[4px] focus:ring-4 focus:ring-gray-200 dark:focus:ring-primary-900 hover:bg-gray-800">
                                    <i class="ti ti-arrow-badge-left"></i>
                                    Вернуться назад
                                </a>
                            </div>
                            <div class="flex">
                                <button type="submit" class="inline-flex items-center  justify-center px-5 py-2.5 text-sm font-medium text-center text-white bg-green-600 rounded-[4px] focus:ring-4 focus:ring-gray-200 dark:focus:ring-primary-900 hover:bg-gray-800">
                                    <i class="ti ti-device-floppy mr-1"></i>
                                    Добавить рубрику
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editorFirst' ) )
            .then( editor => {
                editor.model.document.on('change:data', () => {
                    @this.set('firstText', editor.getData());
                })
            } )
            .catch( error => {
            } );

        ClassicEditor
            .create( document.querySelector( '#editorLast' ) )
            .then( editor => {
                editor.model.document.on('change:data', () => {
                    @this.set('lastText', editor.getData());
                })
            } )
            .catch( error => {
            } );
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
    </script>
@endpush
