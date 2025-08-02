{{-- The main sidebar container with an ID for easy selection --}}
<div id="sidebar" class="fixed ltr:left-0 rtl:right-0 z-40 h-screen w-64">
    <div class="h-full px-3 py-4 overflow-y-auto bg-white dark:bg-slate-900 border-l border-slate-200 dark:border-slate-800 flex flex-col">

        {{-- Logo and Title --}}
        <a href="{{ route('dashboard') }}" class="mb-8 px-1 flex items-center sidebar-item-container">
            {{-- Fuel Pump Icon --}}
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-fuel h-7 w-7 text-primary-800 dark:text-primary-400 flex-shrink-0">
                <line x1="3" x2="15" y1="22" y2="22" />
                <line x1="4" x2="14" y1="9" y2="9" />
                <path d="M14 22V4a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v18" />
                <path d="M14 13h2a2 2 0 0 1 2 2v2a2 2 0 0 0 2 2h0a2 2 0 0 0 2-2V9.83a2 2 0 0 0-.59-1.42L18 5" />
            </svg>
            <span class="sidebar-text text-xl font-display font-semibold text-primary-800 dark:text-primary-400 rtl:ms-2">إدارة المحطات</span>
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
                <div class="sidebar-text px-2 py-1 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">العمليات</div>
            </li>

            {{-- Daily Operations (Collapsible) --}}
            <li>
                <button type="button" class="menu-toggle-button flex items-center justify-center w-full p-2 rounded-lg text-slate-900 dark:text-white hover:bg-slate-100 dark:hover:bg-slate-800">
                    {{-- Clipboard List Icon --}}
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clipboard-list w-5 h-5 flex-shrink-0">
                        <rect width="8" height="4" x="8" y="2" rx="1" ry="1" />
                        <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2" />
                        <path d="M12 11h4" />
                        <path d="M12 16h4" />
                        <path d="M8 11h.01" />
                        <path d="M8 16h.01" />
                    </svg>
                    <span class="sidebar-text flex-1 rtl:ms-2 rtl:text-right whitespace-nowrap">العمليات اليومية</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="chevron-icon sidebar-text w-4 h-4"><path d="m6 9 6 6 6-6"></path></svg>
                </button>
                <ul class="space-y-2 py-2 overflow-hidden" style="display: none;">
                    <li>
                        <a href="" class="flex h-10 rounded-md items-center w-full py-2 pl-11 pr-4 text-slate-900 dark:text-white hover:bg-slate-100 dark:hover:bg-slate-800 group">
                            <span class="rtl:ms-2">إدخال القراءات اليومية</span>
                        </a>
                    </li>
                    <li>
                        <a href="" class="flex h-10 rounded-md items-center w-full py-2 pl-11 pr-4 text-slate-900 dark:text-white hover:bg-slate-100 dark:hover:bg-slate-800 group">
                            <span class="rtl:ms-2">سجل الحركات اليومية</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="pt-4 pb-2 mb-2 border-b border-slate-200 dark:border-slate-700">
                <div class="sidebar-text px-2 py-1 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">إدارة المخزون</div>
            </li>

            {{-- Inventory Management (Collapsible) --}}
            <li>
                <button type="button" class="menu-toggle-button flex items-center justify-center w-full p-2 rounded-lg text-slate-900 dark:text-white hover:bg-slate-100 dark:hover:bg-slate-800">
                    {{-- Database Icon --}}
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-database w-5 h-5 flex-shrink-0">
                        <ellipse cx="12" cy="5" rx="9" ry="3" />
                        <path d="M3 5V19A9 3 0 0 0 21 19V5" />
                        <path d="M3 12A9 3 0 0 0 21 12" />
                    </svg>
                    <span class="sidebar-text flex-1 rtl:ms-2 rtl:text-right whitespace-nowrap">إدارة المخزون</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="chevron-icon sidebar-text w-4 h-4"><path d="m6 9 6 6 6-6"></path></svg>
                </button>
                <ul class="space-y-2 py-2 overflow-hidden" style="display: none;">
                    <li>
                        <a href="" class="flex h-10 rounded-md items-center w-full py-2 pl-11 pr-4 text-slate-900 dark:text-white hover:bg-slate-100 dark:hover:bg-slate-800 group">
                            <span class="rtl:ms-2">حالة الخزانات</span>
                        </a>
                    </li>
                    <li>
                        <a href="" class="flex h-10 rounded-md items-center w-full py-2 pl-11 pr-4 text-slate-900 dark:text-white hover:bg-slate-100 dark:hover:bg-slate-800 group">
                            <span class="rtl:ms-2">الوارد (الشحنات)</span>
                        </a>
                    </li>
                     <li>
                        <a href="" class="flex h-10 rounded-md items-center w-full py-2 pl-11 pr-4 text-slate-900 dark:text-white hover:bg-slate-100 dark:hover:bg-slate-800 group">
                            <span class="rtl:ms-2">أنواع الوقود</span>
                        </a>
                    </li>
                </ul>
            </li>

            {{-- Reports (Collapsible) --}}
            <li>
                <button type="button" class="menu-toggle-button flex items-center justify-center w-full p-2 rounded-lg text-slate-900 dark:text-white hover:bg-slate-100 dark:hover:bg-slate-800">
                    {{-- Chart Icon --}}
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
                            <span class="rtl:ms-2">تقرير الناضح (الفاقد)</span>
                        </a>
                    </li>
                    <li>
                        <a href="" class="flex h-10 rounded-md items-center w-full py-2 pl-11 pr-4 text-slate-900 dark:text-white hover:bg-slate-100 dark:hover:bg-slate-800 group">
                            <span class="rtl:ms-2">تقرير المبيعات</span>
                        </a>
                    </li>
                    <li>
                        <a href="" class="flex h-10 rounded-md items-center w-full py-2 pl-11 pr-4 text-slate-900 dark:text-white hover:bg-slate-100 dark:hover:bg-slate-800 group">
                            <span class="rtl:ms-2">تقرير حركة المخزون</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>

        {{-- Footer/Settings section --}}
        <div class="mt-auto py-2 border-t border-slate-200 dark:border-slate-700 space-y-2">
            {{-- General Settings (Collapsible) --}}
            <button type="button" class="menu-toggle-button flex w-full items-center h-10 px-2 rounded-md hover:bg-slate-100 dark:hover:bg-slate-800 sidebar-item-container">
                {{-- Settings Icon --}}
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-settings w-5 h-5 flex-shrink-0">
                    <path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z" />
                    <circle cx="12" cy="12" r="3" />
                </svg>
                <span class="sidebar-text flex-1 rtl:ms-2 rtl:text-right whitespace-nowrap">الإعدادات العامة</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="chevron-icon sidebar-text w-4 h-4"><path d="m6 9 6 6 6-6"></path></svg>
            </button>
            <ul class="space-y-2 py-2 overflow-hidden" style="display: none;">
                <li>
                    <a href="" class="flex h-10 rounded-md items-center w-full py-2 pl-11 pr-4 text-slate-900 dark:text-white hover:bg-slate-100 dark:hover:bg-slate-800 group">
                        <span class="rtl:ms-2">إدارة الفروع</span>
                    </a>
                </li>
                <li>
                    <a href="" class="flex h-10 rounded-md items-center w-full py-2 pl-11 pr-4 text-slate-900 dark:text-white hover:bg-slate-100 dark:hover:bg-slate-800 group">
                        <span class="rtl:ms-2">إدارة المحطات</span>
                    </a>
                </li>
                 <li>
                    <a href="" class="flex h-10 rounded-md items-center w-full py-2 pl-11 pr-4 text-slate-900 dark:text-white hover:bg-slate-100 dark:hover:bg-slate-800 group">
                        <span class="rtl:ms-2">إدارة المستخدمين</span>
                    </a>
                </li>
            </ul>

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
