@extends('layouts.app')

@php
    $isNavbar = false;
    $isSidebar = false;
    $isFooter = false;
    $isContainer = false;
@endphp

@section('title', __('Login'))

@section('content')
{{-- <body class="font-sans text-slate-900 bg-slate-100 dark:bg-slate-900 dark:text-slate-200 antialiased"> --}}
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div>
            <a href="/">
                {{-- You can place your logo here --}}
                <h1 class="text-4xl font-bold text-primary-600">نظام الأصول</h1>
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
                        تسجيل الدخول
                    </button>
                </div>
            </form>
        </div>
    </div>

<script>
$(document).ready(function() {
    $('#loginForm').submit(function(event) {
        event.preventDefault();

        $('#loading').show();
        var formData = $(this).serialize();

        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: formData,
            success: function(response) {
                $('#loading').hide();
                window.location.href = ("{{ route('home') }}");
            },
            error: function(xhr, textStatus, errorThrown) {
                $('#loading').hide();
                const response = JSON.parse(xhr.responseText);
                if ($('#error-alert').hasClass('d-none')) {
                    $('#error-alert').removeClass('d-none').text(response.message);
                } else {
                    $('#error-alert').text(response.message);
                }
            }
            });
    });
});
</script>
@endsection
