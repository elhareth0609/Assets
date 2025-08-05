<?php
namespace App\DataTables;
use App\Models\Asset;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
class AssetsDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function($row){
                $actions = '';

                $actions .= '<div class="relative group inline-block">
                    <a href="'.route('assets.show', $row->id).'"
                        class="inline-flex items-center justify-center rounded-md font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none bg-transparent h-8 px-3 text-sm text-blue-600 hover:text-blue-700 hover:bg-blue-50 dark:text-blue-400 dark:hover:bg-blue-900/20">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye w-4 h-4">
                            <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                    </a>
                    <div class="absolute z-10 whitespace-nowrap px-2 py-1 text-xs text-white bg-black rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none bottom-full mb-1 left-1/2 transform -translate-x-1/2">عرض</div>
                </div>';

                $actions .= '<div class="relative group inline-block">
                    <a href="'.route('assets.edit', $row->id).'"
                        class="inline-flex items-center justify-center rounded-md font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none bg-transparent h-8 px-3 text-sm text-orange-600 hover:text-orange-700 hover:bg-orange-50 dark:text-orange-400 dark:hover:bg-orange-900/20">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-edit w-4 h-4">
                                <path d="M7 7H6a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2-2v-1"></path>
                                <path d="M20.385 6.585a2.1 2.1 0 0 0-2.97-2.97L9 12v3h3l8.385-8.415Z"></path>
                            <path d="m16 5 3 3"></path>
                        </svg>
                    </a>
                    <div class="absolute z-10 whitespace-nowrap px-2 py-1 text-xs text-white bg-black rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none bottom-full mb-1 left-1/2 transform -translate-x-1/2">تعديل</div>
                </div>';

                $actions .= '<div class="relative group inline-block">
                    <button type="button"
                        class="inline-flex items-center justify-center rounded-md font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none bg-transparent h-8 px-3 text-sm text-purple-600 hover:text-purple-700 hover:bg-purple-50 dark:text-purple-400 dark:hover:bg-purple-900/20 qr-btn"
                        data-id="'.$row->id.'">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-qr-code w-4 h-4">
                                <rect width="5" height="5" x="3" y="3" rx="1"></rect>
                                <rect width="5" height="5" x="16" y="3" rx="1"></rect>
                                <rect width="5" height="5" x="3" y="16" rx="1"></rect>
                                <path d="M21 16h-3a2 2 0 0 0-2 2v3"></path>
                                <path d="M21 21v.01"></path>
                                <path d="M12 7v3a2 2 0 0 1-2 2H7"></path>
                                <path d="M3 12h.01"></path>
                                <path d="M12 3h.01"></path>
                                <path d="M12 16v.01"></path>
                                <path d="M16 12h1"></path>
                                <path d="M21 12v.01"></path>
                                <path d="M12 21v-1"></path>
                            </svg>
                    </button>
                    <div class="absolute z-10 whitespace-nowrap px-2 py-1 text-xs text-white bg-black rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none bottom-full mb-1 left-1/2 transform -translate-x-1/2">باركود</div>
                </div>';

                $actions .= '<div class="relative group inline-block">
                    <button type="button"
                        class="inline-flex items-center justify-center rounded-md font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none bg-transparent h-8 px-3 text-sm text-red-600 hover:text-red-700 hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-900/20 delete-btn"
                        data-id="'.$row->id.'"
                        data-url="'.route('assets.delete', $row->id).'"
                        data-name="'.$row->name.'">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash2 w-4 h-4">
                            <path d="M3 6h18"></path>
                            <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                            <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                            <line x1="10" x2="10" y1="11" y2="17"></line>
                            <line x1="14" x2="14" y1="11" y2="17"></line>
                            </svg>
                        </button>
                    <div class="absolute z-10 whitespace-nowrap px-2 py-1 text-xs text-white bg-black rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none bottom-full mb-1 left-1/2 transform -translate-x-1/2">حذف</div>
                </div>';

                return '<div class="flex ltr:justify-end rtl:justify-start gap-1">'.$actions.'</div>';
            })
            ->editColumn('purchase_date', function ($asset) {
                return $asset->purchase_date ?
                    '<span class="text-slate-600 dark:text-slate-400 text-sm">'.date('d/m/Y', strtotime($asset->purchase_date)).'</span>' :
                    '<span class="text-slate-400 dark:text-slate-500 text-sm">-</span>';
            })
            ->editColumn('status', function ($asset) {
                $statusConfig = [
                    'in_use' => ['label' => 'قيد الاستخدام', 'class' => 'bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-400'],
                    'in_storage' => ['label' => 'في المستودع', 'class' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/20 dark:text-blue-400'],
                    'maintenance' => ['label' => 'في الصيانة', 'class' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/20 dark:text-yellow-400'],
                    'damaged' => ['label' => 'تالف', 'class' => 'bg-red-100 text-red-800 dark:bg-red-900/20 dark:text-red-400']
                ];
                $config = $statusConfig[$asset->status->value] ?? ['label' => $asset->status->value, 'class' => 'bg-slate-100 text-slate-800 dark:bg-slate-900/20 dark:text-slate-400'];
                return '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium '.$config['class'].'">'.$config['label'].'</span>';
            })
            ->editColumn('name', function ($asset) {
                return '<strong class="text-slate-900 dark:text-slate-300">'.$asset->name.'</strong>';
            })
            ->editColumn('number', function ($asset) {
                return '<span class="font-mono bg-slate-100 dark:bg-slate-800 text-slate-800 dark:text-slate-300 px-2 py-1 rounded text-sm">'.$asset->number.'</span>';
            })
            ->filter(function ($query) {
                // Handle custom filters
                if (request()->has('asset_type') && request('asset_type') != '') {
                    $query->where('asset_type', request('asset_type'));
                }
                if (request()->has('status') && request('status') != '') {
                    $query->where('status', request('status'));
                }

                // Fixed search implementation
                if (request()->has('searchi') && request('searchi') != '') {
                    $searchi = request('searchi');
                    $query->where(function($q) use ($searchi) {
                        $q->where('name', 'like', "%{$searchi}%")
                            ->orWhere('number', 'like', "%{$searchi}%")
                            ->orWhere('id', 'like', "%{$searchi}%");
                    });
                }
            })
            ->addIndexColumn()
            ->rawColumns(['action', 'status', 'name', 'number', 'purchase_date']);
    }

    public function query(Asset $model)
    {
        return $model->newQuery()
            ->select(['id', 'name', 'number', 'purchase_date', 'status', 'created_at'])
            ->orderBy('created_at', 'desc');
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('assets-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(0, 'desc')
            ->responsive(true)
            ->autoWidth(false)
            ->pageLength(25)
            ->buttons([
                [
                    'extend' => 'collection',
                    'text' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus w-4 h-4 ltr:mr-2 rtl:ml-2"><path d="M5 12h14"></path><path d="M12 5v14"></path></svg>إضافة أصل جديد',
                    'className' => 'inline-flex items-center justify-center rounded-md font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none bg-primary-600 text-white hover:bg-primary-700 h-8 px-3 text-sm',
                    'buttons' => [
                        [
                            'text' => 'إضافة أصل جديد',
                            'action' => 'function() { window.location.href = "'.route('assets.create').'"; }'
                        ]
                    ]
                ],
                [
                    'extend' => 'excel',
                    'text' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-download w-4 h-4 ltr:mr-2 rtl:ml-2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" x2="12" y1="15" y2="3"></line></svg>تصدير Excel',
                    'className' => 'inline-flex items-center justify-center rounded-md font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none bg-transparent border border-slate-300 dark:border-slate-700 hover:bg-slate-100 dark:hover:bg-slate-800 h-8 px-3 text-sm'
                ],
                [
                    'extend' => 'csv',
                    'text' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-download w-4 h-4 ltr:mr-2 rtl:ml-2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" x2="12" y1="15" y2="3"></line></svg>تصدير CSV',
                    'className' => 'inline-flex items-center justify-center rounded-md font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none bg-transparent border border-slate-300 dark:border-slate-700 hover:bg-slate-100 dark:hover:bg-slate-800 h-8 px-3 text-sm'
                ],
                [
                    'extend' => 'pdf',
                    'text' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-text w-4 h-4 ltr:mr-2 rtl:ml-2"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"></path><polyline points="14,2 14,8 20,8"></polyline><line x1="16" x2="8" y1="13" y2="13"></line><line x1="16" x2="8" y1="17" y2="17"></line><line x1="10" x2="8" y1="9" y2="9"></line></svg>تصدير PDF',
                    'className' => 'inline-flex items-center justify-center rounded-md font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none bg-transparent border border-slate-300 dark:border-slate-700 hover:bg-slate-100 dark:hover:bg-slate-800 h-8 px-3 text-sm'
                ],
                [
                    'extend' => 'print',
                    'text' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-printer w-4 h-4 ltr:mr-2 rtl:ml-2"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect width="12" height="8" x="6" y="14"></rect></svg>طباعة',
                    'className' => 'inline-flex items-center justify-center rounded-md font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none bg-transparent border border-slate-300 dark:border-slate-700 hover:bg-slate-100 dark:hover:bg-slate-800 h-8 px-3 text-sm'
                ],
                [
                    'extend' => 'reload',
                    'text' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-refresh-cw w-4 h-4 ltr:mr-2 rtl:ml-2"><path d="M3 12a9 9 0 0 1 9-9 9.75 9.75 0 0 1 6.74 2.74L21 8"></path><path d="M21 3v5h-5"></path><path d="M21 12a9 9 0 0 1-9 9 9.75 9.75 0 0 1-6.74-2.74L3 16"></path><path d="M3 21v-5h5"></path></svg>تحديث',
                    'className' => 'inline-flex items-center justify-center rounded-md font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none bg-transparent border border-slate-300 dark:border-slate-700 hover:bg-slate-100 dark:hover:bg-slate-800 h-8 px-3 text-sm'
                ]
            ])

            ->parameters([
                'language' => [
                    'processing' => 'جاري المعالجة...',
                    'search' => 'البحث:',
                    'lengthMenu' => 'أظهر _MENU_ سجلات',
                    'info' => 'إظهار _START_ إلى _END_ من أصل _TOTAL_ سجل',
                    'infoEmpty' => 'إظهار 0 إلى 0 من أصل 0 سجل',
                    'infoFiltered' => '(تمت تصفية من أصل _MAX_ سجل)',
                    'loadingRecords' => 'جاري التحميل...',
                    'zeroRecords' => 'لم يتم العثور على سجلات مطابقة',
                    'emptyTable' => 'لا توجد بيانات متاحة في الجدول',
                    'paginate' => [
                        'first' => 'الأول',
                        'previous' => 'السابق',
                        'next' => 'التالي',
                        'last' => 'الأخير'
                    ],
                    'aria' => [
                        'sortAscending' => ': تفعيل لترتيب العمود تصاعدياً',
                        'sortDescending' => ': تفعيل لترتيب العمود تنازلياً'
                    ],
                    'emptyTable' => '
                        <div class="flex flex-col items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-text w-12 h-12 text-slate-300 dark:text-slate-600"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"></path><path d="M14 2v4a2 2 0 0 0 2 2h4"></path><path d="M10 9H8"></path><path d="M16 13H8"></path><path d="M16 17H8"></path></svg>
                            <p class="text-slate-500 font-medium">لا توجد أصول مسجلة في النظام.</p>
                        </div>
                    ',
                    'zeroRecords' => '
                        <div class="flex flex-col items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search-x w-12 h-12 text-slate-300 dark:text-slate-600"><circle cx="11" cy="11" r="8"></circle><path d="m21 21-4.35-4.35"></path><line x1="8" x2="14" y1="11" y2="11"></line></svg>
                            <p class="text-slate-500 font-medium">لم يتم العثور على أصول للفترة المحددة.</p>
                        </div>
                    ',
                ],
                'lengthMenu' => [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'الكل']],
                'pageLength' => 25,
                'searching' => true,
                'ordering' => true,
                'info' => true,
                'responsive' => true,
                'autoWidth' => false,
                'processing' => true,
                'serverSide' => true,
                'stateSave' => false,
                'scrollX' => true,
                'searchDelay' => 500, // Add search delay
                'initComplete' => 'function(settings, json) {
                    $("#assets-table thead").addClass("bg-slate-50 dark:bg-slate-800 border-b border-slate-200 dark:border-slate-700");
                    $("#assets-table thead th").addClass("h-12 px-4 ltr:text-left rtl:text-right align-middle font-medium text-slate-500 dark:text-slate-400");
                }',
                'drawCallback' => 'function(settings) {
                    // Apply Tailwind classes to DataTable elements
                    $(".dataTables_wrapper").addClass("space-y-4");
                    // Style the table
                    $("#assets-table").addClass("w-full caption-bottom text-sm border-collapse");
                    $("#assets-table thead").addClass("bg-slate-50 dark:bg-slate-800");
                    $("#assets-table thead tr").addClass("border-b border-slate-200 dark:border-slate-700 transition-colors hover:bg-slate-50 dark:hover:bg-slate-800/50");
                    $("#assets-table tbody tr").addClass("border-b border-slate-200 dark:border-slate-700 transition-colors hover:bg-slate-50 dark:hover:bg-slate-800/50");
                    $("#assets-table tbody td").addClass("p-4 align-middle text-slate-900 dark:text-slate-300");
                    // Style pagination
                    $(".dataTables_paginate").addClass("flex items-center gap-2");
                    $(".paginate_button").addClass("inline-flex items-center justify-center rounded-md font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none bg-transparent border border-slate-300 dark:border-slate-700 hover:bg-slate-100 dark:hover:bg-slate-800 h-8 px-3 text-sm");
                    $(".paginate_button.current").addClass("bg-primary-600 text-white border-primary-600 hover:bg-primary-700");
                    // Style search input
                    $(".dataTables_filter input").addClass("flex h-10 rounded-md border border-slate-300 bg-white px-3 py-2 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-transparent disabled:cursor-not-allowed disabled:opacity-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50");
                    // Style length select
                    $(".dataTables_length select").addClass("flex h-10 rounded-md border border-slate-300 bg-white px-3 py-2 text-sm placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-transparent disabled:cursor-not-allowed disabled:opacity-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-50");
                    // Style info text
                    $(".dataTables_info").addClass("text-sm text-slate-600 dark:text-slate-400");
                }'
            ]);
    }

    protected function getColumns()
    {
        return [
            Column::computed('DT_RowIndex')
                ->title('#')
                ->exportable(false)
                ->printable(false)
                ->addClass('ltr:text-left rtl:text-right h-12 px-4 ltr:text-left rtl:text-right align-middle font-medium text-slate-500 dark:text-slate-400'),
            Column::make('number')
                ->title('رقم الأصل')
                ->addClass('ltr:text-left rtl:text-right h-12 px-4 ltr:text-left rtl:text-right align-middle font-medium text-slate-500 dark:text-slate-400'),
            Column::make('name')
                ->title('اسم الأصل')
                ->addClass('ltr:text-left rtl:text-right h-12 px-4 ltr:text-left rtl:text-right align-middle font-medium text-slate-500 dark:text-slate-400'),
            Column::make('status')
                ->title('الحالة')
                ->addClass('ltr:text-left rtl:text-right h-12 px-4 ltr:text-left rtl:text-right align-middle font-medium text-slate-500 dark:text-slate-400'),
            Column::make('purchase_date')
                ->title('تاريخ الشراء')
                ->addClass('ltr:text-left rtl:text-right h-12 px-4 ltr:text-left rtl:text-right align-middle font-medium text-slate-500 dark:text-slate-400'),
            Column::computed('action')
                ->title('الإجراءات')
                ->exportable(false)
                ->printable(false)
                ->addClass('ltr:text-left rtl:text-right h-12 px-4 ltr:text-left rtl:text-right align-middle font-medium text-slate-500 dark:text-slate-400'),
        ];
    }

    protected function filename(): string
    {
        return 'Assets_' . date('YmdHis');
    }
}

