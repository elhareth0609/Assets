@extends('layouts.app')

@section('title', __('إضافة أصل جديد'))

@section('content')
<div class="mx-auto p-6 space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-display font-bold text-slate-900 dark:text-slate-100">إضافة أصل جديد</h1>
            <p class="text-slate-600 dark:text-slate-400 mt-1">قم بتعبئة النموذج التالي لإضافة أصل جديد إلى السجل.</p>
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
            <div class="flex gap-2">
                <a href="{{ route('assets') }}" class="inline-flex items-center justify-center rounded-md font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none bg-transparent border border-slate-300 dark:border-slate-700 hover:bg-slate-100 dark:text-slate-100 dark:hover:bg-slate-800 h-8 px-3 text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right w-4 h-4 ltr:mr-2 rtl:ml-2"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    العودة للسجل
                </a>
            </div>
        </div>
    </div>

    <form id="createAssetForm" action="{{ route('assets.store') }}" method="POST">
        @csrf
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow-sm border border-slate-200 dark:border-slate-700 mt-4">
            <div class="p-6 border-b border-slate-200 dark:border-slate-700">
                <h3 class="text-lg font-semibold text-slate-900 dark:text-white leading-none tracking-tight">بيانات الأصل الأساسية</h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <label for="name" class="block text-sm font-medium mb-2 dark:text-slate-400">اسم الأصل</label>
                        <input type="text" id="name" name="name" class="flex h-10 w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50" placeholder="مثال: لابتوب Dell XPS 15" required>
                    </div>

                    <div>
                        <label for="number" class="block text-sm font-medium mb-2 dark:text-slate-400">رقم الأصل / السيريال</label>
                        <input type="text" id="number" name="number" class="flex h-10 w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50" placeholder="مثال: SN-12345ABC" required>
                    </div>

                    <div>
                        <label for="manufacturer_serial" class="block text-sm font-medium mb-2 dark:text-slate-400">الرقم التسلسلي للشركة المصنعة</label>
                        <input type="text" id="manufacturer_serial" name="manufacturer_serial" class="flex h-10 w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50" placeholder="مثال: ABC123XYZ">
                    </div>

                    <div>
                        <label for="type_id" class="block text-sm font-medium mb-2 dark:text-slate-400">نوع الأصل</label>
                        <select id="type_id" name="type_id" class="flex h-10 w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50">
                            <option value="" disabled selected>اختر نوع الأصل...</option>
                            @foreach($types as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="purchase_date" class="block text-sm font-medium mb-2 dark:text-slate-400">تاريخ الشراء</label>
                        <input type="date" id="purchase_date" name="purchase_date" class="flex h-10 w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50">
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium mb-2 dark:text-slate-400">الحالة</label>
                        <select id="status" name="status" class="flex h-10 w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50" required>
                            <option value="in_use" selected>قيد الاستخدام</option>
                            <option value="in_storage">في المستودع</option>
                            <option value="maintenance">صيانة</option>
                            <option value="damaged">تالف</option>
                        </select>
                    </div>

                    <div>
                        <label for="employee_id" class="block text-sm font-medium mb-2 dark:text-slate-400">المستخدم الحالي</label>
                        <select id="employee_id" name="employee_id" class="flex h-10 w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50">
                            <option value="">غير مخصص</option>
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->full_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="location_id" class="block text-sm font-medium mb-2 dark:text-slate-400">الإدارة</label>
                        <select id="location_id" name="location_id" class="flex h-10 w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50">
                            <option value="">غير مخصص</option>
                            @foreach($locations as $location)
                                <option value="{{ $location->id }}">{{ $location->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label for="notes" class="block text-sm font-medium mb-2 dark:text-slate-400">ملاحظات</label>
                        <textarea id="notes" name="notes" rows="4" class="flex w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50" placeholder="أي تفاصيل إضافية عن الأصل..."></textarea>
                    </div>
                </div>
            </div>
            <div class="p-6 border-t border-slate-200 dark:border-slate-700 flex justify-end gap-2">
                <a href="{{ route('assets') }}" class="inline-flex items-center justify-center rounded-md font-medium h-10 px-4 text-sm bg-transparent border border-slate-300 dark:border-slate-700 hover:bg-slate-100 dark:text-slate-100 dark:hover:bg-slate-800">إلغاء</a>
                <button type="submit" class="inline-flex items-center justify-center rounded-md font-medium bg-primary-600 text-white hover:bg-primary-700 h-10 px-4 text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-save w-4 h-4 rtl:ml-2 ltr:mr-2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    حفظ الأصل
                </button>
            </div>
        </div>
    </form>
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


@section('scripts')
<script>
$(document).ready(function() {
    const form = $('#createAssetForm');
    const submitButton = form.find('button[type="submit"]');
    const inputs = form.find('input, select, textarea');
    let originalContent = ''; // 将 originalContent 声明为全局变量

    $('#createAssetForm').on('submit', function(e) {
        e.preventDefault();

        var formData = new FormData(this);
        // 保存原始按钮内容
        originalContent = submitButton.html();

        inputs.prop('disabled', true);
        submitButton.prop('disabled', true);
        submitButton.html(`
            <svg class="animate-spin -ml-1 ml-3 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            جاري الحفظ...
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
            success: function(data) {
                if (data.icon == 'success') {
                    showNotification('success', data.message || 'تم حفظ الأصل بنجاح');

                    setTimeout(function() {
                        window.location.href = '{{ route("assets") }}';
                    }, 1500);
                } else {
                    showNotification('error', data.message || 'حدث خطأ أثناء حفظ الأصل');
                    resetForm();
                }
            },
            error: function(xhr) {
                const errorMessage = xhr.responseJSON && xhr.responseJSON.message
                    ? xhr.responseJSON.message
                    : 'حدث خطأ أثناء حفظ الأصل';
                showNotification('error', errorMessage);
                resetForm();
            }
        });
    });

    function resetForm() {
        inputs.prop('disabled', false);
        submitButton.prop('disabled', false);
        submitButton.html(originalContent);
    }

    function showNotification(type, message) {
        const notification = $(`
            <div class="fixed top-4 right-4 p-4 rounded-md shadow-lg z-50 ${type === 'success' ? 'bg-green-500' : 'bg-red-500'} text-white">
                ${message}
            </div>
        `);

        $('body').append(notification);

        setTimeout(function() {
            notification.remove();
        }, 3000);
    }

    $('#export-excel-btn').on('click', function() {
        window.location.href = '/assets-list/export';
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
