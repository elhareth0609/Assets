@extends('layouts.app')

@section('title', __('Tag'))

@section('content')

<h1 class="h3 mb-4 text-gray-800" dir="{{ app()->getLocale() == "ar" ? "rtl" : "" }}">{{ __('Tag') }}</h1>

<div class="row mb-4">
    <div class="col-md-6 ">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">{{ __('Basic usage:') }}</h5>
            </div>
            <div class="card-body">
                <code class="highlight language-js">new Tager({
    inputId: 'tagInput'
});</code>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="form-group form-group-floating {{ app()->getLocale() == "ar" ? "input-rtl" : "" }}">
                    <input type="text" class="form-control" id="item_id0" placeholder="Select Item">
                    <label for="item_id0" class="form-label">{{ __('Select Item') }}</label>
                </div>
                <script>
                    new Tager({
                        inputId: 'item_id0'
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
                <h5 class="card-title">{{ __('Basic usage with existing select options:') }}</h5>
            </div>
            <div class="card-body">
                <code class="highlight language-js">new Tager({
    inputId: 'tagSelect',
});</code>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="form-group form-group-floating {{ app()->getLocale() == "ar" ? "input-rtl" : "" }}">
                    <input type="text" class="form-control" id="item_id0" placeholder="Select Item">
                    <label for="item_id0" class="form-label">{{ __('Select Item') }}</label>
                </div>
                <script>
                    new Tager({
                        inputId: 'tagSelect'
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
                <h5 class="card-title">{{ __('Basic usage with inside:') }}</h5>
            </div>
            <div class="card-body">
                <code class="highlight language-js">new Tager({
    inputId: 'tagInput',
    tagsPosition: 'inside'
});</code>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="form-group form-group-floating {{ app()->getLocale() == "ar" ? "input-rtl" : "" }}">
                    <input type="text" class="form-control" id="item_id1" placeholder="Select Item">
                    <label for="item_id1" class="form-label">{{ __('Select Item') }}</label>
                </div>
                <script>
                    new Tager({
                        inputId: 'item_id1',
                        tagsPosition: 'inside'
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
                <h5 class="card-title">{{ __('With Max Tags:') }}</h5>
            </div>
            <div class="card-body">
                <code class="highlight language-js">new Tager({
    inputId: 'tagInput',
    maxTags: 5
});</code>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="form-group form-group-floating {{ app()->getLocale() == "ar" ? "input-rtl" : "" }}">
                    <input type="text" class="form-control" id="item_id2" placeholder="Select Item">
                    <label for="item_id1" class="form-label">{{ __('Select Item') }}</label>
                </div>
                <script>
                    new Tager({
                        inputId: 'item_id2',
                        maxTags: 5
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
                <h5 class="card-title">{{ __('With Callbacks:') }}</h5>
            </div>
            <div class="card-body">
                <code class="highlight language-js">new Tager({
    inputId: 'tagInput',
    onAddTag: (tag) => {
        console.log(`Tag added: ${tag}`);
    },
    onRemoveTag: (tag) => {
        console.log(`Tag removed: ${tag}`);
    }
});</code>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="form-group form-group-floating {{ app()->getLocale() == "ar" ? "input-rtl" : "" }}">
                    <input type="text" class="form-control" id="item_id3" placeholder="Select Item">
                    <label for="item_id1" class="form-label">{{ __('Select Item') }}</label>
                </div>
                <script>
                    new Tager({
                        inputId: 'item_id3',
                        onAddTag: (tag) => {
                            console.log(`Tag added: ${tag}`);
                        },
                        onRemoveTag: (tag) => {
                            console.log(`Tag removed: ${tag}`);
                        }
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
                <h5 class="card-title">{{ __('With Custom Placeholder:') }}</h5>
            </div>
            <div class="card-body">
                <code class="highlight language-js">new Tager({
    inputId: 'tagInput',
    placeholderText: 'Type and press enter...'
});</code>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="form-group form-group-floating {{ app()->getLocale() == "ar" ? "input-rtl" : "" }}">
                    <input type="text" class="form-control" id="item_id4" placeholder="Select Item">
                    <label for="item_id1" class="form-label">{{ __('Select Item') }}</label>
                </div>
                <script>
                    new Tager({
                        inputId: 'item_id4',
                        placeholderText: 'Type and press enter...'
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
                <code class="highlight language-js">new Tager({
    inputId: 'tagInput',
    fetchUrl: '/api/demo/tags',
    fetchMethod: 'GET',
    csrfToken: document.querySelector('meta[name="csrf-token"]').content
});</code>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="form-group form-group-floating {{ app()->getLocale() == "ar" ? "input-rtl" : "" }}">
                    <div class="form-group form-group-floating {{ app()->getLocale() == "ar" ? "input-rtl" : "" }}">
                        <input type="text" class="form-control" id="item_id5" placeholder="Select Item">
                        <label for="item_id1" class="form-label">{{ __('Select Item') }}</label>
                    </div>
                </div>
                <script>
                    new Tager({
                        inputId: 'item_id5',
                        fetchUrl: '/tags',
                        fetchMethod: 'GET',
                        csrfToken: csrfToken
                    });
                </script>
            </div>
        </div>
    </div>
</div>

{{--
<div class="row mb-4">
    <div class="col-md-6 ">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">{{ __('With custom option rendering:') }}</h5>
            </div>
            <div class="card-body">
                <code>
                    new SearchableSelect({
                        selectId: 'item_id3',
                        renderOption: (option) => `
                            <div class="d-flex align-items-center">
                                <img src="${option.image}" class="me-2" width="20" height="20">
                                <span>${option.name}</span>
                            </div>
                        `
                    });
                </code>
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
                    new SearchableSelect({
                        selectId: 'item_id3',
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
</div> --}}


@endsection

@push('header_scripts')
    <script src="{{ asset('assets/js/myTager.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('assets/js/myCodeDisplay.js') }}?v={{ time() }}"></script>
@endpush