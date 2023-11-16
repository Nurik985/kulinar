<div>
    <section class="bg-white dark:bg-gray-900">
        <div class="mx-auto max-w-screen-xl">
            <div class="bg-white dark:bg-gray-800 relative border rounded-[4px] overflow-hidden">
                <form wire:submit="savePage" class="p-4">
                    @csrf
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6 mb-5">
                        <div class="sm:col-span-2">
                            <label for="name" class="@error('name') text-red-700 @enderror block mb-2 text-sm font-medium text-gray-900 ">Название</label>
                            <input wire:model="name" wire:keyup="generateSlug" type="text" class="@error('name') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-[4px] block w-full p-2.5  @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-[4px] block w-full p-2.5 " placeholder="" >
                            @error('name')
                            <p class="mt-1 text-xs text-red-600"><span class="font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="sm:col-span-2">
                            <label for="title" class="@error('title')text-red-700 @enderror block mb-2 text-sm font-medium text-gray-900">Title (SEO):</label>
                            <input wire:model.lazy="title" type="text" name="title" id="title" class="@error('title') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-[4px] block w-full p-2.5 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-[4px] w-full p-2.5 " >
                            @error('title')
                            <p class="mt-1 text-xs text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="sm:col-span-2">
                            <label for="url" class="@error('url')text-red-700 @enderror block mb-2 text-sm font-medium text-gray-900">Url:</label>
                            <input wire:model="url" type="text" id="url" class="@error('url') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-[4px] block w-full p-2.5 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-[4px] focus:outline-none block w-full p-2.5 ">
                            @error('url')
                            <p class="mt-1 text-xs text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                        <div wire:ignore class="sm:col-span-2">
                            <div for="text" class="block mb-2 text-sm font-medium text-gray-900">Текст:</div>
                            <textarea wire:model="text" id="editor" rows="8" name="text" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-[4px] border border-gray-300 focus:outline-none"></textarea>
                        </div>
                    </div>
                    <div class="flex items-center align-middle justify-between">
                        <div class="flex items-center">
                            <select wire:model.defer="status"
                                    class="flex w-full items-center justify-center rounded-[4px] border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 md:w-auto">
                                <option value="2">Черновик</option>
                                <option value="1">Опубликовано</option>
                                <option value="3">На утверждении</option>
                            </select>
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="flex  mr-4">
                                <a href="{{ route('pages.index') }}" class="inline-flex items-center  justify-center px-5 py-2.5 text-sm font-medium text-center text-white bg-green-600 rounded-[4px] focus:ring-4 focus:ring-gray-200 hover:bg-gray-800">
                                    <i class="ti ti-arrow-badge-left"></i>
                                    Вернуться назад
                                </a>
                            </div>
                            <div class="flex">
                                <button type="submit" class="inline-flex items-center  justify-center px-5 py-2.5 text-sm font-medium text-center text-white bg-green-600 rounded-[4px] focus:ring-4 focus:ring-gray-200 hover:bg-gray-800">
                                    <i class="ti ti-device-floppy mr-1"></i>
                                    Добавить страницу
                                </button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </section>
</div>

@push('scripts')
    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'),{
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
                    @this.set('text', editor.getData());
                })
            })
            .catch(error => {
            });
    </script>
@endpush
