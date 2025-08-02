@extends('layouts.app')

@section('title', __('Repeater'))

@section('content')

<h1 class="h3 mb-4 text-gray-800" dir="{{ app()->getLocale() == "ar" ? "rtl" : "" }}">{{ __('Repeater') }}</h1>

{{-- BASIC USAGE --}}
<div class="row mb-4">
    <div class="col-md-6 ">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">{{ __('Basic usage Repeater:') }}</h5>
            </div>
            <div class="card-body">
                <code class="highlight language-js">new Repeater({
    item : '#repeater0' // id or class
});</code>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <form class="" action="#" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="repeater repeater0" id="repeater0">
                        <div class="row mb-3 align-items-center justify-content-around" data-repeater-item>
                            <div class="form-group form-group-floating col-md-5">
                                <input type="text" class="form-control" id="full_name_tpl_r1" name="full_name" placeholder="Enter Your Full Name">
                                <label for="full_name_tpl_r1" class="form-label">{{ __('Full Name') }}</label>
                            </div>
                            <div class="form-group form-group-floating col-md-5">
                                <input type="email" class="form-control" id="email_tpl_r1" name="email" placeholder="user@mail.com">
                                <label for="email_tpl_r1" class="form-label">{{ __('Email address') }}</label>
                            </div>
                            <button class="btn btn-icon btn-primary col-md-1" data-repeater-item-create type="button" title="Add below"><i class="mdi mdi-plus-outline"></i></button>
                            <button class="btn btn-icon btn-danger col-md-1" data-repeater-item-delete type="button" title="Delete this item"><i class="mdi mdi-trash-can-outline"></i></button>
                        </div>

                        <button class="btn btn-primary mt-2" data-repeater-create type="button"><i class="mdi mdi-plus-outline"></i></button>
                    </div>
                    <button type="submit" class="btn btn-success mt-3">Submit</button>
                </form>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        new Repeater({
                            item : '#repeater0'
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</div>

{{-- BASIC USAGE --}}
<div class="row mb-4">
    <div class="col-md-6 ">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">{{ __('with namePrefix and multiple items:') }}</h5>
            </div>
            <div class="card-body">
                <code class="highlight language-js">new Repeater({
    item : '#repeater1', // id or class
    namePrefix: 'form1_contacts' // Group name for submitted data
});</code>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <form class="" action="#" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="repeater repeater1" id="repeater1">
                        <div class="row mb-3 align-items-center justify-content-around" data-repeater-item>
                            <div class="form-group form-group-floating col-md-5">
                                <input type="text" class="form-control" id="full_name_tpl_r1" name="full_name" placeholder="Enter Your Full Name">
                                <label for="full_name_tpl_r1" class="form-label">{{ __('Full Name') }}</label>
                            </div>
                            <div class="form-group form-group-floating col-md-5">
                                <input type="email" class="form-control" id="email_tpl_r1" name="email" placeholder="user@mail.com">
                                <label for="email_tpl_r1" class="form-label">{{ __('Email address') }}</label>
                            </div>
                            <button class="btn btn-icon btn-primary col-md-1" data-repeater-item-create type="button" title="Add below"><i class="mdi mdi-plus-outline"></i></button>
                            <button class="btn btn-icon btn-danger col-md-1" data-repeater-item-delete type="button" title="Delete this item"><i class="mdi mdi-trash-can-outline"></i></button>
                        </div>
                        
                        <div class="row mb-3 align-items-center justify-content-around" data-repeater-item>
                            <div class="form-group form-group-floating col-md-5">
                                <input type="text" class="form-control" id="full_name_tpl_r1" name="full_name" placeholder="Enter Your Full Name">
                                <label for="full_name_tpl_r1" class="form-label">{{ __('Full Name') }}</label>
                            </div>
                            <div class="form-group form-group-floating col-md-5">
                                <input type="email" class="form-control" id="email_tpl_r1" name="email" placeholder="user@mail.com">
                                <label for="email_tpl_r1" class="form-label">{{ __('Email address') }}</label>
                            </div>
                            <button class="btn btn-icon btn-primary col-md-1" data-repeater-item-create type="button" title="Add below"><i class="mdi mdi-plus-outline"></i></button>
                            <button class="btn btn-icon btn-danger col-md-1" data-repeater-item-delete type="button" title="Delete this item"><i class="mdi mdi-trash-can-outline"></i></button>
                        </div>

                        <button class="btn btn-primary mt-2" data-repeater-create type="button"><i class="mdi mdi-plus-outline"></i></button>
                    </div>
                    <button type="submit" class="btn btn-success mt-3">Submit</button>
                </form>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        new Repeater({
                            item : '#repeater1',
                            namePrefix: 'form1_contacts' // Group name for submitted data
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</div>


{{-- WITH CALLBACKS (and templateHTML example) --}}
<div class="row mb-4">
    <div class="col-md-6 ">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">{{ __('With callbacks & templateHTML:') }}</h5>
            </div>
            <div class="card-body">
                <code class="highlight language-js">
const repeater2ItemTemplate = `
&lt;div class="row mb-3 align-items-center justify-content-around" data-repeater-item&gt;
    &lt;div class="form-group form-group-floating col-md-5"&gt;
        &lt;input type="text" class="form-control" id="service_name_tpl_r2" name="service_name" placeholder="Service Name" required&gt;
        &lt;label for="service_name_tpl_r2" class="form-label">{{ __('Service Name') }}&lt;/label&gt;
    &lt;/div&gt;
    &lt;div class="form-group form-group-floating col-md-5"&gt;
        &lt;input type="number" class="form-control" id="service_cost_tpl_r2" name="service_cost" placeholder="Cost" required&gt;
        &lt;label for="service_cost_tpl_r2" class="form-label">{{ __('Cost') }}&lt;/label&gt;
    &lt;/div&gt;
    &lt;button class="btn btn-icon btn-danger col-md-1" data-repeater-item-delete type="button"&gt;&lt;i class="mdi mdi-trash-can-outline">&lt;/i&gt;&lt;/button&gt;
&lt;/div&gt;`;

new Repeater({
    item: '#repeater2',
    namePrefix: 'form2_services',
    templateHTML: repeater2ItemTemplate,
    onAdd: function(item, count) {
        console.log('Item added to repeater2', item, 'Total count:', count);
        // You might want to initialize plugins on the new 'item' here
    },
    onDelete: function(item, count) {
        console.log('Item deleted from repeater2. Items remaining:', count);
    }
});</code>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                 <form class="" action="#" method="post"> {{-- Separate form example --}}
                    @csrf
                    <div class="repeater repeater2" id="repeater2">

                        <button class="btn btn-primary mt-2" data-repeater-create type="button"><i class="mdi mdi-plus-outline"></i></button>
                    </div>
                    <button type="submit" class="btn btn-success mt-3">Submit Form 2</button>
                </form>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const repeater2ItemTemplate = `
<div class="row mb-3 align-items-center justify-content-around" data-repeater-item>
    <div class="form-group form-group-floating col-md-5">
        <input type="text" class="form-control" id="service_name_tpl_r2" name="service_name" placeholder="Service Name" required>
        <label for="service_name_tpl_r2" class="form-label">{{ __('Service Name') }}</label>
    </div>
    <div class="form-group form-group-floating col-md-5">
        <input type="number" class="form-control" id="service_cost_tpl_r2" name="service_cost" placeholder="Cost" required>
        <label for="service_cost_tpl_r2" class="form-label">{{ __('Cost') }}</label>
    </div>
    <button class="btn btn-icon btn-danger col-md-1" data-repeater-item-delete type="button" title="Delete this item"><i class="mdi mdi-trash-can-outline"></i></button>
</div>`;

                        new Repeater({
                            item: '#repeater2',
                            namePrefix: 'form2_services',
                            templateHTML: repeater2ItemTemplate,
                            onAdd: function(item, count) {
                                console.log('Item added to repeater2. DOM Element:', item, 'Total items now:', count);
                            },
                            onDelete: function(item, count) {
                                console.log('Item deleted from repeater2. Items remaining:', count);
                            }
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</div>


{{-- MAX ITEMS (and templateHTML example) --}}
<div class="row mb-4">
    <div class="col-md-6 ">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">{{ __('With maxItems & templateHTML:') }}</h5>
            </div>
            <div class="card-body">
                <code class="highlight language-js">
const repeater3ItemTemplate = `
&lt;div class="row mb-3 align-items-center justify-content-around" data-repeater-item&gt;
    &lt;div class="form-group form-group-floating col-md-10"&gt;
        &lt;input type="text" class="form-control" id="tag" name="tag" placeholder="Enter Tag"&gt;
        &lt;label&gt; for="tag" class="form-label"&gt;{{ __('Tag') }}&lt;/label&gt;
    &lt;/div&gt;
    &lt;button class="btn btn-icon btn-danger col-md-1" data-repeater-item-delete type="button"&gt;&lt;i&gt; class="mdi mdi-trash-can-outline"&gt;&lt;/i&gt;&lt;/button&gt;
&lt;/div&gt;`;

new Repeater({
    item: '#repeater3',
    namePrefix: 'form3_tags',
    templateHTML: repeater3ItemTemplate,
    maxItems: 5
});</code>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <form class="" action="#" method="post"> @csrf
                    <div class="repeater repeater3" id="repeater3">

                        <button class="btn btn-primary mt-2" data-repeater-create type="button"><i class="mdi mdi-plus-outline"></i></button>
                    </div>
                    <button type="submit" class="btn btn-success mt-3">Submit</button>
                </form>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const repeater3ItemTemplate = `
                            <div class="row mb-3 align-items-center justify-content-around" data-repeater-item>
                                <div class="form-group form-group-floating col-md-10">
                                    <input type="text" class="form-control" id="tag" name="tag" placeholder="Enter Tag">
                                    <label for="tag" class="form-label">{{ __('Tag') }}</label>
                                </div>
                                <button class="btn btn-icon btn-danger col-md-1" data-repeater-item-delete type="button" title="Delete this item"><i class="mdi mdi-trash-can-outline"></i></button>
                            </div>`;

                        new Repeater({
                            item: '#repeater3',
                            namePrefix: 'form3_tags',
                            templateHTML: repeater3ItemTemplate,
                            maxItems: 5,
                            onAdd: function(item, count) { console.log('Item added to repeater3. Total:', count); },
                            onDelete: function(item, count) { console.log('Item deleted from repeater3. Remaining:', count); }
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</div>

    
    {{-- Force 3 items should be existing --}}
<div class="row mb-4">
    <div class="col-md-6 ">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">{{ __('Force 3 items should be existing:') }}</h5>
            </div>
            <div class="card-body">
                <code class="highlight language-js">new Repeater({
    item: '#repeater4',
    minItems: 3 
});</code>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <form class="" action="#" method="post"> 
                    @csrf
                    <div class="repeater repeater4" id="repeater4">
                        <div class="row mb-3 align-items-center justify-content-around" data-repeater-item>
                            <div class="form-group form-group-floating col-md-5">
                                <input type="text" class="form-control" id="full_name_tpl_r1" name="full_name" placeholder="Enter Your Full Name">
                                <label for="full_name_tpl_r1" class="form-label">{{ __('Full Name') }}</label>
                            </div>
                            <div class="form-group form-group-floating col-md-5">
                                <input type="email" class="form-control" id="email_tpl_r1" name="email" placeholder="user@mail.com">
                                <label for="email_tpl_r1" class="form-label">{{ __('Email address') }}</label>
                            </div>
                            <button class="btn btn-icon btn-primary col-md-1" data-repeater-item-create type="button" title="Add below"><i class="mdi mdi-plus-outline"></i></button>
                            <button class="btn btn-icon btn-danger col-md-1" data-repeater-item-delete type="button" title="Delete this item"><i class="mdi mdi-trash-can-outline"></i></button>
                        </div>
                        <button class="btn btn-primary mt-2" data-repeater-create type="button"><i class="mdi mdi-plus-outline"></i></button>
                    </div>
                    <button type="submit" class="btn btn-success mt-3">Submit</button>
                </form>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        new Repeater({
                            item: '#repeater4',
                            minItems: 3
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</div>
@endsection

@push('header_scripts')
    <script src="{{ asset('assets/js/myRepeater.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('assets/js/myCodeDisplay.js') }}?v={{ time() }}"></script>
@endpush