<!DOCTYPE>
@php
$isFront = ($isFront ?? '') == true ? 'Front' : '';
@endphp
<html lang="{{ session()->get('locale') ?? app()->getLocale() }}" class="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>@yield('title') | {{ config('template.templateName') ? config('template.templateName') : 'TemplateName' }} -
        {{
        config('template.templateSuffix') ? config('template.templateSuffix') : 'TemplateSuffix' }}
    </title>
    <meta name="description"
        content="{{ config('template.templateDescription') ? config('template.templateDescription') : '' }}" />
    <meta name="keywords" content="{{ config('template.templateKeyword') ? config('template.templateKeyword') : '' }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="{{ Vite::asset('resources/images/favicon.png') }}" />
    @include('admin/layouts/sections/styles' . $isFront)
    @include('admin/layouts/sections/scriptsIncludes' . $isFront)
</head>

<body class="bg-gray-500">
    <?php if(!$isFront): ?>
    <div id="preloader" class="fixed w-screen h-screen bg-white z-50 overflow-hidden">
        <div class="flex  w-screen h-screen items-center justify-center">
            <div class="flex flex-col justify-center items-center space-x-1 text-sm text-black ">
                <svg fill='none' class="w-16 h-16 animate-spin" viewBox="0 0 32 32" xmlns='http://www.w3.org/2000/svg'>
                    <path clip-rule='evenodd'
                        d='M15.165 8.53a.5.5 0 01-.404.58A7 7 0 1023 16a.5.5 0 011 0 8 8 0 11-9.416-7.874.5.5 0 01.58.404z'
                        fill='currentColor' fill-rule='evenodd' />
                </svg>
            </div>
        </div>
    </div>
    <?php endif; ?>


    <div
        class="wrapper <?php if(!$isFront): ?>max-w-[95rem] mx-auto border-x-gray-200 xl:border-x dark:bg-gray-800 dark:border-x-gray-700 <?php endif; ?>">
        <main id="content" role="main" class="bg-white">
            @yield('layoutContent')

        </main>
    </div>

    @include('admin/layouts/sections/scripts' . $isFront)
    @include('admin/layouts/sections/scriptsIncludes' . $isFront)

</body>

</html>
