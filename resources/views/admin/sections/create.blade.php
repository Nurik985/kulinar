@extends('admin/layouts/authLayout')

@section('title', 'Разделы')

@section('page-style')
@endsection

@section('content')
    <div class="p-4 lg:ml-64 min-h-screen">
        <h5 class="mb-5 text-black dark:text-white">
            <!-- Breadcrumb -->
            <nav
                class="flex px-5 py-3 text-gray-700 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700"
                aria-label="Breadcrumb">
                <ol class="inline-flex items-center">
                    <li class="inline-flex items-center mr-3">
                        <a href="/admin"
                           class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                            <svg class="w-3 h-3 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                 viewBox="0 0 20 20">
                                <path
                                    d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                            </svg>
                            Домой
                        </a>
                    </li>
                    <li class="inline-flex items-center mr-2">
                        <a href="/admin/razdel"
                           class=" inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                            <svg class="w-3 h-3 mr-2 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="m1 9 4-4-4-4" />
                            </svg>
                            Разделы
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="m1 9 4-4-4-4" />
                            </svg>
                            <span class=" text-sm font-medium text-gray-400  md:ml-2 dark:text-gray-400 ">Добавление раздела</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </h5>
        <section class="bg-white dark:bg-gray-900">
            <div class="mx-auto max-w-screen-xl">
                <div class="bg-white dark:bg-gray-800 relative border rounded-lg overflow-hidden">
                <form action="{{ route('razdel.store') }}" method="post" class="p-4">
                    @csrf
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6 mb-5">
                        <div class="w-full">
                            <label for="url" class="@error('url')text-red-700 dark:text-red-500 @enderror block mb-2 text-sm font-medium text-gray-900 dark:text-white">ЧПУ</label>
                            <input type="text" name="url" id="url" class="@error('url') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg dark:bg-gray-700 block w-full p-2.5 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="" value="{{ old('url', '') }}">
                            @error('url')
                            <p class="mt-1 text-xs text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</p>
                            @enderror

                        </div>
                        <div class="w-full">
                            <label for="h1" class="@error('h1') text-red-700 dark:text-red-500 @enderror block mb-2 text-sm font-medium text-gray-900 dark:text-white">Заголовок</label>
                            <input type="text" name="h1" id="h1" class="@error('h1') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg dark:bg-gray-700 block w-full p-2.5 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white outline-0" placeholder="" value="{{ old('h1', '') }}">
                            @error('h1')
                            <p class="mt-1 text-xs text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="w-full">
                            <label for="title" class="@error('title') text-red-700 dark:text-red-500 @enderror block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                            <input type="text" name="title" id="title" class="@error('title') bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg dark:bg-gray-700 block w-full p-2.5 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="" value="{{ old('title', '') }}">
                            @error('title')
                            <p class="mt-1 text-xs text-red-600 dark:text-red-500"><span class="font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="w-full">
                            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                            <input type="text" name="description" id="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" value="{{ old('description', '') }}">
                        </div>
                        <div class="sm:col-span-2">
                            <textarea id="editor" rows="8" name="text" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="">{{ old('text', '') }}</textarea>
                        </div>
                    </div>
                    <div class="flex items-center align-middle justify-between">
                        <div class="flex items-center">
                            <input id="fadeHome" name="fade_home" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="fadeHome" class="ml-2 cursor-pointer text-sm font-medium text-gray-900 dark:text-gray-300">Вывести на главную страницу</label>
                        </div>
                        <button type="submit" class="inline-flex items-center px-5 m-0 py-2.5 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                            Добавить раздел
                        </button>
                    </div>

                </form>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('page-script')

    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .then( editor => {
                console.log( editor );
            } )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection
