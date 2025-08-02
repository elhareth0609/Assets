@extends('layouts.app')

@section('title', __('Select'))

@section('content')

<h1 class="h3 mb-4 text-gray-800" dir="{{ app()->getLocale() == "ar" ? "rtl" : "" }}">{{ __('Select') }}</h1>

<div class="row mb-4">
    <div class="col-md-6 ">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">{{ __('Basic usage with existing select options:') }}</h5>
            </div>
            <div class="card-body">
                <code class="highlight language-js">new MySelecter({
    selectId: 'edit_category_id',
    clearText: '&lt;i class="mdi mdi-close"&gt;&lt;/i&gt;',
    allowClear: true

});</code>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="form-group form-group-floating {{ app()->getLocale() == "ar" ? "input-rtl" : "" }}">
                    <select class="form-select" id="item_id1">
                        <option value="">Select Item</option>
                        <option value="1">Item 1</option>
                        <option value="2" selected>Item 2</option>
                        <option value="3">Item 3</option>
                    </select>
                </div>
                <script>
                    new MySelecter({
                        selectId: 'item_id1',
                        clearText: '<i class="mdi mdi-close"></i>', // Custom clear icon
                        allowClear: true
                    });

                </script>
            </div>
        </div>
    </div>
</div>


<div class="row mb-4">
    <div class="col-md-6 ">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">{{ __('With URL fetch:') }}</h5>
            </div>
            <div class="card-body">
                <code class="highlight language-js">new MySelecter({
    selectId: 'item_id2',
    url: '/categories/all',
    method: 'GET',
    csrfToken: csrfToken,
    valueField: 'category_id', // Custom value field
    contentField: 'category_name', // Custom content field
    selectedValue: 5 // Pre-select category with ID 5
});</code>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="form-group form-group-floating {{ app()->getLocale() == "ar" ? "input-rtl" : "" }}">
                    <select class="form-select" id="item_id2">
                        <option value="">{{ __('Select Item') }}</option>
                    </select>
                </div>
                <script>
                    new MySelecter({
                        selectId: 'item_id2',
                        url: '/categories/all',
                        method: 'GET',
                        csrfToken: csrfToken,
                        valueField: 'category_id', // Custom value field
                        contentField: 'category_name', // Custom content field
                        selectedValue: 5 // Pre-select category with ID 5
                    });
                </script>
            </div>
        </div>
    </div>
</div>


<div class="row mb-4">
    <div class="col-md-6 ">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">{{ __('With custom option rendering:') }}</h5>
            </div>
            <div class="card-body">
                <code class="highlight language-js">new MySelecter({
    selectId: 'item_id3',
    allowClear: false, // Disable clearing
    renderOption: (option) => `
        &lt;div class=&quot;d-flex align-items-center&quot;&gt;
            &lt;img src=&quot;${option.image}&quot; class=&quot;me-2&quot; width=&quot;20&quot; height=&quot;20&quot;&gt;
            &lt;span&gt;${option.name}&lt;/span&gt;
        &lt;/div&gt;
    `
});</code>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="form-group form-group-floating {{ app()->getLocale() == "ar" ? "input-rtl" : "" }}">
                    <select class="form-select" id="item_id3">
                        <option value="">{{ __('Select Item') }}</option>
                        <option data-image="{{ asset('assets/img/photos/foods/fresh-tasty-burger-2021-08-29-04-51-34-utc 1.png') }}" value="1">ssssssssss</option>
                    </select>
                </div>
                <script>
                    new MySelecter({
                        selectId: 'item_id3',
                        allowClear: false, // Disable clearing
                        renderOption: (option) => `
                            <div class="d-flex align-items-center">
                                <img src="${option.image}" class="me-2" width="20" height="20">
                                <span>${option.name}</span>
                            </div>
                        `
                    });
                </script>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-6 ">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">{{ __('Fully featured example:') }}</h5>
            </div>
            <div class="card-body">
                <code class="highlight language-js">new MySelecter({
    selectId: 'product_selector',
    url: '/api/demo/products',
    valueField: 'id',
    contentField: 'name',
    selectedValue: 10,
    renderOption: (product) => `
    &lt;div class="d-flex align-items-center"&gt;
        &lt;img src="${product.image_url || '/assets/img/placeholder.png'}" class="me-2" width="35" height="35"&gt;
        &lt;div&gt;
            &lt;div class="fw-bold"&gt;${product.name}&lt;/div&gt;
            &lt;div class="small text-muted"&gt;${product.price} - ${product.category}&lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;
    `
});</code>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="form-group form-group-floating {{ app()->getLocale() == "ar" ? "input-rtl" : "" }}">
                    <select class="form-select" id="item_id4">
                        <option value="">Select Product</option>
                    </select>
                </div>
                <script>
                    new MySelecter({
                        selectId: 'item_id4',
                        url: '/api/demo/products',
                        method: 'GET',
                        csrfToken: csrfToken,
                        valueField: 'id',
                        contentField: 'name',
                        selectedValue: 10,
                        renderOption: (product) => `
                            <div class="d-flex align-items-center">
                                <img src="${product.image_url || '/assets/img/photos/users/1737273572_cropped-image.png'}" class="me-2" width="35" height="35">
                                <div>
                                    <div class="fw-bold">${product.name}</div>
                                    <div class="small text-muted">${product.price} - ${product.category}</div>
                                </div>
                            </div>
                        `
                    });
                </script>
            </div>
        </div>
    </div>
</div>

@endsection


@push('header_scripts')
    <script src="{{ asset('assets/js/MySelecter.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('assets/js/myCodeDisplay.js') }}?v={{ time() }}"></script>
@endpush