<div>
    <section class="bg-white dark:bg-gray-900">
        <div class="mx-auto max-w-screen-xl">
            <div class="bg-white dark:bg-gray-800 relative border rounded-[4px] overflow-hidden">
                <form wire:submit="updateComment" class="p-4">
                    @csrf
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6 mb-5">

                        <div class="w-full">
                            <label for="name" class="@error('h1') text-red-700 dark:text-red-500 @enderror block mb-2 text-sm font-medium text-gray-900">Имя</label>
                            <input wire:model.lazy="name" type="text" name="name" id="name" class="@error('name') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-[4px] block w-full p-2.5 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-[4px] block w-full p-2.5 outline-0">
                            @error('name')
                            <p class="mt-1 text-xs text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="w-full">
                            <label for="email" class="@error('email')text-red-700 @enderror block mb-2 text-sm font-medium text-gray-900 ">Email</label>
                            <input wire:model.lazy="email" type="email" name="email" id="email" class="@error('email') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-[4px] block w-full p-2.5 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-[4px] w-full p-2.5 ">
                            @error('email')
                            <p class="mt-1 text-xs text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</p>
                            @enderror

                        </div>
                        <div class="w-full">
                            <div for="comment" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Коментарий</div>
                            <textarea wire:model="comment" rows="8" name="comment" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-[4px] border border-gray-300 focus:outline-none">{{ $comment }}</textarea>
                        </div>
                        <div class="w-full">
                            <div for="answer" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ответ</div>
                            <textarea wire:model="answer" rows="8" name="comment" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-[4px] border border-gray-300 focus:outline-none">{{ $answer }}</textarea>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex  mr-4">
                            <a href="{{ route('comments.index') }}" class="inline-flex items-center  justify-center px-5 py-2.5 text-sm font-medium text-center text-white bg-green-600 rounded-[4px] focus:outline-none">
                                <i class="ti ti-arrow-badge-left"></i>
                                Вернуться назад
                            </a>
                        </div>
                        <div class="flex">
                            <button type="submit" class="inline-flex items-center  justify-center px-5 py-2.5 text-sm font-medium text-center text-white bg-green-600 rounded-[4px] focus:outline-none">
                                <i class="ti ti-device-floppy mr-1"></i>
                                Изменить
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </section>
</div>


