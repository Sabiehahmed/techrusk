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

            var myDropzone2 = new Dropzone("div#main_image_upload", { 
                 url: baseUrl+"/admin/upload/file_path",
                 maxFiles: 1,
                 params: {
                    _token: token1,
                    'folder': '/',
                  }
             });

             myDropzone2.on("success",function(file, response){ 
                $('input[name="image"]').val('{{url('/')}}'+response.url);
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
                <h4 class="pull-left page-title">General Settings</h4>
                <ol class="breadcrumb pull-right">
                    <li><a href="#">{{config('blog.title')}}</a></li>
                    <li><a href="#">General Settings</a></li>
                    <li class="active">Update General Settings</li>
                </ol>
            </div>
        </div>

  

        <div class="row">

                <div class="col-sm-12">
                        <div class="panel panel-default">

                            <div class="panel-heading">
                                <h3 class="panel-title">Update Settings</h3></div>
                            <div class="panel-body">

                                @include('admin.partials.errors')


                                <div class="form">
                                    <form class="cmxform form-horizontal tasi-form" id="poet_from" method="post" action="{{url('/admin/settings',$settings->id)}}" >
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="_method" value="PATCH"/> 
                                    
                                     <div class="form-group">
                        					      <div class="col-md-5">
                        					        <input class="form-control" type="text" name="site_title" value="{{$settings->site_title}}" placeholder="Site Title"> 
                        					      </div>
                        				     </div>
                                	
                                	<div class="form-group">
                    					      <div class="col-md-5">
                    					        <input class="form-control" type="text" name="meta_keywords" value="{{$settings->meta_keywords}}" placeholder="Meta Keywords"> 
                    					      </div>
                    				     </div>
                    				     <div class="form-group">
                    					      <div class="col-md-5">
                    					        <input class="form-control" type="text" name="meta_description" value="{{$settings->meta_description}}" placeholder="Meta Description"> 
                    					      </div>
                    				     </div>

                                  <div class="form-group">
                                  <div class="col-md-12"><label for="footer_text">Footer Text</label>
                                  </div>
                                      <div class="col-md-5">
                                      <textarea name="footer_text" class="form-control">{{$settings->footer_text}}</textarea>
                                       
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