<div>
    <div class="flex justify-center w-full max-h-full">
        <div class="w-full bg-white rounded-[4px] border dark:bg-gray-700">
            <div class="px-6 py-6 lg:px-8">
                <form wire:submit="saveKitchen" class="space-y-6">
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                        <div class="sm:col-span-2">
                            <label for="name" class="@error('name')text-red-700 dark:text-red-500 @enderror block mb-2 text-sm font-medium text-gray-900 dark:text-white">Название</label>
                            <input wire:model.live="name" type="text" name="name" id="name" class="@error('name') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-[4px] dark:bg-gray-700 block w-full p-2.5 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-[4px] focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            @error('name')
                            <p class="mt-1 text-xs text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="flex justify-between">
                        <div class="flex justify-end mr-4">
                            <a href="{{ route('spisok.kitchen.index') }}" class="inline-flex items-center  justify-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-green-600 rounded-[4px] focus:ring-4 focus:ring-gray-200 dark:focus:ring-primary-900 hover:bg-gray-800">
                                <i class="ti ti-arrow-badge-left"></i>
                                Вернуться назад
                            </a>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="inline-flex items-center  justify-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-green-600 rounded-[4px] focus:ring-4 focus:ring-gray-200 dark:focus:ring-primary-900 hover:bg-gray-800">
                                <i class="ti ti-device-floppy mr-1"></i>
                                Добавить кухню
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
