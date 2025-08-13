@extends('layouts.app')

@php
    $isNavbar = false;
    $isSidebar = false;
    $isFooter = false;
    $isContainer = false;
@endphp

@section('title', __('تسجيل الدخول'))

@section('content')
{{-- <body class="font-sans text-slate-900 bg-slate-100 dark:bg-slate-900 dark:text-slate-200 antialiased"> --}}
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div>
            <a href="/">
                {{-- You can place your logo here --}}
                <img src="{{ asset('assets/img/icon1.png') }}" alt="Asset Management Icon" class="size-full text-[#0783a1] dark:text-[#0783a1] flex-shrink-0">
                {{-- <h1 class="text-4xl font-bold text-primary-600">نظام الأصول</h1> --}}
            </a>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white dark:bg-slate-800 shadow-md overflow-hidden sm:rounded-lg border border-slate-200 dark:border-slate-700">
            <h2 class="text-center text-2xl font-bold text-slate-800 dark:text-slate-200 mb-2">تسجيل الدخول</h2>
            <p class="text-center text-sm text-slate-600 dark:text-slate-400 mb-6">مرحباً بك مجدداً! أدخل بياناتك للوصول للنظام.</p>

            <!-- Session Status -->
            {{-- <x-auth-session-status class="mb-4" :status="session('status')" /> --}}

            <form id="loginForm" action="{{ route('auth.login.action') }}" method="POST">
                @csrf

                <!-- Username or Email -->
                <div class="mb-4">
                    <label for="username" class="block text-sm font-medium mb-2 text-slate-700 dark:text-slate-300">اسم المستخدم أو البريد الإلكتروني</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 rtl:right-0 ltr:left-0 flex items-center rtl:pr-3 ltr:pl-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user w-5 h-5 text-slate-400"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        </span>
                        <input id="username" type="text" name="username" :value="old('username')" required autofocus
                            class="flex h-10 w-full rounded-md border border-slate-300 bg-white rtl:pr-10 ltr:pl-10 px-3 py-2 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-transparent disabled:cursor-not-allowed disabled:opacity-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50"
                            placeholder="ادخل اسم المستخدم">
                    </div>
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium mb-2 text-slate-700 dark:text-slate-300">كلمة المرور</label>
                     <div class="relative">
                        <span class="absolute inset-y-0 rtl:right-0 ltr:left-0 flex items-center rtl:pr-3 ltr:pl-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-lock w-5 h-5 text-slate-400"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                        </span>
                        <input id="password" type="password" name="password" required
                            class="flex h-10 w-full rounded-md border border-slate-300 bg-white rtl:pr-10 ltr:pl-10 px-3 py-2 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-transparent disabled:cursor-not-allowed disabled:opacity-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50"
                            placeholder="********">
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-slate-300 dark:border-slate-600 text-primary-600 shadow-sm focus:ring-primary-500" name="remember">
                        <span class="ms-2 text-sm text-slate-600 dark:text-slate-400">تذكرني</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-6">
                        <button type="submit" class="inline-flex w-full items-center justify-center rounded-md font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none bg-primary-600 text-white hover:bg-primary-700 h-10 px-4 text-sm">
                            <span class="button-text">تسجيل الدخول</span>
                            <svg class="animate-spin ml-3 h-4 w-4 text-white hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </button>

                </div>
            </form>
        </div>
    </div>

<script>
$(document).ready(function() {
    const form = $('#loginForm');
    const submitButton = form.find('button[type="submit"]');
    const buttonText = submitButton.find('.button-text');
    const loadingSpinner = submitButton.find('svg');
    const inputs = form.find('input');

    form.submit(function(event) {
        event.preventDefault();
        
        var formData = new FormData(this);
        // 禁用输入和按钮
        inputs.prop('disabled', true);
        submitButton.prop('disabled', true);
        buttonText.addClass('hidden');
        loadingSpinner.removeClass('hidden');

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
                showNotification('success', 'تم تسجيل الدخول بنجاح');
                setTimeout(function() {
                    window.location.href = "{{ route('home') }}";
                }, 1500);
            },
            error: function(xhr) {
                const response = xhr.responseJSON;
                showNotification('error', response.message || 'فشل تسجيل الدخول');
                resetForm();
            }
        });
    });

    function resetForm() {
        inputs.prop('disabled', false);
        submitButton.prop('disabled', false);
        buttonText.removeClass('hidden');
        loadingSpinner.addClass('hidden');
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
