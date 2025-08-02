

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
                            {{-- <tr class="border-b border-slate-200 dark:border-slate-700 transition-colors hover:bg-slate-50 dark:hover:bg-slate-800/50">
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
                                            <a href="{{ route('assets.show', 3) }}" class="inline-flex items-center justify-center rounded-md font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events  --}}


{{-- @extends('layouts.app')

@php
    $isNavbar = false;
    $isSidebar = false;
    $isFooter = false;
    $isContainer = false;
@endphp

@section('title', __('App Landing Page'))

@section('content')

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Arial, sans-serif;
    }

    /* Navigation */
    nav {
        background: rgba(255, 255, 255, 0.95);
        padding: 20px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        position: fixed;
        width: 100%;
        top: 0;
        z-index: 1000;
        backdrop-filter: blur(10px);
        transition: background-color 0.3s;
    }

    nav:hover {
        background: rgba(255, 255, 255, 1);
    }


    .nav-container {
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .logo {
        font-size: 24px;
        font-weight: bold;
        color: #333;
        text-decoration: none;
    }

    .nav-links {
        display: flex;
        gap: 30px;
    }

    .nav-links a {
        text-decoration: none;
        color: #333;
        transition: color 0.3s;
    }

    .nav-links a:hover {
        color: #007bff;
    }

            /* Hamburger Menu Button */
            .menu-btn {
        display: none;
        background: none;
        border: none;
        cursor: pointer;
        padding: 5px;
        z-index: 1001;
    }

    .menu-btn span {
        display: block;
        width: 25px;
        height: 3px;
        background-color: #333;
        margin: 5px 0;
        transition: all 0.3s;
    }

    /* Hero Section */
    .hero {
        padding: 120px 20px 60px;
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        color: white;
        text-align: center;
    }

    .hero h1 {
        font-size: 48px;
        margin-bottom: 20px;
    }

    .hero p {
        font-size: 20px;
        margin-bottom: 30px;
    }

    .app-store-buttons {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-top: 30px;
    }

    .app-store-buttons img {
        height: 50px;
        cursor: pointer;
        transition: transform 0.3s;
    }

    .app-store-buttons img:hover {
        transform: scale(1.05);
    }

    /* Projects Section */
    .projects {
        padding: 80px 20px;
        background: #f8f9fa;
    }

    .section-title {
        text-align: center;
        font-size: 36px;
        margin-bottom: 40px;
        color: #333;
    }

    .projects-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
        max-width: 1200px;
        margin: 0 auto;
    }

    .project-card {
        background: white;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        opacity: 0;
        transform: translateY(20px);
        animation: fadeInUp 0.6s forwards;
    }

    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .project-card:nth-child(1) { animation-delay: 0.2s; }
    .project-card:nth-child(2) { animation-delay: 0.4s; }
    .project-card:nth-child(3) { animation-delay: 0.6s; }



    /* Footer */
    footer {
        background: #333;
        color: white;
        padding: 60px 20px 20px;
    }

    .footer-content {
        max-width: 1200px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 40px;
        margin-bottom: 40px;
    }

    .footer-section h3 {
        margin-bottom: 20px;
    }

    .footer-links {
        list-style: none;
        padding: 0;
    }

    .footer-links li {
        margin-bottom: 10px;
    }

    .footer-links a {
        color: #fff;
        text-decoration: none;
        transition: color 0.3s;
    }

    .footer-links a:hover {
        color: #007bff;
    }

    .copyright {
        text-align: center;
        padding-top: 20px;
        border-top: 1px solid #555;
    }


    /* Responsive Design */
    @media (max-width: 768px) {
        /* .nav-links {
            display: none;
        } */

        .hero h1 {
            font-size: 36px;
        }

        .app-store-buttons {
            flex-direction: column;
            align-items: center;
        }

        .menu-btn {
            display: block;
        }

        .nav-links {
            position: fixed;
            top: 0;
            right: -100%;
            width: 70%;
            height: 100vh;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            transition: right 0.3s ease;
            gap: 40px;
            box-shadow: -2px 0 10px rgba(0,0,0,0.1);
        }

        .nav-links.active {
            right: 0;
        }

        /* Hamburger Animation */
        .menu-btn.active span:nth-child(1) {
            transform: rotate(45deg) translate(5px, 5px);
        }

        .menu-btn.active span:nth-child(2) {
            opacity: 0;
        }

        .menu-btn.active span:nth-child(3) {
            transform: rotate(-45deg) translate(7px, -6px);
        }

    }
</style>

<!-- Navigation -->
<nav>
    <div class="nav-container">
        <a href="#" class="logo">AppName</a>
        <button class="menu-btn" onclick="toggleMenu()">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <div class="nav-links">
            <a href="#home">Home</a>
            <a href="#projects">Projects</a>
            <a href="#sponsors">Sponsors</a>
            <a href="#contact">Contact</a>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section class="hero" id="home">
    <h1>Welcome to AppName</h1>
    <p>Your ultimate solution for everything you need</p>
    <div class="app-store-buttons">
        <a href="#" target="_blank"><img src="{{ asset('assets/img/my/defaults/app.png') }}" alt="Download on App Store"></a>
        <a href="#" target="_blank"><img src="{{ asset('assets/img/my/defaults/google.png') }}" alt="Get it on Google Play"></a>
    </div>
</section>

<!-- Projects Section -->
<section class="projects" id="projects">
    <h2 class="section-title">Our Projects</h2>
    <div class="projects-grid">
        <div class="project-card">
            <img src="/api/placeholder/280/160" alt="Project 1">
            <h3>Project 1</h3>
            <p>Description of project 1 goes here.</p>
        </div>
        <div class="project-card">
            <img src="/api/placeholder/280/160" alt="Project 2">
            <h3>Project 2</h3>
            <p>Description of project 2 goes here.</p>
        </div>
        <div class="project-card">
            <img src="/api/placeholder/280/160" alt="Project 3">
            <h3>Project 3</h3>
            <p>Description of project 3 goes here.</p>
        </div>
    </div>
</section>

<style>
    .sponsor-logo {
        margin: 0 40px;
        flex-shrink: 0;
        height: 50px;
        transition: transform 0.3s ease;
    }

    .sponsor-logo:hover {
        transform: scale(1.05);
    }
</style>

<section class="bg-white px-3 py-5 overflow-hidden position-relative" id="sponsors">
    <h2 class="section-title">{{ __('Our Sponsors') }}</h2>
    <div class="position-relative w-100 overflow-hidden">
        <div class="sponsors-grid d-flex position-relative my-2">
            <img src="{{ asset('assets/my/marks/1.png') }}" alt="Sponsor 1" class="sponsor-logo">
            <img src="{{ asset('assets/my/marks/2.png') }}" alt="Sponsor 2" class="sponsor-logo">
            <img src="{{ asset('assets/my/marks/3.png') }}" alt="Sponsor 3" class="sponsor-logo">
            <img src="{{ asset('assets/my/marks/4.png') }}" alt="Sponsor 4" class="sponsor-logo">
            <img src="{{ asset('assets/my/marks/5.png') }}" alt="Sponsor 5" class="sponsor-logo">
            <img src="{{ asset('assets/my/marks/6.png') }}" alt="Sponsor 6" class="sponsor-logo">
            <img src="{{ asset('assets/my/marks/7.png') }}" alt="Sponsor 7" class="sponsor-logo">
            <img src="{{ asset('assets/my/marks/8.png') }}" alt="Sponsor 8" class="sponsor-logo">
        </div>
    </div>
</section>

<script>
    $(document).ready(function() {
        // Clone the sponsors and append them to create the infinite effect
        const $sponsorsGrid = $('.sponsors-grid');
        const $sponsors = $sponsorsGrid.html();
        $sponsorsGrid.append($sponsors);

        // Calculate the total width of one set of sponsors
        let totalWidth = 0;
        $('.sponsor-logo').each(function(index) {
            if (index < $('.sponsor-logo').length / 2) {
                totalWidth += $(this).outerWidth(true);
            }
        });

        // Variables for the animation
        let currentPosition = 0;
        const speed = 1; // Pixels per frame

        // Animation function
        function animate() {
            currentPosition -= speed;

            // Reset position when we've scrolled one complete set
            if (Math.abs(currentPosition) >= totalWidth) {
                currentPosition = 0;
            }

            $sponsorsGrid.css('transform', `translateX(${currentPosition}px)`);
            requestAnimationFrame(animate);
        }

        // Start the animation
        animate();
    });
</script>


<style>
    .app-showcase.app-showcase-v1 {
        background: #f8f9fa;
        overflow: hidden;
        padding: 60px 0;
    }

    .app-showcase.app-showcase-v1 .app-screens-container {
        position: relative;
        height: 600px;
    }

    .app-showcase.app-showcase-v1 .app-screens {
        position: relative;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        perspective: 1000px;
    }

    .app-showcase.app-showcase-v1 .screen {
        position: absolute;
        transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer; /* Add cursor pointer to indicate clickable */
    }

    .app-showcase.app-showcase-v1 .screen img {
        height: 500px;
        border-radius: 20px;
        box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .app-showcase.app-showcase-v1 .screen-prev {
        transform: translateX(-50%) scale(0.8) rotateY(10deg);
        opacity: 0.6;
        filter: blur(1px);
    }

    .app-showcase.app-showcase-v1 .screen-main {
        transform: translateX(0) scale(1) rotateY(0);
        opacity: 1;
        filter: blur(0);
        z-index: 1;
    }

    .app-showcase.app-showcase-v1 .screen-next {
        transform: translateX(50%) scale(0.8) rotateY(-10deg);
        opacity: 0.6;
        filter: blur(1px);
    }

    .app-showcase.app-showcase-v1 .nav-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(0,0,0,0.5);
        color: white;
        border: none;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        cursor: pointer;
        z-index: 2;
        transition: all 0.3s ease;
    }

    .app-showcase.app-showcase-v1 .nav-btn:hover {
        background: rgba(0,0,0,0.7);
        transform: translateY(-50%) scale(1.1);
    }

    .app-showcase.app-showcase-v1 .prev-btn { left: 20px; }
    .app-showcase.app-showcase-v1 .next-btn { right: 20px; }
</style>


<section class="app-showcase app-showcase-v1 py-5" id="features">
    <h2 class="section-title text-center mb-5">App Features V1</h2>
    <div class="container">
        <div id="appScreensSlider-v1" class="app-screens-container">
            <div class="app-screens">
                <div class="screen screen-prev">
                    <img src="{{ asset('assets/my/landing/1.jpg') }}" alt="App Screen 1">
                </div>
                <div class="screen screen-main">
                    <img src="{{ asset('assets/my/landing/2.jpg') }}" alt="App Screen 2">
                </div>
                <div class="screen screen-next">
                    <img src="{{ asset('assets/my/landing/3.jpg') }}" alt="App Screen 3">
                </div>
            </div>
            <button class="nav-btn prev-btn" onclick="moveSlider('prev')">
                <i class="mdi mdi-chevron-left"></i>
            </button>
            <button class="nav-btn next-btn" onclick="moveSlider('next')">
                <i class="mdi mdi-chevron-right"></i>
            </button>
        </div>
    </div>
</section>

<style>
    .app-showcase.app-showcase-v2 .app-screens-container {
        position: relative;
        overflow: hidden;
        padding: 20px 0;
    }

    .app-showcase.app-showcase-v2 .app-screens {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 20px;
    }

    .app-showcase.app-showcase-v2 .screen {
        position: relative;
        cursor: pointer;
    }

    .app-showcase.app-showcase-v2 .screen img {
        max-width: 300px;
        height: auto;
        border-radius: 10px;
        transition: all 0.8s ease-in-out;
    }

    .app-showcase.app-showcase-v2 .screen-prev img, .screen-next img {
        transform: scale(0.8);
        opacity: 0.7;
    }

    .app-showcase.app-showcase-v2 .screen-main img {
        transform: scale(1);
        opacity: 1;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }

    .app-showcase.app-showcase-v2 .nav-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(255,255,255,0.8);
        border: none;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        cursor: pointer;
        z-index: 10;
        transition: all 0.3s ease;
    }

    .app-showcase.app-showcase-v2 .nav-btn:hover {
        background: rgba(255,255,255,1);
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    .app-showcase.app-showcase-v2 .prev-btn { left: 20px; }
    .app-showcase.app-showcase-v2 .next-btn { right: 20px; }
</style>

<section class="app-showcase app-showcase-v2 py-5" id="features">
    <h2 class="section-title text-center mb-5">App Features V2</h2>
    <div class="container">
        <div id="appScreensSlider-v2" class="app-screens-container">
            <div class="app-screens">
                <div class="screen screen-prev">
                    <img src="{{ asset('assets/my/landing/1.jpg') }}" alt="App Screen 1">
                </div>
                <div class="screen screen-main">
                    <img src="{{ asset('assets/my/landing/2.jpg') }}" alt="App Screen 2">
                </div>
                <div class="screen screen-next">
                    <img src="{{ asset('assets/my/landing/3.jpg') }}" alt="App Screen 3">
                </div>
            </div>
            <button class="nav-btn prev-btn" onclick="moveSlider('prev')">
                <i class="mdi mdi-chevron-left"></i>
            </button>
            <button class="nav-btn next-btn" onclick="moveSlider('next')">
                <i class="mdi mdi-chevron-right"></i>
            </button>
        </div>
    </div>
</section>

<script>
    $(document).ready(function() {
        // Initialize version 1
        const sliderV1 = new AppShowcase('v1');

        // Initialize version 2
        const sliderV2 = new AppShowcase('v2');

    });
</script>



<!-- Testimonials Section -->
<section class="testimonials py-5 bg-light" id="testimonials">
    <div class="container">
        <h2 class="section-title text-center mb-5">What Our Users Say</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="testimonial-card p-4 bg-white rounded shadow">
                    <p class="testimonial-text">"This app has completely transformed the way I manage my tasks. Highly recommended!"</p>
                    <div class="testimonial-author d-flex align-items-center mt-3">
                        <img src="{{ asset('assets/my/testimonials/1.jpg') }}" alt="User 1" class="rounded-circle me-3" width="50">
                        <div>
                            <h5 class="mb-0">John Doe</h5>
                            <small>CEO, Company A</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="testimonial-card p-4 bg-white rounded shadow">
                    <p class="testimonial-text">"The features are amazing and the support team is very responsive. Great job!"</p>
                    <div class="testimonial-author d-flex align-items-center mt-3">
                        <img src="{{ asset('assets/my/testimonials/2.jpg') }}" alt="User 2" class="rounded-circle me-3" width="50">
                        <div>
                            <h5 class="mb-0">Jane Smith</h5>
                            <small>CTO, Company B</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="testimonial-card p-4 bg-white rounded shadow">
                    <p class="testimonial-text">"I love how intuitive and user-friendly the app is. It has made my life so much easier."</p>
                    <div class="testimonial-author d-flex align-items-center mt-3">
                        <img src="{{ asset('assets/my/testimonials/3.jpg') }}" alt="User 3" class="rounded-circle me-3" width="50">
                        <div>
                            <h5 class="mb-0">Alice Johnson</h5>
                            <small>Product Manager, Company C</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- Pricing Plans Section -->
<section class="pricing py-5 bg-white" id="pricing">
    <div class="container">
        <h2 class="section-title text-center mb-5">Pricing Plans</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="pricing-card p-4 bg-light rounded shadow text-center">
                    <h3 class="mb-3">Basic</h3>
                    <p class="price"><span class="currency">$</span>9<span class="period">/mo</span></p>
                    <ul class="list-unstyled mb-4">
                        <li>10 Projects</li>
                        <li>5 GB Storage</li>
                        <li>Basic Support</li>
                    </ul>
                    <button class="btn btn-outline-primary">Get Started</button>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="pricing-card p-4 bg-primary text-white rounded shadow text-center">
                    <h3 class="mb-3">Pro</h3>
                    <p class="price"><span class="currency">$</span>29<span class="period">/mo</span></p>
                    <ul class="list-unstyled mb-4">
                        <li>Unlimited Projects</li>
                        <li>50 GB Storage</li>
                        <li>Priority Support</li>
                    </ul>
                    <button class="btn btn-light">Get Started</button>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="pricing-card p-4 bg-light rounded shadow text-center">
                    <h3 class="mb-3">Enterprise</h3>
                    <p class="price"><span class="currency">$</span>99<span class="period">/mo</span></p>
                    <ul class="list-unstyled mb-4">
                        <li>Unlimited Projects</li>
                        <li>Unlimited Storage</li>
                        <li>24/7 Support</li>
                    </ul>
                    <button class="btn btn-outline-primary">Contact Us</button>
                </div>
            </div>
        </div>
    </div>
</section>





<!-- Team Section -->
<section class="team py-5 bg-light" id="team">
    <div class="container">
        <h2 class="section-title text-center mb-5">Meet Our Team</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="team-card p-4 bg-white rounded shadow text-center">
                    <img src="{{ asset('assets/my/team/1.jpg') }}" alt="Team Member 1" class="rounded-circle mb-3" width="100">
                    <h4 class="mb-2">John Doe</h4>
                    <p class="text-muted">CEO & Founder</p>
                    <div class="social-links">
                        <a href="#" class="text-primary me-2"><i class="mdi mdi-twitter"></i></a>
                        <a href="#" class="text-primary me-2"><i class="mdi mdi-linkedin"></i></a>
                        <a href="#" class="text-primary"><i class="mdi mdi-email"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="team-card p-4 bg-white rounded shadow text-center">
                    <img src="{{ asset('assets/my/team/2.jpg') }}" alt="Team Member 2" class="rounded-circle mb-3" width="100">
                    <h4 class="mb-2">Jane Smith</h4>
                    <p class="text-muted">CTO</p>
                    <div class="social-links">
                        <a href="#" class="text-primary me-2"><i class="mdi mdi-twitter"></i></a>
                        <a href="#" class="text-primary me-2"><i class="mdi mdi-linkedin"></i></a>
                        <a href="#" class="text-primary"><i class="mdi mdi-email"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="team-card p-4 bg-white rounded shadow text-center">
                    <img src="{{ asset('assets/my/team/3.jpg') }}" alt="Team Member 3" class="rounded-circle mb-3" width="100">
                    <h4 class="mb-2">Alice Johnson</h4>
                    <p class="text-muted">Product Manager</p>
                    <div class="social-links">
                        <a href="#" class="text-primary me-2"><i class="mdi mdi-twitter"></i></a>
                        <a href="#" class="text-primary me-2"><i class="mdi mdi-linkedin"></i></a>
                        <a href="#" class="text-primary"><i class="mdi mdi-email"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




<!-- Newsletter Section -->
<section class="newsletter py-5 bg-primary text-white" id="newsletter">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h2 class="mb-3">Subscribe to Our Newsletter</h2>
                <p class="mb-0">Get the latest updates and exclusive offers straight to your inbox.</p>
            </div>
            <div class="col-md-6">
                <form class="newsletter-form d-flex">
                    <input type="email" class="form-control me-2" placeholder="Enter your email" required>
                    <button type="submit" class="btn btn-light">Subscribe</button>
                </form>
            </div>
        </div>
    </div>
</section>







<!-- FAQ Section -->
<section class="faq py-5 bg-light" id="faq">
    <div class="container">
        <h2 class="section-title text-center mb-5">Frequently Asked Questions</h2>
        <div class="accordion" id="faqAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        How do I get started?
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Getting started is easy! Simply sign up for an account, choose a plan, and start using our app right away.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Can I upgrade my plan later?
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Yes, you can upgrade or downgrade your plan at any time from your account settings.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Is there a free trial?
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Yes, we offer a 14-day free trial for all new users. No credit card is required to start the trial.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- Call to Action Section -->
<section class="cta py-5 bg-dark text-white text-center" id="cta">
    <div class="container">
        <h2 class="mb-4">Ready to Get Started?</h2>
        <p class="mb-4">Join thousands of satisfied users and take control of your tasks today.</p>
        <a href="#pricing" class="btn btn-primary btn-lg">Choose a Plan</a>
    </div>
</section>







<!-- Blog Section -->
<section class="blog py-5 bg-white" id="blog">
    <div class="container">
        <h2 class="section-title text-center mb-5">Latest from Our Blog</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="blog-card p-4 bg-light rounded shadow">
                    <img src="{{ asset('assets/my/blog/1.jpg') }}" alt="Blog Post 1" class="img-fluid mb-3 rounded">
                    <h4 class="mb-2">10 Tips for Productivity</h4>
                    <p class="text-muted">Discover how to boost your productivity with these simple tips.</p>
                    <a href="#" class="btn btn-outline-primary">Read More</a>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="blog-card p-4 bg-light rounded shadow">
                    <img src="{{ asset('assets/my/blog/2.jpg') }}" alt="Blog Post 2" class="img-fluid mb-3 rounded">
                    <h4 class="mb-2">The Future of Task Management</h4>
                    <p class="text-muted">Explore the latest trends in task management and how they can benefit you.</p>
                    <a href="#" class="btn btn-outline-primary">Read More</a>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="blog-card p-4 bg-light rounded shadow">
                    <img src="{{ asset('assets/my/blog/3.jpg') }}" alt="Blog Post 3" class="img-fluid mb-3 rounded">
                    <h4 class="mb-2">How to Stay Organized</h4>
                    <p class="text-muted">Learn the best practices for staying organized in a busy world.</p>
                    <a href="#" class="btn btn-outline-primary">Read More</a>
                </div>
            </div>
        </div>
    </div>
</section>





<!-- Statistics Section -->
<section class="statistics py-5 bg-primary text-white" id="statistics">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-3 mb-4">
                <h2 class="mb-0">10,000+</h2>
                <p class="mb-0">Happy Users</p>
            </div>
            <div class="col-md-3 mb-4">
                <h2 class="mb-0">500+</h2>
                <p class="mb-0">Projects Completed</p>
            </div>
            <div class="col-md-3 mb-4">
                <h2 class="mb-0">99%</h2>
                <p class="mb-0">Customer Satisfaction</p>
            </div>
            <div class="col-md-3 mb-4">
                <h2 class="mb-0">24/7</h2>
                <p class="mb-0">Support Available</p>
            </div>
        </div>
    </div>
</section>





<!-- Partners Section -->
<section class="partners py-5 bg-light" id="partners">
    <div class="container">
        <h2 class="section-title text-center mb-5">Our Partners</h2>
        <div class="row align-items-center justify-content-center">
            <div class="col-md-2 col-4 mb-4">
                <img src="{{ asset('assets/my/partners/1.png') }}" alt="Partner 1" class="img-fluid">
            </div>
            <div class="col-md-2 col-4 mb-4">
                <img src="{{ asset('assets/my/partners/2.png') }}" alt="Partner 2" class="img-fluid">
            </div>
            <div class="col-md-2 col-4 mb-4">
                <img src="{{ asset('assets/my/partners/3.png') }}" alt="Partner 3" class="img-fluid">
            </div>
            <div class="col-md-2 col-4 mb-4">
                <img src="{{ asset('assets/my/partners/4.png') }}" alt="Partner 4" class="img-fluid">
            </div>
            <div class="col-md-2 col-4 mb-4">
                <img src="{{ asset('assets/my/partners/5.png') }}" alt="Partner 5" class="img-fluid">
            </div>
        </div>
    </div>
</section>






<!-- Timeline Section -->
<section class="timeline py-5 bg-white" id="timeline">
    <div class="container">
        <h2 class="section-title text-center mb-5">Our Journey</h2>
        <div class="timeline-container">
            <div class="timeline-item">
                <div class="timeline-content">
                    <h4>2018</h4>
                    <p>Founded the company with a vision to revolutionize task management.</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-content">
                    <h4>2019</h4>
                    <p>Launched our first product and gained 1,000 users within the first month.</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-content">
                    <h4>2020</h4>
                    <p>Expanded our team and introduced new features based on user feedback.</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-content">
                    <h4>2021</h4>
                    <p>Reached 10,000 users and received several industry awards.</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-content">
                    <h4>2022</h4>
                    <p>Launched our mobile app and expanded to international markets.</p>
                </div>
            </div>
        </div>
    </div>
</section>







<!-- Video Section -->
<section class="video py-5 bg-light" id="video">
    <div class="container">
        <h2 class="section-title text-center mb-5">Watch Our Story</h2>
        <div class="ratio ratio-16x9">
            <iframe src="https://www.youtube.com/embed/your-video-id" allowfullscreen></iframe>
        </div>
    </div>
</section>




<!-- Social Proof Section -->
<section class="social-proof py-5 bg-white" id="social-proof">
    <div class="container">
        <h2 class="section-title text-center mb-5">As Seen On</h2>
        <div class="row align-items-center justify-content-center">
            <div class="col-md-2 col-4 mb-4">
                <img src="{{ asset('assets/my/social-proof/1.png') }}" alt="Logo 1" class="img-fluid">
            </div>
            <div class="col-md-2 col-4 mb-4">
                <img src="{{ asset('assets/my/social-proof/2.png') }}" alt="Logo 2" class="img-fluid">
            </div>
            <div class="col-md-2 col-4 mb-4">
                <img src="{{ asset('assets/my/social-proof/3.png') }}" alt="Logo 3" class="img-fluid">
            </div>
            <div class="col-md-2 col-4 mb-4">
                <img src="{{ asset('assets/my/social-proof/4.png') }}" alt="Logo 4" class="img-fluid">
            </div>
            <div class="col-md-2 col-4 mb-4">
                <img src="{{ asset('assets/my/social-proof/5.png') }}" alt="Logo 5" class="img-fluid">
            </div>
        </div>
    </div>
</section>



<!-- Download Section -->
<section class="download py-5 bg-primary text-white text-center" id="download">
    <div class="container">
        <h2 class="mb-4">Download Our App Today</h2>
        <p class="mb-4">Join thousands of users who are already enjoying the benefits of our app.</p>
        <div class="app-store-buttons">
            <a href="#" target="_blank"><img src="{{ asset('assets/img/my/defaults/app.png') }}" alt="Download on App Store"></a>
            <a href="#" target="_blank"><img src="{{ asset('assets/img/my/defaults/google.png') }}" alt="Get it on Google Play"></a>
        </div>
    </div>
</section>




<!-- Awards Section -->
<section class="awards py-5 bg-light" id="awards">
    <div class="container">
        <h2 class="section-title text-center mb-5">Awards & Recognitions</h2>
        <div class="row align-items-center justify-content-center">
            <div class="col-md-2 col-4 mb-4">
                <img src="{{ asset('assets/my/awards/1.png') }}" alt="Award 1" class="img-fluid">
            </div>
            <div class="col-md-2 col-4 mb-4">
                <img src="{{ asset('assets/my/awards/2.png') }}" alt="Award 2" class="img-fluid">
            </div>
            <div class="col-md-2 col-4 mb-4">
                <img src="{{ asset('assets/my/awards/3.png') }}" alt="Award 3" class="img-fluid">
            </div>
            <div class="col-md-2 col-4 mb-4">
                <img src="{{ asset('assets/my/awards/4.png') }}" alt="Award 4" class="img-fluid">
            </div>
            <div class="col-md-2 col-4 mb-4">
                <img src="{{ asset('assets/my/awards/5.png') }}" alt="Award 5" class="img-fluid">
            </div>
        </div>
    </div>
</section>



<!-- Contact Form Section (Alternative) -->
<section class="contact-form-alt py-5 bg-white" id="contact-form-alt">
    <div class="container">
        <h2 class="section-title text-center mb-5">Get in Touch</h2>
        <form class="contact-form p-4 bg-light rounded shadow">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" required>
            </div>
            <div class="mb-3">
                <label for="subject" class="form-label">Subject</label>
                <input type="text" class="form-control" id="subject" required>
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea class="form-control" id="message" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Send Message</button>
        </form>
    </div>
</section>



<!-- Gallery Section -->
<section class="gallery py-5 bg-light" id="gallery">
    <div class="container">
        <h2 class="section-title text-center mb-5">Our Gallery</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <img src="{{ asset('assets/my/gallery/1.jpg') }}" alt="Gallery Image 1" class="img-fluid rounded shadow">
            </div>
            <div class="col-md-4 mb-4">
                <img src="{{ asset('assets/my/gallery/2.jpg') }}" alt="Gallery Image 2" class="img-fluid rounded shadow">
            </div>
            <div class="col-md-4 mb-4">
                <img src="{{ asset('assets/my/gallery/3.jpg') }}" alt="Gallery Image 3" class="img-fluid rounded shadow">
            </div>
            <div class="col-md-4 mb-4">
                <img src="{{ asset('assets/my/gallery/4.jpg') }}" alt="Gallery Image 4" class="img-fluid rounded shadow">
            </div>
            <div class="col-md-4 mb-4">
                <img src="{{ asset('assets/my/gallery/5.jpg') }}" alt="Gallery Image 5" class="img-fluid rounded shadow">
            </div>
            <div class="col-md-4 mb-4">
                <img src="{{ asset('assets/my/gallery/6.jpg') }}" alt="Gallery Image 6" class="img-fluid rounded shadow">
            </div>
        </div>
    </div>
</section>



<!-- Events Section -->
<section class="events py-5 bg-white" id="events">
    <div class="container">
        <h2 class="section-title text-center mb-5">Upcoming Events</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="event-card p-4 bg-light rounded shadow">
                    <h4 class="mb-2">Webinar: Productivity Tips</h4>
                    <p class="text-muted">Join us for a live webinar on how to boost your productivity.</p>
                    <p class="text-muted"><strong>Date:</strong> October 15, 2023</p>
                    <a href="#" class="btn btn-outline-primary">Register Now</a>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="event-card p-4 bg-light rounded shadow">
                    <h4 class="mb-2">Workshop: Task Management</h4>
                    <p class="text-muted">Learn the best practices for managing your tasks effectively.</p>
                    <p class="text-muted"><strong>Date:</strong> November 10, 2023</p>
                    <a href="#" class="btn btn-outline-primary">Register Now</a>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="event-card p-4 bg-light rounded shadow">
                    <h4 class="mb-2">Conference: Future of Work</h4>
                    <p class="text-muted">Explore the latest trends in the future of work and productivity.</p>
                    <p class="text-muted"><strong>Date:</strong> December 5, 2023</p>
                    <a href="#" class="btn btn-outline-primary">Register Now</a>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- Press Section -->
<section class="press py-5 bg-light" id="press">
    <div class="container">
        <h2 class="section-title text-center mb-5">Press & Media</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="press-card p-4 bg-white rounded shadow">
                    <h4 class="mb-2">Featured in TechCrunch</h4>
                    <p class="text-muted">Read about how we're revolutionizing task management.</p>
                    <a href="#" class="btn btn-outline-primary">Read Article</a>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="press-card p-4 bg-white rounded shadow">
                    <h4 class="mb-2">Interview with Forbes</h4>
                    <p class="text-muted">Our CEO discusses the future of productivity tools.</p>
                    <a href="#" class="btn btn-outline-primary">Read Article</a>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="press-card p-4 bg-white rounded shadow">
                    <h4 class="mb-2">Coverage in The Verge</h4>
                    <p class="text-muted">Learn how our app is changing the way people work.</p>
                    <a href="#" class="btn btn-outline-primary">Read Article</a>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- Case Studies Section -->
<section class="case-studies py-5 bg-white" id="case-studies">
    <div class="container">
        <h2 class="section-title text-center mb-5">Case Studies</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="case-study-card p-4 bg-light rounded shadow">
                    <h4 class="mb-2">Case Study: Company A</h4>
                    <p class="text-muted">How Company A increased productivity by 50% using our app.</p>
                    <a href="#" class="btn btn-outline-primary">Read More</a>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="case-study-card p-4 bg-light rounded shadow">
                    <h4 class="mb-2">Case Study: Company B</h4>
                    <p class="text-muted">Company B reduced task management time by 30% with our solution.</p>
                    <a href="#" class="btn btn-outline-primary">Read More</a>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="case-study-card p-4 bg-light rounded shadow">
                    <h4 class="mb-2">Case Study: Company C</h4>
                    <p class="text-muted">Company C achieved a 20% increase in team efficiency.</p>
                    <a href="#" class="btn btn-outline-primary">Read More</a>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- Integration Section -->
<section class="integrations py-5 bg-light" id="integrations">
    <div class="container">
        <h2 class="section-title text-center mb-5">Integrations</h2>
        <div class="row align-items-center justify-content-center">
            <div class="col-md-2 col-4 mb-4">
                <img src="{{ asset('assets/my/integrations/1.png') }}" alt="Integration 1" class="img-fluid">
            </div>
            <div class="col-md-2 col-4 mb-4">
                <img src="{{ asset('assets/my/integrations/2.png') }}" alt="Integration 2" class="img-fluid">
            </div>
            <div class="col-md-2 col-4 mb-4">
                <img src="{{ asset('assets/my/integrations/3.png') }}" alt="Integration 3" class="img-fluid">
            </div>
            <div class="col-md-2 col-4 mb-4">
                <img src="{{ asset('assets/my/integrations/4.png') }}" alt="Integration 4" class="img-fluid">
            </div>
            <div class="col-md-2 col-4 mb-4">
                <img src="{{ asset('assets/my/integrations/5.png') }}" alt="Integration 5" class="img-fluid">
            </div>
        </div>
    </div>
</section>




<!-- Roadmap Section -->
<section class="roadmap py-5 bg-white" id="roadmap">
    <div class="container">
        <h2 class="section-title text-center mb-5">Product Roadmap</h2>
        <div class="timeline-container">
            <div class="timeline-item">
                <div class="timeline-content">
                    <h4>Q1 2023</h4>
                    <p>Launch of new mobile app for iOS and Android.</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-content">
                    <h4>Q2 2023</h4>
                    <p>Introduction of advanced analytics and reporting features.</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-content">
                    <h4>Q3 2023</h4>
                    <p>Integration with popular third-party tools like Slack and Trello.</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-content">
                    <h4>Q4 2023</h4>
                    <p>Launch of AI-powered task prioritization and scheduling.</p>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- Security Section -->
<section class="security py-5 bg-light" id="security">
    <div class="container">
        <h2 class="section-title text-center mb-5">Security & Privacy</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="security-card p-4 bg-white rounded shadow text-center">
                    <i class="mdi mdi-shield-check-outline display-4 text-primary mb-3"></i>
                    <h4 class="mb-2">Data Encryption</h4>
                    <p class="text-muted">All your data is encrypted both in transit and at rest.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="security-card p-4 bg-white rounded shadow text-center">
                    <i class="mdi mdi-lock-outline display-4 text-primary mb-3"></i>
                    <h4 class="mb-2">Access Control</h4>
                    <p class="text-muted">Granular access controls to ensure only authorized users can access your data.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="security-card p-4 bg-white rounded shadow text-center">
                    <i class="mdi mdi-security display-4 text-primary mb-3"></i>
                    <h4 class="mb-2">Compliance</h4>
                    <p class="text-muted">We comply with GDPR, CCPA, and other global data protection regulations.</p>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- Support Section -->
<section class="support py-5 bg-white" id="support">
    <div class="container">
        <h2 class="section-title text-center mb-5">Support & Help Center</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="support-card p-4 bg-light rounded shadow text-center">
                    <i class="mdi mdi-help-circle-outline display-4 text-primary mb-3"></i>
                    <h4 class="mb-2">FAQs</h4>
                    <p class="text-muted">Find answers to common questions in our FAQ section.</p>
                    <a href="#" class="btn btn-outline-primary">Visit FAQs</a>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="support-card p-4 bg-light rounded shadow text-center">
                    <i class="mdi mdi-email-outline display-4 text-primary mb-3"></i>
                    <h4 class="mb-2">Contact Support</h4>
                    <p class="text-muted">Reach out to our support team for personalized assistance.</p>
                    <a href="#" class="btn btn-outline-primary">Contact Us</a>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="support-card p-4 bg-light rounded shadow text-center">
                    <i class="mdi mdi-book-open-outline display-4 text-primary mb-3"></i>
                    <h4 class="mb-2">Documentation</h4>
                    <p class="text-muted">Explore our comprehensive documentation for detailed guides.</p>
                    <a href="#" class="btn btn-outline-primary">Read</a>
                </div>
            </div>
        </div>
    </div>
</section>
































<!-- Contact Section -->
<section class="contact py-5" id="contact">
    <div class="container">
        <h2 class="text-center mb-5">Contact Us</h2>
        <div class="row">
            <!-- Form Column -->
            <div class="col-md-6 mb-4 mb-md-0">
                <form class="contact-form p-3 bg-white rounded" style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
            </div>

            <!-- Map Column -->
            <div class="col-md-6">
                <div class="map-container ratio ratio-16x9">
                    <iframe
                        class="rounded-2"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d387193.30591910525!2d-74.25986432970231!3d40.69714941680757!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2s!4v1672809207556!5m2!1sen!2s"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer>
    <div class="footer-content">
        <div class="footer-section">
            <h3>About Us</h3>
            <ul class="footer-links">
                <li><a href="#">Our Story</a></li>
                <li><a href="#">Team</a></li>
                <li><a href="#">Careers</a></li>
            </ul>
        </div>
        <div class="footer-section">
            <h3>Resources</h3>
            <ul class="footer-links">
                <li><a href="#">Documentation</a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="#">Support</a></li>
            </ul>
        </div>
        <div class="footer-section">
            <h3>Legal</h3>
            <ul class="footer-links">
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Terms of Service</a></li>
                <li><a href="#">Cookie Policy</a></li>
            </ul>
        </div>
        <div class="footer-section">
            <h3>Connect</h3>
            <ul class="footer-links">
                <li><a href="#">Twitter</a></li>
                <li><a href="#">LinkedIn</a></li>
                <li><a href="#">Facebook</a></li>
            </ul>
        </div>
    </div>
    <div class="copyright">
        <p>&copy; 2025 AppName. All rights reserved.</p>
    </div>
</footer>


<script>
    // Mobile Menu Toggle
    function toggleMenu() {
        const menuBtn = document.querySelector('.menu-btn');
        const navLinks = document.querySelector('.nav-links');

        menuBtn.classList.toggle('active');
        navLinks.classList.toggle('active');
    }

    // Close menu when clicking a link
    document.querySelectorAll('.nav-links a').forEach(link => {
        link.addEventListener('click', () => {
            const menuBtn = document.querySelector('.menu-btn');
            const navLinks = document.querySelector('.nav-links');

            menuBtn.classList.remove('active');
            navLinks.classList.remove('active');
        });
    });

    // Close menu when clicking outside
    document.addEventListener('click', (e) => {
        const navLinks = document.querySelector('.nav-links');
        const menuBtn = document.querySelector('.menu-btn');

        if (!navLinks.contains(e.target) && !menuBtn.contains(e.target) && navLinks.classList.contains('active')) {
            menuBtn.classList.remove('active');
            navLinks.classList.remove('active');
        }
    });
</script>
@endsection --}}
