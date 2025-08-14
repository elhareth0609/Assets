@extends('layouts.app')

@section('title', __('إعدادات الحساب'))


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
                <form action="{{ route('settings.account.update') }}" method="POST" id="editProfileForm">
                    @csrf
                    <div class="p-6 border-b border-slate-200 dark:border-slate-700">
                        <h3 class="text-lg font-semibold text-slate-900 dark:text-white">معلومات الملف الشخصي</h3>
                        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">قم بتحديث معلوماتك الشخصية الظاهرة في النظام.</p>
                    </div>
                    <div class="p-6 space-y-4">
                        <div>
                            <label for="username" class="block text-sm font-medium mb-2 dark:text-slate-400">اسم المستخدم</label>
                            <input type="text" id="username" name="username" value="{{ auth()->user()->username }}" class="flex h-10 w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50" required>
                        </div>
                        <div>
                            <label for="full_name" class="block text-sm font-medium mb-2 dark:text-slate-400">الاسم الكامل</label>
                            <input type="text" id="full_name" name="full_name" value="{{ auth()->user()->full_name }}" class="flex h-10 w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50" required>
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium mb-2 dark:text-slate-400">البريد الإلكتروني</label>
                            <input type="email" id="email" name="email" value="{{ auth()->user()->email }}" class="flex h-10 w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50" required>
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
                <form action="{{ route('settings.account.password') }}" method="POST" id="editPasswordForm">
                    @csrf
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

@section('scripts')
    <script>
        $(document).ready(function () {
            $('#editProfileForm').on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);

                var form = $(this);
                var submitButton = form.find('button[type="submit"]');
                var email = form.find('#email');
                var full_name = form.find('#full_name');
                var username = form.find('#username');
                var originalButtonText = submitButton.html();

                email.prop('disabled', true);
                full_name.prop('disabled', true);
                username.prop('disabled', true);
                submitButton.prop('disabled', true);
                submitButton.html(`
                    <svg class="animate-spin ml-3 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
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
                    success: function (response) {
                        showNotification('تم التعديل بنجاح', 'success');
                    },
                    error: function(xhr) {
                        var errors = xhr.responseJSON.errors;
                        var errorMessage = 'حدث خطأ أثناء التعديل';

                        if (errors && errors.name) {
                            errorMessage = errors.name[0];
                        }

                        showNotification(errorMessage, 'error');
                    },
                    complete: function() {
                        email.prop('disabled', false);
                        full_name.prop('disabled', false);
                        username.prop('disabled', false);
                        submitButton.prop('disabled', false);
                        submitButton.html(originalButtonText);
                    }
                });
            });
        });

        $('#editPasswordForm').submit(function(event) {
            event.preventDefault();
            var formData = new FormData(this);

            var form = $(this);
            var submitButton = form.find('button[type="submit"]');
            var password_confirmation = form.find('#password_confirmation');
            var password = form.find('#password');
            var current_password = form.find('#current_password');
            var originalButtonText = submitButton.html();

            password_confirmation.prop('disabled', true);
            password.prop('disabled', true);
            current_password.prop('disabled', true);
            submitButton.prop('disabled', true);
            submitButton.html(`
                <svg class="animate-spin ml-3 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
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
                    success: function (response) {
                        showNotification('تم التعديل بنجاح', 'success');
                    },
                error: function(xhr) {
                    var errors = xhr.responseJSON.errors;
                    var errorMessage = 'حدث خطأ أثناء التعديل';

                    if (errors && errors.name) {
                        errorMessage = errors.name[0];
                    }

                    showNotification(errorMessage, 'error');
                },
                complete: function() {
                    current_password.prop('disabled', false);
                    password_confirmation.prop('disabled', false);
                    password.prop('disabled', false);
                    submitButton.prop('disabled', false);
                    submitButton.html(originalButtonText);
                }
            });
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

    </script>
@endsection
