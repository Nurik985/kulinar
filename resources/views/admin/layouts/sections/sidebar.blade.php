<aside id="logo-sidebar"
    class="fixed left-auto top-0 z-10 h-screen w-64 -translate-x-full border-r border-gray-200 bg-white transition-transform dark:border-gray-700 dark:bg-gray-800 lg:translate-x-0"
    aria-label="Sidebar">
    <a href="/admin" class="mb-7 mt-3 flex w-full justify-center">
        <img src="{{ Vite::asset('resources/images/logo.svg') }}" class="h-12" alt="Kulinarenok" />
    </a>
    <div class="h-full overflow-y-auto bg-white px-3 pb-4 dark:bg-gray-800">
        <ul class="space-y-2 font-medium">
            @foreach ($menuData[0]->menu as $menu)
                @php
                    $activeClass = null;
                    $currentRouteName = Route::currentRouteName();
                    $currRoute = explode('.', Route::currentRouteName());
                    $menuSlug = explode('.', $menu->slug);
                    if ($menuSlug[0] === $currRoute[0]) {
                        $activeClass = 'active';
                    } elseif (isset($menu->submenu)) {
                        if (gettype($menu->slug) === 'array') {
                            foreach ($menu->slug as $slug) {
                                if (str_contains($currentRouteName, $slug) and strpos($currentRouteName, $slug) === 0) {
                                    $activeClass = 'active open';
                                }
                            }
                        } else {
                            if (str_contains($currentRouteName, $menu->slug) and strpos($currentRouteName, $menu->slug) === 0) {
                                $activeClass = 'active open';
                            }
                        }
                    }
                @endphp

                @if (isset($menu->submenu))
                    <li>
                        <button type="button"
                            class="group flex w-full items-center rounded-lg p-2 text-base text-gray-900 transition duration-75 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                            aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                            @isset($menu->icon)
                                <i class="{{ $menu->icon }}"></i>
                            @endisset
                            <span
                                class="ml-3 flex-1 whitespace-nowrap text-left">{{ isset($menu->name) ? __($menu->name) : '' }}</span>
                            <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <ul id="dropdown-example"
                            class="@if ($menuSlug[0] != $currRoute[0]) hidden @endif space-y-2 py-2">

                            @foreach ($menu->submenu as $submenu)
                                @php
                                    $sActive = 'no';
                                    $activeClass = null;
                                    $active = 'active open';
                                    $currentRouteName = Route::currentRouteName();
                                    $curRuteName = explode('.', $currentRouteName);

                                    if (count($curRuteName) > 1) {
                                        $submenuSlug = explode('-', $submenu->slug);
                                        if ($curRuteName[0] . '.' . $curRuteName[1] === $submenuSlug[0] . '.' . $submenuSlug[1]) {
                                            $activeClass = 'active';
                                            $sActive = 'yes';
                                        }
                                    }

                                    if ($currentRouteName === $submenu->slug) {
                                        $activeClass = 'active';
                                    } elseif (isset($submenu->submenu)) {
                                        if (gettype($submenu->slug) === 'array') {
                                            foreach ($submenu->slug as $slug) {
                                                if (str_contains($currentRouteName, $slug) and strpos($currentRouteName, $slug) === 0) {
                                                    $activeClass = $active;
                                                }
                                            }
                                        } else {
                                            if (str_contains($currentRouteName, $submenu->slug) and strpos($currentRouteName, $submenu->slug) === 0) {
                                                $activeClass = $active;
                                            }
                                        }
                                    }
                                @endphp
                                <li ss {{ $sActive }} {{ $activeClass }}>
                                    <a href="{{ isset($submenu->url) ? url($submenu->url) : 'javascript:void(0)' }}"
                                        class="{{ $activeClass == 'active' ? 'bg-gray-100 dark:bg-gray-700 text-black' : 'hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-500' }} group flex w-full items-center rounded-lg pb-1 pl-7 pt-1 text-sm  transition duration-75 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                                        @if (isset($submenu->icon))
                                            <i class="{{ $submenu->icon }} mr-3"></i>
                                        @endif
                                        {{ isset($submenu->name) ? __($submenu->name) : '' }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @else
                    <li> <a href="{{ isset($menu->url) ? url($menu->url) : 'javascript:void(0);' }}"
                            class="{{ $activeClass == 'active' ? 'bg-gray-100 dark:bg-gray-700 text-black' : 'hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-900 ' }} group flex items-center rounded-lg p-2  dark:text-white">
                            @isset($menu->icon)
                                <i class="{{ $menu->icon }}"></i>
                            @endisset
                            <span class="ml-3">{{ isset($menu->name) ? __($menu->name) : '' }}</span>
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
</aside>
