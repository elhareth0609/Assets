@extends('layouts.app')

@section('title' , 'سجل الأصول')

@section('content')
<div class="mx-auto p-6 space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-display font-bold text-slate-900 dark:text-slate-100">سجل الأصول</h1>
            <p class="text-slate-600 dark:text-slate-400 mt-1">تتبع وإدارة أصول المؤسسة</p>
        </div>
        <div class="flex gap-2">
            <button id="export-excel-btn" class="inline-flex items-center justify-center rounded-md font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none bg-transparent border border-slate-300 dark:border-slate-700 hover:bg-slate-100 dark:text-slate-100 dark:hover:bg-slate-800 h-8 px-3 text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-download w-4 h-4 ltr:mr-2 rtl:ml-2">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                    <polyline points="7 10 12 15 17 10"></polyline>
                    <line x1="12" x2="12" y1="15" y2="3"></line>
                </svg>
                تصدير Excel
            </button>
            <button id="import-assets-btn" class="inline-flex items-center justify-center rounded-md font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none bg-transparent border border-slate-300 dark:border-slate-700 hover:bg-slate-100 dark:text-slate-100 dark:hover:bg-slate-800 h-8 px-3 text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-download w-4 h-4 ltr:mr-2 rtl:ml-2">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                    <polyline points="7 10 12 15 17 10"></polyline>
                    <line x1="12" x2="12" y1="15" y2="3"></line>
                </svg>
                استيراد Excel
            </button>
            <a href="{{ route('assets.import-template') }}" class="inline-flex items-center justify-center rounded-md font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none bg-transparent border border-slate-300 dark:border-slate-700 hover:bg-slate-100 dark:text-slate-100 dark:hover:bg-slate-800 h-8 px-3 text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-download w-4 h-4 ltr:mr-2 rtl:ml-2">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                    <polyline points="7 10 12 15 17 10"></polyline>
                    <line x1="12" x2="12" y1="15" y2="3"></line>
                </svg>
                قالب Excel
            </a>
            <a href="{{ route('assets.create') }}" class="inline-flex items-center justify-center rounded-md font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none bg-primary-600 text-white hover:bg-primary-700 h-8 px-3 text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus w-4 h-4 ltr:mr-2 rtl:ml-2">
                    <path d="M5 12h14"></path>
                    <path d="M12 5v14"></path>
                </svg>
                إضافة أصل جديد
            </a>
        </div>
    </div>

    <!-- Statistics Cards -->
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
                <div class="text-2xl font-bold text-blue-900 dark:text-blue-100">{{ $data->total }}</div>
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
                <div class="text-2xl font-bold text-green-900 dark:text-green-100">{{ $data->in_use }}</div>
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
                <div class="text-2xl font-bold text-yellow-900 dark:text-yellow-100">{{ $data->maintenance }}</div>
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
                <div class="text-2xl font-bold text-red-900 dark:text-red-100">{{ $data->damaged }}</div>
                <p class="text-xs text-red-600 dark:text-red-400 mt-1">أصول معطلة</p>
            </div>
        </div>
    </div>

    <!-- Custom Filters Section -->
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
            <form id="custom-filters-form">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-2 dark:text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-activity w-4 h-4 inline ltr:mr-1 rtl:ml-1">
                                <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                            </svg>
                            الحالة
                        </label>
                        <div class="w-full">
                            <select id="status" class="flex h-10 rounded-md border border-slate-300 bg-white px-3 py-2 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-transparent disabled:cursor-not-allowed disabled:opacity-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50 w-full" name="status">
                                <option value="">جميع الحالات</option>
                                <option value="in_use">قيد الاستخدام</option>
                                <option value="maintenance">في الصيانة</option>
                                <option value="in_storage">في المستودع</option>
                                <option value="damaged">تالف</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-2 dark:text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-tag w-4 h-4 inline ltr:mr-1 rtl:ml-1">
                                <path d="M12 2H2v10l9.29 9.29c.94.94 2.48.94 3.42 0l6.58-6.58c.94-.94.94-2.48 0-3.42L12 2Z"></path>
                                <path d="M7 7h.01"></path>
                            </svg>
                            نوع الأصل
                        </label>
                        <div class="w-full">
                            <select id="type_id" class="flex h-10 rounded-md border border-slate-300 bg-white px-3 py-2 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-transparent disabled:cursor-not-allowed disabled:opacity-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50 w-full" name="asset_type">
                                <option value="">جميع الأنواع</option>
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="lg:col-span-1">
                        <label class="block text-sm font-medium mb-2 dark:text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search w-4 h-4 inline ltr:mr-1 rtl:ml-1">
                                <circle cx="11" cy="11" r="8"></circle>
                                <path d="m21 21-4.3-4.3"></path>
                            </svg>
                            بحث
                        </label>
                        <div class="w-full">
                            <input id="dataTables_my_filter" type="text" class="flex h-10 rounded-md border border-slate-300 bg-white px-3 py-2 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-transparent disabled:cursor-not-allowed disabled:opacity-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50 w-full" placeholder="ابحث بالرقم، الاسم، أو المستخدم...">
                        </div>
                    </div>
                    <div class="flex items-end">
                        <button type="button" id="apply-filters-btn" class="inline-flex items-center justify-center rounded-md font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none bg-primary-600 text-white hover:bg-primary-700 h-10 px-4 text-sm w-full">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-filter w-4 h-4 ltr:mr-2 rtl:ml-2">
                                <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon>
                            </svg>
                            تطبيق الفلتر
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Table Section -->
    <div class="bg-white dark:bg-slate-800 rounded-lg shadow-sm border border-slate-200 dark:border-slate-700 mt-4">
        <div class="p-0 m-0">
            <div class="space-y-4">
                <div class="w-full overflow-auto md:overflow-visible rounded-lg">
                    <table id="assets-table" class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>رقم الأصل</th>
                                <th>اسم الأصل</th>
                                <th>الموظف</th>
                                <th>الحالة</th>
                                <th>تاريخ الشراء</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <div class="flex flex-col sm:flex-row items-center justify-between p-4">
                    <div class="text-sm text-slate-600 dark:text-slate-400" id="custom-pagination-info"></div>

                    <select id="dataTables_my_length" class="flex h-8 rounded-md border border-slate-300 bg-white px-2 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-transparent dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50">
                        <option value="1">1</option>
                        <option value="10">10</option>
                        <option value="25" selected>25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>

                    <div class="flex items-center gap-1 rtl:flex-row-reverse" id="custom-pagination"></div>
                </div>
            </div>
        </div>
    </div>
</div>





<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white dark:bg-slate-800 rounded-lg shadow-xl max-w-md w-full mx-4">
        <div class="p-6">
            <div class="flex items-center justify-center w-12 h-12 mx-auto bg-red-100 dark:bg-red-900/20 rounded-full mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-alert-triangle text-red-600 dark:text-red-400">
                    <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"></path>
                    <path d="M12 9v4"></path>
                    <path d="m12 17 .01 0"></path>
                </svg>
            </div>
            <h3 class="text-lg font-medium text-center text-slate-900 dark:text-white mb-2">تأكيد الحذف</h3>
            <p class="text-center text-slate-500 dark:text-slate-400 mb-6">هل أنت متأكد من حذف الأصل: <span id="deleteAssetName" class="font-semibold"></span>؟ لا يمكن التراجع عن هذا الإجراء.</p>
            <div class="flex justify-center flex-row-reverse space-x-4">
                <button id="cancelDeleteBtn" class="px-4 py-2 bg-slate-200 dark:bg-slate-700 text-slate-800 dark:text-slate-200 rounded-md hover:bg-slate-300 dark:hover:bg-slate-600 transition-colors">
                    إلغاء
                </button>
                <button id="confirmDeleteBtn" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors">
                    حذف
                </button>
            </div>
        </div>
    </div>
</div>

<!-- QR Code Modal -->
<div id="qrModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white dark:bg-slate-800 rounded-lg shadow-xl max-w-md w-full mx-4">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium text-slate-900 dark:text-white">رمز QR للأصل</h3>
                <button id="closeQrModalBtn" class="text-slate-400 hover:text-slate-500 dark:hover:text-slate-300">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x w-6 h-6">
                        <path d="M18 6 6 18"></path>
                        <path d="m6 6 12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="flex flex-col items-center">
                <div id="qrCodeContainer" class="bg-white p-4 rounded-lg border border-slate-200 dark:border-slate-700 mb-4">
                    <!-- QR code will be generated here -->
                </div>
                <p class="text-center text-slate-500 dark:text-slate-400 mb-4">
                    الأصل: <span id="qrAssetName" class="font-semibold"></span>
                </p>
                <p class="text-center text-slate-500 dark:text-slate-400 mb-6">
                    الرقم: <span id="qrAssetNumber" class="font-semibold"></span>
                </p>
                <button id="printQrBtn" class="inline-flex items-center justify-center rounded-md font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-offset-2 bg-primary-600 text-white hover:bg-primary-700 h-10 px-4 text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-download w-4 h-4 ltr:mr-2 rtl:ml-2">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="7 10 12 15 17 10"></polyline>
                        <line x1="12" x2="12" y1="15" y2="3"></line>
                    </svg>
                    طباعة الباركود
                </button>
            </div>
        </div>
    </div>
</div>



<!-- Import Employee Modal -->
<div id="importAssetsModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white dark:bg-slate-800 rounded-lg shadow-xl max-w-md w-full mx-4">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium text-slate-900 dark:text-white">استيراد موظفين من ملف Excel</h3>
                <button id="closeImportModalBtn" class="text-slate-400 hover:text-slate-500 dark:hover:text-slate-300">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x w-6 h-6">
                        <path d="M18 6 6 18"></path>
                        <path d="m6 6 12 12"></path>
                    </svg>
                </button>
            </div>
            <form id="importAssetsForm" action="{{ route('assets.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="excel_file" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">ملف Excel</label>
                    <div class="flex items-center justify-center w-full">
                        <label for="excel_file" class="flex flex-col items-center justify-center w-full h-32 border-2 border-slate-300 border-dashed rounded-lg cursor-pointer bg-slate-50 dark:hover:bg-bray-800 dark:bg-slate-700 hover:bg-slate-100 dark:border-slate-600 dark:hover:border-slate-500 dark:hover:bg-slate-600">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-spreadsheet w-8 h-8 mb-2 text-slate-500 dark:text-slate-400">
                                    <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"></path>
                                    <polyline points="14 2 14 8 20 8"></polyline>
                                    <path d="M8 13h2"></path>
                                    <path d="M8 17h2"></path>
                                    <path d="M14 13h2"></path>
                                    <path d="M14 17h2"></path>
                                </svg>
                                <p class="mb-1 text-sm text-slate-500 dark:text-slate-400">
                                    <span class="font-semibold">اضغط لرفع الملف</span>
                                </p>
                                <p class="text-xs text-slate-500 dark:text-slate-400">Excel فقط</p>
                            </div>
                            <input id="excel_file" name="excel_file" type="file" class="hidden" accept=".xlsx, .xls" required />
                        </label>
                    </div>
                    <p id="file-name" class="mt-2 text-sm text-slate-500 dark:text-slate-400"></p>
                </div>
                <div class="flex justify-center flex-row-reverse space-x-4">
                    <button type="button" id="cancelImportBtn" class="px-4 py-2 bg-slate-200 dark:bg-slate-700 text-slate-800 dark:text-slate-200 rounded-md hover:bg-slate-300 dark:hover:bg-slate-600 transition-colors">
                        إلغاء
                    </button>
                    <button type="submit" class="flex items-center px-4 py-2 border border-primary-600 text-primary-600 hover:border-primary-700 hover:text-primary-700 rounded-md transition-colors">
                        استيراد
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('styles')
<style>
    .dt-search,
    .dt-paging,
    .dt-length,
    .dt-info,
    .dt-buttons {
        display: none !important;
    }

    /* Hide default DataTables controls */
    .dataTables_wrapper .dataTables_filter,
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_info,
    .dataTables_wrapper .dataTables_paginate {
        display: none !important;
    }

    /* Ensure only one thead is visible */
    .dt-scroll-head {
        display: none !important;
    }
</style>


<style>
  #assets-table {
    width: 100%;
    caption-side: bottom;
    font-size: 0.875rem; /* text-sm */
    border-collapse: collapse;
  }

  #assets-table thead {
    background-color: rgb(248 250 252); /* bg-slate-50 */
  }
  html.dark #assets-table thead {
    background-color: rgb(30 41 59); /* dark:bg-slate-800 */
  }

  #assets-table thead tr {
    border-bottom: 1px solid rgb(226 232 240); /* border-slate-200 */
    transition: background-color 0.2s;
  }
  html.dark #assets-table thead tr {
    border-bottom: 1px solid rgb(51 65 85); /* dark:border-slate-700 */
  }
  #assets-table thead tr:hover {
    background-color: rgb(248 250 252); /* hover:bg-slate-50 */
  }
  html.dark #assets-table thead tr:hover {
    background-color: rgba(30, 41, 59, 0.5); /* dark:hover:bg-slate-800/50 */
  }

  #assets-table tbody tr {
    border-bottom: 1px solid rgb(226 232 240);
    transition: background-color 0.2s;
  }
  html.dark #assets-table tbody tr {
    border-bottom: 1px solid rgb(51 65 85);
  }
  #assets-table tbody tr:hover {
    background-color: rgb(248 250 252);
  }
  html.dark #assets-table tbody tr:hover {
    background-color: rgba(30, 41, 59, 0.5);
  }

  #assets-table tbody td {
    padding: 1rem;
    vertical-align: middle;
    color: rgb(15 23 42); /* text-slate-900 */
  }
  html.dark #assets-table tbody td {
    color: rgb(203 213 225); /* dark:text-slate-300 */
  }

  #assets-table thead th {
    height: 3rem;
    padding-left: 1rem;
    padding-right: 1rem;
    vertical-align: middle;
    font-weight: 500;
    color: rgb(100 116 139); /* text-slate-500 */
  }
  html.ltr #assets-table thead th {
    text-align: left;
  }
  html.rtl #assets-table thead th {
    text-align: right;
  }
  html.dark #assets-table thead th {
    color: rgb(148 163 184); /* dark:text-slate-400 */
  }



      /* Ensure table container doesn't clip dropdowns */
    .dataTables_wrapper {
        overflow: visible !important;
    }

    .dataTables_scrollBody {
        overflow: visible !important;
    }

    /* Ensure table cells don't clip content */
    #locations-table tbody td {
        overflow: visible !important;
    }

    /* Style for dropdown menus */
    .actions-dropdown {
        min-width: 160px;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }

    /* Ensure dropdown appears above other content */
    .actions-dropdown:not(.hidden) {
        z-index: 9999 !important;
    }

    /* Fix for RTL layout if needed */
    html[dir="rtl"] .actions-dropdown {
        right: auto;
        left: 0;
    }
</style>

@endsection



@section('scripts')

<script>
$(document).ready(function() {
    // Initialize DataTable
    var table = $('#assets-table').DataTable({
        language: {
            zeroRecords: `
                <div class="flex flex-col items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-slate-300 dark:text-slate-600">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.35-4.35"></path>
                        <line x1="8" x2="14" y1="11" y2="11"></line>
                    </svg>
                    <p class="text-slate-500 font-medium">لم يتم العثور على أصول للفترة المحددة.</p>
                </div>
            `,
            emptyTable: `
                <div class="flex flex-col items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-slate-300 dark:text-slate-600">
                        <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"></path>
                        <path d="M14 2v4a2 2 0 0 0 2 2h4"></path>
                        <path d="M10 9H8"></path>
                        <path d="M16 13H8"></path>
                        <path d="M16 17H8"></path>
                    </svg>
                    <p class="text-slate-500 font-medium">لا توجد أصول مسجلة في النظام.</p>
                </div>
            `,
        },
        ajax: {
            url: '/assets-list', // Your assets route
            data: function(d) {
                d.type_id = $('#type_id').val();
                d.status = $('#status').val();
            }
        },
        columns: [
            { data: 'number', name: 'number', title: 'رقم الأصل' },
            { data: 'name', name: 'name', title: 'اسم الأصل' },
            { data: 'employee_id', name: 'employee_id', title: 'الموظف' },
            { data: 'status', name: 'status', title: 'الحالة' },
            { data: 'purchase_date', name: 'purchase_date', title: 'تاريخ الشراء' },
            { data: 'action', name: 'action', title: 'الإجراءات', orderable: false,searchable: false }
        ],
        order: [[4, 'desc']],
        initComplete: function(settings, json) {
            applyTailwindStyles();
        },
        drawCallback: function(settings) {
            applyTailwindStyles();
            updateCustomInfo(settings);
        }
    });

    // Apply Tailwind styles function
    function applyTailwindStyles() {
        $(".dataTables_wrapper").addClass("space-y-4");
        $("#assets-table").addClass("w-full caption-bottom text-sm border-collapse");
        $("#assets-table thead").addClass("bg-slate-50 dark:bg-slate-800");
        $("#assets-table thead tr").addClass("border-b border-slate-200 dark:border-slate-700 transition-colors hover:bg-slate-50 dark:hover:bg-slate-800/50");
        $("#assets-table tbody tr").addClass("border-b border-slate-200 dark:border-slate-700 transition-colors hover:bg-slate-50 dark:hover:bg-slate-800/50");
        $("#assets-table tbody td").addClass("p-4 align-middle text-slate-900 dark:text-slate-300");
        $("#assets-table thead th").addClass("h-12 px-4 ltr:text-left rtl:text-right align-middle font-medium text-slate-500 dark:text-slate-400");
    }

    // Update custom info and pagination
    function updateCustomInfo(settings) {
        var api = new $.fn.dataTable.Api(settings);
        var info = api.page.info();

        // Update info text
        $('#custom-pagination-info').text(`عرض ${info.start + 1} إلى ${info.end} من إجمالي ${info.recordsTotal} مُدخلًا`);

        // Update pagination
        updateCustomPagination(info, api);
    }

    function updateCustomPagination(info, api) {
        var pagination = $('#custom-pagination');
        pagination.empty();

        if (info.pages <= 1) return;

        // Previous button
        var prevBtn = $(`
            <div class="relative group inline-block">
                <button class="inline-flex items-center justify-center rounded-md font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none bg-transparent border border-slate-300 dark:border-slate-700 hover:bg-slate-100 dark:hover:bg-slate-800 h-8 text-sm p-2 ${info.page === 0 ? 'opacity-50 cursor-not-allowed' : ''}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m15 18-6-6 6-6"></path>
                    </svg>
                </button>
                <div class="absolute z-10 whitespace-nowrap px-2 py-1 text-xs text-white bg-black rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none bottom-full mb-1 left-1/2 transform -translate-x-1/2">السابق</div>
            </div>
        `);
        if (info.page !== 0) {
            prevBtn.find('button').on('click', function() { api.page('previous').draw('page'); });
        }
        pagination.append(prevBtn);

        // Page numbers
        var startPage = Math.max(0, info.page - 2);
        var endPage = Math.min(info.pages - 1, info.page + 2);

        for (var i = startPage; i <= endPage; i++) {
            var pageBtn = $(`
                <button class="inline-flex items-center justify-center rounded-md font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-offset-2 h-8 px-3 text-sm ${i === info.page ? 'bg-primary-600 text-white border-primary-600' : 'bg-transparent border border-slate-300 dark:border-slate-700 hover:bg-slate-100 dark:hover:bg-slate-800 hidden'}">${i + 1}</button>
            `);

            if (i !== info.page) {
                (function(pageIndex) {
                    pageBtn.on('click', function() { api.page(pageIndex).draw('page'); });
                })(i);
            }
            pagination.append(pageBtn);
        }

        // Next button
        var nextBtn = $(`
            <div class="relative group inline-block">
                <button class="inline-flex items-center justify-center rounded-md font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none bg-transparent border border-slate-300 dark:border-slate-700 hover:bg-slate-100 dark:hover:bg-slate-800 h-8 text-sm p-2 ${info.page === info.pages - 1 ? 'opacity-50 cursor-not-allowed' : ''}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m9 18 6-6-6-6"></path>
                    </svg>
                </button>
                <div class="absolute z-10 whitespace-nowrap px-2 py-1 text-xs text-white bg-black rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none bottom-full mb-1 left-1/2 transform -translate-x-1/2">التالي</div>
            </div>
        `);
        if (info.page !== info.pages - 1) {
            nextBtn.find('button').on('click', function() { api.page('next').draw('page'); });
        }
        pagination.append(nextBtn);
    }

    // Event Handlers
    $('#apply-filters-btn').on('click', function() {
        table.ajax.reload();
    });

    $('#dataTables_my_filter').on('input', function () {
        var query = $(this).val();
        table.search(query).draw();
    });
    // Custom length change
    $('#dataTables_my_length').change(function () {
        var selectedValue = $(this).val();
        table.page.len(selectedValue).draw();
    });

    // Export CSV functionality
    $('#export-excel-btn').on('click', function() {
        window.location.href = '/assets-list/export';
    });

    // Delete button functionality
    $(document).on('click', '.delete-asset-btn', function() {
        $('.actions-dropdown').addClass('hidden');

        var assetId = $(this).data('id');
        var assetName = $(this).data('name');
        var deleteUrl = $(this).data('url');

        // Set asset name in the modal
        $('#deleteAssetName').text(assetName);

        // Show the modal by removing the hidden class
        $('#deleteModal').removeClass('hidden').addClass('flex');

        // Handle confirm delete
        $('#confirmDeleteBtn').off('click').on('click', function() {
            $.ajax({
                url: deleteUrl,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // Hide the modal
                    $('#deleteModal').addClass('hidden').removeClass('flex');

                    // Show success message
                    showNotification('تم حذف الأصل بنجاح', 'success');

                    // Reload the table
                    table.ajax.reload();
                },
                error: function(xhr) {
                    // Hide the modal
                    $('#deleteModal').addClass('hidden').removeClass('flex');

                    // Show error message
                    showNotification('حدث خطأ أثناء حذف الأصل', 'error');
                }
            });
        });
    });

    // Cancel delete button
    $('#cancelDeleteBtn').on('click', function() {
        $('#deleteModal').addClass('hidden').removeClass('flex');
    });

    // QR Code button functionality
    $(document).on('click', '.qr-btn', function() {
        $('.actions-dropdown').addClass('hidden');

        var assetId = $(this).data('id');
        var assetName = $(this).data('name');
        var assetNumber = $(this).data('number');

        // Set asset info in the modal
        $('#qrAssetName').text(assetName);
        $('#qrAssetNumber').text(assetNumber);

        // Generate QR code
        $('#qrCodeContainer').html(`
            <div class="flex items-center justify-center w-40 h-40">
                <svg class="animate-spin h-8 w-8 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                </svg>
            </div>
        `);

        var qrCodeUrl = "{{ route('assets.qr', ['id' => ':id']) }}".replace(':id', assetId) + `?_t=${Date.now()}`;

        let img = new Image();
        img.src = qrCodeUrl;
        img.className = "w-40 h-40";
        img.alt = "QR Code";

        img.onload = function () {
            $('#qrCodeContainer').html(img);
        };

        img.onerror = function () {
            $('#qrCodeContainer').html('<p class="text-red-500 text-sm">⚠️ Failed to load QR Code</p>');
        };

        // } else {
        //     // Fallback to an online QR code generator
        //     var qrImageUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=' + encodeURIComponent(qrCodeUrl);
        //     $('#qrCodeContainer').html(
        //         '<img src="' + qrImageUrl + '" alt="QR Code" class="w-48 h-48">'
        //     );
        // }

        // Show the modal by removing the hidden class
        $('#qrModal').removeClass('hidden').addClass('flex');

        // Handle download QR code
        $('#printQrBtn').on('click', function() {
            var qrImage = $('#qrCodeContainer img')[0];
            if (!qrImage) {
                alert('QR Code not loaded yet.');
                return;
            }

            // Open new window
            var printWindow = window.open('', '_blank');

            // Build minimal HTML
            var doc = printWindow.document;
            doc.open();
            doc.write('<!doctype html><html><head><meta charset="utf-8"><title>Print QR Code</title>');
            doc.write('<style>body{display:flex;align-items:center;justify-content:center;height:100vh;margin:0}img{width:160px;height:160px}</style>');
            doc.write('</head><body>');
            doc.write('<img id="qrToPrint" alt="QR Code" src="' + qrImage.src + '">');
            doc.write('</body></html>');
            doc.close();

            // Wait for the image inside the new window to load, then print and close
            var imgInNewWin = printWindow.document.getElementById('qrToPrint');
            if (imgInNewWin.complete) {
                // already loaded
                printWindow.focus();
                printWindow.print();
                // printWindow.close();
            } else {
                imgInNewWin.onload = function () {
                printWindow.focus();
                printWindow.print();
                //   printWindow.close();
                };
                imgInNewWin.onerror = function () {
                // fallback if can't load
                alert('Failed to load QR image for printing.');
                // optionally close the window:
                // printWindow.close();
                };
            }

        });
    });

    // Close QR modal
    $('#closeQrModalBtn').on('click', function() {
        $('#qrModal').addClass('hidden').removeClass('flex');
    });

    // Close modals when clicking outside
    $(document).on('click', function(e) {
        // Check if click is outside the delete modal content
        if ($(e.target).is('#deleteModal')) {
            $('#deleteModal').addClass('hidden').removeClass('flex');
        }

        // Check if click is outside the QR modal content
        if ($(e.target).is('#qrModal')) {
            $('#qrModal').addClass('hidden').removeClass('flex');
        }
    });

    // Also close modals when pressing Escape key
    $(document).on('keydown', function(e) {
        if (e.key === 'Escape') {
            $('#deleteModal').addClass('hidden').removeClass('flex');
            $('#qrModal').addClass('hidden').removeClass('flex');
        }
    });

    // Notification function
    function showNotification(message, type) {
        var notification = $(`
            <div class="fixed top-4 right-4 z-50 px-4 py-3 rounded-lg shadow-lg text-white ${type === 'success' ? 'bg-green-500' : 'bg-red-500'} transition-opacity duration-300">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-${type === 'success' ? 'check-circle' : 'alert-circle'} w-5 h-5 ml-2">
                        ${type === 'success' ?
                            '<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline>' :
                            '<circle cx="12" cy="12" r="10"></circle><line x1="12" x2="12" y1="8" y2="12"></line><line x1="12" x2="12.01" y1="16" y2="16"></line>'
                        }
                    </svg>
                    <span>${message}</span>
                </div>
            </div>
        `);

        $('body').append(notification);

        // Auto remove after 3 seconds
        setTimeout(function() {
            notification.fadeOut(300, function() {
                $(this).remove();
            });
        }, 3000);
    }

    // Context menu functionality (right-click)
    $(document).on('contextmenu', '#assets-table tbody tr', function(e) {
        e.preventDefault();
        var rowData = table.row(this).data();
        if (rowData) {
            showContextMenu(rowData.id, e.pageX, e.pageY);
        }
    });

    function showContextMenu(id, x, y) {
        // Remove existing context menu
        $('.context-menu').remove();

        var contextMenu = $(`
            <ul class="context-menu fixed bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg shadow-lg py-2 z-50" style="left: ${x}px; top: ${y}px;">
                <li><a href="/assets-list/${id}/show" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700">
                    <i class="lucide lucide-eye w-4 h-4 inline mr-2"></i>عرض
                </a></li>
                <li><a href="/assets-list/${id}/edit" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700">
                    <i class="lucide lucide-edit w-4 h-4 inline mr-2"></i>تعديل
                </a></li>
                <li class="border-t border-slate-200 dark:border-slate-700"></li>
                <li><a href="javascript:void(0)" onclick="deleteAsset(${id})" class="block px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20">
                    <i class="lucide lucide-trash-2 w-4 h-4 inline mr-2"></i>حذف
                </a></li>
            </ul>
        `);

        $('body').append(contextMenu);

        // Remove context menu when clicking elsewhere
        $(document).on('click', function() {
            $('.context-menu').remove();
        });
    }

    // Double-click to edit functionality
    // $(document).on('dblclick', '#assets-table tbody tr', function() {
    //     var rowData = table.row(this).data();
    //     if (rowData) {
    //         window.location.href = `/assets-list/${rowData.id}/edit`;
    //     }
    // });

    // Keyboard shortcuts
    $(document).on('keydown', function(e) {
        // Ctrl/Cmd + N = New Asset
        if ((e.ctrlKey || e.metaKey) && e.key === 'n') {
            e.preventDefault();
            window.location.href = '/assets-list/create';
        }

        // Ctrl/Cmd + R = Refresh Table
        if ((e.ctrlKey || e.metaKey) && e.key === 'r') {
            e.preventDefault();
            table.ajax.reload();
        }

        // ESC = Clear search
        if (e.key === 'Escape') {
            $('#dataTables_my_filter').val('').trigger('keyup');
            $('#status').val('').trigger('change');
            $('#type_id').val('').trigger('change');
        }
    });

    $(document).on('click', '.actions-dropdown-btn', function (e) {
        e.stopPropagation(); // prevent document click from immediately closing

        let relativeParent = $(this).closest('.relative');
        let dropdown = relativeParent.find('.actions-dropdown');

        // Close other dropdowns
        $('.actions-dropdown').not(dropdown).addClass('hidden');

        // Toggle current dropdown
        dropdown.toggleClass('hidden');
    });

    $(document).on('click', function (e) {
        if (!$(e.target).closest('.actions-dropdown-btn, .actions-dropdown').length) {
            $('.actions-dropdown').addClass('hidden');
        }
    });

    // Import Employee Form Submit
    $('#importAssetsForm').on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        var form = $(this);
        var submitButton = form.find('button[type="submit"]');
        var originalButtonText = submitButton.html();
        submitButton.prop('disabled', true);
        submitButton.html(`
            <svg class="animate-spin ml-3 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            جاري الاستيراد...
        `);

        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                $('#importAssetsModal').addClass('hidden').removeClass('flex');
                showNotification('تم استيراد الملف بنجاح', 'success');
                table.ajax.reload();
            },
            error: function(xhr) {
                var errorMessage = 'حدث خطأ أثناء استيراد الملف';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }
                showNotification(errorMessage, 'error');
            },
            complete: function() {
                submitButton.prop('disabled', false);
                submitButton.html(originalButtonText);
            }
        });
    });

    // Import Employee Modal
    $('#import-assets-btn').on('click', function() {
        $('#importAssetsModal').removeClass('hidden').addClass('flex');
        $('#importAssetsForm')[0].reset();
        $('#file-name').text('');
    });

    $('#closeImportModalBtn, #cancelImportBtn').on('click', function() {
        $('#importAssetsModal').addClass('hidden').removeClass('flex');
    });

    // Display selected file name
    $('#excel_file').on('change', function() {
        var fileName = $(this).val().split('\\').pop();
        $('#file-name').text(fileName);
    });

});
</script>
@endsection
