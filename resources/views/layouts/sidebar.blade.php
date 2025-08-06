    <!-- Sidebar -->
    <div id="sidebar" class="fixed ltr:left-0 rtl:right-0 z-40 h-screen w-64 sidebar-transition">
        <div class="h-full px-3 py-4 overflow-y-auto bg-white dark:bg-slate-900 border-l border-slate-200 dark:border-slate-800 flex flex-col">

            <!-- Close button for mobile -->
            <div class="lg:hidden flex justify-between items-center mb-4">
                <span class="text-lg font-semibold text-slate-900 dark:text-white">القائمة</span>
                <button id="mobile-menu-close" class="p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Logo and Title -->
            <a href="#" class="mb-8 px-1 flex items-center sidebar-item-container">
                <!-- Asset Management Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-archive h-7 w-7 text-primary-800 dark:text-primary-400 flex-shrink-0">
                    <rect x="2" y="3" width="20" height="5" rx="1"/>
                    <path d="M4 8v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8"/>
                    <path d="M10 12h4"/>
                </svg>
                <span class="sidebar-text text-xl font-display font-semibold text-primary-800 dark:text-primary-400 rtl:ms-2">إدارة الأصول</span>
            </a>

            <!-- Main Navigation -->
            <ul class="space-y-2 font-medium mb-2">
                <!-- Dashboard Link -->
                <li>
                    <a href="{{ route('dashboard') }}" class="flex w-full items-center px-2 py-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 sidebar-item-container dark:text-white {{ Route::currentRouteName() == 'dashboard' ? 'bg-primary-50 text-primary-700 dark:bg-slate-800 dark:text-primary-400' : '' }}">
                        <!-- Home Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-layout-dashboard w-5 h-5 flex-shrink-0">
                            <rect width="7" height="9" x="3" y="3" rx="1" />
                            <rect width="7" height="5" x="14" y="3" rx="1" />
                            <rect width="7" height="9" x="14" y="12" rx="1" />
                            <rect width="7" height="5" x="3" y="16" rx="1" />
                        </svg>
                        <span class="sidebar-text rtl:ms-2">لوحة التحكم الرئيسية</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('users') }}" class="flex w-full items-center px-2 py-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 sidebar-item-container {{ Route::currentRouteName() == 'users' ? 'bg-primary-50 text-primary-700 dark:bg-slate-800 dark:text-primary-400' : 'text-slate-900 dark:text-white'}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-5 h-5 flex-shrink-0" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-list-icon lucide-list"><path d="M3 12h.01"/><path d="M3 18h.01"/><path d="M3 6h.01"/><path d="M8 12h13"/><path d="M8 18h13"/><path d="M8 6h13"/></svg>
                        <span class="sidebar-text rtl:ms-2">المستخدمين</span>
                    </a>
                </li>

                <li class="pt-4 pb-2 mb-2 border-b border-slate-200 dark:border-slate-700">
                    <div class="sidebar-text px-2 py-1 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">إدارة الأصول</div>
                </li>

                <!-- Assets Management (Collapsible) -->
                <li>
                    <button type="button" class="menu-toggle-button flex items-center justify-center w-full p-2 rounded-lg text-slate-900 dark:text-white hover:bg-slate-100 dark:hover:bg-slate-800">
                        <!-- Assets Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-package w-5 h-5 flex-shrink-0">
                            <path d="m7.5 4.27 9 5.15"></path>
                            <path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"></path>
                            <path d="m3.3 7 8.7 5 8.7-5"></path>
                            <path d="M12 22V12"></path>
                        </svg>
                        <span class="sidebar-text flex-1 rtl:ms-2 rtl:text-right whitespace-nowrap">الأصول</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="chevron-icon sidebar-text w-4 h-4 transition-transform duration-200"><path d="m6 9 6 6 6-6"></path></svg>
                    </button>
                    <ul class="submenu space-y-2 py-2 overflow-hidden transition-all duration-300" style="max-height: 120px;">
                        <li>
                            <a href="{{ route('assets') }}" class="flex h-10 rounded-md items-center w-full py-2 pl-11 pr-4 {{Route::currentRouteName() == 'assets' ? 'bg-primary-50 text-primary-700 dark:bg-slate-800 dark:text-primary-400' : 'text-slate-900 dark:text-white'}} hover:bg-slate-100 dark:hover:bg-slate-800 group">
                                <span class="rtl:ms-2">سجل الأصول</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('assets.create') }}" class="flex h-10 rounded-md items-center w-full py-2 pl-11 pr-4 {{Route::currentRouteName() == 'assets.create' ? 'bg-primary-50 text-primary-700 dark:bg-slate-800 dark:text-primary-400' : 'text-slate-900 dark:text-white'}} hover:bg-slate-100 dark:hover:bg-slate-800 group">
                                <span class="rtl:ms-2">إضافة أصل جديد</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="{{ route('types') }}" class="flex w-full items-center px-2 py-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 sidebar-item-container {{Route::currentRouteName() == 'types' ? 'bg-primary-50 text-primary-700 dark:bg-slate-800 dark:text-primary-400' : 'text-slate-900 dark:text-white'}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-5 h-5 flex-shrink-0" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-tags-icon lucide-tags"><path d="M13.172 2a2 2 0 0 1 1.414.586l6.71 6.71a2.4 2.4 0 0 1 0 3.408l-4.592 4.592a2.4 2.4 0 0 1-3.408 0l-6.71-6.71A2 2 0 0 1 6 9.172V3a1 1 0 0 1 1-1z"/><path d="M2 7v6.172a2 2 0 0 0 .586 1.414l6.71 6.71a2.4 2.4 0 0 0 3.191.193"/><circle cx="10.5" cy="6.5" r=".5" fill="currentColor"/></svg>
                        <span class="sidebar-text rtl:ms-2">الأنواع</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('locations') }}" class="flex w-full items-center px-2 py-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 sidebar-item-container {{Route::currentRouteName() == 'locations' ? 'bg-primary-50 text-primary-700 dark:bg-slate-800 dark:text-primary-400' : 'text-slate-900 dark:text-white'}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-5 h-5 flex-shrink-0" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin-house-icon lucide-map-pin-house"><path d="M15 22a1 1 0 0 1-1-1v-4a1 1 0 0 1 .445-.832l3-2a1 1 0 0 1 1.11 0l3 2A1 1 0 0 1 22 17v4a1 1 0 0 1-1 1z"/><path d="M18 10a8 8 0 0 0-16 0c0 4.993 5.539 10.193 7.399 11.799a1 1 0 0 0 .601.2"/><path d="M18 22v-3"/><circle cx="10" cy="10" r="3"/></svg>
                        <span class="sidebar-text rtl:ms-2">الاماكن</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('employees') }}" class="flex w-full items-center px-2 py-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 sidebar-item-container {{Route::currentRouteName() == 'employees' ? 'bg-primary-50 text-primary-700 dark:bg-slate-800 dark:text-primary-400' : 'text-slate-900 dark:text-white'}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-5 h-5 flex-shrink-0" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-list-icon lucide-list"><path d="M3 12h.01"/><path d="M3 18h.01"/><path d="M3 6h.01"/><path d="M8 12h13"/><path d="M8 18h13"/><path d="M8 6h13"/></svg>
                        <span class="sidebar-text rtl:ms-2">الموظفين</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('depreciation-entries') }}" class="flex w-full items-center px-2 py-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 sidebar-item-container {{Route::currentRouteName() == 'depreciation-entries' ? 'bg-primary-50 text-primary-700 dark:bg-slate-800 dark:text-primary-400' : 'text-slate-900 dark:text-white'}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-5 h-5 flex-shrink-0" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shredder-icon lucide-shredder"><path d="M10 22v-5"/><path d="M14 19v-2"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="M18 20v-3"/><path d="M2 13h20"/><path d="M20 13V7l-5-5H6a2 2 0 0 0-2 2v9"/><path d="M6 20v-3"/></svg>
                        <span class="sidebar-text rtl:ms-2">إهلاك الأصول الثابتة</span>
                    </a>
                </li>
            </ul>


            <!-- Footer/Settings section -->
            <div class="mt-auto py-2 border-t border-slate-200 dark:border-slate-700 space-y-2">
                <!-- Separator -->
                <div class="pt-2"></div>

                <button id="theme-toggle-button" class="flex w-full items-center h-10 px-2 rounded-md hover:bg-slate-100 dark:text-slate-100 dark:hover:bg-slate-800 sidebar-item-container">
                    {{-- Sun Icon (shown in dark mode) --}}
                    <span class="theme-icon-container" style="display: none;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-4 h-4 flex-shrink-0"><circle cx="12" cy="12" r="4"></circle><path d="M12 2v2"></path><path d="M12 20v2"></path><path d="m4.93 4.93 1.41 1.41"></path><path d="m17.66 17.66 1.41 1.41"></path><path d="M2 12h2"></path><path d="M20 12h2"></path><path d="m6.34 17.66-1.41 1.41"></path><path d="m19.07 4.93-1.41 1.41"></path></svg>
                    </span>
                    {{-- Moon Icon (shown in light mode) --}}
                    <span class="theme-icon-container">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="lucide lucide-moon w-4 h-4 flex-shrink-0"><path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"></path></svg>
                    </span>

                    <span class="sidebar-text rtl:ms-2">
                        <span class="theme-text-container" style="display: none;">الوضع الفاتح</span>
                        <span class="theme-text-container">الوضع الداكن</span>
                    </span>
                </button>

                <!-- Toggle Sidebar Button (only visible on large screens) -->
                <button id="sidebar-toggle" class="hidden lg:flex w-full items-center h-10 px-2 rounded-md hover:bg-slate-100 dark:text-slate-100 dark:hover:bg-slate-800 sidebar-item-container">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-panel-left-close w-5 h-5"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M9 3v18"/></svg>
                    <span class="sidebar-text rtl:ms-2">طي القائمة</span>
                </button>
            </div>
        </div>
    </div>
