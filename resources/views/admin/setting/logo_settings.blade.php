@extends('admin.layout')


@section('topbar')
    @include('admin.partials.topbar')
@stop

@section('sidebar')
    @include('admin.partials.sidebar',['activeSettings'=>true])
@stop

@section('footer')
    @include('admin.partials.footer')
@stop

@section('styles')
    <link href="{{ asset('/backend/assets/plugins/dropzone/dist/dropzone.css')}}" rel="stylesheet" type="text/css">
@stop

@section('scripts')
    <script src="{{ asset('/backend/assets/plugins/dropzone/dist/dropzone.js')}}"></script>
     <script type="text/javascript">
            var baseUrl = "{{ url('/') }}";
            var token1 = "{{ Session::getToken() }}";
            Dropzone.autoDiscover = false;

            var myDropzone2 = new Dropzone("div#logo_1_upload", { 
                 url: baseUrl+"/admin/upload/file_path",
                 maxFiles: 1,
                 params: {
                    _token: token1,
                    'folder': '/',
                  }
             });

             myDropzone2.on("success",function(file, response){ 
                $('input[name="logo_1"]').val('');
                $('input[name="logo_1"]').val('{{url('/')}}'+response.url);
            }); 


             var myDropzone1 = new Dropzone("div#logo_2_upload", { 
                 url: baseUrl+"/admin/upload/file_path",
                 maxFiles: 1,
                 params: {
                    _token: token1,
                    'folder': '/',
                  }
             });

             myDropzone1.on("success",function(file, response){ 
                $('input[name="logo_2"]').val('');
                $('input[name="logo_2"]').val('{{url('/')}}'+response.url);
            }); 


            var myDropzone3 = new Dropzone("div#favicon_upload", { 
                 url: baseUrl+"/admin/upload/file_path",
                 maxFiles: 1,
                 params: {
                    _token: token1,
                    'folder': '/',
                  }
             });

             myDropzone3.on("success",function(file, response){ 
                $('input[name="favicon"]').val('');
                $('input[name="favicon"]').val('{{url('/')}}'+response.url);
            }); 


            var myDropzone4 = new Dropzone("div#upload_no_upload", { 
                 url: baseUrl+"/admin/upload/file_path",
                 maxFiles: 1,
                 params: {
                    _token: token1,
                    'folder': '/',
                  }
             });

             myDropzone4.on("success",function(file, response){ 
                $('input[name="no_image"]').val('');
                $('input[name="no_image"]').val('{{url('/')}}'+response.url);
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
                <h4 class="pull-left page-title">Logo Settings</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="#">{{config('blog.title')}}</a></li>
                    <li><a href="#">Logo Settings</a></li>
                    <li class="active">Update Logo Settings</li>
                </ol>
            </div>
        </div>

  

        <div class="row">

                <div class="col-sm-12">
                        <div class="panel panel-default">

                            <div class="panel-heading">
                                <h3 class="panel-title">Update Logo Settings</h3></div>
                            <div class="panel-body">

                                @include('admin.partials.errors')
                                @include('admin.partials.success')


                                <div class="form">
                                    <form class="cmxform form-horizontal tasi-form" id="poet_from" method="post" action="{{url('/admin/logo_settings',$settings->id)}}" >
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="_method" value="PATCH"/> 
                                    
                                    <div class="form-group">
                                          <div class="col-md-5">
                                            <div class="dropzone" id="logo_1_upload">
                                                   <div class="dz-message" data-dz-message><span>Upload Logo 1</span></div>
                                            </div>
                                          </div>
                                    </div>
          
                                   <div class="form-group">
                                        <div class="col-md-5">
                                          <input class="form-control" type="text" name="logo_1" value="{{$settings->logo_1}}" placeholder="Logo 1 Url"> 
                                        </div>
                                  </div>



                                    <div class="form-group">
                                          <div class="col-md-5">
                                            <div class="dropzone" id="logo_2_upload">
                                                   <div class="dz-message" data-dz-message><span>Upload Logo 2</span></div>
                                            </div>
                                          </div>
                                    </div>
          
                                   <div class="form-group">
                                        <div class="col-md-5">
                                          <input class="form-control" type="text" name="logo_2" value="{{$settings->logo_2}}" placeholder="Logo 2 Url"> 
                                        </div>
                                  </div>

                                  
                                   <div class="form-group">
                                        <div class="col-md-5">
                                          <div class="dropzone" id="favicon_upload">
                                                 <div class="dz-message" data-dz-message><span>Upload Favicon</span></div>
                                          </div>
                                        </div>
                                  </div>
                                  
                                   <div class="form-group">
                                        <div class="col-md-5">
                                          <input class="form-control" type="text" name="favicon" value="{{$settings->favicon}}" placeholder="Favicon Url"> 
                                        </div>
                                  </div>
                                  
                                  
                                   <div class="form-group">
                                        <div class="col-md-5">
                                          <div class="dropzone" id="upload_no_upload">
                                                 <div class="dz-message" data-dz-message><span>Upload No Image</span></div>
                                          </div>
                                        </div>
                                  </div>
                                  
                                   <div class="form-group">
                                        <div class="col-md-5">
                                          <input class="form-control" type="text" name="no_image" value="{{$settings->no_image}}" placeholder="No Image Url"> 
                                        </div>
                                  </div>
                            
		                            
                                        <div class="form-group">
                                            <div class="col-lg-offset-2 col-lg-10">
                                                <button class="btn btn-info waves-effect waves-light" type="submit">Update Settings</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- .form -->
                            </div>
                            <!-- panel-body -->
                        </div>
                        <!-- panel -->
                </div>


           
        </div>
        <!-- End Row -->
    </div>
@stop