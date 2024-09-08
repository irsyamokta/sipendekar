<nav class="bg-transparent absolute w-full">
    <div class="flex flex-wrap items-center justify-between mx-auto md:mx-12 p-4 relative">
        <a href="" class="items-center space-x-3 rtl:space-x-reverse">
            <img src="{{ asset('assets/logo/logo-horizontal-color.png') }}" alt="logo sipendekar" class="w-40 lg:w-70">
        </a>
        <div class="md:flex md:gap-2 items-center">
            <div class="flex items-center md:order-2 space-x-1 md:space-x-0 rtl:space-x-reverse">
                <button type="button" id="language-button" data-dropdown-toggle="language-dropdown-menu"
                    class="inline-flex items-center font-medium justify-center px-4 py-2 text-sm text-gray-900">
                    <img id="language-flag" src="{{ App::getLocale() == 'en' ? 'https://flagcdn.com/w320/gb.png' : 'https://flagcdn.com/w320/id.png' }}" alt=""
                        class="w-4 h-4 rounded-full me-2" />
                    <span id="language-label">{{ App::getLocale() == 'en' ? 'ENG' : 'IDN' }}</span>
                </button>
                <!-- Dropdown -->
                <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700"
                    id="language-dropdown-menu">
                    <ul class="py-2 font-medium" role="none">
                        <li>
                            <a href="{{ route('changeLang', ['lang' => 'id']) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary"
                                role="menuitem" onclick="changeLanguage('id')">
                                <div class="inline-flex items-center">
                                    <img src="https://flagcdn.com/w320/id.png" alt=""
                                        class="w-4 h-4 rounded-full me-2" />
                                    IDN
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('changeLang', ['lang' => 'en']) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary"
                                role="menuitem" onclick="changeLanguage('en')">
                                <div class="inline-flex items-center">
                                    <img src="https://flagcdn.com/w320/gb.png" alt=""
                                        class="w-4 h-4 rounded-full me-2" />
                                    ENG
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <button data-collapse-toggle="navbar-language" type="button"
                    class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-secondary"
                    aria-controls="navbar-language" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>
            </div>
            <div class="absolute left-0 top-10 z-50 md:static items-center justify-center hidden w-full md:flex md:w-auto md:order-1 md:gap-4 p-4"
                id="navbar-language">
                <ul
                    class="w-full md:inline-flex md:static font-medium p-4 md:p-0 mt-4 rounded-lg bg-white md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-transparent">
                    <li>
                        <a href="{{ route('homepage') }}"
                            class="block py-2 px-3 text-gray-900 rounded hover:bg-primary md:hover:bg-transparent md:border-0 md:hover:text-soft md:p-0">@lang('message.navbar.home')</a>
                    </li>
                    <li>
                        <a href="{{ route('homepage') }}#about"
                            class="block py-2 px-3 text-gray-900 rounded hover:bg-primary md:hover:bg-transparent md:border-0 md:hover:text-soft md:p-0">@lang('message.navbar.about')</a>
                    </li>
                    <li>
                        <a href="{{ route('homepage') }}#tutorial"
                            class="block py-2 px-3 text-gray-900 rounded hover:bg-primary md:hover:bg-transparent md:border-0 md:hover:text-soft md:p-0">@lang('message.navbar.tutorial')</a>
                    </li>
                    <li>
                        <a href="{{ route('homepage') }}#test"
                            class="block py-2 px-3 text-white bg-secondary rounded md:bg-transparent md:text-secondary md:font-bold md:p-0"
                            aria-current="page">@lang('message.navbar.test')</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>