<aside id="logo-sidebar"
    class="fixed top-0 left-auto z-10 w-64 h-screen transition-transform -translate-x-full bg-white border-r border-gray-200 lg:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    aria-label="Sidebar">
    <a href="/admin" class="flex w-full mt-3 mb-7 justify-center">
        <img src="{{ Vite::asset('resources/images/logo.svg') }}" class="h-12" alt="Kulinarenok" />
    </a>
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
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
            foreach($menu->slug as $slug){
            if (str_contains($currentRouteName,$slug) and strpos($currentRouteName,$slug) === 0) {
            $activeClass = 'active open';
            }
            }
            }
            else{
            if (str_contains($currentRouteName,$menu->slug) and strpos($currentRouteName,$menu->slug) === 0) {
            $activeClass = 'active open';
            }
            }
            }
            @endphp

            @if(isset($menu->submenu))

            <li>
                <button type="button"
                    class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                    aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                    @isset($menu->icon)
                    <i class="{{ $menu->icon }}"></i>
                    @endisset
                    <span class="flex-1 ml-3 text-left whitespace-nowrap">{{ isset($menu->name) ? __($menu->name) : ''
                        }}</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <ul id="dropdown-example" class="hidden py-2 space-y-2">

                    @foreach ($menu->submenu as $submenu)

                    @php
                    $activeClass = null;
                    $active = 'active open';
                    $currentRouteName = Route::currentRouteName();

                    if ($currentRouteName === $submenu->slug) {
                    $activeClass = 'active';
                    }
                    elseif (isset($submenu->submenu)) {
                    if (gettype($submenu->slug) === 'array') {
                    foreach($submenu->slug as $slug){
                    if (str_contains($currentRouteName,$slug) and strpos($currentRouteName,$slug) === 0) {
                    $activeClass = $active;
                    }
                    }
                    }
                    else{
                    if (str_contains($currentRouteName,$submenu->slug) and strpos($currentRouteName,$submenu->slug) ===
                    0) {
                    $activeClass = $active;
                    }
                    }
                    }
                    @endphp
                    <li>
                        <a href="{{ isset($submenu->url) ? url($submenu->url) : 'javascript:void(0)' }}"
                            class="flex items-center w-full text-gray-500 text-sm pt-1 pb-1 transition duration-75 rounded-lg pl-7 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
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
            <li>
                <a href="{{ isset($menu->url) ? url($menu->url) : 'javascript:void(0);' }}"
                    class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white {{($activeClass == 'active') ? 'bg-gray-100 dark:bg-gray-700' : 'hover:bg-gray-100 dark:hover:bg-gray-700 '}}   group">
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