@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 space-y-6">
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-display font-bold text-slate-900 dark:text-slate-100">أنواع الأصول</h1>
            <p class="text-slate-600 dark:text-slate-400 mt-1">إدارة وتصنيف أنواع الأصول في المؤسسة.</p>
        </div>
        <div class="flex gap-2">
            <button
                {{-- This button will trigger the 'Create' modal --}}
                onclick="document.getElementById('createTypeModal').classList.remove('hidden')"
                class="inline-flex items-center justify-center rounded-md font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-offset-2 bg-primary-600 text-white hover:bg-primary-700 h-8 px-3 text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus w-4 h-4 ltr:mr-2 rtl:ml-2">
                    <path d="M5 12h14"/><path d="M12 5v14"/>
                </svg>
                إضافة نوع جديد
            </button>
        </div>
    </div>

    {{-- Main Table Card --}}
    <div class="bg-white dark:bg-slate-800 rounded-lg shadow-sm border border-slate-200 dark:border-slate-700 mt-4">
        <div class="p-0 m-0">
            <div class="w-full overflow-auto rounded-lg">
                <table class="w-full caption-bottom text-sm">
                    <thead class="bg-slate-50 dark:bg-slate-800">
                        <tr class="border-b border-slate-200 dark:border-slate-700">
                            <th class="h-12 px-4 rtl:text-right align-middle font-medium text-slate-500 dark:text-slate-400">#</th>
                            <th class="h-12 px-4 rtl:text-right align-middle font-medium text-slate-500 dark:text-slate-400">اسم النوع</th>
                            <th class="h-12 px-4 text-center align-middle font-medium text-slate-500 dark:text-slate-400">عدد الأصول</th>
                            <th class="h-12 px-4 rtl:text-right align-middle font-medium text-slate-500 dark:text-slate-400">تاريخ الإنشاء</th>
                            <th class="h-12 px-4 text-center align-middle font-medium text-slate-500 dark:text-slate-400">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody class="">
                        {{-- Example Row 1 --}}
                        <tr class="border-b border-slate-200 dark:border-slate-700 transition-colors hover:bg-slate-50 dark:hover:bg-slate-800/50">
                            <td class="p-4 align-middle text-slate-900 dark:text-slate-300">1</td>
                            <td class="p-4 align-middle font-medium text-slate-900 dark:text-slate-300">أجهزة لابتوب</td>
                            <td class="p-4 text-center align-middle text-slate-900 dark:text-slate-300">
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300">
                                    {{-- {{ $type->assets_count }} --}} 45
                                </span>
                            </td>
                            <td class="p-4 align-middle text-slate-900 dark:text-slate-300">01 يناير 2024</td>
                            <td class="p-4 text-center align-middle">
                                <div class="flex justify-center gap-2">
                                    <button onclick="document.getElementById('editTypeModal').classList.remove('hidden')" class="inline-flex items-center justify-center rounded-md p-2 font-medium text-orange-600 hover:text-orange-700 hover:bg-orange-50 dark:text-orange-400 dark:hover:bg-orange-900/20">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-edit w-4 h-4"><path d="M7 7H6a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2-2v-1"/><path d="M20.385 6.585a2.1 2.1 0 0 0-2.97-2.97L9 12v3h3l8.385-8.415Z"/><path d="m16 5 3 3"/></svg>
                                    </button>
                                    <button class="inline-flex items-center justify-center rounded-md p-2 font-medium text-red-600 hover:text-red-700 hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-900/20">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash2 w-4 h-4"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        {{-- Example Row 2 --}}
                        <tr class="border-b border-slate-200 dark:border-slate-700 transition-colors hover:bg-slate-50 dark:hover:bg-slate-800/50">
                            <td class="p-4 align-middle text-slate-900 dark:text-slate-300">2</td>
                            <td class="p-4 align-middle font-medium text-slate-900 dark:text-slate-300">أثاث مكتبي</td>
                            <td class="p-4 text-center align-middle text-slate-900 dark:text-slate-300">
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300">
                                    {{-- {{ $type->assets_count }} --}} 22
                                </span>
                            </td>
                            <td class="p-4 align-middle text-slate-900 dark:text-slate-300">01 يناير 2024</td>
                            <td class="p-4 text-center align-middle">
                                <div class="flex justify-center gap-2">
                                    <button onclick="document.getElementById('editTypeModal').classList.remove('hidden')" class="inline-flex items-center justify-center rounded-md p-2 font-medium text-orange-600 hover:text-orange-700 hover:bg-orange-50 dark:text-orange-400 dark:hover:bg-orange-900/20">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-edit w-4 h-4"><path d="M7 7H6a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2-2v-1"/><path d="M20.385 6.585a2.1 2.1 0 0 0-2.97-2.97L9 12v3h3l8.385-8.415Z"/><path d="m16 5 3 3"/></svg>
                                    </button>
                                    <button class="inline-flex items-center justify-center rounded-md p-2 font-medium text-red-600 hover:text-red-700 hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-900/20">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash2 w-4 h-4"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            {{-- Pagination would go here --}}
        </div>
    </div>
</div>

{{-- Create Modal --}}
<div id="createTypeModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white dark:bg-slate-800 rounded-lg shadow-lg w-full max-w-md">
        <div class="p-6 border-b border-slate-200 dark:border-slate-700 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-slate-900 dark:text-white">إضافة نوع جديد</h3>
            <button onclick="document.getElementById('createTypeModal').classList.add('hidden')" class="text-slate-500 hover:text-slate-800 dark:hover:text-slate-300">×</button>
        </div>
        <form action="{{-- {{ route('asset-types.store') }} --}}" method="POST">
            @csrf
            <div class="p-6">
                <label for="name" class="block text-sm font-medium mb-2 text-slate-700 dark:text-slate-300">اسم النوع</label>
                <input type="text" id="name" name="name" class="flex h-10 w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50" placeholder="مثال: هواتف جوالة" required>
            </div>
            <div class="p-6 border-t border-slate-200 dark:border-slate-700 flex justify-end gap-2">
                <button type="button" onclick="document.getElementById('createTypeModal').classList.add('hidden')" class="inline-flex items-center justify-center rounded-md font-medium h-10 px-4 text-sm bg-transparent border border-slate-300 dark:border-slate-700 hover:bg-slate-100 dark:hover:bg-slate-800">إلغاء</button>
                <button type="submit" class="inline-flex items-center justify-center rounded-md font-medium bg-primary-600 text-white hover:bg-primary-700 h-10 px-4 text-sm">حفظ</button>
            </div>
        </form>
    </div>
</div>

{{-- Edit Modal --}}
<div id="editTypeModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white dark:bg-slate-800 rounded-lg shadow-lg w-full max-w-md">
        <div class="p-6 border-b border-slate-200 dark:border-slate-700 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-slate-900 dark:text-white">تعديل نوع الأصل</h3>
            <button onclick="document.getElementById('editTypeModal').classList.add('hidden')" class="text-slate-500 hover:text-slate-800 dark:hover:text-slate-300">×</button>
        </div>
        <form action="{{-- {{ route('asset-types.update', $type->id) }} --}}" method="POST">
            @csrf
            @method('PUT')
            <div class="p-6">
                <label for="edit_name" class="block text-sm font-medium mb-2 text-slate-700 dark:text-slate-300">اسم النوع</label>
                <input type="text" id="edit_name" name="name" value="أجهزة لابتوب" class="flex h-10 w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50" required>
            </div>
            <div class="p-6 border-t border-slate-200 dark:border-slate-700 flex justify-end gap-2">
                <button type="button" onclick="document.getElementById('editTypeModal').classList.add('hidden')" class="inline-flex items-center justify-center rounded-md font-medium h-10 px-4 text-sm bg-transparent border border-slate-300 dark:border-slate-700 hover:bg-slate-100 dark:hover:bg-slate-800">إلغاء</button>
                <button type="submit" class="inline-flex items-center justify-center rounded-md font-medium bg-primary-600 text-white hover:bg-primary-700 h-10 px-4 text-sm">تحديث</button>
            </div>
        </form>
    </div>
</div>
@endsection