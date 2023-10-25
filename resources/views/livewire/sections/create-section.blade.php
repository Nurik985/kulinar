<div>
    <section class="bg-white dark:bg-gray-900">
        <div class="mx-auto max-w-screen-xl">
            <div class="bg-white dark:bg-gray-800 relative border rounded-[4px] overflow-hidden">
                <form wire:submit="saveSection" class="p-4">
                    @csrf
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6 mb-5">

                        <div class="w-full">
                            <label for="h1" class="@error('h1') text-red-700 dark:text-red-500 @enderror block mb-2 text-sm font-medium text-gray-900 dark:text-white">Заголовок</label>
                            <input wire:model="h1" wire:keyup="generateSlug" type="text" class="@error('h1') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-[4px] dark:bg-gray-700 block w-full p-2.5 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-[4px] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white outline-0" placeholder="" >
                            @error('h1')
                            <p class="mt-1 text-xs text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="w-full">
                            <label for="url" class="@error('url')text-red-700 dark:text-red-500 @enderror block mb-2 text-sm font-medium text-gray-900 dark:text-white">ЧПУ</label>
                            <input wire:model.defer="url" type="text" name="url" id="url" class="@error('url') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-[4px] dark:bg-gray-700 block w-full p-2.5 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-[4px] w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" >
                            @error('url')
                            <p class="mt-1 text-xs text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</p>
                            @enderror

                        </div>
                        <div class="w-full">
                            <label for="title" class="@error('title') text-red-700 dark:text-red-500 @enderror block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                            <input wire:model.live="title" type="text" name="title" id="title" class="@error('title') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-[4px] dark:bg-gray-700 block w-full p-2.5 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-[4px] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="" value="{{ old('title', '') }}">
                            @error('title')
                            <p class="mt-1 text-xs text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="w-full">
                            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                            <input wire:model="description" type="text" name="description" id="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-[4px] focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" value="{{ old('description', '') }}">
                        </div>
                        <div wire:ignore class="sm:col-span-2">
                            <textarea wire:model="text" id="editor" rows="8" name="text" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-[4px] border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="">{{ old('text', '') }}</textarea>
                        </div>
                    </div>
                    <div class="flex items-center align-middle justify-between">
                        <div class="flex items-center">
                            <input wire:model="fade_home" id="fadeHome" name="fade_home" type="checkbox" class="w-6 h-6 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="fadeHome" class="ml-2 cursor-pointer text-sm font-medium text-gray-900 dark:text-gray-300">Вывести на главную страницу</label>
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="flex  mr-4">
                                <a href="{{ route('razdel.index') }}" class="inline-flex items-center  justify-center px-5 py-2.5 text-sm font-medium text-center text-white bg-green-600 rounded-[4px] focus:ring-4 focus:ring-gray-200 dark:focus:ring-primary-900 hover:bg-gray-800">
                                    <i class="ti ti-arrow-badge-left"></i>
                                    Вернуться назад
                                </a>
                            </div>
                            <div class="flex">
                                <button type="submit" class="inline-flex items-center  justify-center px-5 py-2.5 text-sm font-medium text-center text-white bg-green-600 rounded-[4px] focus:ring-4 focus:ring-gray-200 dark:focus:ring-primary-900 hover:bg-gray-800">
                                    <i class="ti ti-device-floppy mr-1"></i>
                                    Добавить раздел
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
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .then( editor => {
                editor.model.document.on('change:data', () => {
                    @this.set('text', editor.getData());
                })
            } )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endpush
