The main sidebar container with an ID for easy selection
<div id="sidebar" class="fixed ltr:left-0 rtl:right-0 z-40 h-screen w-64">
    <div class="h-full px-3 py-4 overflow-y-auto bg-white dark:bg-slate-900 border-l border-slate-200 dark:border-slate-800 flex flex-col">

        {{-- Logo and Title --}}
        <a href="/" class="mb-8 px-1 flex items-center sidebar-item-container">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="lucide lucide-spray-can h-6 w-6 text-primary-800 dark:text-primary-400 flex-shrink-0">
                <path d="M3 3h.01"></path><path d="M7 5h.01"></path><path d="M11 7h.01"></path><path d="M3 7h.01"></path><path d="M7 9h.01"></path><path d="M3 11h.01"></path><rect width="4" height="4" x="15" y="5"></rect><path d="m19 9 2 2v10c0 .6-.4 1-1 1h-6c-.6 0-1-.4-1-1V11l2-2"></path><path d="m13 14 8-2"></path><path d="m13 19 8-2"></path>
            </svg>
            <span class="sidebar-text text-xl font-display font-semibold text-primary-800 dark:text-primary-400 rtl:ms-2">مخزون العطور</span>
        </a>

        {{-- Main Navigation --}}
        <ul class="space-y-2 font-medium mb-2">
            <li class="pb-2 mb-2 border-b border-slate-200 dark:border-slate-700">
                <div class="sidebar-text px-2 py-1 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">العمليات</div>
            </li>

            {{-- Link Example --}}
            <li>
                <a href="#/" class="flex w-full items-center px-2 py-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 sidebar-item-container {{Route::currentRouteName() == 'home' ? 'bg-primary-50 text-primary-700 dark:bg-slate-800 dark:text-primary-400' : 'text-slate-900 dark:text-white'}}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-5 h-5 flex-shrink-0"><path d="M16 16h6"></path><path d="M19 13v6"></path><path d="M21 10V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l2-1.14"></path><path d="m7.5 4.27 9 5.15"></path><polyline points="3.29 7 12 12 20.71 7"></polyline><line x1="12" x2="12" y1="22" y2="12"></line></svg>
                    <span class="sidebar-text rtl:ms-2">نقطة البيع</span>
                </a>
            </li>

            <li class="pt-4 pb-2 mb-2 border-b border-slate-200 dark:border-slate-700">
                <div class="sidebar-text px-2 py-1 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">إدارة المخزون</div>
            </li>

            {{-- Collapsible Menu Item with a trigger class --}}
            <li>
                <button type="button" class="menu-toggle-button flex items-center justify-center w-full p-2 rounded-lg text-slate-900 dark:text-white hover:bg-slate-100 dark:hover:bg-slate-800">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-5 h-5 flex-shrink-0"><path d="M22 8.35V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V8.35A2 2 0 0 1 3.26 6.5l8-3.2a2 2 0 0 1 1.48 0l8 3.2A2 2 0 0 1 22 8.35Z"></path><path d="M6 18h12"></path><path d="M6 14h12"></path><rect width="12" height="12" x="6" y="10"></rect></svg>
                    <span class="sidebar-text flex-1 rtl:ms-2 rtl:text-right whitespace-nowrap">إدارة المخزون</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="chevron-icon sidebar-text w-4 h-4"><path d="m6 9 6 6 6-6"></path></svg>
                </button>
                <ul class="space-y-2 py-2 overflow-hidden" style="display: none;"> {{-- Start closed by default --}}
                    <li>
                        <a href="#/inventory-logs" class="flex h-10 rounded-md items-center w-full py-2 text-slate-900 dark:text-white rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 group">
                             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-4 h-4 flex-shrink-0"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"></path><path d="M3 3v5h5"></path><path d="M12 7v5l4 2"></path></svg>
                             <span class="rtl:ms-2" x-show="sidebarOpen">سجلات المخزون</span>
                        </a>
                    </li>
                    {{-- Add other inventory sub-links similarly --}}
                </ul>
            </li>

            {{-- Another Collapsible Menu (Purchases) --}}
            <li>
                <button type="button" class="menu-toggle-button flex items-center justify-center w-full p-2 rounded-lg text-slate-900 dark:text-white hover:bg-slate-100 dark:hover:bg-slate-800">
                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-5 h-5 flex-shrink-0"><path d="M16 16h6"></path><path d="M19 13v6"></path><path d="M21 10V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l2-1.14"></path><path d="m7.5 4.27 9 5.15"></path><polyline points="3.29 7 12 12 20.71 7"></polyline><line x1="12" x2="12" y1="22" y2="12"></line></svg>
                    <span class="sidebar-text flex-1 rtl:ms-2 rtl:text-right whitespace-nowrap">المشتريات</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="chevron-icon sidebar-text w-4 h-4"><path d="m6 9 6 6 6-6"></path></svg>
                </button>
                <ul class="space-y-2 py-2 overflow-hidden"> {{-- This one starts open as in the original HTML --}}
                     {{-- Sub-menu items for Purchases here... --}}
                </ul>
            </li>
        </ul>

        {{-- Footer/Settings section --}}
        <div class="mt-auto py-2 border-t border-slate-200 dark:border-slate-700 space-y-2">
            <a href="#/settings" class="flex w-full items-center h-10 px-2 rounded-md hover:bg-slate-100 dark:hover:bg-slate-800 sidebar-item-container">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-4 h-4 flex-shrink-0"><path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                <span class="sidebar-text rtl:ms-2">الإعدادات</span>
            </a>

            <button id="theme-toggle-button" class="flex w-full items-center h-10 px-2 rounded-md hover:bg-slate-100 dark:hover:bg-slate-800 sidebar-item-container">
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

            {{-- The main sidebar toggle button with its ID --}}
            <button id="sidebar-toggle" class="flex w-full items-center h-10 px-2 rounded-md hover:bg-slate-100 dark:hover:bg-slate-800 sidebar-item-container">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="chevron-icon w-5 h-5"><path d="m15 18-6-6 6-6"></path></svg>
                <span class="sidebar-text rtl:ms-2">طي</span>
            </button>
        </div>
    </div>
</div>
