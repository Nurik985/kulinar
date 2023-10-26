<div>
    <div class="flex max-h-full w-full justify-center">
        <div class="w-full rounded-[4px] border bg-white dark:bg-gray-700">
            <div class="px-6 py-6 lg:px-8">
                <form wire:submit="updateMethod" class="space-y-6">
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                        <div class="w-full">
                            <label for="name"
                                class="@error('name')text-red-700 dark:text-red-500 @enderror mb-2 block text-sm font-medium text-gray-900 dark:text-white">Название</label>
                            <input wire:model.live="name" type="text" name="name" id="name"
                                class="@error('name') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-[4px] dark:bg-gray-700 block w-full p-2.5 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500 @enderror block w-full rounded-[4px] border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-600 focus:ring-primary-600 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500">
                            @error('name')
                                <p class="mt-1 text-xs text-red-600 dark:text-red-500"><span
                                        class="font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="w-full">
                            <label for="coef"
                                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Коэффициент</label>
                            <input wire:model="coef" type="number" step="0.01" name="coef" id="coef"
                                class="block w-full rounded-[4px] border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-600 focus:ring-primary-600 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                                placeholder="0">
                        </div>
                    </div>
                    <div class="flex justify-between">
                        <div class="mr-4 flex justify-end">
                            <a href="{{ route('spisok.method.index') }}"
                                class="mt-4 inline-flex items-center justify-center rounded-[4px] bg-green-600 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gray-800 focus:ring-4 focus:ring-gray-200 dark:focus:ring-primary-900 sm:mt-6">
                                <i class="ti ti-arrow-badge-left"></i>
                                Вернуться назад
                            </a>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit"
                                class="mt-4 inline-flex items-center justify-center rounded-[4px] bg-green-600 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gray-800 focus:ring-4 focus:ring-gray-200 dark:focus:ring-primary-900 sm:mt-6">
                                <i class="ti ti-device-floppy mr-1"></i>
                                Обновить способ
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
