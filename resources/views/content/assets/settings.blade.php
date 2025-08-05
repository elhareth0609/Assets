@extends('layouts.app')

@section('content')
<div class="mx-auto p-6 space-y-6">
    {{-- Header --}}
    <div>
        <h1 class="text-3xl font-display font-bold text-slate-900 dark:text-slate-100">إعدادات الحساب</h1>
        <p class="text-slate-600 dark:text-slate-400 mt-1">إدارة معلوماتك الشخصية وتفضيلات الأمان.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">

            {{-- Profile Information Card --}}
            <div class="bg-white dark:bg-slate-800 rounded-lg shadow-sm border border-slate-200 dark:border-slate-700">
                <form action="{{-- {{ route('profile.update') }} --}}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="p-6 border-b border-slate-200 dark:border-slate-700">
                        <h3 class="text-lg font-semibold text-slate-900 dark:text-white">معلومات الملف الشخصي</h3>
                        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">قم بتحديث معلوماتك الشخصية الظاهرة في النظام.</p>
                    </div>
                    <div class="p-6 space-y-4">
                        <div>
                            <label for="full_name" class="block text-sm font-medium mb-2 dark:text-slate-400">الاسم الكامل</label>
                            <input type="text" id="full_name" name="full_name" value="{{-- {{ auth()->user()->full_name }} --}}المدير العام" class="flex h-10 w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50" required>
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium mb-2 dark:text-slate-400">البريد الإلكتروني</label>
                            <input type="email" id="email" name="email" value="{{-- {{ auth()->user()->email }} --}}admin@example.com" class="flex h-10 w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50" required>
                        </div>
                    </div>
                    <div class="p-6 bg-slate-50 dark:bg-slate-800/50 border-t border-slate-200 dark:border-slate-700 flex justify-end">
                        <button type="submit" class="inline-flex items-center justify-center rounded-md font-medium bg-primary-600 text-white hover:bg-primary-700 h-10 px-4 text-sm">
                            حفظ التغييرات
                        </button>
                    </div>
                </form>
            </div>

            {{-- Change Password Card --}}
            <div class="bg-white dark:bg-slate-800 rounded-lg shadow-sm border border-slate-200 dark:border-slate-700">
                <form action="{{-- {{ route('password.update') }} --}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="p-6 border-b border-slate-200 dark:border-slate-700">
                        <h3 class="text-lg font-semibold text-slate-900 dark:text-white">تغيير كلمة المرور</h3>
                        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">تأكد من استخدام كلمة مرور قوية وآمنة.</p>
                    </div>
                    <div class="p-6 space-y-4">
                        <div>
                            <label for="current_password" class="block text-sm font-medium mb-2 dark:text-slate-400">كلمة المرور الحالية</label>
                            <input type="password" id="current_password" name="current_password" class="flex h-10 w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50" required>
                        </div>
                        <div>
                            <label for="password" class="block text-sm font-medium mb-2 dark:text-slate-400">كلمة المرور الجديدة</label>
                            <input type="password" id="password" name="password" class="flex h-10 w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50" required>
                        </div>
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium mb-2 dark:text-slate-400">تأكيد كلمة المرور الجديدة</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="flex h-10 w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50" required>
                        </div>
                    </div>
                    <div class="p-6 bg-slate-50 dark:bg-slate-800/50 border-t border-slate-200 dark:border-slate-700 flex justify-end">
                        <button type="submit" class="inline-flex items-center justify-center rounded-md font-medium bg-primary-600 text-white hover:bg-primary-700 h-10 px-4 text-sm">
                            تحديث كلمة المرور
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
