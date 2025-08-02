@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-display font-bold text-slate-900 dark:text-slate-100">تفاصيل الأصل</h1>
            <p class="text-slate-600 dark:text-slate-400 mt-1">{{ $asset->asset_name }}</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('assets') }}" class="inline-flex items-center justify-center rounded-md font-medium h-8 px-3 text-sm bg-transparent border border-slate-300 dark:border-slate-700 hover:bg-slate-100 dark:hover:bg-slate-800">
                 العودة للسجل
            </a>
            <a href="{{-- {{ route('assets.edit', $asset->id) }} --}}" class="inline-flex items-center justify-center rounded-md font-medium bg-orange-500 text-white hover:bg-orange-600 h-8 px-3 text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-edit w-4 h-4 rtl:ml-2 ltr:mr-2"><path d="M7 7H6a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2-2v-1"/><path d="M20.385 6.585a2.1 2.1 0 0 0-2.97-2.97L9 12v3h3l8.385-8.415Z"/><path d="m16 5 3 3"/></svg>
                تعديل
            </a>
        </div>
    </div>

    <div class="bg-white dark:bg-slate-800 rounded-lg shadow-sm border border-slate-200 dark:border-slate-700 mt-4">
        <div class="grid grid-cols-1 md:grid-cols-3">
            <!-- Barcode Section -->
            <div class="md:col-span-1 p-6 flex flex-col items-center justify-center border-b md:border-b-0 md:border-l border-slate-200 dark:border-slate-700">
                <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">باركود الأصل</h3>
                <div class="p-4 bg-white rounded-md">
                    {{-- Here you would generate the QR code SVG or Image --}}
                    {{-- Example using a placeholder SVG --}}
                    <svg xmlns="http://www.w3.org/2000/svg" width="160" height="160" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-qr-code"><rect width="5" height="5" x="3" y="3" rx="1"/><rect width="5" height="5" x="16" y="3" rx="1"/><rect width="5" height="5" x="3" y="16" rx="1"/><path d="M21 16h-3a2 2 0 0 0-2 2v3"/><path d="M21 21v.01"/><path d="M12 7v3a2 2 0 0 1-2 2H7"/><path d="M3 12h.01"/><path d="M12 3h.01"/><path d="M12 16v.01"/><path d="M16 12h1"/><path d="M21 12v.01"/><path d="M12 21v-1"/></svg>
                </div>
                <p class="mt-4 font-mono text-lg text-slate-800 dark:text-slate-300">{{ $asset->asset_number }}</p>
                <button class="mt-4 inline-flex items-center justify-center rounded-md font-medium bg-primary-600 text-white hover:bg-primary-700 h-8 px-3 text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-printer w-4 h-4 rtl:ml-2 ltr:mr-2"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect width="12" height="8" x="6" y="14"/></svg>
                    طباعة الباركود
                </button>
            </div>

            <!-- Details Section -->
            <div class="md:col-span-2 p-6">
                 <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-6">كافة التفاصيل</h3>
                 <div class="space-y-4">
                    <div class="flex justify-between items-center pb-2 border-b border-slate-200 dark:border-slate-700">
                        <span class="text-sm font-medium text-slate-500 dark:text-slate-400">اسم الأصل</span>
                        <span class="text-sm font-semibold text-slate-800 dark:text-slate-200">{{ $asset->asset_name }}</span>
                    </div>
                     <div class="flex justify-between items-center pb-2 border-b border-slate-200 dark:border-slate-700">
                        <span class="text-sm font-medium text-slate-500 dark:text-slate-400">نوع الأصل</span>
                        <span class="text-sm text-slate-800 dark:text-slate-200">{{-- {{ $asset->type->name }} --}} أجهزة لابتوب</span>
                    </div>
                    <div class="flex justify-between items-center pb-2 border-b border-slate-200 dark:border-slate-700">
                        <span class="text-sm font-medium text-slate-500 dark:text-slate-400">الحالة الحالية</span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-400">
                            {{ $asset->status }}
                        </span>
                    </div>
                    <div class="flex justify-between items-center pb-2 border-b border-slate-200 dark:border-slate-700">
                        <span class="text-sm font-medium text-slate-500 dark:text-slate-400">المستخدم الحالي</span>
                        <span class="text-sm text-slate-800 dark:text-slate-200">{{-- {{ $asset->user->full_name ?? 'غير مخصص' }} --}} أحمد محمد علي</span>
                    </div>
                    <div class="flex justify-between items-center pb-2 border-b border-slate-200 dark:border-slate-700">
                        <span class="text-sm font-medium text-slate-500 dark:text-slate-400">تاريخ الشراء</span>
                        <span class="text-sm text-slate-800 dark:text-slate-200">{{ $asset->purchase_date }}</span>
                    </div>
                    <div class="flex justify-between items-center pb-2">
                        <span class="text-sm font-medium text-slate-500 dark:text-slate-400">تاريخ الإضافة للنظام</span>
                        <span class="text-sm text-slate-800 dark:text-slate-200">{{ $asset->created_at }}</span>
                    </div>
                    <div class="pt-4 border-t border-slate-200 dark:border-slate-700">
                        <span class="text-sm font-medium text-slate-500 dark:text-slate-400">ملاحظات</span>
                        <p class="mt-2 text-sm text-slate-800 dark:text-slate-200">{{ $asset->notes ?? 'لا توجد ملاحظات مسجلة.' }}</p>
                    </div>
                 </div>
            </div>
        </div>
    </div>
</div>
@endsection
