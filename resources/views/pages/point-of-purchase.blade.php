@section('content')
{{-- The page content grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-3 p-1 h-full">
        {{-- Left/Main Panel: Current Purchase --}}
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow-sm border border-slate-200 dark:border-slate-700 lg:col-span-2 flex flex-col h-full">
            {{-- All the content from the original main panel goes here --}}
        </div>

        {{-- Right Panel: Item Selection --}}
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow-sm border border-slate-200 dark:border-slate-700 lg:col-span-1 flex flex-col h-full">
           {{-- All the content from the original right panel goes here --}}
        </div>
    </div>
@endsection
