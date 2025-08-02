@extends('layouts.app')
@section('content')
<div class="container mx-auto p-6 space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-display font-bold text-slate-900 dark:text-slate-100">سجل الأصول</h1>
            <p class="text-slate-600 dark:text-slate-400 mt-1">تتبع وإدارة أصول المؤسسة</p>
        </div>
        <div class="flex gap-2">
            <button class="inline-flex items-center justify-center rounded-md font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none bg-transparent border border-slate-300 dark:border-slate-700 hover:bg-slate-100 dark:hover:bg-slate-800 h-8 px-3 text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-download w-4 h-4 ltr:mr-2 rtl:ml-2">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                    <polyline points="7 10 12 15 17 10"></polyline>
                    <line x1="12" x2="12" y1="15" y2="3"></line>
                </svg>
                تصدير CSV
            </button>
            <a href="{{ route('assets.create') }}" class="inline-flex items-center justify-center rounded-md font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none bg-primary-600 text-white hover:bg-primary-700 h-8 px-3 text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus w-4 h-4 ltr:mr-2 rtl:ml-2">
                    <path d="M5 12h14"></path>
                    <path d="M12 5v14"></path>
                </svg>
                إضافة أصل جديد
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mt-4">
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow-sm border bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/20 border-blue-200 dark:border-blue-800">
            <div class="p-6 border-b border-slate-200 dark:border-slate-700 flex flex-row items-center justify-between space-y-0 pb-2">
                <h3 class="tracking-tight text-sm font-medium text-blue-700 dark:text-blue-300">إجمالي الأصول</h3>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-package h-5 w-5 text-blue-600 dark:text-blue-400">
                    <path d="m7.5 4.27 9 5.15"></path>
                    <path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"></path>
                    <path d="m3.3 7 8.7 5 8.7-5"></path>
                    <path d="M12 22V12"></path>
                </svg>
            </div>
            <div class="p-6">
                <div class="text-2xl font-bold text-blue-900 dark:text-blue-100">125</div>
                <p class="text-xs text-blue-600 dark:text-blue-400 mt-1">إجمالي الأصول المسجلة</p>
            </div>
        </div>

        <div class="bg-white dark:bg-slate-800 rounded-lg shadow-sm border bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900/20 dark:to-green-800/20 border-green-200 dark:border-green-800">
            <div class="p-6 border-b border-slate-200 dark:border-slate-700 flex flex-row items-center justify-between space-y-0 pb-2">
                <h3 class="tracking-tight text-sm font-medium text-green-700 dark:text-green-300">قيد الاستخدام</h3>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-circle h-5 w-5 text-green-600 dark:text-green-400">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
            </div>
            <div class="p-6">
                <div class="text-2xl font-bold text-green-900 dark:text-green-100">98</div>
                <p class="text-xs text-green-600 dark:text-green-400 mt-1">أصول نشطة</p>
            </div>
        </div>

        <div class="bg-white dark:bg-slate-800 rounded-lg shadow-sm border bg-gradient-to-br from-yellow-50 to-yellow-100 dark:from-yellow-900/20 dark:to-yellow-800/20 border-yellow-200 dark:border-yellow-800">
            <div class="p-6 border-b border-slate-200 dark:border-slate-700 flex flex-row items-center justify-between space-y-0 pb-2">
                <h3 class="tracking-tight text-sm font-medium text-yellow-700 dark:text-yellow-300">في الصيانة</h3>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-tool h-5 w-5 text-yellow-600 dark:text-yellow-400">
                    <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path>
                </svg>
            </div>
            <div class="p-6">
                <div class="text-2xl font-bold text-yellow-900 dark:text-yellow-100">12</div>
                <p class="text-xs text-yellow-600 dark:text-yellow-400 mt-1">تحت الصيانة</p>
            </div>
        </div>

        <div class="bg-white dark:bg-slate-800 rounded-lg shadow-sm border bg-gradient-to-br from-red-50 to-red-100 dark:from-red-900/20 dark:to-red-800/20 border-red-200 dark:border-red-800">
            <div class="p-6 border-b border-slate-200 dark:border-slate-700 flex flex-row items-center justify-between space-y-0 pb-2">
                <h3 class="tracking-tight text-sm font-medium text-red-700 dark:text-red-300">خارج الخدمة</h3>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-alert-circle h-5 w-5 text-red-600 dark:text-red-400">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" x2="12" y1="8" y2="12"></line>
                    <line x1="12" x2="12.01" y1="16" y2="16"></line>
                </svg>
            </div>
            <div class="p-6">
                <div class="text-2xl font-bold text-red-900 dark:text-red-100">15</div>
                <p class="text-xs text-red-600 dark:text-red-400 mt-1">أصول معطلة</p>
            </div>
        </div>
    </div>

    <div class="bg-white dark:bg-slate-800 rounded-lg shadow-sm border border-slate-200 dark:border-slate-700 mt-4">
        <div class="p-6 border-b border-slate-200 dark:border-slate-700">
            <h3 class="text-lg font-semibold text-slate-900 dark:text-white leading-none tracking-tight flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-filter w-5 h-5">
                    <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon>
                </svg>
                الفلاتر والبحث
            </h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-package w-4 h-4 inline ltr:mr-1 rtl:ml-1">
                            <path d="m7.5 4.27 9 5.15"></path>
                            <path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"></path>
                            <path d="m3.3 7 8.7 5 8.7-5"></path>
                            <path d="M12 22V12"></path>
                        </svg>
                        نوع الأصل
                    </label>
                    <div class="w-full">
                        <select class="flex h-10 rounded-md border border-slate-300 bg-white px-3 py-2 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-transparent disabled:cursor-not-allowed disabled:opacity-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50 w-full" name="assetType">
                            <option value="">جميع الأنواع</option>
                            <option value="laptop">أجهزة لابتوب</option>
                            <option value="desktop">أجهزة مكتبية</option>
                            <option value="furniture">أثاث مكتبي</option>
                            <option value="vehicle">مركبات</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-activity w-4 h-4 inline ltr:mr-1 rtl:ml-1">
                            <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                        </svg>
                        الحالة
                    </label>
                    <div class="w-full">
                        <select class="flex h-10 rounded-md border border-slate-300 bg-white px-3 py-2 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-transparent disabled:cursor-not-allowed disabled:opacity-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50 w-full" name="status">
                            <option value="">جميع الحالات</option>
                            <option value="active">قيد الاستخدام</option>
                            <option value="maintenance">في الصيانة</option>
                            <option value="storage">في المستودع</option>
                            <option value="damaged">تالف</option>
                        </select>
                    </div>
                </div>
                <div class="lg:col-span-1">
                    <label class="block text-sm font-medium mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search w-4 h-4 inline ltr:mr-1 rtl:ml-1">
                            <circle cx="11" cy="11" r="8"></circle>
                            <path d="m21 21-4.3-4.3"></path>
                        </svg>
                        بحث
                    </label>
                    <div class="w-full">
                        <input type="text" class="flex h-10 rounded-md border border-slate-300 bg-white px-3 py-2 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-transparent disabled:cursor-not-allowed disabled:opacity-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50 w-full" placeholder="ابحث بالرقم، الاسم، أو المستخدم...">
                    </div>
                </div>
                <div class="flex items-end">
                    <button class="inline-flex items-center justify-center rounded-md font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none bg-primary-600 text-white hover:bg-primary-700 h-10 px-4 text-sm w-full">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-filter w-4 h-4 ltr:mr-2 rtl:ml-2">
                            <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon>
                        </svg>
                        تطبيق الفلتر
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white dark:bg-slate-800 rounded-lg shadow-sm border border-slate-200 dark:border-slate-700 mt-4">
        <div class="p-0 m-0">
            <div class="space-y-4">
                <div class="w-full overflow-auto rounded-lg">
                    <table class="w-full caption-bottom text-sm">
                        <thead class="bg-slate-50 dark:bg-slate-800">
                            <tr class="border-b border-slate-200 dark:border-slate-700 transition-colors hover:bg-slate-50 dark:hover:bg-slate-800/50">
                                <th class="h-12 px-4 ltr:text-left rtl:text-right align-middle font-medium text-slate-500 dark:text-slate-400">رقم الأصل</th>
                                <th class="h-12 px-4 ltr:text-left rtl:text-right align-middle font-medium text-slate-500 dark:text-slate-400">اسم الأصل</th>
                                <th class="h-12 px-4 ltr:text-left rtl:text-right align-middle font-medium text-slate-500 dark:text-slate-400">نوع الأصل</th>
                                <th class="h-12 px-4 ltr:text-left rtl:text-right align-middle font-medium text-slate-500 dark:text-slate-400">المستخدم الحالي</th>
                                <th class="h-12 px-4 ltr:text-left rtl:text-right align-middle font-medium text-slate-500 dark:text-slate-400">الحالة</th>
                                <th class="h-12 px-4 ltr:text-left rtl:text-right align-middle font-medium text-slate-500 dark:text-slate-400">تاريخ الشراء</th>
                                <th class="h-12 px-4 ltr:text-left rtl:text-right align-middle font-medium text-slate-500 dark:text-slate-400 text-center">الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody class="">
                            <tr class="border-b border-slate-200 dark:border-slate-700 transition-colors hover:bg-slate-50 dark:hover:bg-slate-800/50">
                                <td class="p-4 align-middle text-slate-900 dark:text-slate-300">AS-001</td>
                                <td class="p-4 align-middle text-slate-900 dark:text-slate-300">لابتوب Dell Latitude 5420</td>
                                <td class="p-4 align-middle text-slate-900 dark:text-slate-300">أجهزة لابتوب</td>
                                <td class="p-4 align-middle text-slate-900 dark:text-slate-300">أحمد محمد علي</td>
                                <td class="p-4 align-middle text-slate-900 dark:text-slate-300">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-400">
                                        قيد الاستخدام
                                    </span>
                                </td>
                                <td class="p-4 align-middle text-slate-900 dark:text-slate-300">15 يناير 2024</td>
                                <td class="p-4 align-middle text-slate-900 dark:text-slate-300 text-center">
                                    <div class="flex ltr:justify-end rtl:justify-start gap-1">
                                        <div class="relative group inline-block">
                                            <a href="{{ route('assets.show', 1) }}" class="inline-flex items-center justify-center rounded-md font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none bg-transparent h-8 px-3 text-sm text-blue-600 hover:text-blue-700 hover:bg-blue-50 dark:text-blue-400 dark:hover:bg-blue-900/20">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye w-4 h-4">
                                                    <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                                                    <circle cx="12" cy="12" r="3"></circle>
                                                </svg>
                                            </a>
                                            <div class="absolute z-10 whitespace-nowrap px-2 py-1 text-xs text-white bg-black rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none bottom-full mb-1 left-1/2 transform -translate-x-1/2">عرض</div>
                                        </div>
                                        <div class="relative group inline-block">
                                            <a href="{{ route('assets.edit', 1) }}" class="inline-flex items-center justify-center rounded-md font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none bg-transparent h-8 px-3 text-sm text-orange-600 hover:text-orange-700 hover:bg-orange-50 dark:text-orange-400 dark:hover:bg-orange-900/20">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-edit w-4 h-4">
                                                    <path d="M7 7H6a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2-2v-1"></path>
                                                    <path d="M20.385 6.585a2.1 2.1 0 0 0-2.97-2.97L9 12v3h3l8.385-8.415Z"></path>
                                                    <path d="m16 5 3 3"></path>
                                                </svg>
                                            </a>
                                            <div class="absolute z-10 whitespace-nowrap px-2 py-1 text-xs text-white bg-black rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none bottom-full mb-1 left-1/2 transform -translate-x-1/2">تعديل</div>
                                        </div>
                                        <div class="relative group inline-block">
                                            <button class="inline-flex items-center justify-center rounded-md font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none bg-transparent h-8 px-3 text-sm text-purple-600 hover:text-purple-700 hover:bg-purple-50 dark:text-purple-400 dark:hover:bg-purple-900/20">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-qr-code w-4 h-4">
                                                    <rect width="5" height="5" x="3" y="3" rx="1"></rect>
                                                    <rect width="5" height="5" x="16" y="3" rx="1"></rect>
                                                    <rect width="5" height="5" x="3" y="16" rx="1"></rect>
                                                    <path d="M21 16h-3a2 2 0 0 0-2 2v3"></path>
                                                    <path d="M21 21v.01"></path>
                                                    <path d="M12 7v3a2 2 0 0 1-2 2H7"></path>
                                                    <path d="M3 12h.01"></path>
                                                    <path d="M12 3h.01"></path>
                                                    <path d="M12 16v.01"></path>
                                                    <path d="M16 12h1"></path>
                                                    <path d="M21 12v.01"></path>
                                                    <path d="M12 21v-1"></path>
                                                </svg>
                                            </button>
                                            <div class="absolute z-10 whitespace-nowrap px-2 py-1 text-xs text-white bg-black rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none bottom-full mb-1 left-1/2 transform -translate-x-1/2">باركود</div>
                                        </div>
                                        <div class="relative group inline-block">
                                            <button class="inline-flex items-center justify-center rounded-md font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none bg-transparent h-8 px-3 text-sm text-red-600 hover:text-red-700 hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-900/20">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash2 w-4 h-4">
                                                    <path d="M3 6h18"></path>
                                                    <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                                                    <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                                                    <line x1="10" x2="10" y1="11" y2="17"></line>
                                                    <line x1="14" x2="14" y1="11" y2="17"></line>
                                                </svg>
                                            </button>
                                            <div class="absolute z-10 whitespace-nowrap px-2 py-1 text-xs text-white bg-black rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none bottom-full mb-1 left-1/2 transform -translate-x-1/2">حذف</div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="border-b border-slate-200 dark:border-slate-700 transition-colors hover:bg-slate-50 dark:hover:bg-slate-800/50">
                                <td class="p-4 align-middle text-slate-900 dark:text-slate-300">AS-002</td>
                                <td class="p-4 align-middle text-slate-900 dark:text-slate-300">طاولة مكتب خشبية</td>
                                <td class="p-4 align-middle text-slate-900 dark:text-slate-300">أثاث مكتبي</td>
                                <td class="p-4 align-middle text-slate-900 dark:text-slate-300">فاطمة سعد أحمد</td>
                                <td class="p-4 align-middle text-slate-900 dark:text-slate-300">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-400">
                                        قيد الاستخدام
                                    </span>
                                </td>
                                <td class="p-4 align-middle text-slate-900 dark:text-slate-300">22 مارس 2024</td>
                                <td class="p-4 align-middle text-slate-900 dark:text-slate-300 text-center">
                                    <div class="flex ltr:justify-end rtl:justify-start gap-1">
                                        <div class="relative group inline-block">
                                            <a href="{{ route('assets.show', 2) }}" class="inline-flex items-center justify-center rounded-md font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none bg-transparent h-8 px-3 text-sm text-blue-600 hover:text-blue-700 hover:bg-blue-50 dark:text-blue-400 dark:hover:bg-blue-900/20">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye w-4 h-4">
                                                    <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                                                    <circle cx="12" cy="12" r="3"></circle>
                                                </svg>
                                            </a>
                                            <div class="absolute z-10 whitespace-nowrap px-2 py-1 text-xs text-white bg-black rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none bottom-full mb-1 left-1/2 transform -translate-x-1/2">عرض</div>
                                        </div>
                                        <div class="relative group inline-block">
                                            <a href="{{ route('assets.edit', 2) }}" class="inline-flex items-center justify-center rounded-md font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none bg-transparent h-8 px-3 text-sm text-orange-600 hover:text-orange-700 hover:bg-orange-50 dark:text-orange-400 dark:hover:bg-orange-900/20">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-edit w-4 h-4">
                                                    <path d="M7 7H6a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2-2v-1"></path>
                                                    <path d="M20.385 6.585a2.1 2.1 0 0 0-2.97-2.97L9 12v3h3l8.385-8.415Z"></path>
                                                    <path d="m16 5 3 3"></path>
                                                </svg>
                                            </a>
                                            <div class="absolute z-10 whitespace-nowrap px-2 py-1 text-xs text-white bg-black rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none bottom-full mb-1 left-1/2 transform -translate-x-1/2">تعديل</div>
                                        </div>
                                        <div class="relative group inline-block">
                                            <button class="inline-flex items-center justify-center rounded-md font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none bg-transparent h-8 px-3 text-sm text-purple-600 hover:text-purple-700 hover:bg-purple-50 dark:text-purple-400 dark:hover:bg-purple-900/20">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-qr-code w-4 h-4">
                                                    <rect width="5" height="5" x="3" y="3" rx="1"></rect>
                                                    <rect width="5" height="5" x="16" y="3" rx="1"></rect>
                                                    <rect width="5" height="5" x="3" y="16" rx="1"></rect>
                                                    <path d="M21 16h-3a2 2 0 0 0-2 2v3"></path>
                                                    <path d="M21 21v.01"></path>
                                                    <path d="M12 7v3a2 2 0 0 1-2 2H7"></path>
                                                    <path d="M3 12h.01"></path>
                                                    <path d="M12 3h.01"></path>
                                                    <path d="M12 16v.01"></path>
                                                    <path d="M16 12h1"></path>
                                                    <path d="M21 12v.01"></path>
                                                    <path d="M12 21v-1"></path>
                                                </svg>
                                            </button>
                                            <div class="absolute z-10 whitespace-nowrap px-2 py-1 text-xs text-white bg-black rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none bottom-full mb-1 left-1/2 transform -translate-x-1/2">باركود</div>
                                        </div>
                                        <div class="relative group inline-block">
                                            <button class="inline-flex items-center justify-center rounded-md font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none bg-transparent h-8 px-3 text-sm text-red-600 hover:text-red-700 hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-900/20">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash2 w-4 h-4">
                                                    <path d="M3 6h18"></path>
                                                    <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                                                    <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                                                    <line x1="10" x2="10" y1="11" y2="17"></line>
                                                    <line x1="14" x2="14" y1="11" y2="17"></line>
                                                </svg>
                                            </button>
                                            <div class="absolute z-10 whitespace-nowrap px-2 py-1 text-xs text-white bg-black rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none bottom-full mb-1 left-1/2 transform -translate-x-1/2">حذف</div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="border-b border-slate-200 dark:border-slate-700 transition-colors hover:bg-slate-50 dark:hover:bg-slate-800/50">
                                <td class="p-4 align-middle text-slate-900 dark:text-slate-300">AS-003</td>
                                <td class="p-4 align-middle text-slate-900 dark:text-slate-300">طابعة HP LaserJet</td>
                                <td class="p-4 align-middle text-slate-900 dark:text-slate-300">معدات مكتبية</td>
                                <td class="p-4 align-middle text-slate-900 dark:text-slate-300">
                                    <span class="text-slate-500 italic">غير مخصص</span>
                                </td>
                                <td class="p-4 align-middle text-slate-900 dark:text-slate-300">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900/20 dark:text-yellow-400">
                                        في الصيانة
                                    </span>
                                </td>
                                <td class="p-4 align-middle text-slate-900 dark:text-slate-300">10 فبراير 2024</td>
                                <td class="p-4 align-middle text-slate-900 dark:text-slate-300 text-center">
                                    <div class="flex ltr:justify-end rtl:justify-start gap-1">
                                        <div class="relative group inline-block">
                                            <a href="{{ route('assets.show', 3) }}" class="inline-flex items-center justify-center rounded-md font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none bg-transparent h-8 px-3 text-sm text-blue-600 hover:text-blue-700 hover:bg-blue-50 dark:text-blue-400 dark:hover:bg-blue-900/20">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye w-4 h-4">
                                                    <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                                                    <circle cx="12" cy="12" r="3"></circle>
                                                </svg>
                                            </a>
                                            <div class="absolute z-10 whitespace-nowrap px-2 py-1 text-xs text-white bg-black rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none bottom-full mb-1 left-1/2 transform -translate-x-1/2">عرض</div>
                                        </div>
                                        <div class="relative group inline-block">
                                            <button class="inline-flex items-center justify-center rounded-md font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none bg-transparent h-8 px-3 text-sm text-red-600 hover:text-red-700 hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-900/20">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash2 w-4 h-4">
                                                    <path d="M3 6h18"></path>
                                                    <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                                                    <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                                                    <line x1="10" x2="10" y1="11" y2="17"></line>
                                                    <line x1="14" x2="14" y1="11" y2="17"></line>
                                                </svg>
                                            </button>
                                            <div class="absolute z-10 whitespace-nowrap px-2 py-1 text-xs text-white bg-black rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none bottom-full mb-1 left-1/2 transform -translate-x-1/2">حذف</div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </dev>
            </dev>
        </dev>
    </dev>
</dev>
@endsection
