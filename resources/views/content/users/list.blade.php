@extends('layouts.app')
@section('content')
<div class="mx-auto p-6 space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-display font-bold text-slate-900 dark:text-slate-100">المستخدمين</h1>
            <p class="text-slate-600 dark:text-slate-400 mt-1">إدارة حسابات المستخدمين في النظام</p>
        </div>
        <div class="flex gap-2">
            <button id="create-user-btn" class="inline-flex items-center justify-center rounded-md font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none bg-primary-600 text-white hover:bg-primary-700 h-8 px-3 text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus w-4 h-4 ltr:mr-2 rtl:ml-2">
                    <path d="M5 12h14"></path>
                    <path d="M12 5v14"></path>
                </svg>
                إضافة مستخدم جديد
            </button>
        </div>
    </div>

    <!-- Search Section -->
    <div class="bg-white dark:bg-slate-800 rounded-lg shadow-sm border border-slate-200 dark:border-slate-700 mt-4">
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="md:col-span-1">
                    <label class="block text-sm font-medium mb-2 dark:text-slate-400">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search w-4 h-4 inline ltr:mr-1 rtl:ml-1">
                            <circle cx="11" cy="11" r="8"></circle>
                            <path d="m21 21-4.3-4.3"></path>
                        </svg>
                        بحث
                    </label>
                    <div class="w-full">
                        <input id="dataTables_my_filter" type="text" class="flex h-10 rounded-md border border-slate-300 bg-white px-3 py-2 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-transparent disabled:cursor-not-allowed disabled:opacity-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50 w-full" placeholder="ابحث بالاسم، اسم المستخدم، أو البريد الإلكتروني...">
                    </div>
                </div>
                <div class="flex items-end">
                    <button type="button" id="apply-search-btn" class="inline-flex items-center justify-center rounded-md font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none bg-primary-600 text-white hover:bg-primary-700 h-10 px-4 text-sm w-full">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search w-4 h-4 ltr:mr-2 rtl:ml-2">
                            <circle cx="11" cy="11" r="8"></circle>
                            <path d="m21 21-4.3-4.3"></path>
                        </svg>
                        بحث
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="bg-white dark:bg-slate-800 rounded-lg shadow-sm border border-slate-200 dark:border-slate-700 mt-4">
        <div class="p-0 m-0">
            <div class="space-y-4">
                <div class="w-full overflow-auto rounded-lg">
                    <table id="users-table" class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>المستخدم</th>
                                {{-- <th>البريد الإلكتروني</th> --}}
                                <th>تاريخ التسجيل</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
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

<!-- Create/Edit User Modal -->
<div id="userModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white dark:bg-slate-800 rounded-lg shadow-xl max-w-md w-full mx-4">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 id="userModalTitle" class="text-lg font-medium text-slate-900 dark:text-white">إضافة مستخدم جديد</h3>
                <button id="closeUserModalBtn" class="text-slate-400 hover:text-slate-500 dark:hover:text-slate-300">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x w-6 h-6">
                        <path d="M18 6 6 18"></path>
                        <path d="m6 6 12 12"></path>
                    </svg>
                </button>
            </div>
            <form id="userForm">
                <input type="hidden" id="userId" name="id">
                <div class="space-y-4">
                    <div>
                        <label for="fullName" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">الاسم الكامل</label>
                        <input type="text" id="fullName" name="full_name" required class="flex h-10 rounded-md border border-slate-300 bg-white px-3 py-2 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-transparent disabled:cursor-not-allowed disabled:opacity-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50 w-full" placeholder="أدخل الاسم الكامل">
                    </div>
                    <div>
                        <label for="username" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">اسم المستخدم</label>
                        <input type="text" id="username" name="username" required class="flex h-10 rounded-md border border-slate-300 bg-white px-3 py-2 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-transparent disabled:cursor-not-allowed disabled:opacity-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50 w-full" placeholder="أدخل اسم المستخدم">
                    </div>
                    {{-- <div>
                        <label for="email" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">البريد الإلكتروني</label>
                        <input type="email" id="email" name="email" required class="flex h-10 rounded-md border border-slate-300 bg-white px-3 py-2 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-transparent disabled:cursor-not-allowed disabled:opacity-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50 w-full" placeholder="أدخل البريد الإلكتروني">
                    </div> --}}
                    <div>
                        <label for="password" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">كلمة المرور</label>
                        <input type="password" id="password" name="password" {{ !isset($user) ? 'required' : '' }} class="flex h-10 rounded-md border border-slate-300 bg-white px-3 py-2 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-transparent disabled:cursor-not-allowed disabled:opacity-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50 w-full" placeholder="{{ isset($user) ? 'أدخل كلمة مرور جديدة (اتركها فارغة للحفاظ على الحالية)' : 'أدخل كلمة المرور' }}">
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">تأكيد كلمة المرور</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" {{ !isset($user) ? 'required' : '' }} class="flex h-10 rounded-md border border-slate-300 bg-white px-3 py-2 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-transparent disabled:cursor-not-allowed disabled:opacity-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50 w-full" placeholder="أعد إدخال كلمة المرور">
                    </div>
                </div>
                <div class="flex justify-end flex-row-reverse mt-6 space-x-4">
                    <button type="button" id="cancelUserBtn" class="px-4 py-2 bg-slate-200 dark:bg-slate-700 text-slate-800 dark:text-slate-200 rounded-md hover:bg-slate-300 dark:hover:bg-slate-600 transition-colors">
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
<div id="deleteUserModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
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
            <p class="text-center text-slate-500 dark:text-slate-400 mb-6">هل أنت متأكد من حذف المستخدم: <span id="deleteUserName" class="font-semibold"></span>؟ لا يمكن التراجع عن هذا الإجراء.</p>
            <div class="flex justify-center flex-row-reverse space-x-4">
                <button id="cancelDeleteUserBtn" class="px-4 py-2 bg-slate-200 dark:bg-slate-700 text-slate-800 dark:text-slate-200 rounded-md hover:bg-slate-300 dark:hover:bg-slate-600 transition-colors">
                    إلغاء
                </button>
                <button id="confirmDeleteUserBtn" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors">
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
  #users-table {
    width: 100%;
    caption-side: bottom;
    font-size: 0.875rem; /* text-sm */
    border-collapse: collapse;
  }
  #users-table thead {
    background-color: rgb(248 250 252); /* bg-slate-50 */
  }
  html.dark #users-table thead {
    background-color: rgb(30 41 59); /* dark:bg-slate-800 */
  }
  #users-table thead tr {
    border-bottom: 1px solid rgb(226 232 240); /* border-slate-200 */
    transition: background-color 0.2s;
  }
  html.dark #users-table thead tr {
    border-bottom: 1px solid rgb(51 65 85); /* dark:border-slate-700 */
  }
  #users-table thead tr:hover {
    background-color: rgb(248 250 252); /* hover:bg-slate-50 */
  }
  html.dark #users-table thead tr:hover {
    background-color: rgba(30, 41, 59, 0.5); /* dark:hover:bg-slate-800/50 */
  }
  #users-table tbody tr {
    border-bottom: 1px solid rgb(226 232 240);
    transition: background-color 0.2s;
  }
  html.dark #users-table tbody tr {
    border-bottom: 1px solid rgb(51 65 85);
  }
  #users-table tbody tr:hover {
    background-color: rgb(248 250 252);
  }
  html.dark #users-table tbody tr:hover {
    background-color: rgba(30, 41, 59, 0.5);
  }
  #users-table tbody td {
    padding: 1rem;
    vertical-align: middle;
    color: rgb(15 23 42); /* text-slate-900 */
  }
  html.dark #users-table tbody td {
    color: rgb(203 213 225); /* dark:text-slate-300 */
  }
  #users-table thead th {
    height: 3rem;
    padding-left: 1rem;
    padding-right: 1rem;
    vertical-align: middle;
    font-weight: 500;
    color: rgb(100 116 139); /* text-slate-500 */
  }
  html.ltr #users-table thead th {
    text-align: left;
  }
  html.rtl #users-table thead th {
    text-align: right;
  }
  html.dark #users-table thead th {
    color: rgb(148 163 184); /* dark:text-slate-400 */
  }
</style>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Initialize DataTable
    var table = $('#users-table').DataTable({
        language: {
            zeroRecords: `
                <div class="flex flex-col items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-slate-300 dark:text-slate-600">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.35-4.35"></path>
                        <line x1="8" x2="14" y1="11" y2="11"></line>
                    </svg>
                    <p class="text-slate-500 font-medium">لم يتم العثور على مستخدمين للفترة المحددة.</p>
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
                    <p class="text-slate-500 font-medium">لا توجد مستخدمين مسجلين في النظام.</p>
                </div>
            `,
        },
        ajax: {
            url: "{{ route('users') }}",
            data: function(d) {
                d.search = $('#dataTables_my_filter').val();
            }
        },
        columns: [
            { data: 'id', name: 'id', title: 'المعرف' },
            { data: 'full_name', name: 'full_name', title: 'المستخدم' },
            // { data: 'email', name: 'email', title: 'البريد الإلكتروني' },
            { data: 'created_at', name: 'created_at', title: 'تاريخ التسجيل' },
            { data: 'action', name: 'action', title: 'الإجراءات', orderable: false, searchable: false }
        ],
        order: [[0, 'desc']],
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
        $("#users-table").addClass("w-full caption-bottom text-sm border-collapse");
        $("#users-table thead").addClass("bg-slate-50 dark:bg-slate-800");
        $("#users-table thead tr").addClass("border-b border-slate-200 dark:border-slate-700 transition-colors hover:bg-slate-50 dark:hover:bg-slate-800/50");
        $("#users-table tbody tr").addClass("border-b border-slate-200 dark:border-slate-700 transition-colors hover:bg-slate-50 dark:hover:bg-slate-800/50");
        $("#users-table tbody td").addClass("p-4 align-middle text-slate-900 dark:text-slate-300");
        $("#users-table thead th").addClass("h-12 px-4 ltr:text-left rtl:text-right align-middle font-medium text-slate-500 dark:text-slate-400");
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
    $('#apply-search-btn').on('click', function() {
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

    // Create User Modal
    $('#create-user-btn').on('click', function() {
        $('#userModalTitle').text('إضافة مستخدم جديد');
        $('#userForm')[0].reset();
        $('#userId').val('');
        $('#password').attr('required', true);
        $('#password_confirmation').attr('required', true);
        $('#userModal').removeClass('hidden').addClass('flex');
    });

    // Edit User Modal
    $(document).on('click', '.edit-user-btn', function() {
        var userId = $(this).data('id');

        // Get user details via AJAX
        $.ajax({
            url: '/users/' + userId,
            type: 'GET',
            success: function(response) {
                $('#userModalTitle').text('تعديل المستخدم');
                $('#userId').val(response.id);
                $('#fullName').val(response.full_name);
                $('#username').val(response.username);
                $('#email').val(response.email);
                $('#password').removeAttr('required');
                $('#password_confirmation').removeAttr('required');
                $('#password').val('');
                $('#password_confirmation').val('');

                $('#userModal').removeClass('hidden').addClass('flex');
            },
            error: function(xhr) {
                showNotification('حدث خطأ أثناء جلب بيانات المستخدم', 'error');
            }
        });
    });

    // User Form Submit
    $('#userForm').on('submit', function(e) {
        e.preventDefault();
        var userId = $('#userId').val();
        var url = userId ? '/users/' + userId : '/users/create';
        var method = userId ? 'PUT' : 'POST';

        // For edit, if password is empty, remove it from the form data
        if (userId && !$('#password').val()) {
            $('#password').removeAttr('name');
            $('#password_confirmation').removeAttr('name');
        } else {
            $('#password').attr('name', 'password');
            $('#password_confirmation').attr('name', 'password_confirmation');
        }

        $.ajax({
            url: url,
            type: method,
            data: $(this).serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                $('#userModal').addClass('hidden').removeClass('flex');
                showNotification(userId ? 'تم تحديث المستخدم بنجاح' : 'تم إضافة المستخدم بنجاح', 'success');
                table.ajax.reload();
            },
            error: function(xhr) {
                // Restore password fields if they were removed
                $('#password').attr('name', 'password');
                $('#password_confirmation').attr('name', 'password_confirmation');

                var errors = xhr.responseJSON.errors;
                var errorMessage = 'حدث خطأ أثناء حفظ المستخدم';

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

    // Close User Modal
    $('#closeUserModalBtn, #cancelUserBtn').on('click', function() {
        $('#userModal').addClass('hidden').removeClass('flex');
    });

    // Delete User Modal
    $(document).on('click', '.delete-user-btn', function() {
        var userId = $(this).data('id');
        var userName = $(this).data('full_name');
        var deleteUrl = $(this).data('url');

        $('#deleteUserName').text(userName);
        $('#deleteUserModal').removeClass('hidden').addClass('flex');

        $('#confirmDeleteUserBtn').off('click').on('click', function() {
            $.ajax({
                url: deleteUrl,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#deleteUserModal').addClass('hidden').removeClass('flex');
                    showNotification('تم حذف المستخدم بنجاح', 'success');
                    table.ajax.reload();
                },
                error: function(xhr) {
                    $('#deleteUserModal').addClass('hidden').removeClass('flex');
                    showNotification('حدث خطأ أثناء حذف المستخدم', 'error');
                }
            });
        });
    });

    $('#cancelDeleteUserBtn').on('click', function() {
        $('#deleteUserModal').addClass('hidden').removeClass('flex');
    });

    // Close modals when clicking outside
    $(document).on('click', function(e) {
        if ($(e.target).is('#userModal')) {
            $('#userModal').addClass('hidden').removeClass('flex');
        }
        if ($(e.target).is('#deleteUserModal')) {
            $('#deleteUserModal').addClass('hidden').removeClass('flex');
        }
    });

    // Also close modals when pressing Escape key
    $(document).on('keydown', function(e) {
        if (e.key === 'Escape') {
            $('#userModal').addClass('hidden').removeClass('flex');
            $('#deleteUserModal').addClass('hidden').removeClass('flex');
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
});
</script>
@endsection
