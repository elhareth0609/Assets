@extends('layouts.app')

@section('title', __('Uploader'))

@section('content')

<h1 class="h3 mb-4 text-gray-800" dir="{{ app()->getLocale() == "ar" ? "rtl" : "" }}">{{ __('Uploader') }}</h1>

{{-- BASIC USAGE --}}
<div class="row mb-4">
    <div class="col-md-6 ">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">{{ __('Basic usage Uploader (One Item):') }}</h5>
            </div>
            <div class="card-body">
                <code class="highlight language-js">new Uploader({
    item : '#uploader0' // id or class
    maxItems: 1
});</code>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <form class="" action="#" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="uploader uploader0" id="uploader0"></div>
                    <button type="submit" class="btn btn-success mt-3">Submit</button>
                </form>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        new Uploader({
                            item : '#uploader0',
                            maxItems: 1
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
                <code class="highlight language-js">new Uploader({
    item : '#uploader1' // id or class
});</code>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                    <p class="text-muted">Add your documents here, and you can upload up to 5 files max</p>
    
                    <form action="/upload" class="uploader1 border-dashed rounded bg-white d-flex align-items-center justify-content-center border-primary border-2 p-4" id="dropzone1">
                        <div class="dz-message">
                            <span class="mdi mdi-cloud-upload text-primary fs-1"></span>
                            <h5>Drag your file(s) to start uploading</h5>
                            <p class="text-muted">OR</p>
                            <button type="button" class="btn btn-outline-primary">Browse files</button>
                        </div>
                    </form>
    
                    <div class="mt-3">
                        <small class="text-muted">Only supports .jpg, .png, .svg, and .zip files</small>
                    </div>
    
                    <div id="hidden-previews-container" style="display: none;"></div> <!-- Hidden container for Dropzone previews -->
                    <!-- Upload Progress Items -->
                    <div class="upload-items mt-4"></div>
                </form>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        new Uploader({
                            item : '#uploader1'
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</div>


{{-- WITH CALLBACKS --}}
<div class="row mb-4">
    <div class="col-md-6 ">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">{{ __('With callbacks:') }}</h5>
            </div>
            <div class="card-body">
                <code class="highlight language-js">new Uploader({
    item: '#uploader2',
    onAdd: function(item, count) {
        console.log('Item added to uploader2', item, 'Total count:', count);
        // You might want to initialize plugins on the new 'item' here
    },
    onDelete: function(item, count) {
        console.log('Item deleted from uploader2. Items remaining:', count);
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
                    <div class="uploader uploader2" id="uploader2"></div>
                    <button type="submit" class="btn btn-success mt-3">Submit</button>
                </form>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        new Uploader({
                            item: '#uploader2',
                            onAdd: function(item, count) {
                                console.log('Item added to uploader2. DOM Element:', item, 'Total items now:', count);
                            },
                            onDelete: function(item, count) {
                                console.log('Item deleted from uploader2. Items remaining:', count);
                            }
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</div>

{{-- with expects items: eg: .png,.jpg,.zip --}}
{{-- with expect items size: 3 mb --}}
{{-- with url for upload items : bulk or single --}}

@endsection

@push('header_scripts')
    <script src="{{ asset('assets/js/myUploader.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('assets/js/myCodeDisplay.js') }}?v={{ time() }}"></script>
@endpush