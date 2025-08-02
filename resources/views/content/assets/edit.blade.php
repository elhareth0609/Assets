@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-display font-bold text-slate-900 dark:text-slate-100">تعديل الأصل</h1>
            <p class="text-slate-600 dark:text-slate-400 mt-1">تعديل بيانات الأصل: <span class="font-semibold">{{-- {{ $asset->asset_name }} --}} لابتوب Dell Latitude 5420</span></p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('assets') }}" class="inline-flex items-center justify-center rounded-md font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none bg-transparent border border-slate-300 dark:border-slate-700 hover:bg-slate-100 dark:hover:bg-slate-800 h-8 px-3 text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right w-4 h-4 ltr:mr-2 rtl:ml-2"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                العودة للسجل
            </a>
        </div>
    </div>

    <form action="{{-- {{ route('assets.update', $asset->id) }} --}}" method="POST">
        @csrf
        @method('PUT')
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow-sm border border-slate-200 dark:border-slate-700 mt-4">
            <div class="p-6 border-b border-slate-200 dark:border-slate-700">
                <h3 class="text-lg font-semibold text-slate-900 dark:text-white leading-none tracking-tight">بيانات الأصل الأساسية</h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <label for="asset_name" class="block text-sm font-medium mb-2">اسم الأصل</label>
                        <input type="text" id="asset_name" name="asset_name" value="{{ old('asset_name', $asset->asset_name) }}" class="flex h-10 w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50" required>
                    </div>

                    <div>
                        <label for="asset_number" class="block text-sm font-medium mb-2">رقم الأصل / السيريال</label>
                        <input type="text" id="asset_number" name="asset_number" value="{{ old('asset_number', $asset->asset_number) }}" class="flex h-10 w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50" required>
                    </div>

                    <div>
                        <label for="asset_type_id" class="block text-sm font-medium mb-2">نوع الأصل</label>
                        <select id="asset_type_id" name="asset_type_id" class="flex h-10 w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50" required>
                            {{-- @foreach($assetTypes as $type)
                                <option value="{{ $type->id }}" {{ $asset->asset_type_id == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                            @endforeach --}}
                            <option value="1" selected>أجهزة لابتوب</option>
                            <option value="2">أثاث مكتبي</option>
                        </select>
                    </div>

                    <div>
                        <label for="purchase_date" class="block text-sm font-medium mb-2">تاريخ الشراء</label>
                        <input type="date" id="purchase_date" name="purchase_date" value="{{ old('purchase_date', $asset->purchase_date) }}" class="flex h-10 w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50" required>
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium mb-2">الحالة</label>
                        <select id="status" name="status" class="flex h-10 w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50" required>
                            <option value="in_use" {{ $asset->status == 'in_use' ? 'selected' : '' }} selected>قيد الاستخدام</option>
                            <option value="in_storage" {{ $asset->status == 'in_storage' ? 'selected' : '' }}>في المستودع</option>
                            <option value="maintenance" {{ $asset->status == 'maintenance' ? 'selected' : '' }}>صيانة</option>
                            <option value="damaged" {{ $asset->status == 'damaged' ? 'selected' : '' }}>تالف</option>
                        </select>
                    </div>

                    <div>
                        <label for="current_user_id" class="block text-sm font-medium mb-2">المستخدم الحالي</label>
                        <select id="current_user_id" name="current_user_id" class="flex h-10 w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50">
                            <option value="">غير مخصص</option>
                            {{-- @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ $asset->current_user_id == $user->id ? 'selected' : '' }}>{{ $user->full_name }}</option>
                            @endforeach --}}
                            <option value="1" selected>أحمد محمد علي</option>
                            <option value="2">فاطمة سعد أحمد</option>
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label for="notes" class="block text-sm font-medium mb-2">ملاحظات</label>
                        <textarea id="notes" name="notes" rows="4" class="flex w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50">{{ old('notes', $asset->notes) }}</textarea>
                    </div>
                </div>
            </div>
            <div class="p-6 border-t border-slate-200 dark:border-slate-700 flex justify-end gap-2">
                 <a href="{{ route('assets') }}" class="inline-flex items-center justify-center rounded-md font-medium h-10 px-4 text-sm bg-transparent border border-slate-300 dark:border-slate-700 hover:bg-slate-100 dark:hover:bg-slate-800">إلغاء</a>
                <button type="submit" class="inline-flex items-center justify-center rounded-md font-medium bg-primary-600 text-white hover:bg-primary-700 h-10 px-4 text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-save w-4 h-4 rtl:ml-2 ltr:mr-2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    تحديث البيانات
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
