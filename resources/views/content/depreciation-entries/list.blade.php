@extends('layouts.app')
@section('content')
<div class="mx-auto p-6 space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-display font-bold text-slate-900 dark:text-slate-100">قيود الإهلاك</h1>
            <p class="text-slate-600 dark:text-slate-400 mt-1">إدارة قيود الإهلاك للأصول الثابتة</p>
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
            <button id="create-entry-btn" class="inline-flex items-center justify-center rounded-md font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none bg-primary-600 text-white hover:bg-primary-700 h-8 px-3 text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus w-4 h-4 ltr:mr-2 rtl:ml-2">
                    <path d="M5 12h14"></path>
                    <path d="M12 5v14"></path>
                </svg>
                إضافة قيد جديد
            </button>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mt-4">
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow-sm border bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/20 border-blue-200 dark:border-blue-800">
            <div class="p-6 border-b border-slate-200 dark:border-slate-700 flex flex-row items-center justify-between space-y-0 pb-2">
                <h3 class="tracking-tight text-sm font-medium text-blue-700 dark:text-blue-300">إجمالي تكلفة الشراء</h3>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-dollar-sign h-5 w-5 text-blue-600 dark:text-blue-400">
                    <line x1="12" x2="12" y1="1" y2="23"></line>
                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                </svg>
            </div>
            <div class="p-6">
                <div class="text-2xl font-bold text-blue-900 dark:text-blue-100">{{ number_format($totals->purchase_cost, 2) }}</div>
                <p class="text-xs text-blue-600 dark:text-blue-400 mt-1">إجمالي تكلفة الشراء</p>
            </div>
        </div>
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow-sm border bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900/20 dark:to-green-800/20 border-green-200 dark:border-green-800">
            <div class="p-6 border-b border-slate-200 dark:border-slate-700 flex flex-row items-center justify-between space-y-0 pb-2">
                <h3 class="tracking-tight text-sm font-medium text-green-700 dark:text-green-300">إجمالي الإضافات</h3>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus-circle h-5 w-5 text-green-600 dark:text-green-400">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" x2="12" y1="8" y2="16"></line>
                    <line x1="8" x2="16" y1="12" y2="12"></line>
                </svg>
            </div>
            <div class="p-6">
                <div class="text-2xl font-bold text-green-900 dark:text-green-100">{{ number_format($totals->additions, 2) }}</div>
                <p class="text-xs text-green-600 dark:text-green-400 mt-1">إجمالي الإضافات</p>
            </div>
        </div>
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow-sm border bg-gradient-to-br from-yellow-50 to-yellow-100 dark:from-yellow-900/20 dark:to-yellow-800/20 border-yellow-200 dark:border-yellow-800">
            <div class="p-6 border-b border-slate-200 dark:border-slate-700 flex flex-row items-center justify-between space-y-0 pb-2">
                <h3 class="tracking-tight text-sm font-medium text-yellow-700 dark:text-yellow-300">إجمالي الاستبعادات</h3>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-minus-circle h-5 w-5 text-yellow-600 dark:text-yellow-400">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="8" x2="16" y1="12" y2="12"></line>
                </svg>
            </div>
            <div class="p-6">
                <div class="text-2xl font-bold text-yellow-900 dark:text-yellow-100">{{ number_format($totals->exclusions, 2) }}</div>
                <p class="text-xs text-yellow-600 dark:text-yellow-400 mt-1">إجمالي الاستبعادات</p>
            </div>
        </div>
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow-sm border bg-gradient-to-br from-indigo-50 to-indigo-100 dark:from-indigo-900/20 dark:to-indigo-800/20 border-indigo-200 dark:border-indigo-800">
            <div class="p-6 border-b border-slate-200 dark:border-slate-700 flex flex-row items-center justify-between space-y-0 pb-2">
                <h3 class="tracking-tight text-sm font-medium text-indigo-700 dark:text-indigo-300">صافي القيمة الدفترية</h3>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-text h-5 w-5 text-indigo-600 dark:text-indigo-400">
                    <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                    <line x1="16" x2="8" y1="13" y2="13"></line>
                    <line x1="16" x2="8" y1="17" y2="17"></line>
                    <polyline points="10 9 9 9 8 9"></polyline>
                </svg>
            </div>
            <div class="p-6">
                <div class="text-2xl font-bold text-indigo-900 dark:text-indigo-100">{{ number_format($totals->net_book_value, 2) }}</div>
                <p class="text-xs text-indigo-600 dark:text-indigo-400 mt-1">إجمالي صافي القيمة الدفترية</p>
            </div>
        </div>
    </div>

    <!-- Filters Section -->
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
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar w-4 h-4 inline ltr:mr-1 rtl:ml-1">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="16" x2="16" y1="2" y2="6"></line>
                                <line x1="8" x2="8" y1="2" y2="6"></line>
                                <line x1="3" x2="21" y1="10" y2="10"></line>
                            </svg>
                            السنة
                        </label>
                        <div class="w-full">
                            <select id="year-filter" class="flex h-10 rounded-md border border-slate-300 bg-white px-3 py-2 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-transparent disabled:cursor-not-allowed disabled:opacity-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50 w-full" name="year">
                                <option value="">جميع السنوات</option>
                                @foreach ($years as $year)
                                    <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-2 dark:text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-package w-4 h-4 inline ltr:mr-1 rtl:ml-1">
                                <path d="m7.5 4.27 9 5.15"></path>
                                <path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"></path>
                                <path d="m3.3 7 8.7 5 8.7-5"></path>
                                <path d="M12 22V12"></path>
                            </svg>
                            الأصل
                        </label>
                        <div class="w-full">
                            <select id="asset-filter" class="flex h-10 rounded-md border border-slate-300 bg-white px-3 py-2 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-transparent disabled:cursor-not-allowed disabled:opacity-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50 w-full" name="asset_id">
                                <option value="">جميع الأصول</option>
                                @foreach ($assets as $asset)
                                    <option value="{{ $asset->id }}">{{ $asset->name }}</option>
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
                            <input id="dataTables_my_filter" type="text" class="flex h-10 rounded-md border border-slate-300 bg-white px-3 py-2 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-transparent disabled:cursor-not-allowed disabled:opacity-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50 w-full" placeholder="ابحث بالرقم، الوصف، أو التصنيف...">
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
                <div class="w-full overflow-auto rounded-lg">
                    <table id="depreciation-entries-table" class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>م</th>
                                <th>رقم القيد</th>
                                <th>التاريخ</th>
                                <th>الوصف</th>
                                <th>نسبة الاهلاك</th>
                                <th>بداية الاهلاك</th>
                                <th>سنة احتساب الاهلاك</th>
                                <th>عدد الأيام</th>
                                <th>تكلفة الشراء</th>
                                <th>الإضافات</th>
                                <th>الاستبعادات</th>
                                <th>تكلفة الأصل في</th>
                                <th>مجمع الاهلاك في</th>
                                <th>اهلاك السنة</th>
                                <th>الاهلاك المستبعد</th>
                                <th>مجمع الاهلاك في</th>
                                <th>صافي القيمة الدفترية</th>
                                <th>التصنيف</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                            <tr class="bg-slate-50 dark:bg-slate-800 font-semibold">
                                <td colspan="8" class="text-right">الإجمالي</td>
                                <td>{{ number_format($totals->purchase_cost, 2) }}</td>
                                <td>{{ number_format($totals->additions, 2) }}</td>
                                <td>{{ number_format($totals->exclusions, 2) }}</td>
                                <td>{{ number_format($totals->asset_cost_at_end, 2) }}</td>
                                <td>{{ number_format($totals->accumulated_depreciation_at_start, 2) }}</td>
                                <td>{{ number_format($totals->current_year_depreciation, 2) }}</td>
                                <td>{{ number_format($totals->excluded_depreciation, 2) }}</td>
                                <td>{{ number_format($totals->accumulated_depreciation_at_end, 2) }}</td>
                                <td>{{ number_format($totals->net_book_value, 2) }}</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                        </tfoot>
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

<!-- Create/Edit Entry Modal -->
<div id="entryModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white dark:bg-slate-800 rounded-lg shadow-xl max-w-4xl w-full mx-4 max-h-[90vh] overflow-y-auto">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 id="entryModalTitle" class="text-lg font-medium text-slate-900 dark:text-white">إضافة قيد جديد</h3>
                <button id="closeEntryModalBtn" class="text-slate-400 hover:text-slate-500 dark:hover:text-slate-300">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x w-6 h-6">
                        <path d="M18 6 6 18"></path>
                        <path d="m6 6 12 12"></path>
                    </svg>
                </button>
            </div>
            <form id="entryForm" method="POST" action="{{ route('depreciation-entries.create') }}">
                <input type="hidden" id="entryId" name="id">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="entryNumber" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">رقم القيد</label>
                        <input type="text" id="entryNumber" name="entry_number" required class="flex h-10 rounded-md border border-slate-300 bg-white px-3 py-2 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-transparent disabled:cursor-not-allowed disabled:opacity-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50 w-full" placeholder="أدخل رقم القيد">
                    </div>
                    <div>
                        <label for="entryDate" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">التاريخ</label>
                        <input type="date" id="entryDate" name="date" required class="flex h-10 rounded-md border border-slate-300 bg-white px-3 py-2 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-transparent disabled:cursor-not-allowed disabled:opacity-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50 w-full">
                    </div>
                    <div class="md:col-span-2">
                        <label for="entryDescription" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">الوصف</label>
                        <textarea id="entryDescription" name="description" rows="2" class="flex rounded-md border border-slate-300 bg-white px-3 py-2 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-transparent disabled:cursor-not-allowed disabled:opacity-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50 w-full" placeholder="أدخل وصف القيد"></textarea>
                    </div>
                    <div>
                        <label for="assetId" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">الأصل</label>
                        <select id="assetId" name="asset_id" required class="flex h-10 rounded-md border border-slate-300 bg-white px-3 py-2 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-transparent disabled:cursor-not-allowed disabled:opacity-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50 w-full">
                            <option value="">اختر الأصل</option>
                            @foreach ($assets as $asset)
                                <option value="{{ $asset->id }}">{{ $asset->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="depreciationRate" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">نسبة الاهلاك (%)</label>
                        <input type="number" id="depreciationRate" name="depreciation_rate" step="0.01" class="flex h-10 rounded-md border border-slate-300 bg-white px-3 py-2 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-transparent disabled:cursor-not-allowed disabled:opacity-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50 w-full" placeholder="أدخل نسبة الاهلاك">
                    </div>
                    <div>
                        <label for="depreciationStartDate" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">بداية الاهلاك</label>
                        <input type="date" id="depreciationStartDate" name="depreciation_start_date" class="flex h-10 rounded-md border border-slate-300 bg-white px-3 py-2 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-transparent disabled:cursor-not-allowed disabled:opacity-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50 w-full">
                    </div>
                    <div>
                        <label for="depreciationYear" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">سنة احتساب الاهلاك</label>
                        <input type="date" id="depreciationYear" name="depreciation_year" class="flex h-10 rounded-md border border-slate-300 bg-white px-3 py-2 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-transparent disabled:cursor-not-allowed disabled:opacity-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50 w-full" >
                        {{-- <input type="number" id="depreciationYear" name="depreciation_year" min="2000" max="2100" class="flex h-10 rounded-md border border-slate-300 bg-white px-3 py-2 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-transparent disabled:cursor-not-allowed disabled:opacity-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50 w-full" placeholder="أدخل سنة احتساب الاهلاك"> --}}
                    </div>
                    <div>
                        <label for="daysCount" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">عدد الأيام</label>
                        <input type="number" readonly id="daysCount" name="days_count" min="0" class="flex h-10 rounded-md border border-slate-300 bg-slate-100 cursor-not-allowed px-3 py-2 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-transparent disabled:cursor-not-allowed disabled:opacity-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50 w-full" placeholder="أدخل عدد الأيام">
                    </div>
                    <div>
                        <label for="purchaseCost" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">تكلفة الشراء</label>
                        <input type="number" id="purchaseCost" name="purchase_cost" step="0.01" min="0" class="flex h-10 rounded-md border border-slate-300 bg-white px-3 py-2 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-transparent disabled:cursor-not-allowed disabled:opacity-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50 w-full" placeholder="أدخل تكلفة الشراء">
                    </div>
                    <div>
                        <label for="additions" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">الإضافات</label>
                        <input type="number" id="additions" name="additions" step="0.01" min="0" class="flex h-10 rounded-md border border-slate-300 bg-white px-3 py-2 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-transparent disabled:cursor-not-allowed disabled:opacity-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50 w-full" placeholder="أدخل قيمة الإضافات">
                    </div>
                    <div>
                        <label for="exclusions" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">الاستبعادات</label>
                        <input type="number" id="exclusions" name="exclusions" step="0.01" min="0" class="flex h-10 rounded-md border border-slate-300 bg-white px-3 py-2 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-transparent disabled:cursor-not-allowed disabled:opacity-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50 w-full" placeholder="أدخل قيمة الاستبعادات">
                    </div>
                    <div>
                        <label for="assetCostAtEnd" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">تكلفة الأصل في 31/12/س</label>
                        <input type="number" readonly id="assetCostAtEnd" name="asset_cost_at_end" step="0.01" min="0" class="flex h-10 rounded-md border border-slate-300 bg-slate-100 cursor-not-allowed px-3 py-2 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-transparent disabled:cursor-not-allowed disabled:opacity-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50 w-full" placeholder="أدخل تكلفة الأصل في نهاية الفترة">
                    </div>
                    <div>
                        <label for="accumulatedDepreciationAtStart" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">مجمع الاهلاك في 01/01/س</label>
                        <input type="number" id="accumulatedDepreciationAtStart" name="accumulated_depreciation_at_start" step="0.01" min="0" class="flex h-10 rounded-md border border-slate-300 bg-white px-3 py-2 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-transparent disabled:cursor-not-allowed disabled:opacity-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50 w-full" placeholder="أدخل مجمع الاهلاك في بداية الفترة">
                    </div>
                    <div>
                        <label for="currentYearDepreciation" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">اهلاك السنة س</label>
                        <input type="number" readonly id="currentYearDepreciation" name="current_year_depreciation" step="0.01" min="0" class="flex h-10 rounded-md border border-slate-300 bg-slate-100 cursor-not-allowed px-3 py-2 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-transparent disabled:cursor-not-allowed disabled:opacity-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50 w-full" placeholder="أدخل اهلاك السنة">
                    </div>
                    <div>
                        <label for="excludedDepreciation" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">الاهلاك المستبعد س</label>
                        <input type="number" id="excludedDepreciation" name="excluded_depreciation" step="0.01" min="0" class="flex h-10 rounded-md border border-slate-300 bg-white px-3 py-2 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-transparent disabled:cursor-not-allowed disabled:opacity-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50 w-full" placeholder="أدخل الاهلاك المستبعد">
                    </div>
                    <div>
                        <label for="accumulatedDepreciationAtEnd" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">مجمع الاهلاك في س</label>
                        <input type="number" readonly id="accumulatedDepreciationAtEnd" name="accumulated_depreciation_at_end" step="0.01" min="0" class="flex h-10 rounded-md border border-slate-300 bg-slate-100 cursor-not-allowed px-3 py-2 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-transparent disabled:cursor-not-allowed disabled:opacity-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50 w-full" placeholder="أدخل مجمع الاهلاك في نهاية الفترة">
                    </div>
                    <div>
                        <label for="netBookValue" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">صافي القيمة الدفترية</label>
                        <input type="number" readonly id="netBookValue" name="net_book_value" step="0.01" class="flex h-10 rounded-md border border-slate-300 bg-slate-100 cursor-not-allowed px-3 py-2 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-transparent disabled:cursor-not-allowed disabled:opacity-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50 w-full" placeholder="أدخل صافي القيمة الدفترية">
                    </div>
                    <div>
                        <label for="classification" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">التصنيف</label>
                        <input type="text" id="classification" name="classification" class="flex h-10 rounded-md border border-slate-300 bg-white px-3 py-2 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-transparent disabled:cursor-not-allowed disabled:opacity-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50 w-full" placeholder="أدخل التصنيف">
                    </div>
                </div>
                <div class="flex justify-end flex-row-reverse mt-6 space-x-4">
                    <button type="button" id="cancelEntryBtn" class="px-4 py-2 bg-slate-200 dark:bg-slate-700 text-slate-800 dark:text-slate-200 rounded-md hover:bg-slate-300 dark:hover:bg-slate-600 transition-colors">
                        إلغاء
                    </button>
                    <button type="submit" class="px-4 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700 transition-colors">
                        حفظ
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteEntryModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
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
            <p class="text-center text-slate-500 dark:text-slate-400 mb-6">هل أنت متأكد من حذف القيد: <span id="deleteEntryNumber" class="font-semibold"></span>؟ لا يمكن التراجع عن هذا الإجراء.</p>
            <div class="flex justify-center flex-row-reverse space-x-4">
                <button id="cancelDeleteEntryBtn" class="px-4 py-2 bg-slate-200 dark:bg-slate-700 text-slate-800 dark:text-slate-200 rounded-md hover:bg-slate-300 dark:hover:bg-slate-600 transition-colors">
                    إلغاء
                </button>
                <button id="confirmDeleteEntryBtn" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors">
                    حذف
                </button>
            </div>
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
  #depreciation-entries-table {
    width: 100%;
    caption-side: bottom;
    font-size: 0.875rem; /* text-sm */
    border-collapse: collapse;
  }
  #depreciation-entries-table thead {
    background-color: rgb(248 250 252); /* bg-slate-50 */
  }
  html.dark #depreciation-entries-table thead {
    background-color: rgb(30 41 59); /* dark:bg-slate-800 */
  }
  #depreciation-entries-table thead tr {
    border-bottom: 1px solid rgb(226 232 240); /* border-slate-200 */
    transition: background-color 0.2s;
  }
  html.dark #depreciation-entries-table thead tr {
    border-bottom: 1px solid rgb(51 65 85); /* dark:border-slate-700 */
  }
  #depreciation-entries-table thead tr:hover {
    background-color: rgb(248 250 252); /* hover:bg-slate-50 */
  }
  html.dark #depreciation-entries-table thead tr:hover {
    background-color: rgba(30, 41, 59, 0.5); /* dark:hover:bg-slate-800/50 */
  }
  #depreciation-entries-table tbody tr {
    border-bottom: 1px solid rgb(226 232 240);
    transition: background-color 0.2s;
  }
  html.dark #depreciation-entries-table tbody tr {
    border-bottom: 1px solid rgb(51 65 85);
  }
  #depreciation-entries-table tbody tr:hover {
    background-color: rgb(248 250 252);
  }
  html.dark #depreciation-entries-table tbody tr:hover {
    background-color: rgba(30, 41, 59, 0.5);
  }
  #depreciation-entries-table tbody td {
    padding: 1rem;
    vertical-align: middle;
    color: rgb(15 23 42); /* text-slate-900 */
  }
  html.dark #depreciation-entries-table tbody td {
    color: rgb(203 213 225); /* dark:text-slate-300 */
  }
  #depreciation-entries-table thead th {
    height: 3rem;
    padding-left: 1rem;
    padding-right: 1rem;
    vertical-align: middle;
    font-weight: 500;
    color: rgb(100 116 139); /* text-slate-500 */
  }
  html.ltr #depreciation-entries-table thead th {
    text-align: left;
  }
  html.rtl #depreciation-entries-table thead th {
    text-align: right;
  }
  html.dark #depreciation-entries-table thead th {
    color: rgb(148 163 184); /* dark:text-slate-400 */
  }

  /* Footer totals row styling */
  #depreciation-entries-table tfoot tr {
    background-color: rgb(248 250 252); /* bg-slate-50 */
    font-weight: 600;
  }
  html.dark #depreciation-entries-table tfoot tr {
    background-color: rgb(30 41 59); /* dark:bg-slate-800 */
  }
  #depreciation-entries-table tfoot td {
    padding: 1rem;
    vertical-align: middle;
    color: rgb(15 23 42); /* text-slate-900 */
    font-weight: 600;
  }
  html.dark #depreciation-entries-table tfoot td {
    color: rgb(203 213 225); /* dark:text-slate-300 */
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
    var table = $('#depreciation-entries-table').DataTable({
        language: {
            zeroRecords: `
                <div class="flex flex-col items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-slate-300 dark:text-slate-600">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.35-4.35"></path>
                        <line x1="8" x2="14" y1="11" y2="11"></line>
                    </svg>
                    <p class="text-slate-500 font-medium">لم يتم العثور على قيود للفترة المحددة.</p>
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
                    <p class="text-slate-500 font-medium">لا توجد قيود مسجلة في النظام.</p>
                </div>
            `,
        },
        ajax: {
            url: '/depreciation-entries', // Your depreciation entries route
            data: function(d) {
                d.year = $('#year-filter').val();
                d.asset_id = $('#asset-filter').val();
                d.search = $('#dataTables_my_filter').val();
            }
        },
        columns: [
            { data: 'DT_RowIndex', name: 'id', title: 'م', orderable: false },
            { data: 'entry_number', name: 'entry_number', title: 'رقم القيد' },
            { data: 'date', name: 'date', title: 'التاريخ' },
            { data: 'description', name: 'description', title: 'الوصف' },
            { data: 'depreciation_rate', name: 'depreciation_rate', title: 'نسبة الاهلاك' },
            { data: 'depreciation_start_date', name: 'depreciation_start_date', title: 'بداية الاهلاك' },
            { data: 'depreciation_year', name: 'depreciation_year', title: 'سنة احتساب الاهلاك' },
            { data: 'days_count', name: 'days_count', title: 'عدد الأيام' },
            { data: 'purchase_cost', name: 'purchase_cost', title: 'تكلفة الشراء' },
            { data: 'additions', name: 'additions', title: 'الإضافات' },
            { data: 'exclusions', name: 'exclusions', title: 'الاستبعادات' },
            { data: 'asset_cost_at_end', name: 'asset_cost_at_end', title: 'تكلفة الأصل في' },
            { data: 'accumulated_depreciation_at_start', name: 'accumulated_depreciation_at_start', title: 'مجمع الاهلاك في' },
            { data: 'current_year_depreciation', name: 'current_year_depreciation', title: 'اهلاك السنة' },
            { data: 'excluded_depreciation', name: 'excluded_depreciation', title: 'الاهلاك المستبعد' },
            { data: 'accumulated_depreciation_at_end', name: 'accumulated_depreciation_at_end', title: 'مجمع الاهلاك في' },
            { data: 'net_book_value', name: 'net_book_value', title: 'صافي القيمة الدفترية' },
            { data: 'classification', name: 'classification', title: 'التصنيف' },
            { data: 'action', name: 'action', title: 'الإجراءات', orderable: false, searchable: false }
        ],
        order: [[1, 'asc']],
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
        $("#depreciation-entries-table").addClass("w-full caption-bottom text-sm border-collapse");
        $("#depreciation-entries-table thead").addClass("bg-slate-50 dark:bg-slate-800");
        $("#depreciation-entries-table thead tr").addClass("border-b border-slate-200 dark:border-slate-700 transition-colors hover:bg-slate-50 dark:hover:bg-slate-800/50");
        $("#depreciation-entries-table tbody tr").addClass("border-b border-slate-200 dark:border-slate-700 transition-colors hover:bg-slate-50 dark:hover:bg-slate-800/50");
        $("#depreciation-entries-table tbody td").addClass("p-4 align-middle text-slate-900 dark:text-slate-300");
        $("#depreciation-entries-table thead th").addClass("h-12 px-4 ltr:text-left rtl:text-right align-middle font-medium text-slate-500 dark:text-slate-400");
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

    // Custom search
    $('#dataTables_my_filter').on('input', function () {
        var query = $(this).val();
        table.search(query).draw();
    });

    // Custom length change
    $('#dataTables_my_length').change(function () {
        var selectedValue = $(this).val();
        table.page.len(selectedValue).draw();
    });

    // Export Excel functionality
    $('#export-excel-btn').on('click', function() {
        var params = new URLSearchParams({
            year: $('#year-filter').val() || '',
            asset_id: $('#asset-filter').val() || '',
            search: $('#dataTables_my_filter').val() || '',
            format: 'excel'
        });
        window.location.href = '/depreciation-entries/export?' + params.toString();
    });

    // Create Entry Modal
    $('#create-entry-btn').on('click', function() {
        $('#entryModalTitle').text('إضافة قيد جديد');
        $('#entryForm')[0].reset();
        $('#entryId').val('');
        $('#entryModal').removeClass('hidden').addClass('flex');
    });

    // Edit Entry Modal
    $(document).on('click', '.edit-entry-btn', function() {
        $('.actions-dropdown').addClass('hidden');

        var entryId = $(this).data('id');

        // Get entry details via AJAX
        $.ajax({
            url: '/depreciation-entries/' + entryId + '/get',
            type: 'GET',
            success: function(res) {
                let response = res.data;
                $('#entryModalTitle').text('تعديل القيد');
                $('#entryId').val(response.id);
                $('#entryNumber').val(response.entry_number);
                $('#entryDate').val(response.date ? new Date(response.date).toISOString().split('T')[0] : '');
                $('#entryDescription').val(response.description);
                $('#assetId').val(response.asset_id);
                $('#depreciationRate').val(response.depreciation_rate);
                $('#depreciationStartDate').val(response.depreciation_start_date ? new Date(response.depreciation_start_date).toISOString().split('T')[0] : '');
                $('#depreciationYear').val(response.depreciation_year);
                $('#daysCount').val(response.days_count);
                $('#purchaseCost').val(response.purchase_cost);
                $('#additions').val(response.additions);
                $('#exclusions').val(response.exclusions);
                $('#assetCostAtEnd').val(response.asset_cost_at_end);
                $('#accumulatedDepreciationAtStart').val(response.accumulated_depreciation_at_start);
                $('#currentYearDepreciation').val(response.current_year_depreciation);
                $('#excludedDepreciation').val(response.excluded_depreciation);
                $('#accumulatedDepreciationAtEnd').val(response.accumulated_depreciation_at_end);
                $('#netBookValue').val(response.net_book_value);
                $('#classification').val(response.classification);

                $('#entryModal').removeClass('hidden').addClass('flex');
            },
            error: function(xhr) {
                showNotification('حدث خطأ أثناء جلب بيانات القيد', 'error');
            }
        });
    });

    // Entry Form Submit
    $('#entryForm').on('submit', function(e) {
        e.preventDefault();
        var entryId = $('#entryId').val();
        var url = entryId ? '/depreciation-entries/' + entryId : '/depreciation-entries/create';
        var method = entryId ? 'PUT' : 'POST';

        $.ajax({
            url: url,
            type: method,
            data: $(this).serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                $('#entryModal').addClass('hidden').removeClass('flex');
                showNotification(entryId ? 'تم تحديث القيد بنجاح' : 'تم إضافة القيد بنجاح', 'success');
                table.ajax.reload();
            },
            error: function(xhr) {
                var errors = xhr.responseJSON.errors;
                var errorMessage = 'حدث خطأ أثناء حفظ القيد';

                if (errors) {
                    var firstError = Object.values(errors)[0];
                    if (firstError && firstError[0]) {
                        errorMessage = firstError[0];
                    }
                }

                showNotification(errorMessage, 'error');
            }
        });
    });

    // Close Entry Modal
    $('#closeEntryModalBtn, #cancelEntryBtn').on('click', function() {
        $('#entryModal').addClass('hidden').removeClass('flex');
    });

    // Delete Entry Modal
    $(document).on('click', '.delete-entry-btn', function() {
        $('.actions-dropdown').addClass('hidden');

        var entryId = $(this).data('id');
        var entryNumber = $(this).closest('tr').find('td:eq(1)').text();
        var deleteUrl = $(this).data('url');

        $('#deleteEntryNumber').text(entryNumber);
        $('#deleteEntryModal').removeClass('hidden').addClass('flex');

        $('#confirmDeleteEntryBtn').off('click').on('click', function() {
            $.ajax({
                url: deleteUrl,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#deleteEntryModal').addClass('hidden').removeClass('flex');
                    showNotification('تم حذف القيد بنجاح', 'success');
                    table.ajax.reload();
                },
                error: function(xhr) {
                    $('#deleteEntryModal').addClass('hidden').removeClass('flex');
                    showNotification('حدث خطأ أثناء حذف القيد', 'error');
                }
            });
        });
    });

    $('#cancelDeleteEntryBtn').on('click', function() {
        $('#deleteEntryModal').addClass('hidden').removeClass('flex');
    });

    // Close modals when clicking outside
    $(document).on('click', function(e) {
        if ($(e.target).is('#entryModal')) {
            $('#entryModal').addClass('hidden').removeClass('flex');
        }
        if ($(e.target).is('#deleteEntryModal')) {
            $('#deleteEntryModal').addClass('hidden').removeClass('flex');
        }
    });

    // Also close modals when pressing Escape key
    $(document).on('keydown', function(e) {
        if (e.key === 'Escape') {
            $('#entryModal').addClass('hidden').removeClass('flex');
            $('#deleteEntryModal').addClass('hidden').removeClass('flex');
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


    $('#depreciationStartDate, #depreciationYear').on('change', calculateDaysCount);
    $('#purchaseCost, #additions, #exclusions').on('input', calculateAssetCost);
    $('#depreciationRate, #assetCostAtEnd, #daysCount').on('input', calculateCurrentYearDepreciation);
    $('#accumulatedDepreciationAtStart, #excludedDepreciation, #currentYearDepreciation').on('input', calculateAccumulatedDepreciation);
    $('#assetCostAtEnd, #accumulatedDepreciationAtEnd').on('input', calculateNetBookValue);

});



// Function to calculate days count
function calculateDaysCount() {
    const startDate = new Date($('#depreciationStartDate').val());
    const endDate = new Date($('#depreciationYear').val()); // +
    console.log(startDate,endDate);
    // const year = parseInt($('#depreciationYear').val()); / -

    if (startDate && endDate) { // +
    // if (startDate && year) { // -
        // const endDate = new Date(year, 11, 31); // December 31 of the selected year // -
        const diffTime = Math.abs(endDate - startDate);
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
        $('#daysCount').val(diffDays);

        // Trigger dependent calculations
        calculateCurrentYearDepreciation();
    }
}

// Function to calculate asset cost at end
function calculateAssetCost() {
    const purchaseCost = parseFloat($('#purchaseCost').val()) || 0;
    const additions = parseFloat($('#additions').val()) || 0;
    const exclusions = parseFloat($('#exclusions').val()) || 0;
    const assetCostAtEnd = purchaseCost + additions + exclusions;
    $('#assetCostAtEnd').val(assetCostAtEnd.toFixed(2));

    // Trigger dependent calculations
    calculateCurrentYearDepreciation();
}

// Function to calculate current year depreciation
function calculateCurrentYearDepreciation() {
    const depreciationRate = parseFloat($('#depreciationRate').val()) || 0;
    const assetCostAtEnd = parseFloat($('#assetCostAtEnd').val()) || 0;
    const daysCount = parseFloat($('#daysCount').val()) || 0;

    const currentYearDepreciation = ((depreciationRate * assetCostAtEnd) / 365) * daysCount;
    $('#currentYearDepreciation').val(currentYearDepreciation.toFixed(2));

    calculateAccumulatedDepreciation();
}

// Function to calculate accumulated depreciation at end
function calculateAccumulatedDepreciation() {
    const accumulatedDepreciationAtStart = parseFloat($('#accumulatedDepreciationAtStart').val()) || 0;
    const excludedDepreciation = parseFloat($('#excludedDepreciation').val()) || 0;
    const currentYearDepreciation = parseFloat($('#currentYearDepreciation').val()) || 0;

    const accumulatedDepreciationAtEnd = accumulatedDepreciationAtStart + currentYearDepreciation + excludedDepreciation;
    $('#accumulatedDepreciationAtEnd').val(accumulatedDepreciationAtEnd.toFixed(2));

    // Trigger dependent calculations
    calculateNetBookValue();
}

// Function to calculate net book value
function calculateNetBookValue() {
    const assetCostAtEnd = parseFloat($('#assetCostAtEnd').val()) || 0;
    const accumulatedDepreciationAtEnd = parseFloat($('#accumulatedDepreciationAtEnd').val()) || 0;

    const netBookValue = assetCostAtEnd - accumulatedDepreciationAtEnd;
    $('#netBookValue').val(netBookValue.toFixed(2));
}



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
</script>
@endsection
