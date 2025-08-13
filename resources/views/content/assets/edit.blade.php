@extends('layouts.app')

@section('content')
<div class="mx-auto p-6 space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-display font-bold text-slate-900 dark:text-slate-100">تعديل الأصل</h1>
            <p class="text-slate-600 dark:text-slate-400 mt-1">تعديل بيانات الأصل: <span class="font-semibold">{{ $asset->name }}</span></p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('assets') }}" class="inline-flex items-center justify-center rounded-md font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none bg-transparent border border-slate-300 dark:border-slate-700 hover:bg-slate-100 dark:text-slate-100 dark:hover:bg-slate-800 h-8 px-3 text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right w-4 h-4 ltr:mr-2 rtl:ml-2"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                العودة للسجل
            </a>
        </div>
    </div>

    <form id="editAssetForm" action="{{ route('assets.update', $asset->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow-sm border border-slate-200 dark:border-slate-700 mt-4">
            <div class="p-6 border-b border-slate-200 dark:border-slate-700">
                <h3 class="text-lg font-semibold text-slate-900 dark:text-white leading-none tracking-tight">بيانات الأصل الأساسية</h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <label for="name" class="block text-sm font-medium mb-2 dark:text-slate-400">اسم الأصل</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $asset->name) }}" class="flex h-10 w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50" required>
                    </div>

                    <div>
                        <label for="manufacturer_serial" class="block text-sm font-medium mb-2 dark:text-slate-400">الرقم التسلسلي للشركة المصنعة</label>
                        <input type="text" id="manufacturer_serial" name="manufacturer_serial" value="{{ old('manufacturer_serial', $asset->manufacturer_serial) }}" class="flex h-10 w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50" placeholder="مثال: ABC123XYZ">
                    </div>

                    <div>
                        <label for="number" class="block text-sm font-medium mb-2 dark:text-slate-400">رقم الأصل / السيريال</label>
                        <input type="text" id="number" name="number" value="{{ old('number', $asset->number) }}" class="flex h-10 w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50" required>
                    </div>

                    <div>
                        <label for="type_id" class="block text-sm font-medium mb-2 dark:text-slate-400">نوع الأصل</label>
                        <select id="type_id" name="type_id" class="flex h-10 w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50">
                            <option value="">غير مخصص</option>
                            @foreach($types as $type)
                                <option value="{{ $type->id }}" {{ $asset->type_id == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="purchase_date" class="block text-sm font-medium mb-2 dark:text-slate-400">تاريخ الشراء</label>
                        <input type="date" id="purchase_date" name="purchase_date" value="{{ old('purchase_date', $asset->purchase_date) }}" class="flex h-10 w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50" required>
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium mb-2 dark:text-slate-400">الحالة</label>
                        <select id="status" name="status" class="flex h-10 w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50" required>
                            <option value="in_use" {{ $asset->status == 'in_use' ? 'selected' : '' }} selected>قيد الاستخدام</option>
                            <option value="in_storage" {{ $asset->status == 'in_storage' ? 'selected' : '' }}>في المستودع</option>
                            <option value="maintenance" {{ $asset->status == 'maintenance' ? 'selected' : '' }}>صيانة</option>
                            <option value="damaged" {{ $asset->status == 'damaged' ? 'selected' : '' }}>تالف</option>
                        </select>
                    </div>

                    <div>
                        <label for="employee_id" class="block text-sm font-medium mb-2 dark:text-slate-400">المستخدم الحالي</label>
                        <select id="employee_id" name="employee_id" class="flex h-10 w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50">
                            <option value="">غير مخصص</option>
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}" {{ $asset->employee_id == $employee->id ? 'selected' : '' }}>{{ $employee->full_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="location_id" class="block text-sm font-medium mb-2 dark:text-slate-400">الإدارة</label>
                        <select id="location_id" name="location_id" class="flex h-10 w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50">
                            <option value="">غير مخصص</option>
                            @foreach($locations as $location)
                                <option value="{{ $location->id }}" {{ $asset->location_id == $location->id ? 'selected' : '' }}>{{ $location->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label for="notes" class="block text-sm font-medium mb-2 dark:text-slate-400">ملاحظات</label>
                        <textarea id="notes" name="notes" rows="4" class="flex w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50">{{ old('notes', $asset->notes) }}</textarea>
                    </div>
                </div>
            </div>
            <div class="p-6 border-t border-slate-200 dark:border-slate-700 flex justify-end gap-2">
                 <a href="{{ route('assets') }}" class="inline-flex items-center justify-center rounded-md font-medium h-10 px-4 text-sm bg-transparent border border-slate-300 dark:border-slate-700 hover:bg-slate-100 dark:text-slate-100 dark:hover:bg-slate-800">إلغاء</a>
                <button type="submit" class="inline-flex items-center justify-center rounded-md font-medium bg-primary-600 text-white hover:bg-primary-700 h-10 px-4 text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-save w-4 h-4 rtl:ml-2 ltr:mr-2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    تحديث البيانات
                </button>
            </div>
        </div>
    </form>
</div>
@endsection



@section('scripts')
    <script>
        $(document).ready(function() {
            const form = $('#editAssetForm');
            const submitButton = form.find('button[type="submit"]');
            const inputs = form.find('input, select, textarea');
            let originalContent = ''; // 将 originalContent 声明为全局变量

            $('#editAssetForm').on('submit', function(e) {
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
        });
    </script>
@endsection
