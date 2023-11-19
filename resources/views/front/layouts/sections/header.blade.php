<!-- BEGIN HEADER -->
<header class="header">
    <div class="container">
        <div class="header__top">
            <div class="logo"><a href="/"><img src="{{ Vite::asset('resources/images/logo.svg') }}" alt=""></a></div>
            <div class="social hidden-lg">
            </div>
            <div class="user-panel">
                <a href="#" class="btn visible-lg toggle-menu "><span class="icon-menu"></span></a>
            </div>
            <div class="user-panel top_button navbar" style="text-align: right;">
            </div>
        </div>
        <nav class="navbar hidden-lg">
            <ul class="navbar-menu">
                @php
                    $headerMenu = DB::table('categories')->select('content')->where('name', '=', 'headerMenu')->first();
                    if(!empty($headerMenu)){
                        $menu = json_decode($headerMenu->content, true);
                        if(!empty($menu)){
                            foreach ($menu as $item) {
                                echo '<li class="navbar-menu__item"><a href="/'.$item['url'].'/" class="navbar-menu__link"><span class="icon-rand">'.$item['icon'].'</span><span class="dotted">'.$item['name'].'</span></a></li>';
                            }
                        }
                    }
                @endphp
            </ul>
        </nav>
        <div class="panel">
            <div class="panel__rubric rubric">
                <a href="#" class="rubric__button">
                    <span class="dotted">
                        <span class="hidden-sm">Выбрать рубрику</span>
                        <span class="visible-sm">Рубрики</span>
                    </span>
                </a>
                <nav class="nav-rubric">
                    <ul class="nav-rubric-l">
                        @php
                            $bannerMenu = DB::table('categories')->select('content')->where('name', '=', 'bannerMenu')->first();
                            if(!empty($bannerMenu)){
                                $menu = json_decode($bannerMenu->content, true);
                                foreach ($menu as $key => $item) {
                                    echo '<li class="nav-rubric-l__item nr-dropdown">';
                                    echo '<a href="#" class="nav-rubric-l__link">'.$item['name'].'</a>';
                                    echo '<ul class="nav-rubric-dropdown rrwq">';
                                    foreach ($item['selecteds'] as $k => $selected) {
                                        $headings = DB::table('headings')->where('id', '=', $k)->first();
                                        if(!empty($headings->parent_bread)){

                                            $parent_bread = json_decode($headings->parent_bread,true);
                                            $parent_bread_id = $parent_bread[0];
                                            $parent_sect = json_decode($headings->parent_sect,true);
                                            $parent_sect_id = $parent_sect[0];

                                            $parent_bread = DB::table('headings')->where('id', '=', $parent_bread_id)->first();
                                            $parent_sect = DB::table('sections')->where('id', '=', $parent_sect_id)->first();
                                            $newLocation   = "/".$parent_sect->url."/".$parent_bread->url."/".$headings->url."/";

                                        }else{
                                            $parent_sect = json_decode($headings->parent_sect,true);
                                            $parent_sect_id = $parent_sect[0];
                                            $parent_sect = DB::table('sections')->where('id', '=', $parent_sect_id)->first();
                                            $newLocation   = "/".$parent_sect->url."/".$headings->url."/";
                                        }

                                        echo '<li><a href="'.$newLocation.'">'.$selected.'</a></li>';
                                    }
                                    echo '</ul>';
                                    echo '</li>';
                                }
                            }
                        @endphp
                    </ul>
                </nav>
            </div>
            <?php

            $result = DB::table('headings')
                    ->select(\DB::raw("sections.url as securl"), 'headings.*')
                    ->join('sections', 'headings.parent_sect', 'LIKE', DB::RAW("CONCAT('[', sections.id, '%')"))
                    ->where('headings.fade', '=', 'true')
                    ->first();
            ?>
            <a href="/<?php echo $result->securl; ?>/<?php echo $result->url; ?>/" class="panel__link recipe-link hidden-md">
                <span class="icon-wine-glasses"></span>
                <span class="dotted"><?php echo $result->name; ?></span>
            </a>
            <a href="#search" class="panel__link search-link hidden-sm popup-open">
                <span class="icon-search"></span>
                <span class="dotted">
						<span class="search-link__full-text">Расширенный поиск</span>
						<span class="search-link__short-text">Поиск</span>
					</span>
            </a>
        </div>
    </div>
</header>
<nav class="mobile-menu">
    <div class="container">
        <div class="mobile-menu__header">
            <a href="#search" class="btn btn--icon popup-open"><span class="icon-search"></span> <span class="visible-sm">расширенный поиск</span><span class="hidden-sm">поиск</span></a>
            <a href="#" class="btn toggle-menu"><span class="icon-close"></span></a>
        </div>
        <div class="mobile-menu__body">
            <ul class="mm-menu">
                <li class="mm-menu__item">
                    <a href="/salaty/salaty-prostye-i-vkusnye/" class="mm-menu__link"><span class="dotted">Салаты</span></a>
                </li>
                <li class="mm-menu__item">
                    <a href="/supy/pervye-blyuda/" class="mm-menu__link"><span class="dotted">Первые блюда</span></a>
                </li>
                <li class="mm-menu__item">
                    <a href="/vtorye/vtorye-blyuda-na-kazhdyy-den/" class="mm-menu__link"><span class="dotted">Вторые блюда</span></a>
                </li>
                <li class="mm-menu__item">
                    <a href="/deserty/deserty/" class="mm-menu__link"><span class="dotted">Десерты</span></a>
                </li>
                <li class="mm-menu__item">
                    <a href="/zakuski/zakuski-prostye-i-vkusnye/" class="mm-menu__link"><span class="dotted">Закуски</span></a>
                </li>
                <li class="mm-menu__item">
                    <a href="/napitki/napitki/" class="mm-menu__link"><span class="dotted">Напитки</span></a>
                </li>
                <li class="mm-menu__item">
                    <a href="/zagotovki-na-zimu/zagotovki-na-zimu/" class="mm-menu__link"><span class="dotted">Заготовки на зиму</span></a>
                </li>
            </ul>
            <ul class="mm-menu">
                <li class="mm-menu__item">
                    <a href="/o-proekte/" class="mm-menu__link"><span class="dotted">O проекте</span></a>
                </li>
                <li class="mm-menu__item">
                    <a href="/komanda/" class="mm-menu__link"><span class="dotted">Команда</span></a>
                </li>
                <li class="mm-menu__item">
                    <a href="/kontakty/" class="mm-menu__link"><span class="dotted">Контакты</span></a>
                </li>
                <li class="mm-menu__item">
                    <a href="/stat-avtorom/" class="mm-menu__link"><span class="dotted">Стать автором</span></a>
                </li>
            </ul>

            <div class="mm-links">
                <div class="mm-links__item"><a href="/politika-konfidencialnosti/"><span class="dotted">Политика конфиденциальности</span></a></div>
                <div class="mm-links__item"><a href="/polzovatelskoe-soglashenie/"><span class="dotted">Пользовательское соглашение</span></a></div>
            </div>
        </div>
    </div>
</nav>
<!-- HEADER EOF   -->
