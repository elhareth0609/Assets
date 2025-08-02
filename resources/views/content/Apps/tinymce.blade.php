@extends('layouts.app')

@section('title', __('Tinymce'))

@section('content')

<h1 class="h3 mb-4 text-gray-800" dir="{{ app()->getLocale() == "ar" ? "rtl" : "" }}">{{ __('Tinymce') }}</h1>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form id="contentForm" action="{{ route('apps.tinymce.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <textarea name="content" id="content"></textarea>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        tinymce.init({
            selector: 'textarea[name="content"]',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount linkchecker',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat | Save',
            setup: function (editor) {
                editor.ui.registry.addButton('save', {
                    text: 'Save',
                    onAction: function () {
                    $('textarea[name="content"]').val(editor.getContent());
                    $('#contentForm').submit();
                    }
                });
            }
        });

        $('#contentForm').submit(function(event) {
            event.preventDefault();

            $('#loading').show();
            var formData = new FormData(this);

            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: formData,
                dataType: "json",
                contentType: false, // Don't set content type (let browser handle it)
                processData: false, // Don't process data (let browser handle it)
                success: function(response) {
                    $('#loading').hide();
                    Swal.fire({
                        icon: response.icon,
                        title: response.state,
                        text: response.message,
                        confirmButtonText: __("Ok",lang)
                    });
                },
                error: function(xhr, textStatus, errorThrown) {
                    const response = JSON.parse(xhr.responseText);
                    $('#loading').hide();
                    Swal.fire({
                        icon: response.icon,
                        title: response.state,
                        text: response.message,
                        confirmButtonText: __("Ok",lang)
                    });
                }
            });
        });

    });
</script>

@endsection

@push('page_scripts')
    <script src="https://cdn.tiny.cloud/1/7gjdmwd28tv3zgd10agg1omfs4akvf56ukwbb85qqzlzgxd1/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
@endpush