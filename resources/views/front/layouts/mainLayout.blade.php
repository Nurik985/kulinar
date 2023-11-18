<!DOCTYPE html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, maximum-scale=1">
    <title>Вкусные домашние рецепты c пошаговыми фото - kulinarenok.ru</title>
    <meta name="description" content="Авторские рецепты всех кухонь мира в одном месте с пошаговыми фото и советами от первого лица. Добавляйте Ваши рецепты и выкладывайте собственные кулинарные успехи на нашем проекте!">
    <meta name="keywords" content="Рецепты, кулинарные рецепты, рецепты с фото, рецепты блюд, рецепты приготовления, что приготовить, как приготовить, вкусные рецепты, рецепты дома, простые рецепты, домашние рецепты, рецепты кухни, кулинария">
    <link rel="icon" href="{{asset('favicon.ico')}}" type="image/x-icon">
    @vite('resources/scss/front/style.css')
    @vite('resources/scss/front/bootstrap-grid.css')
    @vite('resources/scss/front/slick.css')
</head>
<body>
    <!-- BEGIN BODY -->
    <div class="main-wrapper">
        @include('front/layouts/sections/header')
        <!-- BEGIN MAIN -->
        <main class="main">
            @yield('layoutContent')
        </main>
        <!-- MAIN EOF -->
        <!-- BEGIN FOOTER -->
        @include('front/layouts/sections/footer')
        <!-- FOOTER EOF -->
        @include('front/layouts/sections/popup')
    </div>
    <!-- BODY EOF -->
    <div class="icon-load">
        <div class="ball a"></div>
        <div class="ball b"></div>
        <div class="ball c"></div>
    </div>
    @include('front/layouts/sections/scripts')
</body>
</html>
