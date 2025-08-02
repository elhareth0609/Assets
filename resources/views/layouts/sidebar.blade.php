{{-- The main sidebar container with an ID for easy selection --}}
<div id="sidebar" class="fixed ltr:left-0 rtl:right-0 z-40 h-screen w-64">
    <div class="h-full px-3 py-4 overflow-y-auto bg-white dark:bg-slate-900 border-l border-slate-200 dark:border-slate-800 flex flex-col">

        {{-- Logo and Title --}}
        <a href="{{ route('dashboard') }}" class="mb-8 px-1 flex items-center sidebar-item-container">
            {{-- Asset Management Icon --}}
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-archive h-7 w-7 text-primary-800 dark:text-primary-400 flex-shrink-0">
                <rect x="2" y="3" width="20" height="5" rx="1"/>
                <path d="M4 8v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8"/>
                <path d="M10 12h4"/>
            </svg>
            <span class="sidebar-text text-xl font-display font-semibold text-primary-800 dark:text-primary-400 rtl:ms-2">إدارة الأصول</span>
        </a>

        {{-- Main Navigation --}}
        <ul class="space-y-2 font-medium mb-2">
            {{-- Dashboard Link --}}
            <li>
                <a href="{{ route('dashboard') }}" class="flex w-full items-center px-2 py-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 sidebar-item-container {{ Request::routeIs('dashboard') ? 'bg-primary-50 text-primary-700 dark:bg-slate-800 dark:text-primary-400' : 'text-slate-900 dark:text-white' }}">
                    {{-- Home Icon --}}
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-layout-dashboard w-5 h-5 flex-shrink-0">
                        <rect width="7" height="9" x="3" y="3" rx="1" />
                        <rect width="7" height="5" x="14" y="3" rx="1" />
                        <rect width="7" height="9" x="14" y="12" rx="1" />
                        <rect width="7" height="5" x="3" y="16" rx="1" />
                    </svg>
                    <span class="sidebar-text rtl:ms-2">لوحة التحكم الرئيسية</span>
                </a>
            </li>

            <li class="pt-4 pb-2 mb-2 border-b border-slate-200 dark:border-slate-700">
                <div class="sidebar-text px-2 py-1 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">إدارة الأصول</div>
            </li>

            {{-- Assets Management (Collapsible) --}}
            <li>
                <button type="button" class="menu-toggle-button flex items-center justify-center w-full p-2 rounded-lg {{ Request::routeIs('dashboard') ? 'bg-primary-50 text-primary-700 dark:bg-slate-800 dark:text-primary-400' : 'text-slate-900 dark:text-white' }} hover:bg-slate-100 dark:hover:bg-slate-800">
                    {{-- Assets Icon --}}
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-package w-5 h-5 flex-shrink-0">
                        <path d="m7.5 4.27 9 5.15"></path>
                        <path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"></path>
                        <path d="m3.3 7 8.7 5 8.7-5"></path>
                        <path d="M12 22V12"></path>
                    </svg>
                    <span class="sidebar-text flex-1 rtl:ms-2 rtl:text-right whitespace-nowrap">الأصول</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="chevron-icon sidebar-text w-4 h-4"><path d="m6 9 6 6 6-6"></path></svg>
                </button>
                <ul class="space-y-2 py-2 overflow-hidden" style="display: none;">
                    <li>
                        <a href="{{ route('assets') }}" class="flex h-10 rounded-md items-center w-full py-2 pl-11 pr-4 {{ Request::routeIs('assets') ? 'bg-primary-50 text-primary-700 dark:bg-slate-800 dark:text-primary-400' : 'text-slate-900 dark:text-white' }} hover:bg-slate-100 dark:hover:bg-slate-800 group">
                            <span class="rtl:ms-2">سجل الأصول</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('assets.create') }}" class="flex h-10 rounded-md items-center w-full py-2 pl-11 pr-4 {{ Request::routeIs('assets.create') ? 'bg-primary-50 text-primary-700 dark:bg-slate-800 dark:text-primary-400' : 'text-slate-900 dark:text-white' }} hover:bg-slate-100 dark:hover:bg-slate-800 group">
                            <span class="rtl:ms-2">إضافة أصل جديد</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('assets') }}" class="flex h-10 rounded-md items-center w-full py-2 pl-11 pr-4 {{ Request::routeIs('assets.type') ? 'bg-primary-50 text-primary-700 dark:bg-slate-800 dark:text-primary-400' : 'text-slate-900 dark:text-white' }} hover:bg-slate-100 dark:hover:bg-slate-800 group">
                            <span class="rtl:ms-2">أنواع الأصول</span>
                        </a>
                    </li>
                </ul>
            </li>

            {{-- <li class="pt-4 pb-2 mb-2 border-b border-slate-200 dark:border-slate-700">
                <div class="sidebar-text px-2 py-1 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">المستخدمون والصيانة</div>
            </li> --}}

            {{-- Users Management (Collapsible) --}}
            {{-- <li>
                <button type="button" class="menu-toggle-button flex items-center justify-center w-full p-2 rounded-lg text-slate-900 dark:text-white hover:bg-slate-100 dark:hover:bg-slate-800">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users w-5 h-5 flex-shrink-0">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="m22 21-3-3"/>
                        <path d="M17 18a3 3 0 1 0 0-6 3 0 0 0 0 6z"/>
                    </svg>
                    <span class="sidebar-text flex-1 rtl:ms-2 rtl:text-right whitespace-nowrap">إدارة المستخدمين</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="chevron-icon sidebar-text w-4 h-4"><path d="m6 9 6 6 6-6"></path></svg>
                </button>
                <ul class="space-y-2 py-2 overflow-hidden" style="display: none;">
                    <li>
                        <a href="" class="flex h-10 rounded-md items-center w-full py-2 pl-11 pr-4 text-slate-900 dark:text-white hover:bg-slate-100 dark:hover:bg-slate-800 group">
                            <span class="rtl:ms-2">قائمة الموظفين</span>
                        </a>
                    </li>
                    <li>
                        <a href="" class="flex h-10 rounded-md items-center w-full py-2 pl-11 pr-4 text-slate-900 dark:text-white hover:bg-slate-100 dark:hover:bg-slate-800 group">
                            <span class="rtl:ms-2">طلبات الصيانة</span>
                        </a>
                    </li>
                    <li>
                        <a href="" class="flex h-10 rounded-md items-center w-full py-2 pl-11 pr-4 text-slate-900 dark:text-white hover:bg-slate-100 dark:hover:bg-slate-800 group">
                            <span class="rtl:ms-2">سجل النقل والتخصيص</span>
                        </a>
                    </li>
                </ul>
            </li> --}}

            {{-- <li>
                <button type="button" class="menu-toggle-button flex items-center justify-center w-full p-2 rounded-lg text-slate-900 dark:text-white hover:bg-slate-100 dark:hover:bg-slate-800">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bar-chart-3 w-5 h-5 flex-shrink-0">
                        <path d="M3 3v18h18" />
                        <path d="M18 17V9" />
                        <path d="M13 17V5" />
                        <path d="M8 17v-3" />
                    </svg>
                    <span class="sidebar-text flex-1 rtl:ms-2 rtl:text-right whitespace-nowrap">التقارير</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="chevron-icon sidebar-text w-4 h-4"><path d="m6 9 6 6 6-6"></path></svg>
                </button>
                <ul class="space-y-2 py-2 overflow-hidden" style="display: none;">
                    <li>
                        <a href="" class="flex h-10 rounded-md items-center w-full py-2 pl-11 pr-4 text-slate-900 dark:text-white hover:bg-slate-100 dark:hover:bg-slate-800 group">
                            <span class="rtl:ms-2">تقرير الأصول حسب النوع</span>
                        </a>
                    </li>
                    <li>
                        <a href="" class="flex h-10 rounded-md items-center w-full py-2 pl-11 pr-4 text-slate-900 dark:text-white hover:bg-slate-100 dark:hover:bg-slate-800 group">
                            <span class="rtl:ms-2">تقرير الأصول حسب الحالة</span>
                        </a>
                    </li>
                    <li>
                        <a href="" class="flex h-10 rounded-md items-center w-full py-2 pl-11 pr-4 text-slate-900 dark:text-white hover:bg-slate-100 dark:hover:bg-slate-800 group">
                            <span class="rtl:ms-2">تقرير الصيانة والإصلاحات</span>
                        </a>
                    </li>
                </ul>
            </li> --}}
        </ul>

        {{-- Footer/Settings section --}}
        <div class="mt-auto py-2 border-t border-slate-200 dark:border-slate-700 space-y-2">
            <button type="button" class="menu-toggle-button flex w-full items-center h-10 px-2 rounded-md hover:bg-slate-100 dark:hover:bg-slate-800 sidebar-item-container">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-settings w-5 h-5 flex-shrink-0">
                    <path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z" />
                    <circle cx="12" cy="12" r="3" />
                </svg>
                <span class="sidebar-text flex-1 rtl:ms-2 rtl:text-right whitespace-nowrap">الإعدادات العامة</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="chevron-icon sidebar-text w-4 h-4"><path d="m6 9 6 6 6-6"></path></svg>
            </button>
            {{-- <ul class="space-y-2 py-2 overflow-hidden" style="display: none;">
                <li>
                    <a href="" class="flex h-10 rounded-md items-center w-full py-2 pl-11 pr-4 text-slate-900 dark:text-white hover:bg-slate-100 dark:hover:bg-slate-800 group">
                        <span class="rtl:ms-2">إدارة الأقسام</span>
                    </a>
                </li>
                <li>
                    <a href="" class="flex h-10 rounded-md items-center w-full py-2 pl-11 pr-4 text-slate-900 dark:text-white hover:bg-slate-100 dark:hover:bg-slate-800 group">
                        <span class="rtl:ms-2">إدارة المواقع</span>
                    </a>
                </li>
                 <li>
                    <a href="" class="flex h-10 rounded-md items-center w-full py-2 pl-11 pr-4 text-slate-900 dark:text-white hover:bg-slate-100 dark:hover:bg-slate-800 group">
                        <span class="rtl:ms-2">إدارة المستخدمين</span>
                    </a>
                </li>
            </ul> --}}

            {{-- Separator --}}
            <div class="pt-2"></div>

            {{-- Toggle Sidebar Button --}}
            <button id="sidebar-toggle" class="flex w-full items-center h-10 px-2 rounded-md hover:bg-slate-100 dark:hover:bg-slate-800 sidebar-item-container">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-panel-left-close w-5 h-5"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M9 3v18"/></svg>
                <span class="sidebar-text rtl:ms-2">طي القائمة</span>
            </button>
        </div>
    </div>
</div>
