@extends('admin.layout')

@section('topbar')
    @include('admin.partials.topbar')
@stop

@section('sidebar')
    @include('admin.partials.sidebar',['activePost'=>true])
@stop

@section('footer')
    @include('admin.partials.footer')
@stop

@section('styles')

    <link href="{{ asset('/backend/assets/pickadate/lib/themes/default.css')}}" rel="stylesheet">
    <link href="{{ asset('/backend/assets/pickadate/lib/themes/default.date.css')}}" rel="stylesheet">
    <link href="{{ asset('/backend/assets/pickadate/lib/themes/default.time.css')}}" rel="stylesheet">
    <link href="{{ asset('/backend/assets/selectize/dist/css/selectize.css')}}" rel="stylesheet">
    <link href="{{ asset('/backend/assets/selectize/dist/css/selectize.bootstrap3.css')}}" rel="stylesheet">

    <link href="{{ asset('/backend/assets/plugins/dropzone/dist/dropzone.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/backend/assets/plugins/datatables/jquery.dataTables.min.css')}}" rel="stylesheet"
          type="text/css">
    <link href="{{ asset('/backend/assets/plugins/notifications/notification.css')}}" rel="stylesheet">
    <link href="{{ asset('/backend/assets/plugins/sweetalert/dist/sweetalert.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/backend/assets/plugins/summernote/dist/summernote.css')}}" rel="stylesheet">

    <style type="text/css" media="screen">
        .input-field-title {
            height: 50px !important;
            background-color: rgb(255, 255, 255) !important;
            color: black;
            border-radius: 0px !important;
            border: 2px solid rgba(0, 0, 0, 0.34) !important;

        }

        #categories_table_filter {
            display: none;
        }

        .dropzone {
            min-height: 152px !important;
            border: 2px dashed rgba(0, 0, 0, 0.3);
            background: white;
            border-radius: 6px;
            padding: 0px 6px;
        }

        .dropzone .dz-message {
            font-size: 25px;
        }
    </style>
@stop

@section('scripts')
    <script src="{{ asset('/backend/assets/plugins/dropzone/dist/dropzone.js')}}"></script>

    <script src="{{ asset('/backend/assets/pickadate/lib/picker.js')}}"></script>
    <script src="{{ asset('/backend/assets/pickadate/lib/picker.date.js')}}"></script>
    <script src="{{ asset('/backend/assets/pickadate/lib/picker.time.js')}}"></script>
    <script src="{{ asset('/backend/assets/selectize/dist/js/standalone/selectize.min.js')}}"></script>

    <script src="{{ asset('/backend/assets/js/jquery.nicescroll.js')}}"></script>
    <script src="{{ asset('/backend/assets/plugins/summernote/dist/summernote.min.js')}}"></script>
    <script src="{{ asset('/backend/assets/plugins/notifyjs/dist/notify.min.js')}}"></script>
    <script src="{{ asset('/backend/assets/plugins/notifications/notify-metro.js')}}"></script>
    <script src="{{ asset('/backend/assets/plugins/notifications/notifications.js')}}"></script>
    <script src="{{ asset('/backend/assets/plugins/sweetalert/dist/sweetalert.min.js')}}"></script>
    <script src="{{ asset('/backend/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('/backend/assets/plugins/datatables/dataTables.bootstrap.js')}}"></script>

    <script type="text/javascript">


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $(function () {
            $("#publish_date").pickadate({
                format: "mmm-d-yyyy"
            });
            $("#publish_time").pickatime({
                format: "h:i A"
            });
            $("#tags").selectize({
                create: true
            });

            $("#categories").selectize({
                create: false
            });
        });

        $(document).ready(function () {
            $('#content').summernote({
                height: 380, // set editor height
                minHeight: null, // set minimum height of editor
                maxHeight: null, // set maximum height of editor

                focus: false, // set focus to editable area after initializing summernote
                onImageUpload: function (files, editor, welEditable) {
                    sendFile(files[0], editor, welEditable);
                }
            });

            $('#content').code('');

            function sendFile(file, editor, welEditable) {
                var data = new FormData();
                data.append("file", file);
                data.append("folder", '/');
                var url = "{{url('/admin/upload/file_url')}}";
                $.ajax({
                    data: data,
                    type: "POST",
                    url: url,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        $('#content').summernote('editor.insertImage', response.url);
                    }
                });
            }


        });
    </script>

    <script type="text/javascript">
        var baseUrl = "{{ url('/') }}";
        var token = "{{ Session::getToken() }}";
        Dropzone.autoDiscover = false;
        var myDropzone = new Dropzone("div#main_image_upload", {
            url: baseUrl + "/admin/upload/file_path",
            maxFiles: 1,
            params: {
                _token: token,
                'folder': '/',
            }
        });

        myDropzone.on("success", function (file, response) {
            $('input[name="page_image"]').val(response.url);
        });

        Dropzone.options.myAwesomeDropzone = {
            paramName: "file", // The name that will be used to transfer the file
            maxFilesize: 4, // MB
            addRemoveLinks: true
        };
    </script>


    <script type="text/javascript">
        var baseUrl1 = "{{ url('/') }}";
        var token1 = "{{ Session::getToken() }}";
        Dropzone.autoDiscover = false;
        var myDropzone2 = new Dropzone("div#promo_main_image", {
            url: baseUrl1 + "/admin/upload/file_path",
            maxFiles: 1,
            params: {
                _token: token1,
                'folder': '/',
            }
        });

        myDropzone2.on("success", function (file, response) {
            $('input[name="promo_image"]').val(response.url);
        });

        Dropzone.options.myAwesomeDropzone = {
            paramName: "file", // The name that will be used to transfer the file
            maxFilesize: 4, // MB
            addRemoveLinks: true
        };
    </script>
@stop

@section('content')
    <div class="container">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <h4 class="pull-left page-title">Add New</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="#">{{config('blog.title')}}</a></li>
                    <li><a href="#">Post</a></li>
                    <li class="active">Create New</li>
                </ol>
            </div>
        </div>


        <div class="row">

            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Create New Post</h3></div>
                    <div class="panel-body">

                        <form class="form-horizontal" role="form" method="POST"
                              action="{{ route('post.store') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            @include('admin.post._form')

                            <div class="col-md-8">
                                <div class="form-group">
                                    <div class="col-md-10 col-md-offset-2">
                                        <button type="submit" class="btn btn-primary ">
                                            <i class="fa fa-disk-o"></i>
                                            Create
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </form>


                    </div>

                </div>

            </div>


        </div>


        <!-- End Row -->
    </div>


@stop