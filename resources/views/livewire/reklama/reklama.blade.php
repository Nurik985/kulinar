<div>
    <section class="bg-white dark:bg-gray-900 mb-40">
        <form wire:submit="saveReklama">
            <div class="mx-auto max-w-screen-xl">
                <div class="bg-white relative border rounded-lg">
                    <div class="rounded-[4px] border bg-white">
                        <div class="">
                            <h2 class="text-cred font-bold text-lg px-4 mt-2 mb-3">В похожих рецептах</h2>
                            <div class="flex items-start px-4 py-1 mb-2">
                                <div class="grid grid-cols-2 gap-4 w-full">
                                    <div class="col-span-1">
                                        <div>
                                            <p>Рекламый код №1 (Моб)</p>
                                            <textarea wire:model.lazy="additional_mob1" cols="30" rows="4" class="w-full border border-gray-400 rounded-[4px]">{!! $additional_mob1 !!}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-span-1">
                                        <div>
                                            <p>Рекламый код №2 (Моб)</p>
                                            <textarea wire:model.lazy="additional_mob2" cols="30" rows="4" class="w-full border border-gray-400 rounded-[4px]">{!! $additional_mob2 !!}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-3">
                        <div class="">
                            <h2 class="text-cred d-block font-bold text-lg px-4 mb-3">В родительских рубриках</h2>
                            <div class="flex items-start px-4 py-1 mb-2">
                                <div class="grid grid-cols-2 gap-4 w-full">
                                    <div class="col-span-1">
                                        @php
//                                            echo "<pre>";
//                                            print_r($rubrica2Desc);
//                                            echo "</pre>";
                                        @endphp
                                        @for($i = 0; $i < 10; $i++)
                                            <div wire:key="rubrica2_desc.{{$i}}" class="mb-3">
                                                <p>Рекламый код № {{$i + 1}} (Десктоп)</p>
                                                <textarea wire:model.lazy="rubrica2_desc.{{ $i }}" cols="30" rows="4" class="w-full border border-gray-400 rounded-[4px]">@if(!empty($rubrica2_desc[$i])) {{$rubrica2_desc[$i]}} @endif</textarea>
                                            </div>
                                        @endfor
                                    </div>
                                    <div class="col-span-1">
                                        @for($i = 0; $i < 10; $i++)
                                            <div wire:key="rubrica2_mob-{{$i}}" class="mb-3">
                                                <p>Рекламый код № {{$i + 1}} (Моб)</p>
                                                <textarea wire:model.lazy="rubrica2_mob.{{ $i }}" cols="30" rows="4" class="w-full border border-gray-400 rounded-[4px]">@if(!empty($rubrica2_mob[$i])) {{$rubrica2_mob[$i]}} @endif</textarea>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-3">
                        <div class="">
                            <h2 class="text-cred d-block font-bold text-lg px-4 mb-3">В дополнительных рецептах (текст после шагов)</h2>
                            <div class="flex items-start px-4 py-1 mb-2">
                                <div class="grid grid-cols-2 gap-4 w-full">
                                    <div class="col-span-1">
                                        @for($i = 0; $i < 10; $i++)
                                            <div wire:key="end_text_desc-{{$i}}" class="mb-3">
                                                <p>Рекламый код № {{$i + 1}} (Десктоп)</p>
                                                <textarea wire:model.lazy="end_text_desc.{{ $i }}" cols="30" rows="4" class="w-full border border-gray-400 rounded-[4px]">@if(!empty($end_text_desc[$i])) {{$end_text_desc[$i]}} @endif</textarea>
                                            </div>
                                        @endfor
                                    </div>
                                    <div class="col-span-1">
                                        @for($i = 0; $i < 10; $i++)
                                            <div wire:key="end_text_mob-{{$i}}" class="mb-3">
                                                <p>Рекламый код № {{$i + 1}} (Моб)</p>
                                                <textarea wire:model.lazy="end_text_mob.{{ $i }}" cols="30" rows="4" class="w-full border border-gray-400 rounded-[4px]">@if(!empty($end_text_mob[$i])) {{$end_text_mob[$i]}} @endif</textarea>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-3">
                        <div class="">
                            <h2 class="text-cred d-block font-bold text-lg px-4 mb-3">В шагах</h2>
                            <div class="flex items-start px-4 py-1 mb-2">
                                <div class="grid grid-cols-2 gap-4 w-full">
                                    <div class="col-span-1">
                                        @for($i = 0; $i < 10; $i++)
                                            <div wire:key="steps_desc-{{$i}}" class="mb-3">
                                                <p>Рекламый код № {{$i + 1}} (Десктоп)</p>
                                                <textarea wire:model.lazy="steps_desc.{{ $i }}" cols="30" rows="4" class="w-full border border-gray-400 rounded-[4px]">@if(!empty($steps_desc[$i])) {{$steps_desc[$i]}} @endif</textarea>
                                            </div>
                                        @endfor
                                    </div>
                                    <div class="col-span-1">
                                        @for($i = 0; $i < 10; $i++)
                                            <div wire:key="steps_mob-{{$i}}" class="mb-3">
                                                <p>Рекламый код № {{$i + 1}} (Моб)</p>
                                                <textarea wire:model.lazy="steps_mob.{{ $i }}" cols="30" rows="4" class="w-full border border-gray-400 rounded-[4px]">@if(!empty($steps_mob[$i])) {{$steps_mob[$i]}} @endif</textarea>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-3">
                        <div class="">
                            <h2 class="text-cred d-block font-bold text-lg px-4 mb-3">Рецепт</h2>
                            <div class="flex items-start px-4 py-1 mb-2">
                                <div class="grid grid-cols-3 gap-4 w-full">
                                    <div class="col-span-1">
                                        @for($i = 0; $i < 6; $i++)
                                            <div wire:key="recipe_desctop-{{$i}}" class="mb-3">
                                                <p>Рекламый код № {{$i + 1}} (Десктоп)</p>
                                                <textarea wire:model.lazy="recipe_desctop.{{ $i }}" cols="30" rows="4" class="w-full border border-gray-400 rounded-[4px]">@if(!empty($recipe_desctop[$i])) {{$recipe_desctop[$i]}} @endif</textarea>
                                            </div>
                                        @endfor
                                    </div>
                                    <div class="col-span-1">
                                        @for($i = 0; $i < 6; $i++)
                                            <div wire:key="recipe_mobile-{{$i}}" class="mb-3">
                                                <p>Рекламый код № {{$i + 1}} (Моб)</p>
                                                <textarea wire:model.lazy="recipe_mobile.{{ $i }}" cols="30" rows="4" class="w-full border border-gray-400 rounded-[4px]">@if(!empty($recipe_mobile[$i])) {{$recipe_mobile[$i]}} @endif</textarea>
                                            </div>
                                        @endfor
                                    </div>
                                    <div class="col-span-1">
                                        @for($i = 0; $i < 6; $i++)
                                            <div wire:key="recipe_amp-{{$i}}" class="mb-3">
                                                <p>Рекламый код № {{$i + 1}} (amp)</p>
                                                <textarea wire:model.lazy="recipe_amp.{{ $i }}" cols="30" rows="4" class="w-full border border-gray-400 rounded-[4px]">@if(!empty($recipe_amp[$i])) {{$recipe_amp[$i]}} @endif</textarea>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-3">
                        <div class="">
                            <h2 class="text-cred d-block font-bold text-lg px-4 mb-3">Рубрика</h2>
                            <div class="flex items-start px-4 py-1 mb-2">
                                <div class="grid grid-cols-3 gap-4 w-full">
                                    <div class="col-span-1">
                                        @foreach($rubrica_desctop as $k => $v)
                                            <div wire:key="rubrica_desctop-{{$k}}" class="mb-3">
                                                <p>Рекламый код № {{$k + 1}} (Десктоп)</p>
                                                <textarea wire:model.lazy="rubrica_desctop.{{ $k }}" cols="30" rows="4" class="w-full border border-gray-400 rounded-[4px]">@if(!empty($rubrica_desctop[$k])) {{$rubrica_desctop[$k]}} @endif</textarea>
                                            </div>
                                        @endforeach
                                        <button wire:click="addRubricaDesctop()" type="button" class="flex text-white bg-gray-500 hover:bg-gray-400 focus:outline-none font-medium rounded-[4px] text-sm px-4 py-2 text-center mr-3 md:mr-0">
                                            <span class="block">добавить десктоп</span>
                                        </button>
                                    </div>
                                    <div class="col-span-1">
                                        @foreach($rubrica_mobile as $k => $v)
                                            <div wire:key="rubrica_mobile-{{$k}}" class="mb-3">
                                                <p>Рекламый код № {{$k + 1}} (Моб)</p>
                                                <textarea wire:model.lazy="rubrica_mobile.{{ $k }}" cols="30" rows="4" class="w-full border border-gray-400 rounded-[4px]">@if(!empty($rubrica_mobile[$k])) {{$rubrica_mobile[$k]}} @endif</textarea>
                                            </div>
                                        @endforeach
                                        <button wire:click="addRubricaMobile()" type="button" class="flex text-white bg-gray-500 hover:bg-gray-400 focus:outline-none font-medium rounded-[4px] text-sm px-4 py-2 text-center mr-3 md:mr-0">
                                            <span class="block">добавить моб</span>
                                        </button>
                                    </div>
                                    <div class="col-span-1">
                                        @foreach($rubrica_amp as $k => $v)
                                            <div wire:key="rubrica_amp-{{$k}}" class="mb-3">
                                                <p>Рекламый код № {{$k + 1}} (amp)</p>
                                                <textarea wire:model.lazy="rubrica_amp.{{ $k }}" cols="30" rows="4" class="w-full border border-gray-400 rounded-[4px]">@if(!empty($rubrica_amp[$k])) {{$rubrica_amp[$k]}} @endif</textarea>
                                            </div>
                                        @endforeach
                                        <button wire:click="addRubricaAmp()" type="button" class="flex text-white bg-gray-500 hover:bg-gray-400 focus:outline-none font-medium rounded-[4px] text-sm px-4 py-2 text-center mr-3 md:mr-0">
                                            <span class="block">добавить amp</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="fixed bottom-0 left-1/2 -translate-x-1/2 z-[49] border w-[95rem] p-3 bg-gray-100">
                <div class="flex content-end flex-wrap justify-end items-center">
                    <div id="hideAlert" class="flex items-center mr-10 text-green-400 animate-fade-in animate-delay-1000">
                        @if ($message = Session::get('success'))
                            {!!  $message !!}
                        @endif
                    </div>
                    <button wire:loading.attr="disabled" wire:target="saveReklama" type="submit"
                            class="border border-green-600 w-fit inline-flex items-center justify-center px-5 py-2 text-sm font-medium text-center text-white cursor-pointer bg-green-600 rounded-[6px] hover:bg-green-800" wire:loading.class="!border !border-gray-700 !text-gray-400 bg-gray-200" wire:loading.class.remove="cursor-pointer bg-green-600 hover:bg-green-800">
                        <svg wire:loading wire:target="saveReklama" fill='none' class="w-5 h-5 animate-spin mr-2" viewBox="0 0 32 32" xmlns='http://www.w3.org/2000/svg'>
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
